@extends('dashboard.layouts.master')

@section('content')

<!-- SUBHEADER -->
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">Détails du Paiement</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.paiements.index') }}">Paiements</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.paiements.historique') }}">Historique</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Détails</li>
                </ol>
            </nav>
        </div>
        <div class="subheader-toolbar">
            <a href="{{ route('admin.paiements.historique') }}" class="btn btn-secondary me-2">
                <i class="material-icons me-1">arrow_back</i>
                Retour
            </a>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
    <div class="col-lg-8">
        <!-- CARTE PRINCIPALE -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title mb-0">
                    <i class="material-icons me-2">receipt_long</i>
                    Détails du Paiement #{{ $paiement->id }}
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-item mb-3">
                            <label class="form-label fw-bold text-muted">Référence Transaction</label>
                            <p class="fs-5 text-primary">{{ $paiement->reference_transaction }}</p>
                        </div>
                        
                        <div class="info-item mb-3">
                            <label class="form-label fw-bold text-muted">Média Bénéficiaire</label>
                            <div class="d-flex align-items-center">
                                @if($paiement->media->logo_media)
                                    <img src="{{ asset('storage/' . $paiement->media->logo_media) }}" 
                                         class="rounded-circle me-3" width="50" height="50" alt="Logo">
                                @else
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                                         style="width: 50px; height: 50px;">
                                        <i class="material-icons text-white">media</i>
                                    </div>
                                @endif
                                <div>
                                    <h5 class="mb-1">{{ $paiement->media->nom_du_media }}</h5>
                                    <p class="text-muted mb-0">{{ $paiement->media->email }}</p>
                                    <p class="text-muted mb-0">{{ $paiement->media->telephone }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="info-item mb-3">
                            <label class="form-label fw-bold text-muted">Demande de Paiement Associée</label>
                            <p class="mb-1">
                                <strong>ID:</strong> {{ $paiement->demandePaiement->id }}
                            </p>
                            <p class="mb-1">
                                <strong>Vues:</strong> {{ number_format($paiement->demandePaiement->vues_total, 0, ',', ' ') }}
                            </p>
                            <p class="mb-0">
                                <strong>Clics:</strong> {{ number_format($paiement->demandePaiement->clics_total, 0, ',', ' ') }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-item mb-3">
                            <label class="form-label fw-bold text-muted">Montant</label>
                            <h2 class="text-success">{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</h2>
                        </div>

                        <div class="info-item mb-3">
                            <label class="form-label fw-bold text-muted">Méthode de Paiement</label>
                            <div class="d-flex align-items-center">
                                @switch($paiement->methode_paiement)
                                    @case('orange_money')
                                        <i class="material-icons text-warning me-2" style="font-size: 24px;">phone_android</i>
                                        <span class="fs-5">Orange Money</span>
                                        @break
                                    @case('mtn_money')
                                        <i class="material-icons text-warning me-2" style="font-size: 24px;">smartphone</i>
                                        <span class="fs-5">MTN Money</span>
                                        @break
                                    @case('wave')
                                        <i class="material-icons text-info me-2" style="font-size: 24px;">account_balance_wallet</i>
                                        <span class="fs-5">Wave</span>
                                        @break
                                    @case('virement_bancaire')
                                        <i class="material-icons text-primary me-2" style="font-size: 24px;">account_balance</i>
                                        <span class="fs-5">Virement Bancaire</span>
                                        @break
                                    @case('especes')
                                        <i class="material-icons text-success me-2" style="font-size: 24px;">money</i>
                                        <span class="fs-5">Espèces</span>
                                        @break
                                @endswitch
                            </div>
                        </div>

                        <div class="info-item mb-3">
                            <label class="form-label fw-bold text-muted">Numéro de Téléphone</label>
                            <p class="fs-5">
                                <i class="material-icons me-2">phone</i>
                                {{ $paiement->numero_telephone }}
                            </p>
                        </div>

                        <div class="info-item mb-3">
                            <label class="form-label fw-bold text-muted">Statut</label>
                            <div>
                                @switch($paiement->statut)
                                    @case('complet')
                                        <span class="badge bg-success fs-6 p-2">
                                            <i class="material-icons me-1">check_circle</i>
                                            Paiement Complet
                                        </span>
                                        @break
                                    @case('initie')
                                        <span class="badge bg-primary fs-6 p-2">
                                            <i class="material-icons me-1">schedule</i>
                                            Paiement Initié
                                        </span>
                                        @break
                                    @case('echec')
                                        <span class="badge bg-danger fs-6 p-2">
                                            <i class="material-icons me-1">error</i>
                                            Échec du Paiement
                                        </span>
                                        @break
                                    @case('en_attente_confirmation')
                                        <span class="badge bg-warning fs-6 p-2">
                                            <i class="material-icons me-1">hourglass_empty</i>
                                            En Attente de Confirmation
                                        </span>
                                        @break
                                @endswitch
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- INFORMATIONS DE DATE -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="info-item">
                            <label class="form-label fw-bold text-muted">Date du Paiement</label>
                            <p class="mb-0">
                                <i class="material-icons me-2">event</i>
                                {{ $paiement->date_paiement->format('d/m/Y') }}
                            </p>
                            <small class="text-muted">
                                à {{ $paiement->date_paiement->format('H:i') }}
                            </small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-item">
                            <label class="form-label fw-bold text-muted">Date de Création</label>
                            <p class="mb-0">
                                <i class="material-icons me-2">create</i>
                                {{ $paiement->created_at->format('d/m/Y') }}
                            </p>
                            <small class="text-muted">
                                à {{ $paiement->created_at->format('H:i') }}
                            </small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-item">
                            <label class="form-label fw-bold text-muted">Dernière Mise à Jour</label>
                            <p class="mb-0">
                                <i class="material-icons me-2">update</i>
                                {{ $paiement->updated_at->format('d/m/Y') }}
                            </p>
                            <small class="text-muted">
                                à {{ $paiement->updated_at->format('H:i') }}
                            </small>
                        </div>
                    </div>
                </div>

                <!-- PREUVE DE PAIEMENT -->
                @if($paiement->preuve_paiement)
                <hr>
                <div class="info-item">
                    <label class="form-label fw-bold text-muted">Preuve de Paiement</label>
                    <div class="mt-2">
                        <a href="{{ asset('storage/' . $paiement->preuve_paiement) }}" 
                           target="_blank" 
                           class="btn btn-outline-primary">
                            <i class="material-icons me-2">visibility</i>
                            Voir la Preuve
                        </a>
                        <a href="{{ asset('storage/' . $paiement->preuve_paiement) }}" 
                           download 
                           class="btn btn-outline-success">
                            <i class="material-icons me-2">download</i>
                            Télécharger
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- CARTE INFORMATIONS MEDIA -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">
                    <i class="material-icons me-2">info</i>
                    Informations du Média
                </h5>
            </div>
            <div class="card-body">
                <div class="info-item mb-3">
                    <label class="form-label fw-bold text-muted">Nom du Média</label>
                    <p class="mb-1">{{ $paiement->media->nom_du_media }}</p>
                </div>

                <div class="info-item mb-3">
                    <label class="form-label fw-bold text-muted">Site Web</label>
                    <p class="mb-1">
                        <a href="{{ $paiement->media->url_site }}" target="_blank" class="text-decoration-none">
                            {{ $paiement->media->url_site }}
                        </a>
                    </p>
                </div>

                <div class="info-item mb-3">
                    <label class="form-label fw-bold text-muted">RCCM</label>
                    <p class="mb-1">{{ $paiement->media->numero_rccm ?? 'Non renseigné' }}</p>
                </div>

                <div class="info-item mb-3">
                    <label class="form-label fw-bold text-muted">Adresse</label>
                    <p class="mb-1">{{ $paiement->media->adresse ?? 'Non renseignée' }}</p>
                </div>

                <div class="info-item">
                    <label class="form-label fw-bold text-muted">Statut du Média</label>
                    <div>
                        @if($paiement->media->statut == 'validé')
                            <span class="badge bg-success">Validé</span>
                        @elseif($paiement->media->statut == 'en attente')
                            <span class="badge bg-warning">En Attente</span>
                        @else
                            <span class="badge bg-danger">Suspendu</span>
                        @endif
                    </div>
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
    
    .text-primary, .text-success, .text-info {
        color: black !important;
    }
}
</style>

@endsection

@section('scripts')
<script>
// Fonction pour générer un reçu PDF (à implémenter)
function genererPDF() {
    // Implémentation future pour générer un PDF
    alert('Fonction de génération PDF à implémenter');
}

// Fonction pour envoyer un email de confirmation (à implémenter)
function envoyerEmail() {
    // Implémentation future pour l'envoi d'email
    alert('Fonction d\'envoi d\'email à implémenter');
}
</script>
@endsection