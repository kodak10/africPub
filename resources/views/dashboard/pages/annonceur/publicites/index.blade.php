@extends('dashboard.layouts.master')

@section('content')

<!-- SUBHEADER -->
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">Mes Publicités</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('annonceur.dashboard') }}">Tableau de Bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mes Publicités</li>
                </ol>
            </nav>
        </div>
        <div class="subheader-toolbar">
            <a href="{{ route('annonceur.create_publicites') }}" class="btn btn-primary">
                <i class="material-icons me-1">add</i>
                Nouvelle Publicité
            </a>
        </div>
    </div>
</div>

<div class="container-fluid mt-3">
    <!-- FILTRES -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('annonceur.index_publicites') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Statut</label>
                        <select name="statut" class="form-select" id="filterStatut">
                            <option value="">Tous les statuts</option>
                            <option value="brouillon" {{ request('statut') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                            <option value="en_attente_validation" {{ request('statut') == 'en_attente_validation' ? 'selected' : '' }}>En attente</option>
                            <option value="validé" {{ request('statut') == 'validé' ? 'selected' : '' }}>Validé</option>
                            <option value="suspendu" {{ request('statut') == 'suspendu' ? 'selected' : '' }}>Suspendu</option>
                            <option value="rejete" {{ request('statut') == 'rejete' ? 'selected' : '' }}>Rejeté</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Forfait</label>
                        <select name="forfait_id" class="form-select" id="filterForfait">
                            <option value="">Tous les forfaits</option>
                            @foreach($forfaits as $forfait)
                                <option value="{{ $forfait->id }}" {{ request('forfait_id') == $forfait->id ? 'selected' : '' }}>
                                    {{ $forfait->libelle }} — {{ number_format($forfait->objectif_vues, 0, ',', ' ') }} vues — {{ number_format($forfait->montant, 0, ',', ' ') }} FCFA
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1">
                                <i class="material-icons me-1">search</i> Rechercher
                            </button>
                            <a href="{{ route('annonceur.index_publicites') }}" class="btn btn-secondary flex-grow-1">
                                <i class="material-icons me-1">refresh</i> Réinitialiser
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

    <!-- TABLEAU DES PUBLICITÉS -->
    <div class="card shadow">
        <div class="card-header">
            <h2 class="p-1 m-0 text-16 font-weight-semi">Liste de mes publicités</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped w-100" id="datatablePublicites">
                    <thead>
                        <tr>
                            <th>Publicité</th>
                            <th>Forfait</th>
                            <th>Statut</th>
                            <th>Vues</th>
                            <th>Clics</th>
                            <th>Création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($publicites as $publicite)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($publicite->type_media == 'image')
                                        <img src="{{ asset('storage/' . $publicite->media_path) }}" 
                                             class="rounded me-3" width="60" height="60" alt="{{ $publicite->titre }}" style="object-fit: cover;">
                                    @else
                                        <div class="bg-primary rounded d-flex align-items-center justify-content-center me-3" 
                                             style="width: 60px; height: 60px;">
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
                                <div>
                                    <strong>{{ $publicite->forfait->libelle }}</strong>
                                    <br>
                                    <small class="text-muted">{{ number_format($publicite->forfait->objectif_vues, 0, ',', ' ') }} vues</small>
                                    <br>
                                    <small class="text-muted">{{ number_format($publicite->forfait->montant, 0, ',', ' ') }} FCFA</small>
                                </div>
                            </td>
                            <td>
                                @switch($publicite->statut)
                                    @case('brouillon')
                                        <span class="badge bg-secondary">
                                            <i class="material-icons me-1" style="font-size: 14px;">edit</i> Brouillon
                                        </span>
                                        @break
                                    @case('en_attente_validation')
                                        <span class="badge bg-warning">
                                            <i class="material-icons me-1" style="font-size: 14px;">schedule</i> En attente
                                        </span>
                                        @break
                                    @case('validé')
                                        <span class="badge bg-success">
                                            <i class="material-icons me-1" style="font-size: 14px;">check_circle</i> Validé
                                        </span>
                                        @break
                                    @case('suspendu')
                                        <span class="badge bg-danger">
                                            <i class="material-icons me-1" style="font-size: 14px;">pause_circle</i> Suspendu
                                        </span>
                                        @break
                                    @case('rejete')
                                        <span class="badge bg-danger">
                                            <i class="material-icons me-1" style="font-size: 14px;">cancel</i> Rejeté
                                        </span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ $publicite->statut }}</span>
                                @endswitch
                            </td>
                            <td>
                                <div class="text-center">
                                    <span class="badge bg-info">{{ $publicite->vues->count() }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <span class="badge bg-success">{{ $publicite->clics->count() }}</span>
                                </div>
                            </td>
                            <td>
                                <small>
                                    {{ $publicite->created_at->format('d/m/Y') }}<br>
                                    <span class="text-muted">{{ $publicite->created_at->format('H:i') }}</span>
                                </small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('annonceur.show_publicite', $publicite->id) }}" 
                                       class="btn btn-info" title="Voir détails">
                                        <i class="material-icons">visibility</i>
                                    </a>
                                    @if($publicite->statut == 'brouillon')
                                        <a href="#" class="btn btn-warning" title="Modifier">
                                            <i class="material-icons">edit</i>
                                        </a>
                                    @endif
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
    if ($.fn.DataTable.isDataTable('#datatablePublicites')) {
        $('#datatablePublicites').DataTable().destroy();
    }
    
    // Initialisation de DataTable avec responsive
    var table = $('#datatablePublicites').DataTable({
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
            { responsivePriority: 2, targets: 6 },  // Actions - priorité haute
            { responsivePriority: 3, targets: 2 },  // Statut - priorité moyenne
            { responsivePriority: 4, targets: 1 },  // Forfait - priorité moyenne
            { responsivePriority: 5, targets: 3 },  // Vues - priorité basse
            { responsivePriority: 6, targets: 4 },  // Clics - priorité basse
            { responsivePriority: 7, targets: 5 }   // Création - priorité basse
        ],
        autoWidth: false,
        order: [[5, 'desc']] // Tri par date de création décroissante
    });
    
    // Vérifier si Select2 est chargé avant de l'utiliser
    if ($.fn.select2) {
        // Initialisation de Select2 pour les filtres
        $('#filterStatut, #filterForfait').select2({
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
</script>
@endsection