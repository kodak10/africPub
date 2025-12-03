@extends('dashboard.layouts.master')

@section('content')

<!-- SUBHEADER -->
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">Demandes de Remboursement - Annonceurs</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Remboursements</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Annonceurs</li>
                </ol>
            </nav>
        </div>
       
    </div>
</div>

<div class="container mt-5">
    <div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="mb-0">{{ $totalEnAttente }}</h4>
                        <p class="mb-0">En attente</p>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="material-icons" style="font-size: 40px;">pending_actions</i>
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
                        <h4 class="mb-0">{{ $totalApprouve }}</h4>
                        <p class="mb-0">Approuvées</p>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="material-icons" style="font-size: 40px;">check_circle</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="mb-0">{{ number_format($montantTotal, 0, ',', ' ') }} FCFA</h4>
                        <p class="mb-0">Montant à rembourser</p>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="material-icons" style="font-size: 40px;">payments</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.paiements.remboursements.index') }}" class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Annonceur</label>
                <select name="annonceur_id" class="form-select">
                    <option value="">Tous les annonceurs</option>
                    @foreach($annonceurs as $annonceur)
                        <option value="{{ $annonceur->id }}" {{ request('annonceur_id') == $annonceur->id ? 'selected' : '' }}>
                            {{ $annonceur->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Statut</label>
                <select name="statut" class="form-select">
                    <option value="">Tous les statuts</option>
                    <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                    <option value="approuve" {{ request('statut') == 'approuve' ? 'selected' : '' }}>Approuvé</option>
                    <option value="rejete" {{ request('statut') == 'rejete' ? 'selected' : '' }}>Rejeté</option>
                    <option value="rembourse" {{ request('statut') == 'rembourse' ? 'selected' : '' }}>Remboursé</option>
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
                <a href="{{ route('admin.paiements.remboursements.index') }}" class="btn btn-secondary w-100">
                    <i class="material-icons">refresh</i>
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="p-1 m-0 text-16 font-weight-semi">Liste des demandes de remboursement</h2>
    </div>
    <div class="card-body">
        @if($demandes->count() > 0)
            <div class="table-responsive">
                <table class="table nowrap table-hover" id="datatableRemboursements" style="width:100%">
                    <thead>
                        <tr>
                            <th>Date Demande</th>
                            <th>Annonceur</th>
                            <th>Facture</th>
                            <th>Montant</th>
                            <th>Raison</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($demandes as $demande)
                        <tr>
                            <td>
                                <strong>{{ $demande->created_at->format('d/m/Y') }}</strong>
                                <br>
                                <small class="text-muted">{{ $demande->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" 
                                         style="width: 30px; height: 30px;">
                                        <i class="material-icons text-white" style="font-size: 16px;">person</i>
                                    </div>
                                    <div>
                                        <strong>{{ $demande->annonceur->nom }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $demande->annonceur->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <small class="text-muted">{{ $demande->paiementAnnonceur->numero_facture }}</small>
                            </td>
                            <td>
                                <strong class="text-primary">{{ $demande->montant_formate }}</strong>
                            </td>
                            <td>
                                <span class="text-truncate d-inline-block" style="max-width: 200px;" 
                                      title="{{ $demande->raison }}">
                                    {{ Str::limit($demande->raison, 50) }}
                                </span>
                            </td>
                            <td>
                                @switch($demande->statut)
                                    @case('en_attente')
                                        <span class="badge bg-warning">
                                            <i class="material-icons me-1" style="font-size: 14px;">pending</i>En attente
                                        </span>
                                        @break
                                    @case('approuve')
                                        <span class="badge bg-success">
                                            <i class="material-icons me-1" style="font-size: 14px;">check_circle</i>Approuvé
                                        </span>
                                        @break
                                    @case('rejete')
                                        <span class="badge bg-danger">
                                            <i class="material-icons me-1" style="font-size: 14px;">cancel</i>Rejeté
                                        </span>
                                        @break
                                    @case('rembourse')
                                        <span class="badge bg-info">
                                            <i class="material-icons me-1" style="font-size: 14px;">paid</i>Remboursé
                                        </span>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                <div class="btn-group">
                                    <!-- Voir détails -->
                                    <a href="{{ route('admin.paiements.remboursements.show', $demande->id) }}" 
                                       class="btn btn-sm btn-info" 
                                       title="Voir détails">
                                        <i class="material-icons" style="font-size: 16px;">visibility</i>
                                    </a>
                                    
                                    <!-- Actions selon statut -->
                                    @if($demande->statut == 'en_attente')
                                        <a href="{{ route('admin.paiements.remboursements.approuver', $demande->id) }}" 
                                           class="btn btn-sm btn-success"
                                           onclick="return confirm('Approuver cette demande de remboursement ?')"
                                           title="Approuver">
                                            <i class="material-icons" style="font-size: 16px;">check</i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#rejeterModal{{ $demande->id }}"
                                                title="Rejeter">
                                            <i class="material-icons" style="font-size: 16px;">close</i>
                                        </button>
                                    @elseif($demande->statut == 'approuve')
                                        <button type="button" class="btn btn-sm btn-primary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#rembourserModal{{ $demande->id }}"
                                                title="Procéder au remboursement">
                                            <i class="material-icons" style="font-size: 16px;">payments</i>
                                        </button>
                                    @endif
                                </div>

                                <!-- Modal pour rejeter -->
                                <div class="modal fade" id="rejeterModal{{ $demande->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('admin.paiements.remboursements.rejeter', $demande->id) }}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Rejeter la demande</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>Raison du rejet</label>
                                                        <textarea name="raison_rejet" class="form-control" rows="3" required 
                                                                  placeholder="Expliquez la raison du rejet..."></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-danger">Confirmer le rejet</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal pour rembourser -->
                                <div class="modal fade" id="rembourserModal{{ $demande->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('admin.paiements.remboursements.rembourser', $demande->id) }}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Procéder au remboursement</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>Méthode de remboursement</label>
                                                        <select name="methode_remboursement" class="form-select" required>
                                                            <option value="">Sélectionner...</option>
                                                            <option value="virement_bancaire">Virement Bancaire</option>
                                                            <option value="carte_credit">Carte de Crédit</option>
                                                            <option value="cheque">Chèque</option>
                                                            <option value="credit_plateforme">Crédit Plateforme</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Référence du remboursement</label>
                                                        <input type="text" name="reference_remboursement" class="form-control" required
                                                               placeholder="Numéro de transaction ou référence">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Date du remboursement</label>
                                                        <input type="date" name="date_remboursement" class="form-control" required
                                                               value="{{ now()->format('Y-m-d') }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-primary">Confirmer le remboursement</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
                    Affichage de {{ $demandes->firstItem() }} à {{ $demandes->lastItem() }} sur {{ $demandes->total() }} demandes
                </div>
                <div>
                    {{ $demandes->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="material-icons text-muted" style="font-size: 64px;">receipt_long</i>
                <h4 class="text-muted mt-3">Aucune demande de remboursement</h4>
                <p class="text-muted">Aucune demande ne correspond à vos critères de recherche.</p>
                <a href="{{ route('admin.paiements.remboursements.index') }}" class="btn btn-primary mt-3">
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
    $('#datatableRemboursements').DataTable({
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
        order: [[0, 'desc']]
    });
});
</script>
@endsection