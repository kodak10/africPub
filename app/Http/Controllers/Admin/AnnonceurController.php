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

    public function validateProfil($id)
    {
        $annonceur = Annonceur::findOrFail($id);
        $annonceur->actif = 1;
        $annonceur->save();

        return response()->json(['message' => 'Profil validé avec succès !']);
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

