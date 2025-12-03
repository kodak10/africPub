<?php

namespace App\Http\Controllers\Annonceur;

use App\Http\Controllers\Controller;
use App\Models\Annonceur;
use App\Models\Publicite;
use App\Models\PaiementAnnonceur;
use App\Models\DemandeRemboursementAnnonceur;
use App\Models\Forfait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AnnonceurController extends Controller
{
    // Dashboard annonceur
    public function dashboard()
    {
        $annonceur = auth()->user()->annonceur;
        
        // Statistiques
        $totalPublicites = $annonceur->publicites()->count();
        $publicitesActives = $annonceur->publicites()->where('statut', 'validé')->count();
        $totalPaiements = $annonceur->paiementsAnnonceur()->where('statut', PaiementAnnonceur::STATUT_PAYE)->count();
        
        // Publicités récentes
        $publicitesRecentes = $annonceur->publicites()->with('forfait')->latest()->limit(5)->get();
        
        // Paiements récents
        $paiementsRecents = $annonceur->paiementsAnnonceur()->with('forfait')->latest()->limit(5)->get();
        
        // Statistiques de vues/clics
        $statsGlobales = [
            'total_vues' => $annonceur->publicites()->withCount('vues')->get()->sum('vues_count'),
            'total_clics' => $annonceur->publicites()->withCount('clics')->get()->sum('clics_count'),
            'taux_conversion' => 0
        ];
        
        if ($statsGlobales['total_vues'] > 0) {
            $statsGlobales['taux_conversion'] = ($statsGlobales['total_clics'] / $statsGlobales['total_vues']) * 100;
        }

        return view('dashboard.pages.annonceur.home', compact(
            'annonceur',
            'totalPublicites',
            'publicitesActives',
            'totalPaiements',
            'publicitesRecentes',
            'paiementsRecents',
            'statsGlobales'
        ));
    }

    // Formulaire création publicité
    public function createPublicite()
    {
        $forfaits = Forfait::get();
        return view('dashboard.pages.annonceur.publicites.create', compact('forfaits'));
    }

    // Liste des publicités
    public function publicites(Request $request)
    {
        $annonceur = auth()->user()->annonceur;

        $query = $annonceur->publicites()->with(['forfait', 'medias']);

        // Filtres
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('forfait_id')) {
            $query->where('forfait_id', $request->forfait_id);
        }

        $publicites = $query->latest()->paginate(10);
        $forfaits = Forfait::all();

        return view('dashboard.pages.annonceur.publicites.index', compact('publicites', 'forfaits'));
    }

    // Détails d'une publicité
    public function showPublicite($id)
    {
        $annonceur = auth()->user()->annonceur;

        $publicite = $annonceur->publicites()
            ->with(['forfait', 'medias', 'vues', 'clics'])
            ->findOrFail($id);

        // Statistiques de la publicité
        $stats = [
            'vues_total' => $publicite->vues->count(),
            'clics_total' => $publicite->clics->count(),
            'taux_conversion' => $publicite->vues->count() > 0 ? 
                ($publicite->clics->count() / $publicite->vues->count()) * 100 : 0,
            'vues_30j' => $publicite->vues()->where('created_at', '>=', now()->subDays(30))->count(),
            'clics_30j' => $publicite->clics()->where('created_at', '>=', now()->subDays(30))->count()
        ];

        return view('dashboard.pages.annonceur.publicites.show', compact('publicite', 'stats'));
    }

    // Stocker une nouvelle publicité
    public function storePublicite(Request $request)
{
    $request->validate([
        'titre' => 'required|string|max:255',
        'media_file' => 'required|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:10240',
        'url_cible' => 'required|url',
        'forfait_id' => 'required|exists:forfaits,id',
        'description' => 'nullable|string|max:500'
    ]);

    $annonceur = auth()->user()->annonceur;

    DB::transaction(function () use ($request, $annonceur) {
        $file = $request->file('media_file');
        $extension = strtolower($file->getClientOriginalExtension());

        // Déterminer automatiquement le type de média
        if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            $type_media = 'image';
        } elseif (in_array($extension, ['mp4', 'mov', 'avi'])) {
            $type_media = 'video';
        } else {
            throw new \Exception('Format de fichier non supporté.');
        }

        // Upload du fichier
        $mediaPath = $file->store('publicites', 'public');

        // Création de la publicité
        Publicite::create([
            'annonceur_id' => $annonceur->id ?? 1,
            'titre' => $request->titre,
            'type_media' => $type_media,
            'media_path' => $mediaPath,
            'url_cible' => $request->url_cible,
            'forfait_id' => $request->forfait_id,
            'statut' => 'en_attente_validation',
            'description' => $request->description
        ]);
    });

    return redirect()->route('annonceur.index_publicites')
        ->with('success', 'Publicité créée avec succès. Elle est en attente de validation par l\'administration.');
}


    // Rapports et statistiques
    public function rapports(Request $request)
    {
        $annonceur = auth()->user()->annonceur;
        
        // Période par défaut : 30 derniers jours
        $dateDebut = $request->filled('date_debut') ? $request->date_debut : now()->subDays(30)->format('Y-m-d');
        $dateFin = $request->filled('date_fin') ? $request->date_fin : now()->format('Y-m-d');

        // Statistiques globales
        $statsGlobales = [
            'total_vues' => $annonceur->publicites()->withCount(['vues' => function($query) use ($dateDebut, $dateFin) {
                $query->whereBetween('date_vue', [$dateDebut, $dateFin]);
            }])->get()->sum('vues_count'),
            
            'total_clics' => $annonceur->publicites()->withCount(['clics' => function($query) use ($dateDebut, $dateFin) {
                $query->whereBetween('date_clic', [$dateDebut, $dateFin]);
            }])->get()->sum('clics_count'),
            
            'publicites_actives' => $annonceur->publicites()->where('statut', 'validé')->count(),
            'investissement_total' => $annonceur->paiementsAnnonceur()->where('statut', 'paye')->sum('montant')
        ];

        $statsGlobales['taux_conversion'] = $statsGlobales['total_vues'] > 0 ? 
            ($statsGlobales['total_clics'] / $statsGlobales['total_vues']) * 100 : 0;

        // Performances par publicité
        $performancesPublicites = $annonceur->publicites()
            ->with('forfait')
            ->withCount([
                'vues as total_vues' => function ($query) use ($dateDebut, $dateFin) {
                    $query->whereBetween('date_vue', [$dateDebut, $dateFin]);
                },
                'clics as total_clics' => function ($query) use ($dateDebut, $dateFin) {
                    $query->whereBetween('date_clic', [$dateDebut, $dateFin]);
                },
            ])
            ->get()
            ->map(function ($publicite) {
                $publicite->taux_conversion = $publicite->total_vues > 0 ?
                    ($publicite->total_clics / $publicite->total_vues) * 100 : 0;
                return $publicite;
            });

        Log::info('Performances Publicités: ', $performancesPublicites->toArray());


        return view('dashboard.pages.annonceur.publicites.rapports', compact(
            'statsGlobales',
            'performancesPublicites',
            'dateDebut',
            'dateFin'
        ));
    }

    // Historique des paiements
    public function historiquePaiements(Request $request)
    {
        $annonceur = auth()->user()->annonceur;
        $query = $annonceur->paiementsAnnonceur()->with('forfait');

        // Filtres
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        $paiements = $query->latest()->paginate(15);

        // Statistiques
        $totalPaye = $paiements->where('statut', PaiementAnnonceur::STATUT_PAYE)->sum('montant');
        $totalEnAttente = $paiements->where('statut', PaiementAnnonceur::STATUT_EN_ATTENTE)->sum('montant');

        return view('dashboard.pages.annonceur.paiements.historique', compact(
            'paiements', 
            'totalPaye',
            'totalEnAttente'
        ));
    }

    // Détails d'un paiement
    public function showPaiement($id)
    {
        $annonceur = auth()->user()->annonceur;
        $paiement = $annonceur->paiementsAnnonceur()
            ->with(['forfait', 'demandesRemboursement'])
            ->findOrFail($id);

        return view('dashboard.pages.annonceur.paiements.show', compact('paiement'));
    }

    // Formulaire création demande de remboursement
    public function createRemboursement()
    {
        $annonceur = auth()->user()->annonceur;
        
        $paiementsRemboursables = $annonceur->paiementsAnnonceur()
            ->where('statut', PaiementAnnonceur::STATUT_PAYE)
            ->whereDoesntHave('demandesRemboursement', function($query) {
                $query->whereIn('statut', [
                    DemandeRemboursementAnnonceur::STATUT_EN_ATTENTE,
                    DemandeRemboursementAnnonceur::STATUT_APPROUVE
                ]);
            })
            ->with('forfait')
            ->get();

        return view('dashboard.pages.annonceur.paiements.remboursement', compact('paiementsRemboursables'));
    }

    // Stocker une demande de remboursement
    public function storeRemboursement(Request $request)
    {
        $request->validate([
            'paiement_annonceur_id' => 'required|exists:paiement_annonceurs,id',
            'montant' => 'required|numeric|min:0',
            'raison' => 'required|string|min:10|max:1000',
            'preuves.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120'
        ]);

        $annonceur = auth()->user()->annonceur;

        return DB::transaction(function () use ($request, $annonceur) {
            $paiement = $annonceur->paiementsAnnonceur()->findOrFail($request->paiement_annonceur_id);

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
                'annonceur_id' => $annonceur->id,
                'paiement_annonceur_id' => $request->paiement_annonceur_id,
                'montant' => $request->montant,
                'raison' => $request->raison,
                'preuves' => $preuvesPaths,
                'statut' => DemandeRemboursementAnnonceur::STATUT_EN_ATTENTE
            ]);

            return redirect()->route('annonceur.paiements.historique')
                ->with('success', 'Demande de remboursement créée avec succès. Elle sera traitée par l\'administration.');
        });
    }
}