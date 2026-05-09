@extends('dashboard.layouts.master')

@section('content')

<!-- SUBHEADER -->
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">Rapports de Performance</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('media.dashboard') }}">Tableau de Bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Rapports</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid mt-3">
    <!-- FILTRES -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('media.rapports') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Date de début</label>
                        <input type="date" name="date_debut" class="form-control" 
                               value="{{ $dateDebut }}" max="{{ now()->format('Y-m-d') }}">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Date de fin</label>
                        <input type="date" name="date_fin" class="form-control" 
                               value="{{ $dateFin }}" max="{{ now()->format('Y-m-d') }}">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1">
                                <i class="material-icons me-1">search</i> Appliquer
                            </button>
                            <a href="{{ route('media.rapports') }}" class="btn btn-secondary flex-grow-1">
                                <i class="material-icons me-1">refresh</i> Réinitialiser
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- STATISTIQUES GLOBALES -->
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 col-sm-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Vues
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($statsPeriode['vues'], 0, ',', ' ') }}
                            </div>
                            <div class="text-xs text-muted mt-1">
                                {{ number_format($statsPeriode['vues_jour'], 0, ',', ' ') }} vues/jour
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons text-gray-300" style="font-size: 2rem;">visibility</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 col-sm-12 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Clics
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($statsPeriode['clics'], 0, ',', ' ') }}
                            </div>
                            <div class="text-xs text-muted mt-1">
                                {{ number_format($statsPeriode['clics_jour'], 0, ',', ' ') }} clics/jour
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons text-gray-300" style="font-size: 2rem;">touch_app</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 col-sm-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Revenu Estimé
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($statsPeriode['revenu'], 0, ',', ' ') }} FCFA
                            </div>
                            <div class="text-xs text-muted mt-1">
                                Période sélectionnée
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons text-gray-300" style="font-size: 2rem;">payments</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ANALYSE DE FRAUDE -->
    @if($analyseFraude['fraude_detectee'])
        <div class="alert alert-warning mb-4">
            <div class="d-flex align-items-center">
                <i class="material-icons me-2" style="font-size: 24px;">warning</i>
                <h5 class="mb-0">Analyse de Fraude - Score de Risque: {{ $analyseFraude['score_risque'] }}</h5>
            </div>
            <hr>
            <div class="mt-2">
                <strong>Raisons détectées:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($analyseFraude['raisons'] as $raison)
                        <li>{{ $raison }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @else
        <div class="alert alert-success mb-4">
            <div class="d-flex align-items-center">
                <i class="material-icons me-2" style="font-size: 24px;">verified</i>
                <h5 class="mb-0">Aucune activité frauduleuse détectée - Score de Risque: Faible</h5>
            </div>
        </div>
    @endif

    <!-- PERFORMANCES PAR PUBLICITÉ -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="material-icons me-2">campaign</i>
                Performances des Publicités
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped w-100" id="datatablePerformances">
                    <thead>
                        <tr>
                            <th>Publicité</th>
                            <th>Forfait</th>
                            <th>Vues</th>
                            <th>Clics</th>
                            <th>Revenu Estimé</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($performancesPublicites as $publicite)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($publicite->type_media == 'image')
                                        <img src="{{ asset('storage/' . $publicite->media_path) }}" 
                                             class="rounded me-3" width="50" height="50" 
                                             alt="{{ $publicite->titre }}" style="object-fit: cover;">
                                    @else
                                        <div class="bg-primary rounded d-flex align-items-center justify-content-center me-3" 
                                             style="width: 50px; height: 50px;">
                                            <i class="material-icons text-white">play_circle</i>
                                        </div>
                                    @endif
                                    <div>
                                        <strong>{{ $publicite->titre }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $publicite->type_media }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $publicite->forfait->libelle }}</span>
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ number_format($publicite->vues_periode, 0, ',', ' ') }}</span>
                            </td>
                            <td>
                                <span class="badge bg-success">{{ number_format($publicite->clics_periode, 0, ',', ' ') }}</span>
                            </td>
                            <td>
                                <strong class="text-warning">{{ number_format($publicite->revenu_estime, 0, ',', ' ') }} FCFA</strong>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('media.rapports.detail', $publicite->id) }}" 
                                       class="btn btn-outline-primary" title="Voir détails">
                                        <i class="material-icons">visibility</i>
                                    </a>
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
    if ($.fn.DataTable.isDataTable('#datatablePerformances')) {
        $('#datatablePerformances').DataTable().destroy();
    }
    
    // Initialisation de DataTable avec responsive
    var table = $('#datatablePerformances').DataTable({
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
            { responsivePriority: 1, targets: 0 },  // Publicité - priorité haute
            { responsivePriority: 2, targets: 5 },  // Actions - priorité haute
            { responsivePriority: 3, targets: 2 },  // Vues - priorité moyenne
            { responsivePriority: 4, targets: 3 },  // Clics - priorité moyenne
            { responsivePriority: 5, targets: 4 },  // Revenu - priorité moyenne
            { responsivePriority: 6, targets: 1 }   // Forfait - priorité basse
        ],
        autoWidth: false,
        order: [[2, 'desc']] // Tri par vues décroissantes
    });
    
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
</script>
@endsection