@extends('dashboard.layouts.master')

@section('content')

<div class="subheader px-lg">
    <div class="subheader-container">
        <h3 class="subheader-title">Gestion des Publicités</h3>
    </div>
</div>

<div class="container-fluid px-lg">
    <!-- FORMULAIRE DE RECHERCHE -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.publicites.index') }}" class="row g-3">
                <div class="col-md-2 col-sm-6">
                    <label>Statut</label>
                    <select name="statut" class="form-select">
                        <option value="">--Tous--</option>
                        <option value="en_attente_paiement" {{ request('statut')=='en_attente_paiement' ? 'selected' : '' }}>En attente de paiement</option>
                        <option value="en_attente_validation" {{ request('statut')=='en_attente_validation' ? 'selected' : '' }}>En attente de validation</option>
                        <option value="validé" {{ request('statut')=='validé' ? 'selected' : '' }}>Validé</option>
                        <option value="rejete" {{ request('statut')=='rejete' ? 'selected' : '' }}>Rejeté</option>
                    </select>
                </div>

                <div class="col-md-2 col-sm-6">
                    <label>Média</label>
                    <select name="media_id" class="form-select">
                        <option value="">--Tous--</option>
                        @foreach($medias as $media)
                            <option value="{{ $media->id }}" {{ request('media_id') == $media->id ? 'selected' : '' }}>
                                {{ $media->nom_du_media }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 col-sm-6">
                    <label>Annonceur</label>
                    <select name="annonceur_id" class="form-select">
                        <option value="">--Tous--</option>
                        @foreach($annonceurs as $ann)
                            <option value="{{ $ann->id }}" {{ request('annonceur_id') == $ann->id ? 'selected' : '' }}>
                                {{ $ann->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-1 col-sm-6">
                    <label>Vues min</label>
                    <input type="number" name="min_vues" class="form-control" value="{{ request('min_vues') }}">
                </div>

                <div class="col-md-1 col-sm-6">
                    <label>Vues max</label>
                    <input type="number" name="max_vues" class="form-control" value="{{ request('max_vues') }}">
                </div>

                <div class="col-md-2 col-sm-6">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary w-100">Rechercher</button>
                </div>
                <div class="col-md-2 col-sm-6">
                    <label>&nbsp;</label>
                    <a href="{{ route('admin.publicites.index') }}" class="btn btn-secondary w-100">Réinitialiser</a>
                </div>
            </form>
        </div>
    </div>

    <!-- TABLEAU DES PUBLICITÉS -->
    <div class="card shadow">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped w-100" id="datatablePublicites">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Titre</th>
                            <th>Média</th>
                            <th>Annonceur</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($publicites as $pub)
                        <tr>
                            <td>{{ $pub->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $pub->titre }}</td>
                            <td>
                                @foreach($pub->medias as $m)
                                    <span class="badge bg-info">{{ $m->nom_du_media }}</span>
                                @endforeach
                            </td>
                            <td>{{ $pub->annonceur->nom }}</td>
                            <td>
                                <span class="badge 
                                    @if($pub->statut=='validé') bg-success
                                    @elseif($pub->statut=='suspendu') bg-danger
                                    @else bg-warning @endif">
                                    {{ ucfirst($pub->statut) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalPub{{ $pub->id }}" class="btn btn-info" title="Aperçu">
                                        <i class="material-icons">visibility</i>
                                    </a>

                                    @if($pub->statut == 'brouillon' || $pub->statut == 'en_attente_paiement' || $pub->statut == 'en_attente_validation')
                                        <a href="{{ route('admin.publicites.change-status', [$pub->id, 'validé']) }}" class="btn btn-success" title="Valider">
                                            <i class="material-icons">check_circle</i>
                                        </a>
                                        <a href="{{ route('admin.publicites.change-status', [$pub->id, 'suspendu']) }}" class="btn btn-warning" title="Suspendre">
                                            <i class="material-icons">pause_circle</i>
                                        </a>
                                    @elseif($pub->statut == 'validé')
                                        <a href="{{ route('admin.publicites.change-status', [$pub->id, 'suspendu']) }}" class="btn btn-warning" title="Suspendre">
                                            <i class="material-icons">pause_circle</i>
                                        </a>
                                    @elseif($pub->statut == 'suspendu' || $pub->statut == 'rejete')
                                        <a href="{{ route('admin.publicites.change-status', [$pub->id, 'validé']) }}" class="btn btn-success" title="Réactiver">
                                            <i class="material-icons">check_circle</i>
                                        </a>
                                    @endif
                                </div>
                             </td>
                         </tr>

                        <!-- Modal preview -->
                        <div class="modal fade" id="modalPub{{ $pub->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ $pub->titre }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        @if($pub->type_media == 'image')
                                            <img src="{{ asset('storage/' . $pub->media_path) }}" class="img-fluid rounded mb-2" alt="{{ $pub->titre }}">
                                        @elseif($pub->type_media == 'video')
                                            @php
                                                $videoPath = Str::startsWith($pub->media_path, 'publicites/') 
                                                    ? $pub->media_path 
                                                    : 'publicites/' . $pub->media_path;
                                            @endphp
                                            <video controls class="img-fluid rounded mb-2" style="max-width: 100%; max-height: 500px;">
                                                <source src="{{ asset('storage/' . $videoPath) }}" type="video/mp4">
                                                Votre navigateur ne supporte pas la lecture de vidéos.
                                            </video>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Liens de pagination Bootstrap -->
            <div class="mt-3 d-flex justify-content-center">
                {{ $publicites->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
$(document).ready(function() {
    // Vérifier si DataTable existe déjà et la détruire
    if ($.fn.DataTable.isDataTable('#datatablePublicites')) {
        $('#datatablePublicites').DataTable().destroy();
    }
    
    // Initialisation de DataTable avec responsive
    $('#datatablePublicites').DataTable({
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tous"]],
        columnDefs: [
            { responsivePriority: 1, targets: 1 },  // Titre - priorité haute
            { responsivePriority: 2, targets: 4 },  // Statut - priorité haute
            { responsivePriority: 3, targets: 5 },  // Actions - priorité haute
            { responsivePriority: 4, targets: 0 },  // Date - priorité moyenne
            { responsivePriority: 5, targets: 2 },  // Média - priorité moyenne
            { responsivePriority: 6, targets: 3 }   // Annonceur - priorité basse
        ],
        autoWidth: false,
        processing: true,
        stateSave: true,
        order: [[0, 'desc']] // Trier par date décroissante
    });
    
    // Messages toastr
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif
    
    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif
});
</script>
@endsection