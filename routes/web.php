<?php

use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PubliciteController;
use App\Http\Controllers\Admin\PaiementController;
use App\Http\Controllers\Admin\AnnonceurController as AdminAnnonceurController;
use App\Http\Controllers\Annonceur\AnnonceurController as UserAnnonceurController;


use App\Http\Controllers\Admin\RemboursementAnnonceurController;

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('dashboard.pages.admin.home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Administrateurs
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // Tableau de bord
    Route::get('/dashboard', function () {
        return 'Dashboard Administrateurs';
    })->name('dashboard');

    /**
     * -------------------------
     *  ANNONCEURS
     * -------------------------
     */
    Route::prefix('annonceurs')->name('annonceurs.')->group(function () {
        Route::get('/', [AdminAnnonceurController::class, 'index'])->name('index');
        Route::get('/toggle-status/{id}/{action}', [AdminAnnonceurController::class, 'toggleStatus'])->name('toggle-status');
        Route::get('/show/{id}', [AdminAnnonceurController::class, 'show'])->name('show'); 
    });

    /**
     * -------------------------
     *  MEDIAS
     * -------------------------
     */
    Route::prefix('medias')->name('medias.')->group(function () {
        Route::get('/', [MediaController::class, 'index'])->name('index');
        Route::get('/toggle-status/{id}/{action}', [MediaController::class, 'toggleStatus'])->name('toggle-status');
        Route::get('/show/{id}', [MediaController::class, 'show'])->name('show');
    });

    /**
     * -------------------------
     *  PUBLICITES
     * -------------------------
     */
    Route::prefix('publicites')->name('publicites.')->group(function () {
        Route::get('/', [PubliciteController::class, 'index'])->name('index');
        Route::get('/suspend/{id}', [PubliciteController::class, 'suspend'])->name('suspend');
        Route::get('/{id}/status/{status}', [PubliciteController::class, 'changeStatus'])->name('change-status');

        // Assignation Médias
        Route::get('/assign-media', [PubliciteController::class, 'assignMediaToPublicite'])->name('assign-media');
        Route::get('/{publicite}/assign-media', [PubliciteController::class, 'assignMediaToPubliciteForm'])->name('assign-media-form');
        Route::post('/{publicite}/assign-media', [PubliciteController::class, 'assignMediaToPubliciteStore'])->name('assign-media-store');
    });

    /**
     * -------------------------
     *  PAIEMENTS
     * -------------------------
     */
    Route::prefix('paiements')->name('paiements.')->group(function () {

        Route::get('/', [PaiementController::class, 'index'])->name('index');
        Route::post('/creer/{mediaId}', [PaiementController::class, 'creerDemande'])->name('creer');

        Route::get('/payer/{id}', [PaiementController::class, 'showPaiement'])->name('payer');
        Route::post('/process/{id}', [PaiementController::class, 'processPaiement'])->name('process');

        Route::post('/approuver/{id}', [PaiementController::class, 'approuverDemande'])->name('approuver');
        Route::post('/rejeter/{id}', [PaiementController::class, 'rejeterDemande'])->name('rejeter');

        // Détails et historique
        Route::get('/historique', [PaiementController::class, 'historiquePaiements'])->name('historique');
        Route::get('/details/{id}', [PaiementController::class, 'showDetailsPaiement'])->name('details');
        Route::get('/recu/{id}', [PaiementController::class, 'genererRecu'])->name('recu');


        /**
         * -------------------------
         *  REMBOURSEMENTS
         * -------------------------
         */
        Route::prefix('remboursements')->name('remboursements.')->group(function () {

            // Liste
            Route::get('/', [RemboursementAnnonceurController::class, 'index'])->name('index');

            // Formulaire
            Route::get('/create', [RemboursementAnnonceurController::class, 'create'])->name('create');
            Route::get('/create/{paiementId}', [RemboursementAnnonceurController::class, 'create'])->name('create.with-paiement');

            // Enregistrement
            Route::post('/', [RemboursementAnnonceurController::class, 'store'])->name('store');

            // Détails
            Route::get('/{id}', [RemboursementAnnonceurController::class, 'show'])->name('show');

            // Actions
            Route::post('/approuver/{id}', [RemboursementAnnonceurController::class, 'approuverDemande'])->name('approuver');
            Route::post('/rejeter/{id}', [RemboursementAnnonceurController::class, 'rejeterDemande'])->name('rejeter');
            Route::post('/rembourser/{id}', [RemboursementAnnonceurController::class, 'processRemboursement'])->name('rembourser');

            // Historique
            Route::get('/historique', [RemboursementAnnonceurController::class, 'historique'])->name('historique');

            // AJAX
            Route::get('/paiements/{annonceurId}', [RemboursementAnnonceurController::class, 'getPaiementsAnnonceur'])->name('paiements');
            Route::get('/paiement-details/{paiementId}', [RemboursementAnnonceurController::class, 'getDetailsPaiement'])->name('paiement-details');
        });
    });


    /**
     * -------------------------
     *  MODERATION SITES
     * -------------------------
     */
    Route::get('/sites/moderation', function () {
        return 'Modération des sites';
    })->name('sites');


    Route::get('/rapport-financier', function () {
        return 'Rapport financier';
    })->name('rapport_financier');
});


/*
|--------------------------------------------------------------------------
| Annonceurs
|--------------------------------------------------------------------------
*/
// Routes pour l'espace annonceur
Route::prefix('annonceur')->name('annonceur.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [UserAnnonceurController::class, 'dashboard'])->name('dashboard');
    
    // Publicités
    Route::get('/publicites/create', [UserAnnonceurController::class, 'createPublicite'])->name('create_publicites');
    Route::get('/publicites', [UserAnnonceurController::class, 'publicites'])->name('index_publicites');
    Route::get('/publicites/{id}', [UserAnnonceurController::class, 'showPublicite'])->name('show_publicite');
    Route::post('/publicites', [UserAnnonceurController::class, 'storePublicite'])->name('store_publicite');
    
    // Rapports
    Route::get('/rapports', [UserAnnonceurController::class, 'rapports'])->name('rapports');
    
    // Paiements
    Route::get('/paiements/historique', [UserAnnonceurController::class, 'historiquePaiements'])->name('paiements.historique');
    Route::get('/paiements/remboursement', [UserAnnonceurController::class, 'createRemboursement'])->name('paiements.remboursement');
    Route::post('/paiements/remboursement', [UserAnnonceurController::class, 'storeRemboursement'])->name('store_remboursement');
    Route::get('/paiements/{id}', [UserAnnonceurController::class, 'showPaiement'])->name('show_paiement');
});



/*
|--------------------------------------------------------------------------
| Médias
|--------------------------------------------------------------------------
*/
Route::prefix('media')->name('media.')->group(function () {

    Route::get('/dashboard', function () {
        return 'Dashboard Médias';
    })->name('dashboard');

    Route::get('/rapports', function () {
        return 'Rapports médias';
    })->name('rapports');

    Route::prefix('paiements')->name('paiements.')->group(function () {

        Route::get('/historique', function () {
            return 'Historique des paiements média';
        })->name('historique');

        Route::get('/reclamation', function () {
            return 'Réclamer un paiement média';
        })->name('reclamation');
    });
});
