<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DemandePaiement;
use App\Models\Media;
use App\Models\PaiementMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PaiementController extends Controller
{
    // Liste des demandes de paiement
    public function index(Request $request)
    {
        $query = DemandePaiement::with('media')->latest();

        // Filtres
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('media_id')) {
            $query->where('media_id', $request->media_id);
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        $demandes = $query->paginate(20);
        $medias = Media::all();

        return view('dashboard.pages.admin.paiements.index', compact('demandes', 'medias'));
    }

    // Page de paiement
    public function showPaiement($id)
    {
        $demande = DemandePaiement::with('media')->findOrFail($id);
        
        // Vérifier si un paiement existe déjà pour cette demande
        $paiementExistant = PaiementMedia::where('demande_paiement_id', $id)->first();
        
        if ($paiementExistant) {
            return redirect()->route('admin.paiements.index')
                ->with('error', 'Un paiement existe déjà pour cette demande.');
        }

        // Analyser la fraude avancée
        $analyseFraude = $demande->media->analyserFraudeAvancee();
        
        return view('dashboard.pages.admin.paiements.cash', compact('demande', 'analyseFraude'));
    }

    // Traitement du paiement - CORRIGÉ
    public function processPaiement(Request $request, $id)
    {
        $request->validate([
            'methode_paiement' => 'required|string|in:orange_money,mtn_money,wave,virement_bancaire,especes',
            'numero_telephone' => 'required|string',
            //'password_confirmation' => 'required'
        ]);

        // Vérification du mot de passe administrateur (optionnel)
        // if (!Hash::check($request->password_confirmation, auth()->user()->password)) {
        //     return back()->withErrors(['password_confirmation' => 'Mot de passe incorrect']);
        // }

        return DB::transaction(function () use ($request, $id) {
            $demande = DemandePaiement::with('media')->findOrFail($id);
            $media = $demande->media;

            // Vérifier si un paiement existe déjà
            $paiementExistant = PaiementMedia::where('demande_paiement_id', $id)->first();
            if ($paiementExistant) {
                return back()->with('error', 'Un paiement existe déjà pour cette demande.');
            }

            // CORRECTION : Création du paiement média d'abord
            $paiementMedia = PaiementMedia::create([
                'media_id' => $media->id,
                'demande_paiement_id' => $demande->id,
                'montant' => $demande->montant,
                'methode_paiement' => $request->methode_paiement,
                'numero_telephone' => $request->numero_telephone,
                'reference_transaction' => PaiementMedia::genererReference(),
                'statut' => PaiementMedia::STATUT_COMPLET,
                'date_paiement' => now(),
                'preuve_paiement' => $request->hasFile('preuve_paiement') ? 
                    $request->file('preuve_paiement')->store('preuves_paiement', 'public') : null
            ]);

            // Mise à jour de la demande
            $demande->update(['statut' => DemandePaiement::STATUT_PAYE]);

            // Réinitialisation des compteurs du média
            $media->reinitialiserCompteurs();

            return redirect()->route('admin.paiements.index')
                ->with('success', 'Paiement effectué avec succès et compteurs réinitialisés.');
        });
    }

    // Créer une demande de paiement
    public function creerDemande($mediaId)
    {
        $media = Media::findOrFail($mediaId);
        
        // Vérifier si le média a des vues/clics
        if ($media->total_vues == 0 && $media->total_clics == 0) {
            return redirect()->route('admin.paiements.index')
                ->with('error', 'Ce média n\'a aucune vue ou clic à payer.');
        }

        // Vérifier s'il y a déjà une demande en attente
        $demandeExistante = $media->demandesPaiementEnAttente()->first();
        
        if ($demandeExistante) {
            return redirect()->route('admin.paiements.index')
                ->with('error', 'Une demande de paiement est déjà en attente pour ce média.');
        }

        // Créer la demande
        $demande = $media->creerDemandePaiement();

        return redirect()->route('admin.paiements.index')
            ->with('success', 'Demande de paiement créée avec succès. Montant: ' . $demande->montant_formate);
    }

    // Rejeter une demande
    public function rejeterDemande(Request $request, $id)
    {
        $request->validate(['raison' => 'required|string|min:10']);

        $demande = DemandePaiement::findOrFail($id);
        
        // Vérifier si la demande n'est pas déjà payée
        if ($demande->statut === DemandePaiement::STATUT_PAYE) {
            return back()->with('error', 'Impossible de rejeter une demande déjà payée.');
        }

        $demande->update([
            'statut' => DemandePaiement::STATUT_REJETE,
            'raison_fraude' => $request->raison
        ]);

        return back()->with('success', 'Demande rejetée avec succès.');
    }

    // Méthode utilitaire pour obtenir le libellé de la méthode de paiement
    private function getMethodePaiementLibelle($methode)
    {
        $libelles = [
            'orange_money' => 'Orange Money',
            'mtn_money' => 'MTN Money',
            'wave' => 'Wave',
            'virement_bancaire' => 'Virement Bancaire',
            'especes' => 'Espèces'
        ];

        return $libelles[$methode] ?? $methode;
    }




    public function historiquePaiements(Request $request)
    {
        $query = PaiementMedia::with(['media', 'demandePaiement'])->latest();

        // Filtres
        if ($request->filled('media_id')) {
            $query->where('media_id', $request->media_id);
        }

        if ($request->filled('methode_paiement')) {
            $query->where('methode_paiement', $request->methode_paiement);
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('date_paiement', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('date_paiement', '<=', $request->date_fin);
        }

        $paiements = $query->paginate(20);
        $medias = Media::all();
        
        // Statistiques
        $totalPaiements = $paiements->total();
        $montantTotal = $paiements->sum('montant');
        $paiementsComplets = PaiementMedia::where('statut', PaiementMedia::STATUT_COMPLET)->count();

        return view('dashboard.pages.admin.paiements.historique', compact(
            'paiements', 
            'medias',
            'totalPaiements',
            'montantTotal',
            'paiementsComplets'
        ));
    }

    public function showDetailsPaiement($id)
    {
        $paiement = PaiementMedia::with(['media', 'demandePaiement'])
            ->findOrFail($id);

        return view('dashboard.pages.admin.paiements.details-paiement', compact('paiement'));
    }
}