@extends('dashboard.layouts.master')

@section('content')

<!-- SUBHEADER -->
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">Demandes de Paiement</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Gestion</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Paiements</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid mt-3">
    <!-- FORMULAIRE DE RECHERCHE -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.paiements.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3 col-sm-12">
                        <label class="form-label">Statut</label>
                        <select name="statut" class="form-select" id="filterStatut">
                            <option value="">--Tous--</option>
                            <option value="en_attente" {{ request('statut')=='en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="approuve" {{ request('statut')=='approuve' ? 'selected' : '' }}>Approuvé</option>
                            <option value="paye" {{ request('statut')=='paye' ? 'selected' : '' }}>Payé</option>
                            <option value="rejete" {{ request('statut')=='rejete' ? 'selected' : '' }}>Rejeté</option>
                        </select>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <label class="form-label">Média</label>
                        <select name="media_id" class="form-select" id="filterMedia">
                            <option value="">--Tous--</option>
                            @foreach($medias as $media)
                                <option value="{{ $media->id }}" {{ request('media_id') == $media->id ? 'selected' : '' }}>
                                    {{ $media->nom_du_media }}
                                </option>
                            @endforeach
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

                    <div class="col-md-2 col-sm-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1">
                                <i class="material-icons me-1">search</i> Rechercher
                            </button>
                            <a href="{{ route('admin.paiements.index') }}" class="btn btn-secondary flex-grow-1">
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

    <!-- Liste des demandes -->
    <div class="card">
        <div class="card-header">
            <h2 class="p-1 m-0 text-16 font-weight-semi">Liste des demandes de paiement</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped w-100" id="datatablePaiements">
                    <thead>
                        <tr>
                            <th>Média</th>
                            <th>Vues Total</th>
                            <th>Clics Total</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Détection Fraude</th>
                            <th>Date Demande</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($demandes as $demande)
                            <tr class="@if($demande->fraude_detectee) table-warning @endif">
                                <td>
                                    <strong>{{ $demande->media->nom_du_media }}</strong>
                                    <br>
                                    <small class="text-muted">ID: #{{ $demande->id }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ number_format($demande->vues_total) }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-primary">{{ number_format($demande->clics_total) }}</span>
                                </td>
                                <td>
                                    <strong class="text-success">{{ number_format($demande->montant, 0, ',', ' ') }} FCFA</strong>
                                </td>
                                <td>
                                    <span class="badge 
                                        @if($demande->statut == 'paye') bg-success
                                        @elseif($demande->statut == 'approuve') bg-info
                                        @elseif($demande->statut == 'rejete') bg-danger
                                        @else bg-warning @endif">
                                        @if($demande->statut == 'en_attente')
                                            En attente
                                        @elseif($demande->statut == 'approuve')
                                            Approuvé
                                        @elseif($demande->statut == 'paye')
                                            Payé
                                        @elseif($demande->statut == 'rejete')
                                            Rejeté
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    @if($demande->fraude_detectee)
                                        <span class="badge bg-danger" title="{{ $demande->raison_fraude }}">
                                            ⚠️ Fraude
                                        </span>
                                    @else
                                        <span class="badge bg-success">✓ Normal</span>
                                    @endif
                                </td>
                                <td>{{ $demande->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        @if($demande->statut == 'en_attente')
                                            <a href="{{ route('admin.paiements.payer', $demande->id) }}" 
                                               class="btn btn-primary" title="Approuver et payer">
                                                <i class="material-icons">payment</i>
                                                <span class="d-none d-md-inline-block ms-1">Payer</span>
                                            </a>
                                           
                                            <button type="button" class="btn btn-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#rejeterModal{{ $demande->id }}" title="Rejeter">
                                                <i class="material-icons">close</i>
                                                <span class="d-none d-md-inline-block ms-1">Rejeter</span>
                                            </button>
                                        @elseif($demande->statut == 'approuve')
                                            <a href="{{ route('admin.paiements.payer', $demande->id) }}" 
                                               class="btn btn-success" title="Procéder au paiement">
                                                <i class="material-icons">paid</i>
                                                <span class="d-none d-md-inline-block ms-1">Payer</span>
                                            </a>
                                        @elseif($demande->statut == 'paye')
                                            <span class="text-success">
                                                <i class="material-icons">check_circle</i> Payé
                                            </span>
                                        @elseif($demande->statut == 'rejete')
                                            <span class="text-danger">
                                                <i class="material-icons">cancel</i> Rejeté
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Modal pour rejeter -->
                                    <div class="modal fade" id="rejeterModal{{ $demande->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        <i class="material-icons me-1">error</i>
                                                        Rejeter la demande
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form method="POST" action="{{ route('admin.paiements.rejeter', $demande->id) }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Raison du rejet</label>
                                                            <textarea name="raison" class="form-control" rows="3" required 
                                                                      placeholder="Expliquez la raison du rejet..."></textarea>
                                                            <small class="text-muted mt-1 d-block">Cette raison sera communiquée au média</small>
                                                        </div>
                                                        <div class="alert alert-warning">
                                                            <i class="material-icons me-1">warning</i>
                                                            Cette action est irréversible.
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                            <i class="material-icons me-1">close</i> Annuler
                                                        </button>
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="material-icons me-1">cancel</i> Confirmer le rejet
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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
    if ($.fn.DataTable.isDataTable('#datatablePaiements')) {
        $('#datatablePaiements').DataTable().destroy();
    }
    
    // Initialisation de DataTable avec responsive
    var table = $('#datatablePaiements').DataTable({
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
            { responsivePriority: 1, targets: 0 },  // Média - priorité haute
            { responsivePriority: 2, targets: 7 },  // Actions - priorité haute
            { responsivePriority: 3, targets: 4 },  // Statut - priorité moyenne
            { responsivePriority: 4, targets: 5 },  // Fraude - priorité moyenne
            { responsivePriority: 5, targets: 3 },  // Montant - priorité moyenne
            { responsivePriority: 6, targets: 1 },  // Vues - priorité basse
            { responsivePriority: 7, targets: 2 },  // Clics - priorité basse
            { responsivePriority: 8, targets: 6 }   // Date - priorité basse
        ],
        autoWidth: false,
        order: [[6, 'desc']] // Trier par date décroissante
    });
    
    // Vérifier si Select2 est chargé avant de l'utiliser
    if ($.fn.select2) {
        // Initialisation de Select2 pour les filtres
        $('#filterStatut, #filterMedia').select2({
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