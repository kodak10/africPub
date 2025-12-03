@extends('dashboard.layouts.master')

@section('content')
<!-- SUBHEADER -->
{{-- <div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">Tableau de Bord Média</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tableau de Bord</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container mt-4">
    <!-- STATISTIQUES RAPIDES -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Vues (Ce mois)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($statsMois['vues'], 0, ',', ' ') }}
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
                                Clics (Ce mois)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($statsMois['clics'], 0, ',', ' ') }}
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
                                {{ $statsMois['taux_conversion'] }}%
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
                                Revenu Estimé (Mois)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($statsMois['revenu_estime'], 0, ',', ' ') }} FCFA
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

    <div class="row">
        <!-- PUBLICITÉS ACTIVES -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="material-icons me-2">campaign</i>
                        Publicités Actives
                    </h6>
                </div>
                <div class="card-body">
                    @if($publicitesActives->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($publicitesActives as $publicite)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $publicite->titre }}</h6>
                                    <small class="text-muted">{{ $publicite->forfait->libelle }}</small>
                                </div>
                                <span class="badge bg-success badge-pill">
                                    {{ $publicite->pivot->vues_restantes ?? '∞' }} vues restantes
                                </span>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="material-icons text-muted" style="font-size: 48px;">campaign</i>
                            <p class="text-muted mt-2 mb-0">Aucune publicité active</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- DERNIERS PAIEMENTS -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="material-icons me-2">payments</i>
                        Derniers Paiements
                    </h6>
                </div>
                <div class="card-body">
                    @if($derniersPaiements->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($derniersPaiements as $paiement)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</h6>
                                    <small class="text-muted">{{ $paiement->date_paiement->format('d/m/Y') }}</small>
                                </div>
                                <span class="badge bg-{{ $paiement->statut == 'complet' ? 'success' : 'warning' }} badge-pill">
                                    {{ ucfirst($paiement->statut) }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="material-icons text-muted" style="font-size: 48px;">payments</i>
                            <p class="text-muted mt-2 mb-0">Aucun paiement reçu</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- PERFORMANCES 7 JOURS -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="material-icons me-2">analytics</i>
                        Performances des 7 Derniers Jours
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <h4 class="text-primary">{{ number_format($performances7Jours['vues'], 0, ',', ' ') }}</h4>
                            <p class="text-muted">Vues</p>
                        </div>
                        <div class="col-md-3">
                            <h4 class="text-success">{{ number_format($performances7Jours['clics'], 0, ',', ' ') }}</h4>
                            <p class="text-muted">Clics</p>
                        </div>
                        <div class="col-md-3">
                            <h4 class="text-info">{{ $performances7Jours['taux_conversion'] }}%</h4>
                            <p class="text-muted">Taux Conversion</p>
                        </div>
                        <div class="col-md-3">
                            <h4 class="text-warning">{{ number_format($performances7Jours['revenu_estime'], 0, ',', ' ') }} FCFA</h4>
                            <p class="text-muted">Revenu Estimé</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ACTIONS RAPIDES -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body text-center">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('media.rapports') }}" class="btn btn-primary btn-lg w-100">
                                <i class="material-icons me-2">analytics</i>
                                Voir Rapports Détaillés
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('media.paiements.historique') }}" class="btn btn-success btn-lg w-100">
                                <i class="material-icons me-2">history</i>
                                Historique Paiements
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('media.paiements.reclamation') }}" class="btn btn-warning btn-lg w-100">
                                <i class="material-icons me-2">request_quote</i>
                                Demander Paiement
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection