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
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Gestion</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Médias</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- TABLE -->
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h2 class="p-1 m-0 text-16 font-weight-semi">Liste des médias</h2>
        </div>
        <div class="card-body">
            <table class="table nowrap" id="datatableMedia" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom du média</th>
                        <th>Propriétaire</th>
                        <th>URL</th>
                        <th>Vues totales</th>
                        <th>Clics totaux</th>
                        <th>Revenu actuel</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($medias as $media)
                    <tr>
                        <td>{{ $media->nom_du_media }}</td>
                        <td>{{ $media->user->name ?? '-' }}</td>
                        <td><a href="{{ $media->url_site }}" target="_blank">{{ $media->url_site }}</a></td>
                        <td>{{ $media->total_vues ?? 0 }}</td>
                        <td>{{ $media->total_clics ?? 0 }}</td>
                        <td>{{ number_format($media->revenu_actuel,0,'',' ') }} FCFA</td>
                        <td>
                            <!-- Voir Modal -->
                            <a href="#" class="text-info me-2" data-bs-toggle="modal" data-bs-target="#modalMedia{{ $media->id }}" title="Voir détails">
                                <i class="material-icons">visibility</i>
                            </a>
                            <!-- Actions rapides -->
                            <a href="#" class="text-success me-2 validate-media-btn" data-id="{{ $media->id }}" title="Valider">
                                <i class="material-icons">check_circle</i>
                            </a>
                            <a href="#" class="text-warning me-2 suspend-media-btn" data-id="{{ $media->id }}" title="Suspendre">
                                <i class="material-icons">pause_circle</i>
                            </a>
                            <a href="#" class="text-danger delete-media-btn" data-id="{{ $media->id }}" data-name="{{ $media->nom_du_media }}" title="Supprimer">
                                <i class="material-icons">delete</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODALS -->
@foreach($medias as $media)
<div class="modal fade" id="modalMedia{{ $media->id }}" tabindex="-1" aria-labelledby="modalMediaLabel{{ $media->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center">
                            <div class="avatar-lg bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                <i class="material-icons">perm_media</i>
                            </div>
                            <div>
                                <h4 class="mb-1">{{ $media->nom_du_media }}</h4>
                                <p class="text-muted mb-0">Propriétaire: {{ $media->user->name ?? 'Non renseigné' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <span class="badge bg-success fs-6 p-2">
                            Statut actif
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="info-card mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="material-icons text-primary me-2">link</i>
                                <strong>URL :</strong>
                            </div>
                            <p class="ms-4"><a href="{{ $media->url_site }}" target="_blank">{{ $media->url_site }}</a></p>
                        </div>
                        <div class="info-card mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="material-icons text-primary me-2">visibility</i>
                                <strong>Total Vues :</strong>
                            </div>
                            <p class="ms-4">{{ $media->total_vues ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-card mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="material-icons text-primary me-2">touch_app</i>
                                <strong>Total Clics :</strong>
                            </div>
                            <p class="ms-4">{{ $media->total_clics ?? 0 }}</p>
                        </div>
                        <div class="info-card mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="material-icons text-primary me-2">paid</i>
                                <strong>Revenu actuel :</strong>
                            </div>
                            <p class="ms-4">{{ number_format($media->revenu_actuel,0,'',' ') }} FCFA</p>
                        </div>
                    </div>
                </div>

                <h6>Publicités associées :</h6>
                @if($media->publicites->count())
                <ul>
                    @foreach($media->publicites as $pub)
                        <li>{{ $pub->titre }} - Statut: {{ $pub->pivot->status }}</li>
                    @endforeach
                </ul>
                @else
                    <p class="text-muted">Aucune publicité associée.</p>
                @endif

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
<script>
$(document).ready(function () {
    $('#datatableMedia').DataTable({
        scrollY: "400px",
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        searching: true,
        ordering: true,
        responsive: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        }
    });

    // Actions médias (validate, suspend, delete)
    $('.validate-media-btn').click(function(e){
        e.preventDefault();
        let id = $(this).data('id');
        Swal.fire({
            title: 'Valider ce média ?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui',
            cancelButtonText: 'Annuler'
        }).then((res)=>{
            if(res.isConfirmed){
                $.post('/admin/medias/toggle-status/'+id, {_token:'{{ csrf_token() }}', action:'validate'}, function(resp){
                    toastr.success(resp.message);
                    setTimeout(()=>location.reload(),1500);
                });
            }
        });
    });

    $('.suspend-media-btn').click(function(e){
        e.preventDefault();
        let id = $(this).data('id');
        Swal.fire({
            title: 'Suspendre ce média ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f39c12',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui',
            cancelButtonText: 'Annuler'
        }).then((res)=>{
            if(res.isConfirmed){
                $.post('/admin/medias/toggle-status/'+id, {_token:'{{ csrf_token() }}', action:'suspend'}, function(resp){
                    toastr.warning(resp.message);
                    setTimeout(()=>location.reload(),1500);
                });
            }
        });
    });

    $('.delete-media-btn').click(function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let name = $(this).data('name');
        Swal.fire({
            title: 'Supprimer ce média ?',
            html: `Supprimer définitivement <strong>${name}</strong> ?`,
            icon: 'error',
            showCancelButton:true,
            confirmButtonColor:'#d33',
            cancelButtonColor:'#3085d6',
            confirmButtonText:'Oui',
            cancelButtonText:'Annuler'
        }).then((res)=>{
            if(res.isConfirmed){
                $.ajax({
                    url:'/admin/medias/'+id,
                    type:'DELETE',
                    data:{_token:'{{ csrf_token() }}'},
                    success:function(resp){
                        toastr.success(resp.message);
                        setTimeout(()=>location.reload(),1500);
                    }
                });
            }
        });
    });
});
</script>
@endsection
