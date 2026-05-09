@extends('dashboard.layouts.master')

@section('content')

<!-- SUBHEADER -->
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">Demandes de Remboursement - Annonceurs</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Remboursements</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Annonceurs</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid mt-3">
    <!-- Cartes de statistiques -->
    <div class="row mb-4">
        <div class="col-md-4 col-sm-12">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="mb-0">{{ $totalEnAttente }}</h4>
                            <p class="mb-0">En attente</p>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="material-icons" style="font-size: 40px;">pending_actions</i>
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
                            <h4 class="mb-0">{{ $totalApprouve }}</h4>
                            <p class="mb-0">Approuvées</p>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="material-icons" style="font-size: 40px;">check_circle</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="mb-0">{{ number_format($montantTotal, 0, ',', ' ') }} FCFA</h4>
                            <p class="mb-0">Montant à rembourser</p>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="material-icons" style="font-size: 40px;">payments</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FORMULAIRE DE RECHERCHE -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.paiements.remboursements.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3 col-sm-12">
                        <label class="form-label">Annonceur</label>
                        <select name="annonceur_id" class="form-select" id="filterAnnonceur">
                            <option value="">Tous les annonceurs</option>
                            @foreach($annonceurs as $annonceur)
                                <option value="{{ $annonceur->id }}" {{ request('annonceur_id') == $annonceur->id ? 'selected' : '' }}>
                                    {{ $annonceur->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <label class="form-label">Statut</label>
                        <select name="statut" class="form-select" id="filterStatut">
                            <option value="">Tous les statuts</option>
                            <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="approuve" {{ request('statut') == 'approuve' ? 'selected' : '' }}>Approuvé</option>
                            <option value="rejete" {{ request('statut') == 'rejete' ? 'selected' : '' }}>Rejeté</option>
                            <option value="rembourse" {{ request('statut') == 'rembourse' ? 'selected' : '' }}>Remboursé</option>
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
                            <a href="{{ route('admin.paiements.remboursements.index') }}" class="btn btn-secondary flex-grow-1">
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
            <h2 class="p-1 m-0 text-16 font-weight-semi">Liste des demandes de remboursement</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped w-100" id="datatableRemboursements">
                    <thead>
                        <tr>
                            <th>Date Demande</th>
                            <th>Annonceur</th>
                            <th>Facture</th>
                            <th>Montant</th>
                            <th>Raison</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($demandes as $demande)
                        <tr>
                            <td>
                                <strong>{{ $demande->created_at->format('d/m/Y') }}</strong>
                                <br>
                                <small class="text-muted">{{ $demande->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" 
                                         style="width: 30px; height: 30px;">
                                        <i class="material-icons text-white" style="font-size: 16px;">person</i>
                                    </div>
                                    <div>
                                        <strong>{{ $demande->annonceur->nom }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $demande->annonceur->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <small class="text-muted">{{ $demande->paiementAnnonceur->numero_facture ?? 'N/A' }}</small>
                            </td>
                            <td>
                                <strong class="text-primary">{{ number_format($demande->montant, 0, ',', ' ') }} FCFA</strong>
                            </td>
                            <td>
                                <span class="text-truncate d-inline-block" style="max-width: 200px;" 
                                      title="{{ $demande->raison }}">
                                    {{ Str::limit($demande->raison, 50) }}
                                </span>
                            </td>
                            <td>
                                @switch($demande->statut)
                                    @case('en_attente')
                                        <span class="badge bg-warning">
                                            <i class="material-icons me-1" style="font-size: 14px;">pending</i>En attente
                                        </span>
                                        @break
                                    @case('approuve')
                                        <span class="badge bg-success">
                                            <i class="material-icons me-1" style="font-size: 14px;">check_circle</i>Approuvé
                                        </span>
                                        @break
                                    @case('rejete')
                                        <span class="badge bg-danger">
                                            <i class="material-icons me-1" style="font-size: 14px;">cancel</i>Rejeté
                                        </span>
                                        @break
                                    @case('rembourse')
                                        <span class="badge bg-info">
                                            <i class="material-icons me-1" style="font-size: 14px;">paid</i>Remboursé
                                        </span>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <!-- Voir détails -->
                                    <a href="{{ route('admin.paiements.remboursements.show', $demande->id) }}" 
                                       class="btn btn-info" 
                                       title="Voir détails">
                                        <i class="material-icons">visibility</i>
                                    </a>
                                    
                                    <!-- Actions selon statut -->
                                    @if($demande->statut == 'en_attente')
                                        <a href="{{ route('admin.paiements.remboursements.approuver', $demande->id) }}" 
                                           class="btn btn-success"
                                           onclick="return confirm('Approuver cette demande de remboursement ?')"
                                           title="Approuver">
                                            <i class="material-icons">check</i>
                                        </a>
                                        <button type="button" class="btn btn-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#rejeterModal{{ $demande->id }}"
                                                title="Rejeter">
                                            <i class="material-icons">close</i>
                                        </button>
                                    @elseif($demande->statut == 'approuve')
                                        <button type="button" class="btn btn-primary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#rembourserModal{{ $demande->id }}"
                                                title="Procéder au remboursement">
                                            <i class="material-icons">payments</i>
                                        </button>
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
                                            <form method="POST" action="{{ route('admin.paiements.remboursements.rejeter', $demande->id) }}">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Raison du rejet</label>
                                                        <textarea name="raison_rejet" class="form-control" rows="3" required 
                                                                  placeholder="Expliquez la raison du rejet..."></textarea>
                                                        <small class="text-muted mt-1 d-block">Cette raison sera communiquée à l'annonceur</small>
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

                                <!-- Modal pour rembourser -->
                                <div class="modal fade" id="rembourserModal{{ $demande->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    <i class="material-icons me-1">payments</i>
                                                    Procéder au remboursement
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form method="POST" action="{{ route('admin.paiements.remboursements.rembourser', $demande->id) }}">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Méthode de remboursement</label>
                                                        <select name="methode_remboursement" class="form-select" required>
                                                            <option value="">Sélectionner...</option>
                                                            <option value="virement_bancaire">Virement Bancaire</option>
                                                            <option value="carte_credit">Carte de Crédit</option>
                                                            <option value="cheque">Chèque</option>
                                                            <option value="credit_plateforme">Crédit Plateforme</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Référence du remboursement</label>
                                                        <input type="text" name="reference_remboursement" class="form-control" required
                                                               placeholder="Numéro de transaction ou référence">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Date du remboursement</label>
                                                        <input type="date" name="date_remboursement" class="form-control" required
                                                               value="{{ now()->format('Y-m-d') }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="material-icons me-1">close</i> Annuler
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="material-icons me-1">check</i> Confirmer le remboursement
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
    if ($.fn.DataTable.isDataTable('#datatableRemboursements')) {
        $('#datatableRemboursements').DataTable().destroy();
    }
    
    // Initialisation de DataTable avec responsive
    var table = $('#datatableRemboursements').DataTable({
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
            { responsivePriority: 1, targets: 1 },  // Annonceur - priorité haute
            { responsivePriority: 2, targets: 6 },  // Actions - priorité haute
            { responsivePriority: 3, targets: 5 },  // Statut - priorité moyenne
            { responsivePriority: 4, targets: 3 },  // Montant - priorité moyenne
            { responsivePriority: 5, targets: 0 },  // Date - priorité moyenne
            { responsivePriority: 6, targets: 2 },  // Facture - priorité basse
            { responsivePriority: 7, targets: 4 }   // Raison - priorité basse
        ],
        autoWidth: false,
        order: [[0, 'desc']] // Trier par date décroissante
    });
    
    // Vérifier si Select2 est chargé avant de l'utiliser
    if ($.fn.select2) {
        // Initialisation de Select2 pour les filtres
        $('#filterAnnonceur, #filterStatut').select2({
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