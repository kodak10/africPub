@extends('dashboard.layouts.master')

@section('content')

<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="d-flex justify-content-between align-items-center w-100">
            <h3 class="subheader-title">Paiement - {{ $demande->media->nom_du_media }}</h3>

            <a href="{{ route('admin.paiements.index') }}" class="btn btn-secondary">
                ← Retour aux demandes
            </a>
        </div>
    </div>
</div>


<div class="container mt-5">
    <div class="row">
        <!-- Informations du média et KPI -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Informations du Média</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <strong>Nom du média:</strong> {{ $demande->media->nom_du_media }}
                        </div>
                        <div class="col-12 mb-3">
                            <strong>Email:</strong> {{ $demande->media->email }}
                        </div>
                        <div class="col-12 mb-3">
                            <strong>Téléphone:</strong> {{ $demande->media->telephone }}
                        </div>
                    </div>

                    <hr>

                    <h6 class="text-primary">Performances</h6>
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border rounded p-2">
                                <div class="h4 text-info mb-0">{{ number_format($demande->vues_total, 0, ',', ' ') }}</div>
                                <small class="text-muted">Vues Total</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded p-2">
                                <div class="h4 text-success mb-0">{{ number_format($demande->clics_total, 0, ',', ' ') }}</div>
                                <small class="text-muted">Clics Total</small>
                            </div>
                        </div>
                        
                    </div>

                    @if($demande->fraude_detectee)
                    <div class="alert alert-danger mt-3">
                        <h6>⚠️ Alerte Fraude Détectée</h6>
                        <p class="mb-0">{{ $demande->raison_fraude }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Formulaire de paiement -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Formulaire de Paiement</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.paiements.process', $demande->id) }}">
                        @csrf

                        <!-- Montant -->
                        <div class="mb-3">
                            <label class="form-label">Montant à Payer</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-lg text-success fw-bold" 
                                       value="{{ number_format($demande->montant, 2, ',', ' ') }} FCFA" readonly>
                            </div>
                        </div>

                        <!-- Méthode de paiement -->
                        <div class="mb-3">
                            <label class="form-label">Méthode de Paiement *</label>
                            <select name="methode_paiement" class="form-select" required>
                                <option value="">-- Sélectionner --</option>
                                <option value="orange_money">Orange Money</option>
                                <option value="mtn_money">MTN Money</option>
                                <option value="wave">Wave</option>
                                <option value="virement_bancaire">Virement Bancaire</option>
                                <option value="especes">Espèces</option>
                            </select>
                        </div>

                        <!-- Numéro de téléphone -->
                        <div class="mb-3">
                            <label class="form-label">Numéro de Téléphone *</label>
                            <input type="text" name="numero_telephone" class="form-control" 
                                   value="{{ $demande->media->telephone }}" required
                                   placeholder="Ex: +225 07 00 00 00 00">
                        </div>

                        <!-- Confirmation mot de passe -->
                        <div class="mb-4">
                            <label class="form-label">Mot de passe de confirmation *</label>
                            <input type="password" name="password_confirmation" class="form-control" required
                                   placeholder="Saisissez votre mot de passe administrateur">
                            <div class="form-text">
                                Sécurité requise pour confirmer le paiement
                            </div>
                        </div>

                        <!-- Avertissement réinitialisation -->
                        <div class="alert alert-warning">
                            <h6>⚠️ Attention</h6>
                            <p class="mb-2">
                                Après ce paiement, les compteurs de vues et clics du média 
                                <strong>seront réinitialisés à zéro</strong>.
                            </p>
                            @if($demande->fraude_detectee)
                            <p class="mb-0 text-danger">
                                <strong>Alerte:</strong> Activité suspecte détectée. Vérifiez les KPI avant paiement.
                            </p>
                            @endif
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg"
                                    onclick="return confirm('Confirmez-vous le paiement de {{ number_format($demande->montant, 2, ',', ' ') }} FCFA à {{ $demande->media->nom_du_media }} ?')">
                                💳 Confirmer le Paiement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection