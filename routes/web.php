<?php

use App\Http\Controllers\Admin\AnnonceurController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PubliciteController;
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

    Route::get('/dashboard', function () {
        return 'Dashboard Administrateurs';
    })->name('dashboard');

    Route::prefix('annonceurs')->name('annonceurs.')->group(function () {
        Route::get('/', [AnnonceurController::class, 'index'])->name('index');
        Route::get('/show/{id}', [AnnonceurController::class, 'show'])->name('show'); // pour modal (AJAX)
    });

    Route::prefix('medias')->name('medias.')->group(function () {
        Route::get('/', [MediaController::class, 'index'])->name('index');
        Route::get('/toggle-status/{id}/{action}', [MediaController::class, 'toggleStatus'])->name('toggle-status');

        Route::get('/show/{id}', [MediaController::class, 'show'])->name('show'); // pour modal (AJAX)
    });

    Route::get('/publicites', [PubliciteController::class, 'index'])->name('publicites.index');
    Route::get('/publicites/suspend/{id}', [PubliciteController::class, 'suspend'])->name('publicites.suspend');
    Route::get('/publicites/{id}/status/{status}', [PubliciteController::class, 'changeStatus'])->name('publicites.change-status');

    // Afficher toutes les publicités validées
    Route::get('/publicites/assign-media', [PubliciteController::class, 'assignMediaToPublicite'])->name('publicites.assign-media');
    // Formulaire d'assignation des médias pour une publicité
    Route::get('/publicites/{publicite}/assign-media', [PubliciteController::class, 'assignMediaToPubliciteForm'])->name('publicites.assign-media-form');
    // Enregistrer les médias affectés à une publicité
    Route::post('/publicites/{publicite}/assign-media', [PubliciteController::class, 'assignMediaToPubliciteStore'])->name('publicites.assign-media-store');

    Route::get('/sites/moderation', function () {
        return 'Modération des sites';
    })->name('sites');

    Route::prefix('paiements')->name('paiements.')->group(function () {
        Route::get('/faire', function () {
            return 'Faire un paiement';
        })->name('create');

        Route::get('/liste', function () {
            return 'Liste des paiements';
        })->name('index');
    });

    Route::get('/rapport-financier', function () {
        return 'Rapport financier';
    })->name('rapport_financier');
});


/*
|--------------------------------------------------------------------------
| Annonceurs
|--------------------------------------------------------------------------
*/
Route::prefix('annonceur')->name('annonceur.')->group(function () {

    Route::get('/dashboard', function () {
        return 'Dashboard Annonceur';
    })->name('dashboard');

    Route::get('/create-publicite', function () {
        return 'Créer une publicité';
    })->name('create_publicites');

    Route::get('/mes-publicites', function () {
        return 'Mes publicités';
    })->name('index_publicites');

    Route::get('/rapports', function () {
        return 'Rapports annonceur';
    })->name('rapports');

    Route::prefix('paiements')->name('paiements.')->group(function () {
        Route::get('/historique', function () {
            return 'Historique des paiements Annonceur';
        })->name('historique');

        Route::get('/remboursement', function () {
            return 'Réclamer un remboursement';
        })->name('remboursement');
    });
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
