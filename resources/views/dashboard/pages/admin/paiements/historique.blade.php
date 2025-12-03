@extends('dashboard.layouts.master')

@section('content')

<!-- SUBHEADER -->
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">Historique des Paiements Médias</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Paiements</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Historique</li>
                </ol>
            </nav>
        </div>
        
    </div>
</div>

<div class="container mt-5">
    <div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="mb-0">{{ number_format($montantTotal, 0, ',', ' ') }} FCFA</h4>
                        <p class="mb-0">Montant total payé</p>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="material-icons" style="font-size: 40px;">payments</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="mb-0">{{ $totalPaiements }}</h4>
                        <p class="mb-0">Paiements effectués</p>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="material-icons" style="font-size: 40px;">check_circle</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="mb-0">{{ $paiementsComplets }}</h4>
                        <p class="mb-0">Paiements complétés</p>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="material-icons" style="font-size: 40px;">done_all</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.paiements.historique') }}" class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Média</label>
                <select name="media_id" class="form-select">
                    <option value="">Tous les médias</option>
                    @foreach($medias as $media)
                        <option value="{{ $media->id }}" {{ request('media_id') == $media->id ? 'selected' : '' }}>
                            {{ $media->nom_du_media }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Méthode</label>
                <select name="methode_paiement" class="form-select">
                    <option value="">Toutes</option>
                    <option value="orange_money" {{ request('methode_paiement') == 'orange_money' ? 'selected' : '' }}>Orange Money</option>
                    <option value="mtn_money" {{ request('methode_paiement') == 'mtn_money' ? 'selected' : '' }}>MTN Money</option>
                    <option value="wave" {{ request('methode_paiement') == 'wave' ? 'selected' : '' }}>Wave</option>
                    <option value="virement_bancaire" {{ request('methode_paiement') == 'virement_bancaire' ? 'selected' : '' }}>Virement</option>
                    <option value="especes" {{ request('methode_paiement') == 'especes' ? 'selected' : '' }}>Espèces</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Statut</label>
                <select name="statut" class="form-select">
                    <option value="">Tous</option>
                    <option value="complet" {{ request('statut') == 'complet' ? 'selected' : '' }}>Complet</option>
                    <option value="initie" {{ request('statut') == 'initie' ? 'selected' : '' }}>Initié</option>
                    <option value="echec" {{ request('statut') == 'echec' ? 'selected' : '' }}>Échec</option>
                    <option value="en_attente_confirmation" {{ request('statut') == 'en_attente_confirmation' ? 'selected' : '' }}>En attente</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Date début</label>
                <input type="date" name="date_debut" class="form-control" value="{{ request('date_debut') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">Date fin</label>
                <input type="date" name="date_fin" class="form-control" value="{{ request('date_fin') }}">
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="material-icons">search</i>
                </button>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <a href="{{ route('admin.paiements.historique') }}" class="btn btn-secondary w-100">
                    <i class="material-icons">refresh</i>
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="p-1 m-0 text-16 font-weight-semi">Historique des paiements</h2>
    </div>
    <div class="card-body">
        @if($paiements->count() > 0)
            <div class="table-responsive">
                <table class="table nowrap table-hover" id="datatableHistorique" style="width:100%">
                    <thead>
                        <tr>
                            <th>Date Paiement</th>
                            <th>Média</th>
                            <th>Montant</th>
                            <th>Méthode</th>
                            <th>Téléphone</th>
                            <th>Référence</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paiements as $paiement)
                        <tr>
                            <td>
                                <strong>{{ $paiement->date_paiement->format('d/m/Y') }}</strong>
                                <br>
                                <small class="text-muted">{{ $paiement->date_paiement->format('H:i') }}</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($paiement->media->logo_media)
                                        <img src="{{ asset('storage/' . $paiement->media->logo_media) }}" 
                                             class="rounded-circle me-2" width="30" height="30" alt="Logo">
                                    @else
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" 
                                             style="width: 30px; height: 30px;">
                                            <i class="material-icons text-white" style="font-size: 16px;">media</i>
                                        </div>
                                    @endif
                                    <div>
                                        <strong>{{ $paiement->media->nom_du_media }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $paiement->media->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <strong class="text-success">{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</strong>
                            </td>
                            <td>
                                <span class="badge bg-info">
                                    @switch($paiement->methode_paiement)
                                        @case('orange_money')
                                            <i class="material-icons me-1" style="font-size: 14px;">phone_android</i>Orange
                                            @break
                                        @case('mtn_money')
                                            <i class="material-icons me-1" style="font-size: 14px;">smartphone</i>MTN
                                            @break
                                        @case('wave')
                                            <i class="material-icons me-1" style="font-size: 14px;">account_balance_wallet</i>Wave
                                            @break
                                        @case('virement_bancaire')
                                            <i class="material-icons me-1" style="font-size: 14px;">account_balance</i>Virement
                                            @break
                                        @case('especes')
                                            <i class="material-icons me-1" style="font-size: 14px;">money</i>Espèces
                                            @break
                                        @default
                                            {{ $paiement->methode_paiement }}
                                    @endswitch
                                </span>
                            </td>
                            <td>
                                <code>{{ $paiement->numero_telephone }}</code>
                            </td>
                            <td>
                                <small class="text-muted">{{ $paiement->reference_transaction }}</small>
                            </td>
                            <td>
                                @switch($paiement->statut)
                                    @case('complet')
                                        <span class="badge bg-success">
                                            <i class="material-icons me-1" style="font-size: 14px;">check_circle</i>Complet
                                        </span>
                                        @break
                                    @case('initie')
                                        <span class="badge bg-primary">
                                            <i class="material-icons me-1" style="font-size: 14px;">schedule</i>Initié
                                        </span>
                                        @break
                                    @case('echec')
                                        <span class="badge bg-danger">
                                            <i class="material-icons me-1" style="font-size: 14px;">error</i>Échec
                                        </span>
                                        @break
                                    @case('en_attente_confirmation')
                                        <span class="badge bg-warning">
                                            <i class="material-icons me-1" style="font-size: 14px;">hourglass_empty</i>En attente
                                        </span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ $paiement->statut }}</span>
                                @endswitch
                            </td>
                            <td>
                                <div class="btn-group">
                                    <!-- Voir détails -->
                                    <a href="{{ route('admin.paiements.details', $paiement->id) }}" 
                                       class="btn btn-sm btn-info" 
                                       title="Voir détails">
                                        <i class="material-icons" style="font-size: 16px;">visibility</i>
                                    </a>
                                    
                                    <!-- Télécharger preuve -->
                                    @if($paiement->preuve_paiement)
                                        <a href="{{ asset('storage/' . $paiement->preuve_paiement) }}" 
                                           class="btn btn-sm btn-success" 
                                           target="_blank"
                                           title="Voir la preuve">
                                            <i class="material-icons" style="font-size: 16px;">receipt</i>
                                        </a>
                                    @endif
                                    
                                    <!-- Réimprimer reçu -->
                                    <button class="btn btn-sm btn-warning" 
                                            onclick="genererRecu({{ $paiement->id }})"
                                            title="Réimprimer reçu">
                                        <i class="material-icons" style="font-size: 16px;">print</i>
                                    </button>
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
                    Affichage de {{ $paiements->firstItem() }} à {{ $paiements->lastItem() }} sur {{ $paiements->total() }} paiements
                </div>
                <div>
                    {{ $paiements->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="material-icons text-muted" style="font-size: 64px;">payments</i>
                <h4 class="text-muted mt-3">Aucun paiement trouvé</h4>
                <p class="text-muted">Aucun paiement ne correspond à vos critères de recherche.</p>
                <a href="{{ route('admin.paiements.historique') }}" class="btn btn-primary">
                    <i class="material-icons me-1">refresh</i>
                    Réinitialiser les filtres
                </a>
            </div>
        @endif
    </div>
</div>
</div>

@endsection

@section('scripts')
<!-- DATATABLES -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    // Datatable en français
    $('#datatableHistorique').DataTable({
        scrollY: "500px",
        scrollX: true,
        scrollCollapse: true,
        paging: false, // On utilise la pagination Laravel
        searching: false, // On utilise les filtres personnalisés
        ordering: true,
        responsive: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        },
        order: [[0, 'desc']] // Tri par date décroissante
    });

    // Fonction pour générer un reçu
    window.genererRecu = function(paiementId) {
        // Ici vous pouvez implémenter la génération de reçu PDF
        // Pour l'instant, simple redirection
        window.open('/admin/paiements/recu/' + paiementId, '_blank');
    };
});
</script>
@endsection