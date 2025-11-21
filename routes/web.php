<?php

use App\Http\Controllers\Admin\AnnonceurController;
use App\Http\Controllers\Admin\MediaController;
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
        Route::get('/show/{id}', [MediaController::class, 'show'])->name('show'); // pour modal (AJAX)
    });

    Route::get('/publicites', function () {
        return 'Gestion des Publicités';
    })->name('publicites');

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
