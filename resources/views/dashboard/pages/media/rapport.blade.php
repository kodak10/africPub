@extends('dashboard.layouts.master')

@section('content')
<!-- SUBHEADER -->
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">Rapports de Performance</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('media.dashboard') }}">Tableau de Bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Rapports</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container mt-4">
    <!-- FILTRES -->
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="card-title mb-0">
                <i class="material-icons me-2">filter_list</i>
                Filtres de Période
            </h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('media.rapports') }}" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Date de début</label>
                    <input type="date" name="date_debut" class="form-control" 
                           value="{{ $dateDebut }}" max="{{ now()->format('Y-m-d') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Date de fin</label>
                    <input type="date" name="date_fin" class="form-control" 
                           value="{{ $dateFin }}" max="{{ now()->format('Y-m-d') }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <div class="d-grid gap-2 d-md-flex">
                        <button type="submit" class="btn btn-primary">
                            <i class="material-icons me-1">search</i>
                            Appliquer
                        </button>
                        <a href="{{ route('media.rapports') }}" class="btn btn-secondary">
                            <i class="material-icons me-1">refresh</i>
                            Réinitialiser
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- STATISTIQUES GLOBALES -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Vues
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($statsPeriode['vues'], 0, ',', ' ') }}
                            </div>
                            <div class="text-xs text-muted mt-1">
                                {{ number_format($statsPeriode['vues_jour'], 0, ',', ' ') }} vues/jour
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons text-gray-300" style="font-size: 2rem;">visibility</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Clics
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($statsPeriode['clics'], 0, ',', ' ') }}
                            </div>
                            <div class="text-xs text-muted mt-1">
                                {{ number_format($statsPeriode['clics_jour'], 0, ',', ' ') }} clics/jour
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons text-gray-300" style="font-size: 2rem;">touch_app</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Taux de Conversion
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $statsPeriode['taux_conversion'] }}%
                            </div>
                            <div class="text-xs text-muted mt-1">
                                Performance globale
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons text-gray-300" style="font-size: 2rem;">trending_up</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Revenu Estimé
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($statsPeriode['revenu'], 0, ',', ' ') }} FCFA
                            </div>
                            <div class="text-xs text-muted mt-1">
                                Période sélectionnée
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons text-gray-300" style="font-size: 2rem;">payments</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ANALYSE DE FRAUDE -->
    @if($analyseFraude['fraude_detectee'])
    <div class="alert alert-warning mb-4">
        <div class="d-flex align-items-center">
            <i class="material-icons me-2" style="font-size: 24px;">warning</i>
            <h5 class="mb-0">Analyse de Fraude - Score de Risque: {{ $analyseFraude['score_risque'] }}</h5>
        </div>
        <hr>
        <div class="mt-2">
            <strong>Raisons détectées:</strong>
            <ul class="mb-0 mt-2">
                @foreach($analyseFraude['raisons'] as $raison)
                <li>{{ $raison }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @else
    <div class="alert alert-success mb-4">
        <div class="d-flex align-items-center">
            <i class="material-icons me-2" style="font-size: 24px;">verified</i>
            <h5 class="mb-0">Aucune activité frauduleuse détectée - Score de Risque: Faible</h5>
        </div>
    </div>
    @endif

    <!-- PERFORMANCES PAR PUBLICITÉ -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="material-icons me-2">campaign</i>
                Performances
            </h5>
        </div>
        <div class="card-body">
            @if($performancesPublicites->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover" id="datatablePerformances">
                        <thead>
                            <tr>
                                <th>Publicité</th>
                                <th>Forfait</th>
                                <th>Vues</th>
                                <th>Clics</th>
                                <th>Taux Conversion</th>
                                <th>Revenu Estimé</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($performancesPublicites as $publicite)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($publicite->type_media == 'image')
                                            <img src="{{ asset('storage/' . $publicite->media_path) }}" 
                                                 class="rounded me-3" width="50" height="50" 
                                                 alt="{{ $publicite->titre }}" style="object-fit: cover;">
                                        @else
                                            <div class="bg-primary rounded d-flex align-items-center justify-content-center me-3" 
                                                 style="width: 50px; height: 50px;">
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
                                    <span class="badge bg-info">{{ $publicite->forfait->libelle }}</span>
                                </td>
                                <td>
                                    <strong class="text-primary">{{ number_format($publicite->vues_periode, 0, ',', ' ') }}</strong>
                                </td>
                                <td>
                                    <strong class="text-success">{{ number_format($publicite->clics_periode, 0, ',', ' ') }}</strong>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $publicite->taux_conversion >= 2 ? 'success' : ($publicite->taux_conversion >= 1 ? 'warning' : 'danger') }}">
                                        {{ $publicite->taux_conversion }}%
                                    </span>
                                </td>
                                <td>
                                    <strong class="text-warning">{{ number_format($publicite->revenu_estime, 0, ',', ' ') }} FCFA</strong>
                                </td>
                                <td>
                                    <a href="{{ route('media.rapports.detail', $publicite->id) }}" 
                                       class="btn btn-sm btn-outline-primary"
                                       title="Voir détails">
                                        <i class="material-icons" style="font-size: 16px;">visibility</i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="material-icons text-muted" style="font-size: 64px;">analytics</i>
                    <h4 class="text-muted mt-3">Aucune donnée disponible</h4>
                    <p class="text-muted">Aucune performance n'est disponible pour la période sélectionnée.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- DATATABLES -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $('#datatablePerformances').DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        },
        order: [[2, 'desc']], // Tri par vues décroissantes
        pageLength: 10,
        responsive: true
    });
});
</script>
@endpush