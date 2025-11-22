@extends('dashboard.layouts.master')

@section('content')

<!-- SUBHEADER -->
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">Médias</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="/"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Gestion</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Médias</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h2 class="p-1 m-0 text-16 font-weight-semi">Liste des Médias</h2>
        </div>
        <div class="card-body">
            <table class="table nowrap" id="datatableScrollXY" style="width:100%">
                <thead>
                    <tr>
                        <th>Date inscription</th>
                        <th>Nom du média</th>
                        <th>URL</th>
                        <th>Vues</th>
                        <th>Clics</th>
                        <th>Revenu (FCFA)</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($medias as $media)
                    <tr>
                        <td>{{ $media->created_at->format('d/m/Y') }}</td>
                        <td>{{ $media->nom_du_media }}</td>
                        <td><a href="{{ $media->url_site }}" target="_blank">{{ $media->url_site }}</a></td>

                        <td><span class="badge bg-primary">{{ $media->total_vues }}</span></td>
                        <td><span class="badge bg-info">{{ $media->total_clics }}</span></td>
                        <td><b>{{ number_format($media->revenu_actuel, 0, ',', ' ') }}</b></td>

                        <td>
                            <span class="badge 
                                @if($media->statut == 'validé') bg-success 
                                @elseif($media->statut == 'suspendu') bg-danger 
                                @else bg-warning @endif">
                                {{ ucfirst($media->statut) }}
                            </span>
                        </td>

                        <td>
                            <!-- Voir détails -->
                            <a href="#" class="text-info me-2" data-bs-toggle="modal"
                                data-bs-target="#modalMedia{{ $media->id }}">
                                <i class="material-icons">visibility</i>
                            </a>

                            @if($media->statut !== 'validé')
                                <a href="{{ route('admin.medias.toggle-status', [$media->id, 'validate']) }}" class="text-success me-2">
                                    <i class="material-icons">check_circle</i>
                                </a>
                            @else
                                <a href="{{ route('admin.medias.toggle-status', [$media->id, 'suspend']) }}" class="text-warning me-2">
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

@foreach($medias as $media)
<div class="modal fade" id="modalMedia{{ $media->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">

                <!-- En-tête -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center">
                            <div class="avatar-lg bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                <i class="material-icons">language</i>
                            </div>
                            <div>
                                <h4>{{ $media->nom_du_media }}</h4>
                                <p class="text-muted mb-0">Inscrit le
                                    {{ $media->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 text-end">
                        <span class="badge
                            @if($media->statut=='validé') bg-success
                            @elseif($media->statut=='suspendu') bg-danger
                            @else bg-warning @endif fs-6 p-2">
                            {{ ucfirst($media->statut) }}
                        </span>
                    </div>
                </div>

                <!-- Onglets -->
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="pill"
                           href="#info{{ $media->id }}">
                           <i class="material-icons me-1">info</i> Informations
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="pill"
                           href="#stats{{ $media->id }}">
                           <i class="material-icons me-1">analytics</i> Vues & Clics
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="pill"
                           href="#pubs{{ $media->id }}">
                           <i class="material-icons me-1">photo_library</i> Publicités
                        </a>
                    </li>
                </ul>

                <div class="tab-content">

                    <!-- TAB INFORMATIONS -->
                    <div class="tab-pane fade show active" id="info{{ $media->id }}">
                       <div class="row mb-3">
                            <!-- Colonne gauche -->
                            <div class="col-6">
                                <dl class="row mb-0">
                                    <dt class="col-6">Nom du média :</dt>
                                    <dd class="col-6">{{ $media->nom_du_media }}</dd>

                                    <dt class="col-6">URL :</dt>
                                    <dd class="col-6">
                                        <a href="{{ $media->url_site }}" target="_blank">{{ $media->url_site }}</a>
                                    </dd>

                                    <dt class="col-6">RCCM :</dt>
                                    <dd class="col-6">{{ $media->numero_rccm }}</dd>

                                    <dt class="col-6">Téléphone :</dt>
                                    <dd class="col-6">{{ $media->telephone }}</dd>
                                </dl>
                            </div>

                            <!-- Colonne droite -->
                            <div class="col-6">
                                <dl class="row mb-0">
                                    <dt class="col-6">Email :</dt>
                                    <dd class="col-6">{{ $media->email }}</dd>

                                    <dt class="col-6">Adresse :</dt>
                                    <dd class="col-6">{{ $media->adresse }}</dd>

                                    <dt class="col-6">Statut :</dt>
                                    <dd class="col-6">{{ $media->statut }}</dd>

                                    <dt class="col-6">Logo :</dt>
                                    <dd class="col-6">
                                        @if($media->logo_media)
                                            <img src="{{ asset('storage/'.$media->logo_media) }}" alt="Logo" class="img-fluid rounded">
                                        @else
                                            Aucun logo
                                        @endif
                                    </dd>
                                </dl>
                            </div>
                        </div>

                    </div>



                    <!-- TAB STATS -->
                    <div class="tab-pane fade" id="stats{{ $media->id }}">
                        <div class="row text-center">

                            <div class="col-md-4 mb-3">
                                <div class="card bg-primary text-white">
                                    <div class="card-body">
                                        <i class="material-icons mb-2">visibility</i>
                                        <h3>{{ $media->total_vues }}</h3>
                                        <p>Vues</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card bg-info text-white">
                                    <div class="card-body">
                                        <i class="material-icons mb-2">mouse</i>
                                        <h3>{{ $media->total_clics }}</h3>
                                        <p>Clics</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card bg-success text-white">
                                    <div class="card-body">
                                        <i class="material-icons mb-2">payments</i>
                                        <h3>{{ number_format($media->revenu_actuel, 0, ',', ' ') }}</h3>
                                        <p>Revenu</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- TAB PUBLICITES ACTIVES -->
                    <div class="tab-pane fade" id="pubs{{ $media->id }}">
                        @if($media->publicites_actives->count() > 0)
                            <div class="row">

                                @foreach($media->publicites_actives as $pub)

                                    <div class="col-md-3 mb-3">
                                        <div class="card shadow-sm">
                                            <div class="card-body text-center">

                                                @if(Str::endsWith($pub->media_path, ['.jpg','.png','.jpeg','.webp']))
                                                    <img src="{{ asset('storage/'.$pub->media_path) }}"
                                                        class="img-fluid rounded" />
                                                @elseif(Str::endsWith($pub->media_path, ['.mp4']))
                                                    <video src="{{ asset('storage/'.$pub->media_path) }}"
                                                        class="img-fluid rounded" autoplay loop muted></video>
                                                @endif


                                                <h6 class="mt-2">{{ $pub->titre }}</h6>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach

                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="material-icons text-muted" style="font-size:40px;">photo_library</i>
                                <p class="text-muted mt-2">Aucune publicité active</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
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

    // Configuration de Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000"
    };



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