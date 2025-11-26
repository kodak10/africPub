<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Media;
use App\Models\Annonceur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('home.auth.login');
    }

    public function showRegisterForm()
    {
        return view('home.auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Redirection basée sur le rôle
            if ($user->hasRole('SuperAdmin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('Admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('Proprietaire')) {
                return redirect()->route('proprietaire.dashboard');
            } elseif ($user->hasRole('Media')) {
                return redirect()->route('media.dashboard');
            } elseif ($user->hasRole('Annonceur')) {
                return redirect()->route('annonceur.dashboard');
            }
            
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Les identifiants ne correspondent pas.',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'role_type' => 'required|in:media,annonceur',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->role_type === 'media') {
            $request->validate([
                'name' => 'required|string|max:255',
                'url_site' => 'required|url',
                'numero_rccm' => 'required|string',
                'telephone' => 'required|string',
                'adresse' => 'required|string',
            ]);

            // Création du média
            Media::create([
                'user_id' => $user->id,
                'nom_du_media' => $request->name,
                'url_site' => $request->url_site,
                'numero_rccm' => $request->numero_rccm,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'adresse' => $request->adresse,
                'media_token' => Str::uuid(),

            ]);

            $user->assignRole('Media');
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'telephone_annonceur' => 'nullable|string',
                'adresse_annonceur' => 'nullable|string',
            ]);

            // Création de l'annonceur
            Annonceur::create([
                'nom' => $request->name,
                'email' => $request->email,
                'telephone' => $request->telephone_annonceur,
                'adresse' => $request->adresse_annonceur,
            ]);

            $user->assignRole('Annonceur');
        }

        Auth::login($user);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}