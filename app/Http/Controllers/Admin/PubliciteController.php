<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Annonceur;
use Illuminate\Http\Request;
use App\Models\Publicite;
use App\Models\Media;
use App\Models\User;

use App\Models\Forfait;
use App\Models\PubliciteMedia;
use Illuminate\Support\Facades\Log;

class PubliciteController extends Controller
{

public function index(Request $request)
{
    $medias = Media::all();
    $annonceurs = Annonceur::where('statut', 'validé')->get();

    $query = Publicite::query()->with(['annonceur','medias']);

    // Filtres
    if ($request->filled('statut')) {
        $query->where('statut', $request->statut);
    }
    if ($request->filled('media_id')) {
        $query->whereHas('medias', function($q) use ($request){
            $q->where('media_id', $request->media_id);
        });
    }
    if ($request->filled('annonceur_id')) {
        $query->where('annonceur_id', $request->annonceur_id);
    }
    if ($request->filled('min_vues')) {
        $query->whereHas('vues', function($q) use ($request){
            $q->havingRaw('COUNT(*) >= ?', [$request->min_vues]);
        });
    }
    if ($request->filled('max_vues')) {
        $query->whereHas('vues', function($q) use ($request){
            $q->havingRaw('COUNT(*) <= ?', [$request->max_vues]);
        });
    }

    // Vérifie si au moins un filtre est rempli
    $hasSearch = $request->filled('statut') || $request->filled('media_id') || $request->filled('annonceur_id')
                 || $request->filled('min_vues') || $request->filled('max_vues')
                 || ($request->filled('periode_start') && $request->filled('periode_end'));

    $publicites = $hasSearch ? $query->get() : collect();

    return view('dashboard.pages.admin.publicites.index', compact('publicites','medias','annonceurs'));
}



  public function changeStatus(Request $request, $id, $status)
{
    // Récupérer la publicité
    $pub = Publicite::findOrFail($id);

    // Vérifie si le statut demandé est valide
    $validStatuses = ['brouillon', 'en_attente_paiement', 'en_attente_validation', 'validé', 'rejete', 'approuve', 'suspendu'];

    if (!in_array($status, $validStatuses)) {
        return redirect()->route('admin.publicites.index', $request->query())
                         ->with('error', 'Statut non valide pour ce changement!');
    }

    // Changer le statut en fonction de l'action
    if ($status == 'validé') {
        // Si la publicité est en 'brouillon', 'en_attente_validation', ou 'en_attente_paiement', on peut la valider
        if (in_array($pub->statut, ['brouillon', 'en_attente_paiement', 'en_attente_validation'])) {
            $pub->statut = 'validé';  // Marquer comme 'validé'
        } else {
            return redirect()->route('admin.publicites.index', $request->query())
                             ->with('error', 'La publicité ne peut pas être validée dans son état actuel.');
        }
    } elseif ($status == 'suspendu') {
        // Suspendre la publicité, ici on la marque comme 'rejete'
        if ($pub->statut == 'validé' || $pub->statut == 'approuve') {
            $pub->statut = 'rejete';  // Marquer comme 'rejete' pour suspendre
        } else {
            return redirect()->route('admin.publicites.index', $request->query())
                             ->with('error', 'La publicité ne peut pas être suspendue dans son état actuel.');
        }
    }

    // Sauvegarder la modification
    $pub->save();

    // Rediriger avec un message de succès
    return redirect()->route('admin.publicites.index', $request->query())
                     ->with('success', "Le statut de la publicité a été mis à jour avec succès : $status");
}




public function assignMediaToPublicite(Request $request)
{
    // Récupérer les filtres de recherche
    $mediaId = $request->input('media_id');
    $annonceurId = $request->input('annonceur_id');
    $forfaitId = $request->input('forfait_id'); // Ajout du filtre forfait
    $pourcentage = $request->input('pourcentage'); // Pourcentage basé sur les vues

    // Récupérer toutes les publicités approuvées en fonction des filtres
    $query = Publicite::where('statut', 'validé');

    // Filtrage par Annonceur
    if ($annonceurId) {
        $query->where('annonceur_id', $annonceurId);
    }

    // Filtrage par Forfait
    if ($forfaitId) {
        $query->where('forfait_id', $forfaitId); // Filtrer par forfait
    }

    // Filtrage par Pourcentage de vues basé sur l'objectif du forfait
    if ($pourcentage && $forfaitId) {
        $forfait = Forfait::find($forfaitId);
        if ($forfait) {
            $objectifVues = $forfait->objectif_vues; // Objectif des vues du forfait
            $minVues = ($objectifVues * $pourcentage) / 100; // Calculer le seuil de vues en fonction du pourcentage
            $query->where('vues', '>=', $minVues); // Filtrer les publicités avec vues >= seuil calculé
        }
    }

    // Récupérer les publicités après application des filtres
    $publicites = $query->get();

    // Charger tous les médias disponibles, annonceurs et forfaits
    $medias = Media::where('statut', 'validé')->get();
    $annonceurs = Annonceur::where('statut', 'validé')->get();
    $forfaits = Forfait::all(); // Récupérer tous les forfaits

    // Ajouter le nombre de vues et l'objectif de vues à chaque publicité
    foreach ($publicites as $publicite) {
        $publicite->nombre_vues = $publicite->vues()->count(); // Compter le nombre de vues liées à la publicité
        $publicite->objectif_vues = $publicite->forfait ? $publicite->forfait->objectif_vues : null; // Récupérer l'objectif de vues du forfait
    }

    // Retourner la vue avec les publicités filtrées, médias, annonceurs et forfaits
    return view('dashboard.pages.admin.publicites.assign-media', compact('publicites', 'medias', 'annonceurs', 'forfaits'));
}






    public function assignMediaToPubliciteStore(Request $request, $publiciteId)
{
    try {
        // Validation des données
        $validated = $request->validate([
            'media_ids' => 'required|array',
            'media_ids.*' => 'exists:medias,id',
        ]);

        // Trouver la publicité par son ID
        $publicite = Publicite::findOrFail($publiciteId);

        // Détacher les anciens médias associés à cette publicité
        $publicite->medias()->detach();

        // Ajouter les nouveaux médias
        foreach ($validated['media_ids'] as $mediaId) {
            $publicite->medias()->attach($mediaId);
        }

        // Message de succès
        return redirect()->route('admin.publicites.assign-media')
            ->with('success', 'Médias affectés avec succès à la publicité.');

    } catch (\Exception $e) {
        // En cas d'erreur
        return redirect()->route('admin.publicites.assign-media')
            ->with('error', 'Une erreur est survenue. Veuillez réessayer.');
    }
}




}

