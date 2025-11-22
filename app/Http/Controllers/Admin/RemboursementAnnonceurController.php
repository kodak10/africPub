<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Annonceur;
use App\Models\DemandeRemboursementAnnonceur;
use App\Models\HistoriqueRemboursementAnnonceur;
use App\Models\PaiementAnnonceur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RemboursementAnnonceurController extends Controller
{
    // Liste des demandes de remboursement
    public function index(Request $request)
    {
        $query = DemandeRemboursementAnnonceur::with(['annonceur', 'paiementAnnonceur'])->latest();

        // Filtres
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('annonceur_id')) {
            $query->where('annonceur_id', $request->annonceur_id);
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        $demandes = $query->paginate(20);
        $annonceurs = Annonceur::all();

        // Statistiques
        $totalEnAttente = DemandeRemboursementAnnonceur::where('statut', DemandeRemboursementAnnonceur::STATUT_EN_ATTENTE)->count();
        $totalApprouve = DemandeRemboursementAnnonceur::where('statut', DemandeRemboursementAnnonceur::STATUT_APPROUVE)->count();
        $montantTotal = DemandeRemboursementAnnonceur::where('statut', DemandeRemboursementAnnonceur::STATUT_APPROUVE)->sum('montant');

        return view('dashboard.pages.admin.remboursements.index', compact(
            'demandes', 
            'annonceurs',
            'totalEnAttente',
            'totalApprouve',
            'montantTotal'
        ));
    }

    // Formulaire de création de demande
    public function create($paiementId = null)
    {
        $paiement = null;
        $annonceurs = Annonceur::has('paiementsAnnonceur')->with('paiementsAnnonceur')->get();

        if ($paiementId) {
            $paiement = PaiementAnnonceur::with(['annonceur', 'forfait'])->findOrFail($paiementId);
            
            // Vérifier si le paiement peut être remboursé
            if (!$paiement->peutEtreRembourse()) {
                return redirect()->route('admin.remboursements-annonceurs.index')
                    ->with('error', 'Ce paiement ne peut pas être remboursé.');
            }
        }

        return view('dashboard.pages.admin.remboursements.create', compact('paiement', 'annonceurs'));
    }

    // Traitement de la création de demande
    public function store(Request $request)
    {
        $request->validate([
            'paiement_annonceur_id' => 'required|exists:paiement_annonceurs,id',
            'montant' => 'required|numeric|min:0',
            'raison' => 'required|string|min:10|max:1000',
            'preuves.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120'
        ]);

        return DB::transaction(function () use ($request) {
            $paiement = PaiementAnnonceur::with('annonceur')->findOrFail($request->paiement_annonceur_id);

            // Vérifier si le paiement peut être remboursé
            if (!$paiement->peutEtreRembourse()) {
                return back()->with('error', 'Ce paiement ne peut pas être remboursé.');
            }

            // Vérifier si une demande existe déjà pour ce paiement
            $demandeExistante = DemandeRemboursementAnnonceur::where('paiement_annonceur_id', $request->paiement_annonceur_id)
                ->whereIn('statut', [
                    DemandeRemboursementAnnonceur::STATUT_EN_ATTENTE, 
                    DemandeRemboursementAnnonceur::STATUT_APPROUVE
                ])
                ->first();

            if ($demandeExistante) {
                return back()->with('error', 'Une demande de remboursement est déjà en cours pour ce paiement.');
            }

            // Vérifier que le montant ne dépasse pas le montant du paiement
            if ($request->montant > $paiement->montant) {
                return back()->with('error', 'Le montant demandé ne peut pas dépasser le montant du paiement (' . number_format($paiement->montant, 0, ',', ' ') . ' FCFA).');
            }

            // Traitement des fichiers de preuve
            $preuvesPaths = [];
            if ($request->hasFile('preuves')) {
                foreach ($request->file('preuves') as $file) {
                    $preuvesPaths[] = $file->store('preuves_remboursement_annonceurs', 'public');
                }
            }

            // Création de la demande
            $demande = DemandeRemboursementAnnonceur::create([
                'annonceur_id' => $paiement->annonceur_id,
                'paiement_annonceur_id' => $request->paiement_annonceur_id,
                'montant' => $request->montant,
                'raison' => $request->raison,
                'preuves' => $preuvesPaths,
                'statut' => DemandeRemboursementAnnonceur::STATUT_EN_ATTENTE
            ]);

            return redirect()->route('admin.remboursements-annonceurs.index')
                ->with('success', 'Demande de remboursement créée avec succès.');
        });
    }

    // Détails d'une demande
    public function show($id)
    {
        $demande = DemandeRemboursementAnnonceur::with(['annonceur', 'paiementAnnonceur.forfait'])
            ->findOrFail($id);

        return view('dashboard.pages.admin.remboursements.show', compact('demande'));
    }

    // Approuver une demande
    public function approuverDemande($id)
    {
        return DB::transaction(function () use ($id) {
            $demande = DemandeRemboursementAnnonceur::findOrFail($id);

            if (!$demande->estEnAttente()) {
                return back()->with('error', 'Seules les demandes en attente peuvent être approuvées.');
            }

            $demande->update([
                'statut' => DemandeRemboursementAnnonceur::STATUT_APPROUVE
            ]);

            return back()->with('success', 'Demande de remboursement approuvée avec succès.');
        });
    }

    // Rejeter une demande
    public function rejeterDemande(Request $request, $id)
    {
        $request->validate([
            'raison_rejet' => 'required|string|min:10|max:500'
        ]);

        return DB::transaction(function () use ($request, $id) {
            $demande = DemandeRemboursementAnnonceur::findOrFail($id);

            if (!$demande->estEnAttente()) {
                return back()->with('error', 'Seules les demandes en attente peuvent être rejetées.');
            }

            $demande->update([
                'statut' => DemandeRemboursementAnnonceur::STATUT_REJETE,
                'raison_rejet' => $request->raison_rejet
            ]);

            return back()->with('success', 'Demande de remboursement rejetée avec succès.');
        });
    }

    // Traitement du remboursement
    public function processRemboursement(Request $request, $id)
    {
        $request->validate([
            'methode_remboursement' => 'required|string|in:virement_bancaire,carte_credit,cheque,credit_plateforme',
            'reference_remboursement' => 'required|string',
            'date_remboursement' => 'required|date'
        ]);

        return DB::transaction(function () use ($request, $id) {
            $demande = DemandeRemboursementAnnonceur::findOrFail($id);

            if (!$demande->peutEtreRembourse()) {
                return back()->with('error', 'Cette demande ne peut pas être remboursée.');
            }

            $demande->update([
                'statut' => DemandeRemboursementAnnonceur::STATUT_REMBOURSE,
                'methode_remboursement' => $request->methode_remboursement,
                'reference_remboursement' => $request->reference_remboursement,
                'date_remboursement' => $request->date_remboursement
            ]);

            return back()->with('success', 'Remboursement effectué avec succès.');
        });
    }

    // Historique des remboursements
    public function historique(Request $request)
    {
        $query = DemandeRemboursementAnnonceur::with(['annonceur', 'paiementAnnonceur'])
            ->where('statut', DemandeRemboursementAnnonceur::STATUT_REMBOURSE)
            ->latest();

        // Filtres
        if ($request->filled('annonceur_id')) {
            $query->where('annonceur_id', $request->annonceur_id);
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('date_remboursement', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('date_remboursement', '<=', $request->date_fin);
        }

        $remboursements = $query->paginate(20);
        $annonceurs = Annonceur::all();

        // Statistiques
        $totalRembourse = $remboursements->total();
        $montantTotal = $remboursements->sum('montant');

        return view('dashboard.pages.admin.remboursements-annonceurs.historique', compact(
            'remboursements',
            'annonceurs',
            'totalRembourse',
            'montantTotal'
        ));
    }

    // Récupérer les paiements d'un annonceur pour le formulaire (AJAX)
    public function getPaiementsAnnonceur($annonceurId)
    {
        $paiements = PaiementAnnonceur::with('forfait')
            ->where('annonceur_id', $annonceurId)
            ->where('statut', PaiementAnnonceur::STATUT_PAYE)
            ->whereDoesntHave('demandesRemboursement', function($query) {
                $query->whereIn('statut', [
                    DemandeRemboursementAnnonceur::STATUT_EN_ATTENTE,
                    DemandeRemboursementAnnonceur::STATUT_APPROUVE,
                    DemandeRemboursementAnnonceur::STATUT_REMBOURSE
                ]);
            })
            ->get()
            ->map(function($paiement) {
                return [
                    'id' => $paiement->id,
                    'text' => 'Facture #' . $paiement->numero_facture . ' - ' . 
                             number_format($paiement->montant, 0, ',', ' ') . ' FCFA - ' .
                             ($paiement->forfait->libelle ?? 'Forfait')
                ];
            });

        return response()->json($paiements);
    }

    // Récupérer les détails d'un paiement (AJAX)
    public function getDetailsPaiement($paiementId)
    {
        $paiement = PaiementAnnonceur::with(['annonceur', 'forfait'])
            ->findOrFail($paiementId);

        return response()->json([
            'montant' => $paiement->montant,
            'annonceur' => $paiement->annonceur->nom,
            'forfait' => $paiement->forfait->libelle ?? 'Non spécifié',
            'numero_facture' => $paiement->numero_facture
        ]);
    }
}