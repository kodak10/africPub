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

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="p-1 m-0 text-16 font-weight-semi">Liste des Médias</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped nowrap w-100" id="datatableMedias">
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
                                    <td><a href="{{ $media->url_site }}" target="_blank">{{ Str::limit($media->url_site, 30) }}</a></td>
                                    <td><span class="badge bg-primary">{{ number_format($media->total_vues) }}</span></td>
                                    <td><span class="badge bg-info">{{ number_format($media->total_clics) }}</span></td>
                                    <td><b>{{ number_format($media->revenu_actuel, 0, ',', ' ') }}</b> FCFA</td>
                                    <td>
                                        <span class="badge 
                                            @if($media->statut == 'validé') bg-success 
                                            @elseif($media->statut == 'suspendu') bg-danger 
                                            @else bg-warning @endif">
                                            {{ ucfirst($media->statut) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="#" title="Voir les informations" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalMedia{{ $media->id }}">
                                                <i class="material-icons">visibility</i>
                                            </a>

                                            @if($media->statut !== 'validé')
                                                <a href="{{ route('admin.medias.toggle-status', [$media->id, 'validate']) }}" title="Valider" class="btn btn-sm btn-success">
                                                    <i class="material-icons">check_circle</i>
                                                </a>
                                            @else
                                                <a href="{{ route('admin.medias.toggle-status', [$media->id, 'suspend']) }}" title="Suspendre" class="btn btn-sm btn-warning">
                                                    <i class="material-icons">pause_circle</i>
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
    </div>
</div>

<!-- Modals for each media -->
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
                                <p class="text-muted mb-0">Inscrit le {{ $media->created_at->format('d/m/Y') }}</p>
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
                        <a class="nav-link active" data-bs-toggle="pill" href="#info{{ $media->id }}">
                            <i class="material-icons me-1">info</i> Informations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="pill" href="#stats{{ $media->id }}">
                            <i class="material-icons me-1">analytics</i> Vues & Clics
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="pill" href="#pubs{{ $media->id }}">
                            <i class="material-icons me-1">photo_library</i> Publicités
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- TAB INFORMATIONS -->
                    <div class="tab-pane fade show active" id="info{{ $media->id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <dl class="row">
                                    <dt class="col-5">Nom du média :</dt>
                                    <dd class="col-7">{{ $media->nom_du_media }}</dd>

                                    <dt class="col-5">URL :</dt>
                                    <dd class="col-7"><a href="{{ $media->url_site }}" target="_blank">{{ $media->url_site }}</a></dd>

                                    <dt class="col-5">RCCM :</dt>
                                    <dd class="col-7">{{ $media->numero_rccm ?? 'Non renseigné' }}</dd>

                                    <dt class="col-5">Téléphone :</dt>
                                    <dd class="col-7">{{ $media->telephone }}</dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <dl class="row">
                                    <dt class="col-5">Email :</dt>
                                    <dd class="col-7">{{ $media->email }}</dd>

                                    <dt class="col-5">Adresse :</dt>
                                    <dd class="col-7">{{ $media->adresse ?? 'Non renseignée' }}</dd>

                                    <dt class="col-5">Statut :</dt>
                                    <dd class="col-7">{{ ucfirst($media->statut) }}</dd>

                                    <dt class="col-5">Logo :</dt>
                                    <dd class="col-7">
                                        @if($media->logo_media)
                                            <img src="{{ asset('storage/'.$media->logo_media) }}" alt="Logo" class="img-fluid rounded" style="max-height: 80px;">
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
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card bg-primary text-white">
                                    <div class="card-body text-center">
                                        <i class="material-icons mb-2">visibility</i>
                                        <h3>{{ number_format($media->total_vues) }}</h3>
                                        <p>Vues</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card bg-info text-white">
                                    <div class="card-body text-center">
                                        <i class="material-icons mb-2">mouse</i>
                                        <h3>{{ number_format($media->total_clics) }}</h3>
                                        <p>Clics</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card bg-success text-white">
                                    <div class="card-body text-center">
                                        <i class="material-icons mb-2">payments</i>
                                        <h3>{{ number_format($media->revenu_actuel, 0, ',', ' ') }} FCFA</h3>
                                        <p>Revenu</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB PUBLICITES ACTIVES -->
                    <div class="tab-pane fade" id="pubs{{ $media->id }}">
                        @if($media->publicites_actives && $media->publicites_actives->count() > 0)
                            <div class="row">
                                @foreach($media->publicites_actives as $pub)
                                    <div class="col-md-3 mb-3">
                                        <div class="card shadow-sm">
                                            <div class="card-body text-center">
                                                @if(Str::endsWith($pub->media_path, ['.jpg','.png','.jpeg','.webp']))
                                                    <img src="{{ asset('storage/'.$pub->media_path) }}" class="img-fluid rounded" style="max-height: 150px;">
                                                @elseif(Str::endsWith($pub->media_path, ['.mp4']))
                                                    <video src="{{ asset('storage/'.$pub->media_path) }}" class="img-fluid rounded" autoplay loop muted style="max-height: 150px;"></video>
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
<script>
$(document).ready(function() {
    // Initialisation de DataTable
    if ($.fn.dataTable.isDataTable('#datatableMedias')) {
        $('#datatableMedias').DataTable().destroy();
    }
    
    $('#datatableMedias').DataTable({
        responsive: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tous"]],
        autoWidth: false,
        columnDefs: [
            { width: "120px", targets: 0 },
            { width: "200px", targets: 1 },
            { width: "150px", targets: 2 },
            { width: "80px", targets: 3 },
            { width: "80px", targets: 4 },
            { width: "120px", targets: 5 },
            { width: "100px", targets: 6 },
            { width: "120px", targets: 7 }
        ]
    });

    // Toastr notifications
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @elseif(session('error'))
        toastr.error("{{ session('error') }}");
    @endif
});
</script>
@endsection