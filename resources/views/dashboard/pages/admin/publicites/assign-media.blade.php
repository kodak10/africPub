@extends('dashboard.layouts.master')

@section('content')

<!-- SUBHEADER -->
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">Affectation des Publicités aux Médias</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Gestion</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Affectation</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid mt-3">
    <!-- FORMULAIRE DE RECHERCHE -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.publicites.assign-media') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Annonceur</label>
                        <select name="annonceur_id" class="form-select" id="filterAnnonceur">
                            <option value="">--Tous--</option>
                            @foreach($annonceurs as $ann)
                                <option value="{{ $ann->id }}" {{ request('annonceur_id') == $ann->id ? 'selected' : '' }}>
                                    {{ $ann->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <label class="form-label">Forfait</label>
                        <select name="forfait_id" class="form-select" id="filterForfait">
                            <option value="">--Tous--</option>
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
                            <a href="{{ route('admin.publicites.assign-media') }}" class="btn btn-secondary flex-grow-1">
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

    <!-- Liste des publicités -->
    <div class="card">
        <div class="card-header">
            <h2 class="p-1 m-0 text-16 font-weight-semi">Liste des publicités approuvées</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped w-100" id="datatableAssignMedia">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Annonceur</th>
                            <th>Statut</th>
                            <th>Vues Actuelles</th>
                            <th>Objectif</th>
                            <th>Avancement</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($publicites as $publicite)
                            <tr>
                                <td>
                                    <strong>{{ $publicite->titre }}</strong>
                                    <br>
                                    <small class="text-muted">ID: #{{ $publicite->id }}</small>
                                </td>
                                <td>{{ $publicite->annonceur->nom }}</td>
                                <td>
                                    <span class="badge 
                                        @if($publicite->statut == 'validé') bg-success
                                        @elseif($publicite->statut == 'suspendu') bg-danger
                                        @else bg-warning @endif">
                                        {{ ucfirst($publicite->statut) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ number_format($publicite->nombre_vues) }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-primary">{{ number_format($publicite->objectif_vues) }}</span>
                                </td>
                                <td>
                                    @php
                                        $pourcentage = $publicite->objectif_vues > 0 ? min(100, ($publicite->nombre_vues / $publicite->objectif_vues) * 100) : 0;
                                    @endphp
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $pourcentage }}%;" aria-valuenow="{{ $pourcentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="text-muted">{{ round($pourcentage, 1) }}% atteint</small>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#assignMediaModal{{ $publicite->id }}" title="Affecter à des Médias">
                                        <i class="material-icons">assignment</i>
                                        <span class="d-none d-md-inline-block ms-1">Affecter</span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODALS pour l'affectation des médias -->
@foreach($publicites as $publicite)
<div class="modal fade" id="assignMediaModal{{ $publicite->id }}" tabindex="-1" aria-labelledby="assignMediaModalLabel{{ $publicite->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignMediaModalLabel{{ $publicite->id }}">
                    <i class="material-icons me-1">assignment</i>
                    Affecter des Médias : {{ $publicite->titre }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.publicites.assign-media-store', $publicite->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Sélectionnez les médias :</label>
                        <select name="media_ids[]" class="form-select select2-modal" multiple="multiple" id="select2-modal-{{ $publicite->id }}" style="width: 100%">
                            @foreach($medias as $media)
                                <option value="{{ $media->id }}" 
                                    @if($publicite->medias && $publicite->medias->contains($media->id)) selected @endif>
                                    {{ $media->nom_du_media }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted mt-1 d-block">Vous pouvez sélectionner plusieurs médias</small>
                    </div>

                    <!-- Informations récapitulatives -->
                    <div class="alert alert-info">
                        <div class="row">
                            <div class="col-md-6">
                                <i class="material-icons me-1">visibility</i>
                                <strong>Objectif vues :</strong> {{ number_format($publicite->objectif_vues, 0, ',', ' ') }}
                            </div>
                            <div class="col-md-6">
                                <i class="material-icons me-1">analytics</i>
                                <strong>Vues actuelles :</strong> {{ number_format($publicite->nombre_vues, 0, ',', ' ') }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Médias déjà affectés -->
                    @if($publicite->medias && $publicite->medias->count() > 0)
                        <div class="mt-3">
                            <label class="form-label fw-bold">Médias actuellement affectés :</label>
                            <div>
                                @foreach($publicite->medias as $media)
                                    <span class="badge bg-success me-1 mb-1">
                                        <i class="material-icons me-1" style="font-size: 12px;">check_circle</i>
                                        {{ $media->nom_du_media }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="material-icons me-1">close</i> Fermer
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="material-icons me-1">save</i> Enregistrer les affectations
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection

@section('scripts')
<!-- Chargement de Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
$(document).ready(function () {
    // Initialisation de DataTable (sans re-déclarer frenchTranslation car déjà dans master)
    if ($.fn.DataTable.isDataTable('#datatableAssignMedia')) {
        $('#datatableAssignMedia').DataTable().destroy();
    }
    
    // Initialisation de DataTable avec responsive
    var table = $('#datatableAssignMedia').DataTable({
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
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 6 },
            { responsivePriority: 3, targets: 2 },
            { responsivePriority: 4, targets: 5 },
            { responsivePriority: 5, targets: 1 },
            { responsivePriority: 6, targets: 3 },
            { responsivePriority: 7, targets: 4 }
        ],
        autoWidth: false,
        order: [[0, 'asc']]
    });
    
    // Vérifier si Select2 est chargé avant de l'utiliser
    if ($.fn.select2) {
        // Initialisation de Select2 pour les filtres
        $('#filterAnnonceur, #filterForfait').select2({
            placeholder: "Sélectionner...",
            allowClear: true,
            width: '100%'
        });
        
        // Initialisation des Select2 dans les modals
        function initSelectInModal(modal) {
            modal.find('.select2-modal').each(function() {
                if (!$(this).hasClass('select2-hidden-accessible')) {
                    $(this).select2({
                        placeholder: "Sélectionner les médias...",
                        allowClear: true,
                        width: '100%',
                        dropdownParent: modal
                    });
                }
            });
        }
        
        // Quand un modal s'ouvre, initialiser Select2
        $('.modal').on('shown.bs.modal', function() {
            initSelectInModal($(this));
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