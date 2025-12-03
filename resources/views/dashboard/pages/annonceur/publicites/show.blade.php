@extends('dashboard.layouts.master')

@section('content')

<!-- SUBHEADER -->
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">Détails de la Publicité</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('annonceur.dashboard') }}">Tableau de Bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('annonceur.index_publicites') }}">Mes Publicités</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Détails</li>
                </ol>
            </nav>
        </div>
        <div class="subheader-toolbar">
            <a href="{{ route('annonceur.index_publicites') }}" class="btn btn-secondary">
                <i class="material-icons me-1">arrow_back</i>
                Retour
            </a>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="row">
    <div class="col-lg-8">
        <!-- CARTE PRINCIPALE -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title mb-0">
                    <i class="material-icons me-2">campaign</i>
                    {{ $publicite->titre }}
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <!-- AFFICHAGE DU MÉDIA -->
                        <div class="text-center mb-4">
                            @if($publicite->type_media == 'image')
                                <img src="{{ asset('storage/' . $publicite->media_path) }}" 
                                     class="img-fluid rounded" 
                                     alt="{{ $publicite->titre }}"
                                     style="max-height: 300px;">
                            @else
                                <div class="bg-dark rounded d-flex align-items-center justify-content-center" 
                                     style="height: 300px;">
                                    <i class="material-icons text-white" style="font-size: 64px;">play_circle</i>
                                </div>
                                <p class="text-muted mt-2">Vidéo: {{ $publicite->media_path }}</p>
                            @endif
                        </div>

                        <!-- INFORMATIONS DE BASE -->
                        <div class="info-item mb-3">
                            <label class="form-label fw-bold text-muted">URL de destination</label>
                            <p class="mb-0">
                                <a href="{{ $publicite->url_cible }}" target="_blank" class="text-decoration-none">
                                    {{ $publicite->url_cible }}
                                </a>
                            </p>
                        </div>

                        <div class="info-item mb-3">
                            <label class="form-label fw-bold text-muted">Type de média</label>
                            <p class="mb-0">
                                <span class="badge bg-info">
                                    <i class="material-icons me-1">
                                        {{ $publicite->type_media == 'image' ? 'image' : 'videocam' }}
                                    </i>
                                    {{ ucfirst($publicite->type_media) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- STATISTIQUES -->
                        <div class="info-item mb-4">
                            <label class="form-label fw-bold text-muted">Statistiques de performance</label>
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="border rounded p-2">
                                        <div class="h3 text-info mb-0">{{ number_format($stats['vues_total']) }}</div>
                                        <small class="text-muted">Vues totales</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border rounded p-2">
                                        <div class="h3 text-success mb-0">{{ number_format($stats['clics_total']) }}</div>
                                        <small class="text-muted">Clics totaux</small>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <!-- STATUT ET FORFAIT -->
                        <div class="info-item mb-3">
                            <label class="form-label fw-bold text-muted">Statut</label>
                            <div>
                                @switch($publicite->statut)
                                    @case('brouillon')
                                        <span class="badge bg-secondary fs-6 p-2">
                                            <i class="material-icons me-1">draft</i>
                                            Brouillon
                                        </span>
                                        @break
                                    @case('en_attente_validation')
                                        <span class="badge bg-warning fs-6 p-2">
                                            <i class="material-icons me-1">schedule</i>
                                            En attente de validation
                                        </span>
                                        @break
                                    @case('validé')
                                        <span class="badge bg-success fs-6 p-2">
                                            <i class="material-icons me-1">check_circle</i>
                                            Validé et actif
                                        </span>
                                        @break
                                    @case('suspendu')
                                        <span class="badge bg-danger fs-6 p-2">
                                            <i class="material-icons me-1">pause_circle</i>
                                            Suspendu
                                        </span>
                                        @break
                                    @case('rejete')
                                        <span class="badge bg-danger fs-6 p-2">
                                            <i class="material-icons me-1">cancel</i>
                                            Rejeté
                                        </span>
                                        @break
                                @endswitch
                            </div>
                        </div>

                        <div class="info-item mb-3">
                            <label class="form-label fw-bold text-muted">Forfait</label>
                            <div class="border rounded p-3 bg-light">
                                <h5 class="text-primary">{{ $publicite->forfait->libelle }}</h5>
                                <p class="mb-1">
                                    <strong>Montant:</strong> {{ number_format($publicite->forfait->montant, 0, ',', ' ') }} FCFA
                                </p>
                                <p class="mb-0">
                                    <strong>Objectif vues:</strong> {{ number_format($publicite->forfait->objectif_vues, 0, ',', ' ') }} vues
                                </p>
                            </div>
                        </div>

                        <!-- MÉDIAS ASSIGNÉS -->
                        @if($publicite->medias->count() > 0)
                        <div class="info-item">
                            <label class="form-label fw-bold text-muted">Médias de diffusion</label>
                            <div class="mt-2">
                                @foreach($publicite->medias as $media)
                                <span class="badge bg-info me-1 mb-1">
                                    <i class="material-icons me-1" style="font-size: 14px;">public</i>
                                    {{ $media->nom_du_media }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <hr>

                <!-- STATISTIQUES DÉTAILLÉES -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="form-label fw-bold text-muted">Performances sur 30 jours</label>
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="border rounded p-2">
                                        <div class="h4 text-info mb-0">{{ number_format($stats['vues_30j']) }}</div>
                                        <small class="text-muted">Vues (30j)</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border rounded p-2">
                                        <div class="h4 text-success mb-0">{{ number_format($stats['clics_30j']) }}</div>
                                        <small class="text-muted">Clics (30j)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="form-label fw-bold text-muted">Informations de création</label>
                            <p class="mb-1">
                                <strong>Créée le:</strong> {{ $publicite->created_at->format('d/m/Y à H:i') }}
                            </p>
                            <p class="mb-0">
                                <strong>Dernière modification:</strong> {{ $publicite->updated_at->format('d/m/Y à H:i') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- DESCRIPTION -->
                @if($publicite->description)
                <hr>
                <div class="info-item">
                    <label class="form-label fw-bold text-muted">Description</label>
                    <div class="border rounded p-3 bg-light">
                        {{ $publicite->description }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- CARTE ACTIONS RAPIDES -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">
                    <i class="material-icons me-2">flash_on</i>
                    Actions Rapides
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    @if($publicite->statut == 'brouillon')
                    <a href="#" class="btn btn-warning">
                        <i class="material-icons me-2">edit</i>
                        Modifier la publicité
                    </a>
                    <a href="#" class="btn btn-primary">
                        <i class="material-icons me-2">send</i>
                        Soumettre pour validation
                    </a>
                    @endif

                    @if($publicite->statut == 'validé')
                    <a href="#" class="btn btn-outline-warning">
                        <i class="material-icons me-2">pause_circle</i>
                        Suspendre la diffusion
                    </a>
                    @endif

                    @if($publicite->statut == 'suspendu')
                    <a href="#" class="btn btn-outline-success">
                        <i class="material-icons me-2">play_circle</i>
                        Reprendre la diffusion
                    </a>
                    @endif

                    <a href="{{ $publicite->url_cible }}" target="_blank" class="btn btn-outline-info">
                        <i class="material-icons me-2">open_in_new</i>
                        Tester l'URL de destination
                    </a>

                    <button class="btn btn-outline-primary" onclick="window.print()">
                        <i class="material-icons me-2">print</i>
                        Imprimer ce rapport
                    </button>
                </div>
            </div>
        </div>

       
    </div>
</div>
</div>

<!-- STYLE POUR L'IMPRESSION -->
<style>
@media print {
    .subheader, .card-header, .btn, .breadcrumb, .col-lg-4 .card:last-child {
        display: none !important;
    }
    
    .card {
        border: 1px solid #000 !important;
        box-shadow: none !important;
    }
    
    body {
        background: white !important;
        color: black !important;
    }
}
</style>

@endsection