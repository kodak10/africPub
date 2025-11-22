@extends('dashboard.layouts.master')

@section('content')

<!-- SUBHEADER -->
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">Nouvelle Demande de Remboursement</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.remboursements-annonceurs.index') }}">Remboursements</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nouvelle demande</li>
                </ol>
            </nav>
        </div>
        <div class="subheader-toolbar">
            <a href="{{ route('admin.remboursements-annonceurs.index') }}" class="btn btn-secondary">
                <i class="material-icons me-1">arrow_back</i>
                Retour
            </a>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title mb-0">
                    <i class="material-icons me-2">receipt_long</i>
                    Formulaire de demande de remboursement
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.paiements.remboursements.store') }}" enctype="multipart/form-data">
                    @csrf

                    @if($paiement)
                    <!-- Si on vient d'un paiement spécifique -->
                    <div class="alert alert-info">
                        <h6><i class="material-icons me-2">info</i>Remboursement pour paiement spécifique</h6>
                        <p class="mb-1"><strong>Annonceur:</strong> {{ $paiement->annonceur->nom }}</p>
                        <p class="mb-1"><strong>Facture:</strong> {{ $paiement->numero_facture }}</p>
                        <p class="mb-1"><strong>Montant payé:</strong> {{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</p>
                        <input type="hidden" name="paiement_annonceur_id" value="{{ $paiement->id }}">
                    </div>
                    @else
                    <!-- Sélection manuelle -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Annonceur <span class="text-danger">*</span></label>
                                <select name="annonceur_id" id="annonceur_id" class="form-select" required>
                                    <option value="">Sélectionner un annonceur</option>
                                    @foreach($annonceurs as $annonceur)
                                        <option value="{{ $annonceur->id }}">{{ $annonceur->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Paiement à rembourser <span class="text-danger">*</span></label>
                                <select name="paiement_annonceur_id" id="paiement_annonceur_id" class="form-select" required disabled>
                                    <option value="">Sélectionner d'abord un annonceur</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Informations du paiement sélectionné -->
                    <div id="paiement-details" class="alert alert-info d-none">
                        <h6><i class="material-icons me-2">receipt</i>Informations du paiement</h6>
                        <div id="paiement-info"></div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Montant du remboursement <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="montant" class="form-control" 
                                           step="0.01" min="0" required
                                           placeholder="0.00"
                                           @if($paiement) max="{{ $paiement->montant }}" @endif
                                           value="{{ $paiement->montant ?? '' }}">
                                    <span class="input-group-text">FCFA</span>
                                </div>
                                @if($paiement)
                                <div class="form-text">
                                    Montant maximum: {{ number_format($paiement->montant, 0, ',', ' ') }} FCFA
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Raison du remboursement <span class="text-danger">*</span></label>
                        <textarea name="raison" class="form-control" rows="4" required
                                  placeholder="Décrivez la raison du remboursement..."></textarea>
                        <div class="form-text">
                            Minimum 10 caractères. Décrivez précisément pourquoi ce remboursement est nécessaire.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Preuves (optionnel)</label>
                        <input type="file" name="preuves[]" class="form-control" multiple
                               accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                        <div class="form-text">
                            Formats acceptés: JPG, PNG, PDF, DOC. Maximum 5MB par fichier.
                        </div>
                    </div>

                    <div class="alert alert-warning">
                        <h6><i class="material-icons me-2">warning</i>Important</h6>
                        <p class="mb-0">
                            La demande sera soumise pour approbation. Vous pourrez suivre son statut dans la liste des demandes.
                        </p>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.remboursements-annonceurs.index') }}" class="btn btn-secondary me-md-2">
                            <i class="material-icons me-1">cancel</i>
                            Annuler
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="material-icons me-1">send</i>
                            Soumettre la demande
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function () {
    // Chargement des paiements selon l'annonceur sélectionné
    $('#annonceur_id').change(function() {
        const annonceurId = $(this).val();
        const paiementSelect = $('#paiement_annonceur_id');
        const detailsDiv = $('#paiement-details');
        const infoDiv = $('#paiement-info');

        if (annonceurId) {
            paiementSelect.prop('disabled', false);
            
            // Charger les paiements via AJAX
            $.get('/admin/remboursements-annonceurs/paiements/' + annonceurId, function(data) {
                paiementSelect.empty().append('<option value="">Sélectionner un paiement</option>');
                $.each(data, function(index, paiement) {
                    paiementSelect.append('<option value="' + paiement.id + '">' + paiement.text + '</option>');
                });
            });
        } else {
            paiementSelect.prop('disabled', true).empty().append('<option value="">Sélectionner d\'abord un annonceur</option>');
            detailsDiv.addClass('d-none');
        }
    });

    // Chargement des détails du paiement sélectionné
    $('#paiement_annonceur_id').change(function() {
        const paiementId = $(this).val();
        const detailsDiv = $('#paiement-details');
        const infoDiv = $('#paiement-info');
        const montantInput = $('input[name="montant"]');

        if (paiementId) {
            // Charger les détails du paiement via AJAX
            $.get('/admin/remboursements-annonceurs/paiement-details/' + paiementId, function(data) {
                infoDiv.html(`
                    <p class="mb-1"><strong>Annonceur:</strong> ${data.annonceur}</p>
                    <p class="mb-1"><strong>Facture:</strong> ${data.numero_facture}</p>
                    <p class="mb-1"><strong>Forfait:</strong> ${data.forfait}</p>
                    <p class="mb-0"><strong>Montant payé:</strong> ${new Intl.NumberFormat('fr-FR').format(data.montant)} FCFA</p>
                `);
                detailsDiv.removeClass('d-none');
                
                // Définir le montant maximum
                montantInput.attr('max', data.montant);
                montantInput.val(data.montant);
            });
        } else {
            detailsDiv.addClass('d-none');
        }
    });
});
</script>
@endsection