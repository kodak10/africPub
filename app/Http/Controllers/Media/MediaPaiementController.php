<?php

namespace App\Http\Controllers\Media;
use App\Http\Controllers\Controller;

use App\Models\Media;
use App\Models\PaiementMedia;
use App\Models\DemandePaiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MediaPaiementController extends Controller
{
    public function historique()
    {
        $user = auth()->user();
        $media = Media::where('user_id', $user->id)->first();

        if (!$media) {
            return back()->with('error', 'Aucun média trouvé.');
        }

        $paiements = $media->paiementsMedia()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $statistiquesPaiements = [
            'total_paye' => $media->paiementsComplets()->sum('montant'),
            'montant_moyen' => $media->paiementsComplets()->avg('montant') ?? 0,
            'paiements_total' => $media->paiementsComplets()->count(),
            'dernier_paiement' => $media->paiementsComplets()->latest()->first()
        ];

        return view('dashboard.pages.media.paiements.historique', compact(
            'media',
            'paiements',
            'statistiquesPaiements'
        ));
    }

//     public function reclamation()
// {
    

//     $media = Media::first();

//     if (!$media) {
//         return back()->with('error', 'Aucun média trouvé.');
//     }

//     // Vérifier l'éligibilité au paiement
//     $eligibilite = $media->estEligiblePaiement();
    
//     // Dernières demandes de paiement
//     $demandesRecent = $media->demandesPaiement()
//         ->orderBy('created_at', 'desc')
//         ->take(5)
//         ->get();

//     return view('dashboard.pages.media.paiements.reclamation', compact(
//         'media',
//         'eligibilite',
//         'demandesRecent'
//     ));
// }

public function reclamation()
{
    $media = Media::first();
    

    if (!$media) {
        return back()->with('error', 'Aucun média trouvé.');
    }


    // Récupérer le paiement lié — ici je prends le dernier paiement du média
    // Adapte si tu as une relation différente (ex: $media->paiements())
    $paiement = $media->paiementsMedia()->orderBy('created_at', 'desc')->first();

    // Si pas de paiement trouvé, on crée un objet null-safe pour la vue
    if (!$paiement) {
        $paiement = null;
    }

    // Vérifier l'éligibilité au paiement
    $eligibilite = $media->estEligiblePaiement();

    // Dernières demandes de paiement (pivot/table demandes)
    $demandesRecent = $media->demandesPaiement()
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    // Construire les statistiques attendues par la vue
    // Remplace les calculs par ceux qui correspondent à ton modèle/BDD si nécessaire
    $vuesCouvertes = 0;
    $clicsCouverts = 0;
    $periodeCouverte = 'Personnalisée';

    if ($paiement) {
        // Exemple d'obtention des stats : adapte selon tes colonnes/relations
        // Supposons que le paiement contient des métadonnées ou que tu peux calculer par rapport aux publicites liées
        // Exemple simple : chercher dans la table pivot publicite_media les enregistrements liés au paiement (si tu as)
        // Ici on fait un calcul basique depuis le média ou depuis le paiement (à adapter)

        // Si tu as des champs spécifiques sur paiement, utilise-les. Sinon on calcule depuis le média :
        $vuesCouvertes = $paiement->vues_couvertes ?? $media->total_vues ?? 0;
        $clicsCouverts = $paiement->clics_couverts ?? $media->total_clics ?? 0;

        // Exemple de période : si paiement possède date_debut/date_fin
        if (!empty($paiement->date_debut) && !empty($paiement->date_fin)) {
            $periodeCouverte = $paiement->date_debut->format('d/m/Y') . ' - ' . $paiement->date_fin->format('d/m/Y');
        } else {
            // fallback : utiliser created_at
            $periodeCouverte = $paiement->created_at ? $paiement->created_at->format('d/m/Y') : 'Personnalisée';
        }
    }

    $statistiquesPaiement = [
        'vues_couvertes'  => (int) $vuesCouvertes,
        'clics_couverts'  => (int) $clicsCouverts,
        'periode_couverte' => $periodeCouverte,
    ];

    return view('dashboard.pages.media.paiements.reclamation', compact(
        'media',
        'eligibilite',
        'demandesRecent',
        'paiement',
        'statistiquesPaiement'
    ));
}


public function demanderPaiement(Request $request)
{
    $user = auth()->user();
    
    if (!$user) {
        return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
    }

    $media = Media::where('user_id', $user->id)->first();

    if (!$media) {
        return back()->with('error', 'Aucun média trouvé.');
    }

    // Vérifier l'éligibilité
    $eligibilite = $media->estEligiblePaiement();
    if (!$eligibilite['eligible']) {
        return back()->with('error', 
            "Solde insuffisant. Minimum requis: " . number_format($eligibilite['montant_minimum'], 0, ',', ' ') . 
            " FCFA. Votre solde: " . number_format($eligibilite['solde_actuel'], 0, ',', ' ') . " FCFA");
    }

    // Vérifier s'il y a déjà une demande en cours
    if ($media->paiement_demande) {
        return back()->with('error', 'Vous avez déjà une demande de paiement en cours.');
    }

    try {
        DB::beginTransaction();

        // Créer la demande de paiement
        $demandePaiement = $media->creerDemandePaiement();

        // Créer l'entrée dans paiements_media
        $paiement = PaiementMedia::create([
            'media_id' => $media->id,
            'demande_paiement_id' => $demandePaiement->id,
            'montant' => $eligibilite['solde_actuel'],
            'statut' => PaiementMedia::STATUT_ATTENTE_CONFIRMATION,
            'date_demande' => now(),
            'methode_paiement' => $request->get('methode_paiement', 'orange_money'),
            'numero_compte' => $request->get('numero_compte')
        ]);

        DB::commit();

        return redirect()->route('media.paiements.detail', $paiement->id)
            ->with('success', 'Demande de paiement envoyée avec succès!');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Erreur lors de la demande: ' . $e->getMessage());
    }
}

public function detailPaiement($id)
{
    

    $media = Media::first();

    if (!$media) {
        return back()->with('error', 'Aucun média trouvé.');
    }

    // Récupérer le paiement avec vérification
    $paiement = PaiementMedia::where('id', $id)
        ->where('media_id', $media->id)
        ->first();

    if (!$paiement) {
        return back()->with('error', 'Paiement non trouvé.');
    }

    // Statistiques associées à ce paiement
    $statistiquesPaiement = [
        'vues_couvertes' => $media->total_vues,
        'clics_couverts' => $media->total_clics,
        'periode_couverte' => $paiement->created_at->format('d/m/Y') . ' - ' . now()->format('d/m/Y')
    ];

    return view('dashboard.pages.media.paiements.detail', compact(
        'paiement',
        'media',
        'statistiquesPaiement'
    ));
}
}