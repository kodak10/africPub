@extends('dashboard.layouts.master')

@section('content')

<!-- SUBHEADER -->
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">Historique des Paiements Médias</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Paiements</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Historique</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid mt-3">
    <!-- Cartes de statistiques -->
    <div class="row mb-4">
        <div class="col-md-4 col-sm-12">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="mb-0">{{ number_format($montantTotal, 0, ',', ' ') }} FCFA</h4>
                            <p class="mb-0">Montant total payé</p>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="material-icons" style="font-size: 40px;">payments</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="mb-0">{{ $totalPaiements }}</h4>
                            <p class="mb-0">Paiements effectués</p>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="material-icons" style="font-size: 40px;">check_circle</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="mb-0">{{ $paiementsComplets }}</h4>
                            <p class="mb-0">Paiements complétés</p>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="material-icons" style="font-size: 40px;">done_all</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FORMULAIRE DE RECHERCHE -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.paiements.historique') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3 col-sm-12">
                        <label class="form-label">Média</label>
                        <select name="media_id" class="form-select" id="filterMedia">
                            <option value="">Tous les médias</option>
                            @foreach($medias as $media)
                                <option value="{{ $media->id }}" {{ request('media_id') == $media->id ? 'selected' : '' }}>
                                    {{ $media->nom_du_media }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 col-sm-12">
                        <label class="form-label">Méthode</label>
                        <select name="methode_paiement" class="form-select" id="filterMethode">
                            <option value="">Toutes</option>
                            <option value="orange_money" {{ request('methode_paiement') == 'orange_money' ? 'selected' : '' }}>Orange Money</option>
                            <option value="mtn_money" {{ request('methode_paiement') == 'mtn_money' ? 'selected' : '' }}>MTN Money</option>
                            <option value="wave" {{ request('methode_paiement') == 'wave' ? 'selected' : '' }}>Wave</option>
                            <option value="virement_bancaire" {{ request('methode_paiement') == 'virement_bancaire' ? 'selected' : '' }}>Virement</option>
                            <option value="especes" {{ request('methode_paiement') == 'especes' ? 'selected' : '' }}>Espèces</option>
                        </select>
                    </div>

                    <div class="col-md-2 col-sm-12">
                        <label class="form-label">Statut</label>
                        <select name="statut" class="form-select" id="filterStatut">
                            <option value="">Tous</option>
                            <option value="complet" {{ request('statut') == 'complet' ? 'selected' : '' }}>Complet</option>
                            <option value="initie" {{ request('statut') == 'initie' ? 'selected' : '' }}>Initié</option>
                            <option value="echec" {{ request('statut') == 'echec' ? 'selected' : '' }}>Échec</option>
                            <option value="en_attente_confirmation" {{ request('statut') == 'en_attente_confirmation' ? 'selected' : '' }}>En attente</option>
                        </select>
                    </div>

                    <div class="col-md-2 col-sm-12">
                        <label class="form-label">Date début</label>
                        <input type="date" name="date_debut" class="form-control" value="{{ request('date_debut') }}">
                    </div>

                    <div class="col-md-2 col-sm-12">
                        <label class="form-label">Date fin</label>
                        <input type="date" name="date_fin" class="form-control" value="{{ request('date_fin') }}">
                    </div>

                    <div class="col-md-1 col-sm-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="material-icons">search</i>
                                <span class="d-none d-md-inline-block ms-1">Rechercher</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-12">
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.paiements.historique') }}" class="btn btn-secondary w-100">
                                <i class="material-icons">refresh</i>
                                <span class="d-none d-md-inline-block ms-1">Reset</span>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Messages Flash -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="material-icons me-1">check_circle</i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="material-icons me-1">error</i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Liste des paiements -->
    <div class="card">
        <div class="card-header">
            <h2 class="p-1 m-0 text-16 font-weight-semi">Liste des paiements effectués</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped w-100" id="datatableHistorique">
                    <thead>
                        <tr>
                            <th>Date Paiement</th>
                            <th>Média</th>
                            <th>Montant</th>
                            <th>Méthode</th>
                            <th>Téléphone</th>
                            <th>Référence</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paiements as $paiement)
                        <tr>
                            <td>
                                <strong>{{ $paiement->date_paiement->format('d/m/Y') }}</strong>
                                <br>
                                <small class="text-muted">{{ $paiement->date_paiement->format('H:i') }}</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($paiement->media->logo_media)
                                        <img src="{{ asset('storage/' . $paiement->media->logo_media) }}" 
                                             class="rounded-circle me-2" width="30" height="30" alt="Logo">
                                    @else
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" 
                                             style="width: 30px; height: 30px;">
                                            <i class="material-icons text-white" style="font-size: 16px;">media</i>
                                        </div>
                                    @endif
                                    <div>
                                        <strong>{{ $paiement->media->nom_du_media }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $paiement->media->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <strong class="text-success">{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</strong>
                            </td>
                            <td>
                                <span class="badge bg-info">
                                    @switch($paiement->methode_paiement)
                                        @case('orange_money')
                                            <i class="material-icons me-1" style="font-size: 14px;">phone_android</i>Orange
                                            @break
                                        @case('mtn_money')
                                            <i class="material-icons me-1" style="font-size: 14px;">smartphone</i>MTN
                                            @break
                                        @case('wave')
                                            <i class="material-icons me-1" style="font-size: 14px;">account_balance_wallet</i>Wave
                                            @break
                                        @case('virement_bancaire')
                                            <i class="material-icons me-1" style="font-size: 14px;">account_balance</i>Virement
                                            @break
                                        @case('especes')
                                            <i class="material-icons me-1" style="font-size: 14px;">money</i>Espèces
                                            @break
                                        @default
                                            {{ $paiement->methode_paiement }}
                                    @endswitch
                                </span>
                            </td>
                            <td>
                                <code>{{ $paiement->numero_telephone }}</code>
                            </td>
                            <td>
                                <small class="text-muted">{{ $paiement->reference_transaction }}</small>
                            </td>
                            <td>
                                @switch($paiement->statut)
                                    @case('complet')
                                        <span class="badge bg-success">
                                            <i class="material-icons me-1" style="font-size: 14px;">check_circle</i>Complet
                                        </span>
                                        @break
                                    @case('initie')
                                        <span class="badge bg-primary">
                                            <i class="material-icons me-1" style="font-size: 14px;">schedule</i>Initié
                                        </span>
                                        @break
                                    @case('echec')
                                        <span class="badge bg-danger">
                                            <i class="material-icons me-1" style="font-size: 14px;">error</i>Échec
                                        </span>
                                        @break
                                    @case('en_attente_confirmation')
                                        <span class="badge bg-warning">
                                            <i class="material-icons me-1" style="font-size: 14px;">hourglass_empty</i>En attente
                                        </span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ $paiement->statut }}</span>
                                @endswitch
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <!-- Voir détails -->
                                    <a href="{{ route('admin.paiements.details', $paiement->id) }}" 
                                       class="btn btn-info" 
                                       title="Voir détails">
                                        <i class="material-icons">visibility</i>
                                    </a>
                                    
                                    <!-- Télécharger preuve -->
                                    @if($paiement->preuve_paiement)
                                        <a href="{{ asset('storage/' . $paiement->preuve_paiement) }}" 
                                           class="btn btn-success" 
                                           target="_blank"
                                           title="Voir la preuve">
                                            <i class="material-icons">receipt</i>
                                        </a>
                                    @endif
                                    
                                    <!-- Réimprimer reçu -->
                                    <button class="btn btn-warning" 
                                            onclick="genererRecu({{ $paiement->id }})"
                                            title="Réimprimer reçu">
                                        <i class="material-icons">print</i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<!-- Chargement de Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
$(document).ready(function () {
    // Initialisation de DataTable (sans re-déclarer frenchTranslation car déjà dans master)
    if ($.fn.DataTable.isDataTable('#datatableHistorique')) {
        $('#datatableHistorique').DataTable().destroy();
    }
    
    // Initialisation de DataTable avec responsive
    var table = $('#datatableHistorique').DataTable({
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        paging: true,
        searching: true,
        ordering: true,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tous"]],
        // Utiliser la variable du master si elle existe, sinon utiliser une traduction par défaut
        language: typeof frenchTranslation !== 'undefined' ? frenchTranslation : {
            "sProcessing": "Traitement en cours...",
            "sSearch": "Rechercher :",
            "sLengthMenu": "Afficher _MENU_ éléments",
            "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
            "sInfoEmpty": "Affichage de 0 à 0 sur 0 éléments",
            "sInfoFiltered": "(filtré de _MAX_ éléments au total)",
            "sZeroRecords": "Aucun élément à afficher",
            "sEmptyTable": "Aucune donnée disponible dans le tableau",
            "oPaginate": {
                "sFirst": "Premier",
                "sPrevious": "Précédent",
                "sNext": "Suivant",
                "sLast": "Dernier"
            }
        },
        columnDefs: [
            { responsivePriority: 1, targets: 1 },  // Média - priorité haute
            { responsivePriority: 2, targets: 7 },  // Actions - priorité haute
            { responsivePriority: 3, targets: 6 },  // Statut - priorité moyenne
            { responsivePriority: 4, targets: 2 },  // Montant - priorité moyenne
            { responsivePriority: 5, targets: 0 },  // Date - priorité moyenne
            { responsivePriority: 6, targets: 3 },  // Méthode - priorité basse
            { responsivePriority: 7, targets: 4 },  // Téléphone - priorité basse
            { responsivePriority: 8, targets: 5 }   // Référence - priorité basse
        ],
        autoWidth: false,
        order: [[0, 'desc']] // Trier par date décroissante
    });
    
    // Vérifier si Select2 est chargé avant de l'utiliser
    if ($.fn.select2) {
        // Initialisation de Select2 pour les filtres
        $('#filterMedia, #filterMethode, #filterStatut').select2({
            placeholder: "Sélectionner...",
            allowClear: true,
            width: '100%'
        });
    } else {
        console.warn('Select2 non chargé');
    }
    
    // Configuration de Toastr
    if (typeof toastr !== 'undefined') {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000"
        };
        
        // Messages flash
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        
        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    }
});

// Fonction pour générer un reçu
window.genererRecu = function(paiementId) {
    window.open('/admin/paiements/recu/' + paiementId, '_blank');
};
</script>
@endsection