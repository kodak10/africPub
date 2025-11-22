<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Annonceur;
use Illuminate\Http\Request;

class AnnonceurController extends Controller
{
    public function index()
    {
        $annonceurs = Annonceur::get();

        return view('dashboard.pages.admin.annonceurs.index', compact('annonceurs'));
    }

     public function toggleStatus($id, $action)
    {
        $annonceur = Annonceur::findOrFail($id);

        if ($action === 'validate') {
            $annonceur->statut = 'validé';
            $annonceur->save();
            session()->flash('success', 'Annonceur validé avec succès !');
        } elseif ($action === 'suspend') {
            $annonceur->statut = 'suspendu';
            $annonceur->save();
            session()->flash('success', 'Annonceur suspendu avec succès !');
        } else {
            session()->flash('error', 'Action inconnue');
        }

        return redirect()->route('admin.annonceurs.index');
    }



    public function show($id)
    {
        $annonceur = Annonceur::with('publicites')->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $annonceur
        ]);
    }
}

