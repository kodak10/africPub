@extends('dashboard.layouts.master')

@section('content')

<div class="subheader px-lg">
    <div class="subheader-container">
        <h3 class="subheader-title">Gestion des Publicités</h3>
    </div>
</div>

<div class="container">
    <!-- FORMULAIRE DE RECHERCHE -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.publicites.index') }}" class="row g-3">
            <div class="col-md-2">
                <label>Statut</label>
                <select name="statut" class="form-select">
                    <option value="">--Tous--</option>
                    <option value="en_attente_paiement" {{ request('statut')=='en_attente_paiement' ? 'selected' : '' }}>En attente de paiement</option>
                    <option value="en_attente_validation" {{ request('statut')=='en_attente_validation' ? 'selected' : '' }}>En attente de validation</option>
                    <option value="validé" {{ request('statut')=='validé' ? 'selected' : '' }}>Validé</option>
                    <option value="rejete" {{ request('statut')=='rejete' ? 'selected' : '' }}>Rejeté</option>
                </select>
            </div>

            <div class="col-md-2">
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

            <div class="col-md-2">
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

            <div class="col-md-1">
                <label>Vues min</label>
                <input type="number" name="min_vues" class="form-control" value="{{ request('min_vues') }}">
            </div>

            <div class="col-md-1">
                <label>Vues max</label>
                <input type="number" name="max_vues" class="form-control" value="{{ request('max_vues') }}">
            </div>

            
            <div class="col-md-2">
                
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
            <div class="col-md-2">
                
                <a href="{{ route('admin.publicites.index') }}" class="btn btn-secondary">Réinitialiser</a>
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

        <table class="table table-bordered" id="datatablePublicites">
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
                        <td>{{ $pub->created_at }}</td>
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
                            <!-- Preview modal -->
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalPub{{ $pub->id }}" class="btn btn-sm btn-info">Preview</a>

                            
                            <!-- Boutons pour changer le statut -->
                            @if($pub->statut == 'brouillon' || $pub->statut == 'en_attente_paiement' || $pub->statut == 'en_attente_validation')
                                <!-- Si la publicité est en "brouillon", "en_attente_paiement" ou "en_attente_validation", afficher les boutons -->
                                <a href="{{ route('admin.publicites.change-status', [$pub->id, 'validé']) }}" class="btn btn-sm btn-success">
                                    Valider
                                </a>
                                <a href="{{ route('admin.publicites.change-status', [$pub->id, 'suspendu']) }}" class="btn btn-sm btn-warning">
                                    Suspendre
                                </a>
                            @elseif($pub->statut == 'validé')
                                <!-- Si la publicité est "validée", afficher uniquement le bouton suspendre -->
                                <a href="{{ route('admin.publicites.change-status', [$pub->id, 'suspendu']) }}" class="btn btn-sm btn-warning">
                                    Suspendre
                                </a>
                            @elseif($pub->statut == 'suspendu')
                                <!-- Si la publicité est "suspendue", afficher uniquement le bouton valider -->
                                <a href="{{ route('admin.publicites.change-status', [$pub->id, 'validé']) }}" class="btn btn-sm btn-success">
                                    Réactiver / Valider
                                </a>
                            @elseif($pub->statut == 'rejete')
                                <!-- Si la publicité est "rejetée", afficher uniquement le bouton valider -->
                                <a href="{{ route('admin.publicites.change-status', [$pub->id, 'validé']) }}" class="btn btn-sm btn-success">
                                    Valider
                                </a>
                            @endif

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
                                    @foreach($pub->medias as $m)
                                        @if($pub->type_media=='image')
                                            <img src="{{ asset('storage/'.$pub->media_path) }}" class="img-fluid rounded mb-2">
                                        @elseif($pub->type_media=='video')
                                            <video src="{{ asset('storage/'.$pub->media_path) }}" controls class="img-fluid rounded mb-2"></video>
                                        @endif
                                    @endforeach
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
        <!-- Liens de pagination Bootstrap -->
        <div class="mt-3">
            {{ $publicites->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#datatablePublicites').DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        }
    });
});
</script>
@endsection
