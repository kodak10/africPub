@extends('dashboard.layouts.master')

@section('content')
<!-- SUBHEADER -->
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
<h3 class="subheader-title">
    Détail du Paiement
    @if($paiement)
        #PAY-{{ str_pad($paiement->id, 6, '0', STR_PAD_LEFT) }}
    @endif
</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('media.dashboard') }}">Tableau de Bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('media.paiements.historique') }}">Historique Paiements</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Détail Paiement</li>
                </ol>
            </nav>
        </div>
        <div class="subheader-toolbar">
            <a href="{{ route('media.paiements.historique') }}" class="btn btn-secondary">
                <i class="material-icons me-1">arrow_back</i>
                Retour
            </a>
            @if($paiement->statut == 'complet')
            <button class="btn btn-success ms-2">
                <i class="material-icons me-1">receipt</i>
                Télécharger Reçu
            </button>
            @endif
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- EN-TÊTE PAIEMENT -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="text-primary mb-1">
                                {{ number_format($paiement->montant, 0, ',', ' ') }} FCFA
                            </h2>
                            <p class="text-muted mb-2">
                                Référence: <strong>#PAY-{{ str_pad($paiement->id, 6, '0', STR_PAD_LEFT) }}</strong>
                            </p>
                            <div class="d-flex align-items-center">
                                @switch($paiement->statut)
                                    @case('complet')
                                        <span class="badge bg-success me-2">
                                            <i class="material-icons me-1">check_circle</i>
                                            Complet
                                        </span>
                                        @break
                                    @case('attente_confirmation')
                                        <span class="badge bg-warning me-2">
                                            <i class="material-icons me-1">schedule</i>
                                            En Attente
                                        </span>
                                        @break
                                    @case('initie')
                                        <span class="badge bg-info me-2">
                                            <i class="material-icons me-1">play_circle</i>
                                            Initié
                                        </span>
                                        @break
                                    @case('echec')
                                        <span class="badge bg-danger me-2">
                                            <i class="material-icons me-1">error</i>
                                            Échec
                                        </span>
                                        @break
                                @endswitch
                                <small class="text-muted">
                                    Méthode: 
                                    <strong>
                                        @switch($paiement->methode_paiement)
                                            @case('orange_money') Orange Money @break
                                            @case('mtn_money') MTN Money @break
                                            @case('wave') Wave @break
                                            @case('virement') Virement Bancaire @break
                                            @default {{ $paiement->methode_paiement }}
                                        @endswitch
                                    </strong>
                                </small>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="bg-light rounded p-3">
                                <i class="material-icons text-primary" style="font-size: 48px;">
                                    @if($paiement->statut == 'complet') check_circle
                                    @elseif($paiement->statut == 'echec') error
                                    @else schedule
                                    @endif
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- INFORMATIONS DÉTAILLÉES -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-info text-white">
                            <h6 class="card-title mb-0">
                                <i class="material-icons me-2">info</i>
                                Informations du Paiement
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Date de Demande:</strong><br>
                                {{ $paiement->date_demande->format('d/m/Y à H:i') }}
                            </div>
                            @if($paiement->date_paiement)
                            <div class="mb-3">
                                <strong>Date de Paiement:</strong><br>
                                {{ $paiement->date_paiement->format('d/m/Y à H:i') }}
                            </div>
                            @endif
                            <div class="mb-3">
                                <strong>Méthode de Paiement:</strong><br>
                                <span class="badge bg-primary">
                                    @switch($paiement->methode_paiement)
                                        @case('orange_money') Orange Money @break
                                        @case('mtn_money') MTN Money @break
                                        @case('wave') Wave @break
                                        @case('virement') Virement Bancaire @break
                                        @default {{ $paiement->methode_paiement }}
                                    @endswitch
                                </span>
                            </div>
                            @if($paiement->numero_compte)
                            <div>
                                <strong>Numéro de Compte:</strong><br>
                                <code>{{ $paiement->numero_compte }}</code>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-success text-white">
                            <h6 class="card-title mb-0">
                                <i class="material-icons me-2">analytics</i>
                                Statistiques Associées
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Vues Couvertes:</strong><br>
                                {{ number_format($statistiquesPaiement['vues_couvertes'] ?? 0, 0, ',', ' ') }} vues
                            </div>
                            <div class="mb-3">
                                <strong>Clics Couverts:</strong><br>
                                {{ number_format($statistiquesPaiement['clics_couverts'] ?? 0, 0, ',', ' ') }} clics
                            </div>
                            <div class="mb-3">
                                <strong>Période Couverte:</strong><br>
                                {{ $statistiquesPaiement['periode_couverte'] ?? 'Personnalisée' }}
                            </div>
                            <div>
                                <strong>Taux de Conversion:</strong><br>
                                @php
                                    $vues = $statistiquesPaiement['vues_couvertes'] ?? 0;
                                    $clics = $statistiquesPaiement['clics_couvertes'] ?? 0;
                                    $taux = $vues > 0 ? round(($clics / $vues) * 100, 2) : 0;
                                @endphp
                                <span class="badge bg-{{ $taux >= 2 ? 'success' : ($taux >= 1 ? 'warning' : 'danger') }}">
                                    {{ $taux }}%
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TIMELINE DU PAIEMENT -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="card-title mb-0">
                        <i class="material-icons me-2">timeline</i>
                        Progression du Paiement
                    </h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item {{ $paiement->date_demande ? 'completed' : '' }}">
                            <div class="timeline-marker bg-success">
                                <i class="material-icons">check</i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Demande Soumise</h6>
                                <small class="text-muted">
                                    {{ $paiement->date_demande->format('d/m/Y à H:i') }}
                                </small>
                            </div>
                        </div>

                        <div class="timeline-item {{ in_array($paiement->statut, ['attente_confirmation', 'initie', 'complet']) ? 'completed' : '' }}">
                            <div class="timeline-marker {{ in_array($paiement->statut, ['attente_confirmation', 'initie', 'complet']) ? 'bg-success' : 'bg-secondary' }}">
                                <i class="material-icons">visibility</i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-1">En Révision</h6>
                                <small class="text-muted">
                                    @if(in_array($paiement->statut, ['attente_confirmation', 'initie', 'complet']))
                                        Analyse en cours par l'équipe
                                    @else
                                        En attente de révision
                                    @endif
                                </small>
                            </div>
                        </div>

                        <div class="timeline-item {{ in_array($paiement->statut, ['initie', 'complet']) ? 'completed' : '' }}">
                            <div class="timeline-marker {{ in_array($paiement->statut, ['initie', 'complet']) ? 'bg-success' : 'bg-secondary' }}">
                                <i class="material-icons">play_circle</i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Paiement Initié</h6>
                                <small class="text-muted">
                                    @if(in_array($paiement->statut, ['initie', 'complet']))
                                        Transfert initié vers votre compte
                                    @else
                                        En attente d'initiation
                                    @endif
                                </small>
                            </div>
                        </div>

                        <div class="timeline-item {{ $paiement->statut == 'complet' ? 'completed' : '' }}">
                            <div class="timeline-marker {{ $paiement->statut == 'complet' ? 'bg-success' : 'bg-secondary' }}">
                                <i class="material-icons">check_circle</i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Paiement Complet</h6>
                                <small class="text-muted">
                                    @if($paiement->statut == 'complet')
                                        {{ $paiement->date_paiement->format('d/m/Y à H:i') }}
                                    @else
                                        En attente de confirmation
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ACTIONS -->
            @if($paiement->statut != 'complet')
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h6 class="card-title mb-0">
                        <i class="material-icons me-2">support</i>
                        Support
                    </h6>
                </div>
                <div class="card-body">
                    <p class="mb-3">
                        Si votre paiement est en attente depuis plus de 5 jours ouvrés, 
                        vous pouvez contacter notre équipe de support.
                    </p>
                    <div class="d-grid gap-2 d-md-flex">
                        <button class="btn btn-primary">
                            <i class="material-icons me-1">email</i>
                            Contacter le Support
                        </button>
                        <button class="btn btn-outline-secondary">
                            <i class="material-icons me-1">help</i>
                            Voir la FAQ
                        </button>
                    </div>
                </div>
            </div>
            @endif
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

.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    padding-bottom: 20px;
}

.timeline-item:last-child {
    padding-bottom: 0;
}

.timeline-marker {
    position: absolute;
    left: -30px;
    top: 0;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.timeline-marker i {
    font-size: 12px;
}

.timeline-content {
    padding-left: 10px;
}

.timeline-item.completed .timeline-content {
    color: #28a745;
}

.timeline-item:not(.completed) .timeline-content {
    color: #6c757d;
}

.timeline::before {
    content: '';
    position: absolute;
    left: -21px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e3e6f0;
}

.timeline-item.completed::before {
    background: #28a745;
}
</style>
@endpush