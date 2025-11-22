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

<!-- FILTRES -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('annonceur.index_publicites') }}" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Statut</label>
                <select name="statut" class="form-select">
                    <option value="">Tous les statuts</option>
                    <option value="brouillon" {{ request('statut') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                    <option value="en_attente_validation" {{ request('statut') == 'en_attente_validation' ? 'selected' : '' }}>En attente</option>
                    <option value="validé" {{ request('statut') == 'validé' ? 'selected' : '' }}>Validé</option>
                    <option value="suspendu" {{ request('statut') == 'suspendu' ? 'selected' : '' }}>Suspendu</option>
                    <option value="rejete" {{ request('statut') == 'rejete' ? 'selected' : '' }}>Rejeté</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Forfait</label>
                <select name="forfait_id" class="form-select">
                    <option value="">Tous les forfaits</option>
                    @foreach($forfaits as $forfait)
                        <option value="{{ $forfait->id }}" {{ request('forfait_id') == $forfait->id ? 'selected' : '' }}>
                            {{ $forfait->libelle }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="material-icons">search</i>
                </button>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <a href="{{ route('annonceur.index_publicites') }}" class="btn btn-secondary w-100">
                    <i class="material-icons">refresh</i>
                </a>
            </div>
        </form>
    </div>
</div>

<!-- TABLEAU DES PUBLICITÉS -->
<div class="card">
    <div class="card-header">
        <h2 class="p-1 m-0 text-16 font-weight-semi">Liste de mes publicités</h2>
    </div>
    <div class="card-body">
        @if($publicites->count() > 0)
            <div class="table-responsive">
                <table class="table nowrap table-hover" id="datatablePublicites" style="width:100%">
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
                                             class="rounded me-3" width="60" height="60" alt="{{ $publicite->titre }}">
                                    @else
                                        <div class="bg-primary rounded d-flex align-items-center justify-content-center me-3" 
                                             style="width: 60px; height: 60px;">
                                            <i class="material-icons text-white">play_circle</i>
                                        </div>
                                    @endif
                                    <div>
                                        <h6 class="mb-1">{{ $publicite->titre }}</h6>
                                        <small class="text-muted">{{ $publicite->type_media }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <strong>{{ $publicite->forfait->libelle }}</strong>
                                    <br>
                                    <small class="text-muted">{{ number_format($publicite->forfait->montant, 0, ',', ' ') }} FCFA</small>
                                </div>
                            </td>
                            <td>
                                @switch($publicite->statut)
                                    @case('brouillon')
                                        <span class="badge bg-secondary">
                                            <i class="material-icons me-1">draft</i>Brouillon
                                        </span>
                                        @break
                                    @case('en_attente_validation')
                                        <span class="badge bg-warning">
                                            <i class="material-icons me-1">schedule</i>En attente
                                        </span>
                                        @break
                                    @case('validé')
                                        <span class="badge bg-success">
                                            <i class="material-icons me-1">check_circle</i>Validé
                                        </span>
                                        @break
                                    @case('suspendu')
                                        <span class="badge bg-danger">
                                            <i class="material-icons me-1">pause_circle</i>Suspendu
                                        </span>
                                        @break
                                    @case('rejete')
                                        <span class="badge bg-danger">
                                            <i class="material-icons me-1">cancel</i>Rejeté
                                        </span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ $publicite->statut }}</span>
                                @endswitch
                            </td>
                            <td>
                                <div class="text-center">
                                    <strong class="text-info">{{ $publicite->vues->count() }}</strong>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <strong class="text-success">{{ $publicite->clics->count() }}</strong>
                                </div>
                            </td>
                            <td>
                                <small>
                                    {{ $publicite->created_at->format('d/m/Y') }}
                                    <br>
                                    <span class="text-muted">{{ $publicite->created_at->format('H:i') }}</span>
                                </small>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('annonceur.show_publicite', $publicite->id) }}" 
                                       class="btn btn-sm btn-info" 
                                       title="Voir détails">
                                        <i class="material-icons" style="font-size: 16px;">visibility</i>
                                    </a>
                                    @if($publicite->statut == 'brouillon')
                                    <a href="#" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="material-icons" style="font-size: 16px;">edit</i>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Affichage de {{ $publicites->firstItem() }} à {{ $publicites->lastItem() }} sur {{ $publicites->total() }} publicités
                </div>
                <div>
                    {{ $publicites->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="material-icons text-muted" style="font-size: 64px;">campaign</i>
                <h4 class="text-muted mt-3">Aucune publicité</h4>
                <p class="text-muted">Vous n'avez pas encore créé de publicités.</p>
                <a href="{{ route('annonceur.create_publicites') }}" class="btn btn-primary">
                    <i class="material-icons me-1">add</i>
                    Créer votre première publicité
                </a>
            </div>
        @endif
    </div>
</div>

@endsection

@section('scripts')
<!-- DATATABLES -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $('#datatablePublicites').DataTable({
        scrollY: "500px",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        searching: false,
        ordering: true,
        responsive: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        },
        order: [[5, 'desc']]
    });
});
</script>
@endsection