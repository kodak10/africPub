<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Media;
use App\Models\Publicite;
use App\Models\VuePublicite;
use App\Models\ClicPublicite;

/*
|--------------------------------------------------------------------------
| API Routes pour les Médias (avec token)
|--------------------------------------------------------------------------
*/

// Routes protégées par token média
Route::prefix('media')->middleware(['verify.media.token'])->group(function () {
    
    /**
     * GET /api/media/publicites
     * Récupérer les publicités affectées au média
     */
    Route::get('/publicites', function (Request $request) {
        $media = $request->get('media');
        
        if (!$media) {
            return response()->json([
                'success' => false,
                'message' => 'Média non trouvé'
            ], 404);
        }
        
        // Récupérer les publicités actives via la table pivot
        $publicites = $media->publicites()
            ->where('publicites.statut', 'validé')
            ->where('publicite_media.status', 'active')
            ->where(function($q) {
                // Vérifier la date d'expiration si elle existe
                $q->whereNull('publicite_media.date_expiration')
                  ->orWhere('publicite_media.date_expiration', '>=', now());
            })
            ->with('annonceur')
            ->orderBy('publicite_media.ordre_priorite', 'desc')
            ->orderBy('publicite_media.created_at', 'asc')
            ->get();
        
        return response()->json([
            'success' => true,
            'media' => [
                'id' => $media->id,
                'nom' => $media->nom_du_media,
                'url_site' => $media->url_site,
                'logo' => $media->logo_media ? asset('storage/' . $media->logo_media) : null
            ],
            'total_publicites' => $publicites->count(),
            'publicites' => $publicites->map(function($pub) {
                // Construire le chemin complet du média
                $mediaPath = $pub->media_path;
                if ($mediaPath && !filter_var($mediaPath, FILTER_VALIDATE_URL)) {
                    $mediaPath = asset('storage/' . $mediaPath);
                }
                
                return [
                    'id' => $pub->id,
                    'titre' => $pub->titre,
                    'description' => $pub->description ?? 'Découvrez cette offre exclusive',
                    'type_media' => $pub->type_media,
                    'media_path' => $mediaPath,
                    'url_cible' => $pub->url_cible,
                    'annonceur_id' => $pub->annonceur_id,
                    'annonceur_nom' => $pub->annonceur->nom ?? 'Annonceur',
                    'vues_restantes' => $pub->pivot->vues_restantes ?? 0,
                    'ordre_priorite' => $pub->pivot->ordre_priorite ?? 0,
                    'date_expiration' => $pub->pivot->date_expiration,
                    'est_expiree' => $pub->pivot->date_expiration ? now()->gt($pub->pivot->date_expiration) : false
                ];
            })
        ]);
    });
    
    /**
     * POST /api/media/record-view
     * Enregistrer une vue sur une publicité
     */
    Route::post('/record-view', function (Request $request) {
        $media = $request->get('media');
        
        $validated = $request->validate([
            'publicite_id' => 'required|exists:publicites,id',
        ]);
        
        try {
            // Générer une empreinte unique pour le visiteur (IP + UserAgent + date)
            $empreinte = hash('sha256', $request->ip() . $request->userAgent() . now()->toDateString());
            
            // Vérifier si l'utilisateur n'a pas déjà vu cette pub aujourd'hui
            $vueExiste = VuePublicite::where('publicite_id', $validated['publicite_id'])
                ->where('media_id', $media->id)
                ->where('empreinte_visiteur', $empreinte)
                ->exists();
            
            if ($vueExiste) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cette publicité a déjà été vue par ce visiteur aujourd\'hui'
                ], 409);
            }
            
            // Vérifier que la publicité est toujours active sur ce média
            $pivot = $media->publicites()
                ->where('publicite_id', $validated['publicite_id'])
                ->where('publicite_media.status', 'active')
                ->first();
            
            if (!$pivot) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cette publicité n\'est plus active sur ce média'
                ], 403);
            }
            
            // Créer l'enregistrement de vue
            $vue = VuePublicite::create([
                'publicite_id' => $validated['publicite_id'],
                'media_id' => $media->id,
                'visiteur_ip' => $request->ip(),
                'navigateur' => $request->userAgent(),
                'empreinte_visiteur' => $empreinte,
                'referer' => $request->header('referer'),
                'date_vue' => now()
            ]);
            
            // Incrémenter le compteur total_vues dans la table media
            $media->increment('total_vues');
            
            // Décrémenter les vues_restantes dans la table pivot si > 0
            $media->publicites()
                ->where('publicite_id', $validated['publicite_id'])
                ->where('vues_restantes', '>', 0)
                ->update([
                    'vues_restantes' => \DB::raw('vues_restantes - 1')
                ]);
            
            // Récupérer les nouvelles vues restantes
            $nouvellesVuesRestantes = $media->publicites()
                ->where('publicite_id', $validated['publicite_id'])
                ->first()
                ->pivot
                ->vues_restantes ?? 0;
            
            return response()->json([
                'success' => true,
                'message' => 'Vue enregistrée avec succès',
                'vue_id' => $vue->id,
                'vues_restantes' => $nouvellesVuesRestantes
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'enregistrement de la vue: ' . $e->getMessage()
            ], 500);
        }
    });
    
    /**
     * POST /api/media/record-click
     * Enregistrer un clic sur une publicité
     */
    Route::post('/record-click', function (Request $request) {
        $media = $request->get('media');
        
        $validated = $request->validate([
            'publicite_id' => 'required|exists:publicites,id',
        ]);
        
        try {
            // Générer une empreinte unique pour le visiteur
            $empreinte = hash('sha256', $request->ip() . $request->userAgent());
            
            // Vérifier que la publicité est active sur ce média
            $pivot = $media->publicites()
                ->where('publicite_id', $validated['publicite_id'])
                ->where('publicite_media.status', 'active')
                ->first();
            
            if (!$pivot) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cette publicité n\'est plus active sur ce média'
                ], 403);
            }
            
            // Créer l'enregistrement de clic
            $clic = ClicPublicite::create([
                'publicite_id' => $validated['publicite_id'],
                'media_id' => $media->id,
                'visiteur_ip' => $request->ip(),
                'navigateur' => $request->userAgent(),
                'empreinte_visiteur' => $empreinte,
                'referer' => $request->header('referer'),
                'date_clic' => now()
            ]);
            
            // Incrémenter le compteur total_clics dans la table media
            $media->increment('total_clics');
            
            return response()->json([
                'success' => true,
                'message' => 'Clic enregistré avec succès',
                'clic_id' => $clic->id
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'enregistrement du clic: ' . $e->getMessage()
            ], 500);
        }
    });
    
    /**
     * GET /api/media/statistiques
     * Récupérer les statistiques complètes du média
     */
    Route::get('/statistiques', function (Request $request) {
        $media = $request->get('media');
        
        // Récupérer toutes les publicités du média avec leurs vues et clics
        $publicites = $media->publicites()
            ->with(['vues', 'clics', 'annonceur'])
            ->get();
        
        // Statistiques par jour (30 derniers jours)
        $vuesParJour = VuePublicite::where('media_id', $media->id)
            ->where('date_vue', '>=', now()->subDays(30))
            ->selectRaw('DATE(date_vue) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        $clicsParJour = ClicPublicite::where('media_id', $media->id)
            ->where('date_clic', '>=', now()->subDays(30))
            ->selectRaw('DATE(date_clic) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        // Calculer le revenu estimé (basé sur les vues et clics)
        $revenuEstime = ($media->total_vues * 0.001) + ($media->total_clics * 0.01);
        
        $stats = [
            'media' => [
                'id' => $media->id,
                'nom' => $media->nom_du_media,
                'statut' => $media->statut,
                'total_vues' => $media->total_vues,
                'total_clics' => $media->total_clics,
                'revenu_actuel' => $media->revenu_actuel,
                'paiement_demande' => (bool) $media->paiement_demande
            ],
            'global' => [
                'total_vues' => $media->total_vues,
                'total_clics' => $media->total_clics,
                'revenu_estime' => round($revenuEstime, 2),
                'ctr' => $media->total_vues > 0 
                    ? round(($media->total_clics / $media->total_vues) * 100, 2) 
                    : 0,
                'cout_par_mille_vues' => 1.00, // 1 FCFA pour 1000 vues
                'cout_par_clic' => 0.01 // 0.01 FCFA par clic
            ],
            'par_publicite' => $publicites->map(function($pub) {
                $nbVues = $pub->vues->count();
                $nbClics = $pub->clics->count();
                $revenuPub = ($nbVues * 0.001) + ($nbClics * 0.01);
                
                return [
                    'id' => $pub->id,
                    'titre' => $pub->titre,
                    'annonceur' => $pub->annonceur->nom ?? 'Inconnu',
                    'vues' => $nbVues,
                    'clics' => $nbClics,
                    'revenu' => round($revenuPub, 2),
                    'vues_restantes' => $pub->pivot->vues_restantes ?? 0,
                    'ctr' => $nbVues > 0 ? round(($nbClics / $nbVues) * 100, 2) : 0,
                    'status_pivot' => $pub->pivot->status ?? 'inactive',
                    'ordre_priorite' => $pub->pivot->ordre_priorite ?? 0
                ];
            }),
            'evolution' => [
                'labels' => $vuesParJour->pluck('date'),
                'vues_data' => $vuesParJour->pluck('total'),
                'clics_data' => $clicsParJour->pluck('total')
            ]
        ];
        
        return response()->json($stats);
    });
    
    /**
     * GET /api/media/me
     * Récupérer les informations du média connecté
     */
    Route::get('/me', function (Request $request) {
        $media = $request->get('media');
        
        $revenuEstime = ($media->total_vues * 0.001) + ($media->total_clics * 0.01);
        
        return response()->json([
            'success' => true,
            'media' => [
                'id' => $media->id,
                'nom_du_media' => $media->nom_du_media,
                'url_site' => $media->url_site,
                'telephone' => $media->telephone,
                'email' => $media->email,
                'adresse' => $media->adresse,
                'description' => $media->description,
                'logo_media' => $media->logo_media ? asset('storage/' . $media->logo_media) : null,
                'numero_rccm' => $media->numero_rccm,
                'statut' => $media->statut,
                'total_vues' => $media->total_vues,
                'total_clics' => $media->total_clics,
                'revenu_actuel' => $media->revenu_actuel,
                'revenu_estime' => round($revenuEstime, 2),
                'paiement_demande' => (bool) $media->paiement_demande
            ]
        ]);
    });
});