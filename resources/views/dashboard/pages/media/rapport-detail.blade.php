@extends('dashboard.layouts.master')

@section('content')
<!-- SUBHEADER -->
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">Détail Publicité - {{ $publicite->titre }}</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('media.dashboard') }}">Tableau de Bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('media.rapports') }}">Rapports</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Détail Publicité</li>
                </ol>
            </nav>
        </div>
        <div class="subheader-toolbar">
            <a href="{{ route('media.rapports') }}" class="btn btn-secondary">
                <i class="material-icons me-1">arrow_back</i>
                Retour aux Rapports
            </a>
        </div>
    </div>
</div>

<div class="container mt-4">
    <!-- EN-TÊTE PUBLICITÉ -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    @if($publicite->type_media == 'image')
                        <img src="{{ asset('storage/' . $publicite->media_path) }}" 
                             class="img-fluid rounded shadow" alt="{{ $publicite->titre }}">
                    @else
                        <div class="bg-primary rounded d-flex align-items-center justify-content-center" 
                             style="width: 120px; height: 120px;">
                            <i class="material-icons text-white" style="font-size: 48px;">play_circle</i>
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <h4 class="text-primary">{{ $publicite->titre }}</h4>
                    <p class="text-muted mb-2">
                        <strong>Type:</strong> 
                        <span class="badge bg-info">{{ ucfirst($publicite->type_media) }}</span>
                    </p>
                    <p class="text-muted mb-2">
                        <strong>Forfait:</strong> {{ $publicite->forfait->libelle }}
                    </p>
                    <p class="text-muted mb-0">
                        <strong>URL Cible:</strong> 
                        <a href="{{ $publicite->url_cible }}" target="_blank" class="text-decoration-none">
                            {{ Str::limit($publicite->url_cible, 50) }}
                        </a>
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="d-grid gap-2">
                        <div class="text-center p-3 bg-light rounded">
                            <h5 class="text-primary mb-1">{{ number_format($statsPublicite['vues_total'], 0, ',', ' ') }}</h5>
                            <small class="text-muted">Total Vues</small>
                        </div>
                        <div class="text-center p-3 bg-light rounded">
                            <h5 class="text-success mb-1">{{ number_format($statsPublicite['clics_total'], 0, ',', ' ') }}</h5>
                            <small class="text-muted">Total Clics</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- STATISTIQUES DÉTAILLÉES -->
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Vues Total
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($statsPublicite['vues_total'], 0, ',', ' ') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons text-gray-300">visibility</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Clics Total
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($statsPublicite['clics_total'], 0, ',', ' ') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons text-gray-300">touch_app</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Revenu Généré
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($statsPublicite['revenu_total'], 0, ',', ' ') }} FCFA
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons text-gray-300">payments</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- TOP RÉFÉRENTS -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h6 class="card-title mb-0">
                        <i class="material-icons me-2">link</i>
                        Top Pages Référentes
                    </h6>
                </div>
                <div class="card-body">
                    @if($topReferers->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($topReferers as $referer)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="text-truncate" style="max-width: 70%;">
                                    @if($referer->referer)
                                        <a href="{{ $referer->referer }}" target="_blank" class="text-decoration-none text-muted">
                                            {{ Str::limit($referer->referer, 50) }}
                                        </a>
                                    @else
                                        <span class="text-muted">Direct / Inconnu</span>
                                    @endif
                                </div>
                                <span class="badge bg-primary badge-pill">{{ $referer->count }}</span>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="material-icons text-muted" style="font-size: 48px;">link_off</i>
                            <p class="text-muted mt-2 mb-0">Aucun référent enregistré</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- GÉOLOCALISATION -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h6 class="card-title mb-0">
                        <i class="material-icons me-2">public</i>
                        Top Adresses IP
                    </h6>
                </div>
                <div class="card-body">
                    @if($geolocalisation->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($geolocalisation as $geo)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <code class="text-muted">{{ $geo->visiteur_ip }}</code>
                                <span class="badge bg-success badge-pill">{{ $geo->count }}</span>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="material-icons text-muted" style="font-size: 48px;">public_off</i>
                            <p class="text-muted mt-2 mb-0">Aucune donnée de géolocalisation</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- ANALYSE DE PERFORMANCE -->
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h6 class="card-title mb-0">
                <i class="material-icons me-2">analytics</i>
                Analyse de Performance
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>Points Forts</h6>
                    <ul class="list-unstyled">
                        @if($statsPublicite['taux_conversion'] >= 2)
                        <li class="mb-2">
                            <i class="material-icons text-success me-2">check_circle</i>
                            <strong>Excellent engagement:</strong> Taux de conversion de {{ $statsPublicite['taux_conversion'] }}%
                        </li>
                        @endif
                        @if($statsPublicite['vues_total'] >= 1000)
                        <li class="mb-2">
                            <i class="material-icons text-success me-2">check_circle</i>
                            <strong>Fort potentiel:</strong> {{ number_format($statsPublicite['vues_total'], 0, ',', ' ') }} vues générées
                        </li>
                        @endif
                        @if($statsPublicite['clics_total'] >= 100)
                        <li class="mb-2">
                            <i class="material-icons text-success me-2">check_circle</i>
                            <strong>Conversion solide:</strong> {{ number_format($statsPublicite['clics_total'], 0, ',', ' ') }} actions réalisées
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="col-md-6">
                    <h6>Recommandations</h6>
                    <ul class="list-unstyled">
                        
                        @if($statsPublicite['vues_total'] < 100)
                        <li class="mb-2">
                            <i class="material-icons text-warning me-2">info</i>
                            <strong>Augmenter la visibilité:</strong> Volume de vues limité
                        </li>
                        @endif
                        @if($topReferers->count() == 0)
                        <li class="mb-2">
                            <i class="material-icons text-warning me-2">info</i>
                            <strong>Diversifier les sources:</strong> Aucun référent identifié
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- RAPPORT FINANCIER -->
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h6 class="card-title mb-0">
                <i class="material-icons me-2">attach_money</i>
                Rapport Financier
            </h6>
        </div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="p-3 border rounded">
                        <h4 class="text-primary">{{ number_format($statsPublicite['revenu_total'], 0, ',', ' ') }} FCFA</h4>
                        <small class="text-muted">Revenu Total Généré</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded">
                        <h4 class="text-success">{{ number_format(($statsPublicite['vues_total'] * 0.001), 2, ',', ' ') }} FCFA</h4>
                        <small class="text-muted">Revenu Vues (0.001 F/vue)</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded">
                        <h4 class="text-info">{{ number_format(($statsPublicite['clics_total'] * 0.01), 2, ',', ' ') }} FCFA</h4>
                        <small class="text-muted">Revenu Clics (0.01 F/clic)</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.card {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}
</style>
@endpush