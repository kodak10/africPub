<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Media;
use App\Models\DemandePaiement;
use App\Models\PaiementMedia;
use App\Models\Annonceur;
use App\Models\PaiementAnnonceur;
use App\Models\DemandeRemboursementAnnonceur;
class AdminController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.admin.home');
    }

    public function rapport()
    {
        // Résumé global
        $total_revenu_medias = PaiementMedia::where('statut', 'complet')->sum('montant');
        $total_revenu_annonceurs = PaiementAnnonceur::where('statut', 'paye')->sum('montant');
        $total_remboursements = DemandeRemboursementAnnonceur::where('statut', 'rembourse')->sum('montant');

        // Répartition des revenus médias par media
        $medias = Media::with(['paiementsMedia'])->get();
        $media_labels = $medias->pluck('nom_du_media');
        $media_revenus = $medias->map(fn($m) => $m->paiementsMedia()->where('statut','complet')->sum('montant'));

        // Répartition des revenus annonceurs par forfait
        $forfaits = PaiementAnnonceur::with('forfait')->get()->groupBy('forfait.libelle');
        $forfait_labels = $forfaits->keys();
        $forfait_revenus = $forfaits->map(fn($f) => $f->sum('montant'));

        // Demandes de paiement en attente
        $paiements_en_attente = DemandePaiement::where('statut','en_attente')->get();
        $remboursements_en_attente = DemandeRemboursementAnnonceur::where('statut','en_attente')->get();

        return view('dashboard.pages.admin.rapport', compact(
            'total_revenu_medias',
            'total_revenu_annonceurs',
            'total_remboursements',
            'media_labels',
            'media_revenus',
            'forfait_labels',
            'forfait_revenus',
            'paiements_en_attente',
            'remboursements_en_attente'
        ));
    }
}
