@extends('dashboard.layouts.master')

@section('content')

<!-- SUBHEADER -->
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">Annonceurs</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Gestion</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Annonceurs</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h2 class="p-1 m-0 text-16 font-weight-semi">Liste des annonceurs</h2>
        </div>
        <div class="card-body">
            <table class="table nowrap" id="datatableScrollXY" style="width:100%">
                <thead>
                    <tr>
                        <th>Membre depuis</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($annonceurs as $annonceur)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($annonceur->created_at)->locale('fr')->isoFormat('DD/MM/YYYY') }}</td>
                        <td>{{ $annonceur->nom }}</td>
                        <td>{{ $annonceur->email }}</td>
                        <td>{{ $annonceur->telephone ?? '-' }}</td>
                        <td>{{ $annonceur->adresse ?? '-' }}</td>
                        <td>
                            <span class="badge 
                                @if($annonceur->statut == 'validé') bg-success 
                                @elseif($annonceur->statut == 'suspendu') bg-danger 
                                @else bg-warning @endif">
                                {{ ucfirst($annonceur->statut) }}
                            </span>
                        </td>
                        <td>
                            <!-- Voir Modal -->
                            <a href="#" class="text-info me-2" data-bs-toggle="modal" data-bs-target="#modalAnnonceur{{ $annonceur->id }}" title="Voir détails">
                                <i class="material-icons">visibility</i>
                            </a>
                            <!-- Actions rapides -->
                            @if($annonceur->statut !== 'validé')
                            <a href="{{ route('admin.annonceurs.toggle-status', [$annonceur->id, 'validate']) }}" class="text-success me-2 validate-btn" data-id="{{ $annonceur->id }}" title="Valider">
                                <i class="material-icons">check_circle</i>
                            </a>
                            @else
                            <a href="{{ route('admin.annonceurs.toggle-status', [$annonceur->id, 'suspend']) }}" class="text-warning me-2 suspend-btn" data-id="{{ $annonceur->id }}" title="Suspendre">
                                <i class="material-icons">pause_circle</i>
                            </a>
                            @endif
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<!-- MODALS (hors tableau) -->
@foreach($annonceurs as $annonceur)
<div class="modal fade" id="modalAnnonceur{{ $annonceur->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $annonceur->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-body">
                <!-- En-tête du profil -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center">
                            <div class="avatar-lg bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                <i class="material-icons">person</i>
                            </div>
                            <div>
                                <h4 class="mb-1">{{ $annonceur->nom }}</h4>
                                <p class="text-muted mb-0">Membre depuis le {{ \Carbon\Carbon::parse($annonceur->created_at)->locale('fr')->isoFormat('DD MMMM YYYY') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <span class="badge {{ $annonceur->actif ? 'bg-success' : 'bg-warning' }} fs-6 p-2">
                            {{ $annonceur->actif ? '✓ Compte Validé' : '⏳ En attente' }}
                        </span>
                    </div>
                </div>

                <!-- Nav pills -->
                <div class="nav-pills-primary w-100">
                    <ul class="nav nav-pills w-100 mb-4" id="pills-tab-{{ $annonceur->id }}" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-info-tab-{{ $annonceur->id }}" data-bs-toggle="pill" href="#pills-info-{{ $annonceur->id }}" role="tab" aria-controls="pills-info-{{ $annonceur->id }}" aria-selected="true">
                                <i class="material-icons me-1">info</i>
                                Informations
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-pub-tab-{{ $annonceur->id }}" data-bs-toggle="pill" href="#pills-pub-{{ $annonceur->id }}" role="tab" aria-controls="pills-pub-{{ $annonceur->id }}" aria-selected="false">
                                <i class="material-icons me-1">campaign</i>
                                Publicités ({{ $annonceur->publicites->count() }})
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-stats-tab-{{ $annonceur->id }}" data-bs-toggle="pill" href="#pills-stats-{{ $annonceur->id }}" role="tab" aria-controls="pills-stats-{{ $annonceur->id }}" aria-selected="false">
                                <i class="material-icons me-1">analytics</i>
                                Statistiques
                            </a>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="pills-tabContent-{{ $annonceur->id }}">
                        <!-- Infos Tab -->
                        <div class="tab-pane fade show active" id="pills-info-{{ $annonceur->id }}" role="tabpanel" aria-labelledby="pills-info-tab-{{ $annonceur->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-card mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="material-icons text-primary me-2">email</i>
                                            <strong>Email :</strong>
                                        </div>
                                        <p class="ms-4">{{ $annonceur->email }}</p>
                                    </div>
                                    
                                    <div class="info-card mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="material-icons text-primary me-2">phone</i>
                                            <strong>Téléphone :</strong>
                                        </div>
                                        <p class="ms-4">{{ $annonceur->telephone ?? 'Non renseigné' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-card mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="material-icons text-primary me-2">location_on</i>
                                            <strong>Adresse :</strong>
                                        </div>
                                        <p class="ms-4">{{ $annonceur->adresse ?? 'Non renseignée' }}</p>
                                    </div>
                                    
                                    <div class="info-card mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="material-icons text-primary me-2">calendar_today</i>
                                            <strong>Dernière connexion :</strong>
                                        </div>
                                        <p class="ms-4">{{ $annonceur->last_login ? \Carbon\Carbon::parse($annonceur->last_login)->locale('fr')->isoFormat('DD/MM/YYYY HH:mm') : 'Jamais' }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <!-- Publicités Tab -->
                        <div class="tab-pane fade" id="pills-pub-{{ $annonceur->id }}" role="tabpanel" aria-labelledby="pills-pub-tab-{{ $annonceur->id }}">
                            @if($annonceur->publicites->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Titre</th>
                                                <th>Type Média</th>
                                                <th>Forfait</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($annonceur->publicites as $pub)
                                            <tr>
                                                <td>
                                                    <strong>{{ $pub->titre ?? 'Sans titre' }}</strong>
                                                    @if($pub->statut === 'actif')
                                                        <span class="badge bg-success ms-1">Actif</span>
                                                    @elseif($pub->statut === 'en_attente')
                                                        <span class="badge bg-warning ms-1">En attente</span>
                                                    @else
                                                        <span class="badge bg-secondary ms-1">{{ $pub->statut }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">{{ $pub->type_media ?? '-' }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary">{{ $pub->forfait->libelle ?? '-' }}</span>
                                                    @if($pub->forfait)
                                                        <br><small class="text-muted">{{ $pub->forfait->montant ?? '0' }} FCFA</small>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                            @else
                                <div class="text-center py-5">
                                    <i class="material-icons text-muted" style="font-size: 48px;">campaign</i>
                                    <h5 class="text-muted mt-3">Aucune publicité</h5>
                                    <p class="text-muted">Cet annonceur n'a pas encore créé de publicités.</p>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Statistiques Tab -->
                        <div class="tab-pane fade" id="pills-stats-{{ $annonceur->id }}" role="tabpanel" aria-labelledby="pills-stats-tab-{{ $annonceur->id }}">
                            <div class="row text-center">
                                <div class="col-md-4 mb-3">
                                    <div class="card bg-primary text-white">
                                        <div class="card-body">
                                            <i class="material-icons mb-2">campaign</i>
                                            <h3>{{ $annonceur->publicites->count() }}</h3>
                                            <p class="mb-0">Publicités totales</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card bg-success text-white">
                                        <div class="card-body">
                                            <i class="material-icons mb-2">check_circle</i>
                                            <h3>{{ $annonceur->publicites->where('statut', 'approuve')->count() }}</h3>
                                            <p class="mb-0">Publicités actives</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card bg-info text-white">
                                        <div class="card-body">
                                            <i class="material-icons mb-2">calendar_today</i>
                                            <h3>{{ $annonceur->publicites->sum(fn($p) => $p->vues->count()) }}</h3>
                                            <p class="mb-0">Total de vues</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection


@section('scripts')
<!-- DATATABLES JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- SWEETALERT & TOASTR -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script>
$(document).ready(function () {
    // Datatable en français
    $('#datatableScrollXY').DataTable({
        scrollY: "400px",
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        searching: true,
        ordering: true,
        responsive: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        },
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
    });

    // Configuration de Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000"
    };

    // Fonction pour valider un annonceur
    $('.validate-btn').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var name = $(this).closest('tr').find('td:nth-child(2)').text();
        
        Swal.fire({
            title: 'Valider cet annonceur ?',
            html: `Vous êtes sur le point de valider le compte de <strong>${name}</strong>.`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, valider !',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/annonceurs/toggle-status/' + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        action: 'validate'
                    },
                    success: function(response) {
                        toastr.success(response.message, 'Succès');
                        setTimeout(() => location.reload(), 1500);
                    },
                    error: function(xhr) {
                        toastr.error('Une erreur est survenue lors de la validation', 'Erreur');
                    }
                });
            }
        });
    });

    // Fonction pour suspendre un annonceur
    $('.suspend-btn').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var name = $(this).closest('tr').find('td:nth-child(2)').text();
        
        Swal.fire({
            title: 'Suspendre cet annonceur ?',
            html: `Vous êtes sur le point de suspendre le compte de <strong>${name}</strong>.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f39c12',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, suspendre !',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/annonceurs/toggle-status/' + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        action: 'remove'
                    },
                    success: function(response) {
                        toastr.warning(response.message, 'Suspension');
                        setTimeout(() => location.reload(), 1500);
                    },
                    error: function(xhr) {
                        toastr.error('Une erreur est survenue lors de la suspension', 'Erreur');
                    }
                });
            }
        });
    });

    // Fonction pour supprimer un annonceur
    $('.delete-btn').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var name = $(this).data('name') || $(this).closest('tr').find('td:nth-child(2)').text();
        
        Swal.fire({
            title: 'Supprimer cet annonceur ?',
            html: `Êtes-vous sûr de vouloir supprimer définitivement <strong>${name}</strong> ?<br><span class="text-danger">Cette action est irréversible !</span>`,
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/annonceurs/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        toastr.success(response.message, 'Supprimé');
                        setTimeout(() => location.reload(), 1500);
                    },
                    error: function(xhr) {
                        toastr.error('Une erreur est survenue lors de la suppression', 'Erreur');
                    }
                });
            }
        });
    });
});
</script>
@endsection