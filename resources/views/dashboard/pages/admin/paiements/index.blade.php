@extends('dashboard.layouts.master')

@section('content')

<div class="subheader px-lg">
    <div class="subheader-container">
        <h3 class="subheader-title">Demandes de Paiement</h3>
    </div>
</div>

<div class="container">
    <!-- FORMULAIRE DE RECHERCHE -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.paiements.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label>Statut</label>
                    <select name="statut" class="form-select">
                        <option value="">--Tous--</option>
                        <option value="en_attente" {{ request('statut')=='en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="approuve" {{ request('statut')=='approuve' ? 'selected' : '' }}>Approuvé</option>
                        <option value="paye" {{ request('statut')=='paye' ? 'selected' : '' }}>Payé</option>
                        <option value="rejete" {{ request('statut')=='rejete' ? 'selected' : '' }}>Rejeté</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Média</label>
                    <select name="media_id" class="form-select">
                        <option value="">--Tous--</option>
                        @foreach($medias as $media)
                            <option value="{{ $media->id }}" {{ request('media_id') == $media->id ? 'selected' : '' }}>
                                {{ $media->nom_du_media }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Date début</label>
                    <input type="date" name="date_debut" class="form-control" value="{{ request('date_debut') }}">
                </div>

                <div class="col-md-2">
                    <label>Date fin</label>
                    <input type="date" name="date_fin" class="form-control" value="{{ request('date_fin') }}">
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Rechercher</button>
                    <a href="{{ route('admin.paiements.index') }}" class="btn btn-secondary">Réinitialiser</a>
                </div>
            </form>
        </div>
    </div>

    <!-- TABLEAU DES DEMANDES -->
    <div class="card shadow">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Média</th>
                            <th>Vues Total</th>
                            <th>Clics Total</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Détection Fraude</th>
                            <th>Date Demande</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($demandes as $demande)
                            <tr class="@if($demande->fraude_detectee) table-warning @endif">
                                <td>
                                    <strong>{{ $demande->media->nom_du_media }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $demande->media->email }}</small>
                                </td>
                               <td>{{ $demande->vues_total }}</td>
                                <td>{{ $demande->clics_total }}</td>

                                
                                <td>
                                    <strong>{{ number_format($demande->montant, 2, ',', ' ') }} FCFA</strong>
                                </td>
                                <td>
                                    <span class="badge 
                                        @if($demande->statut == 'paye') bg-success
                                        @elseif($demande->statut == 'approuve') bg-info
                                        @elseif($demande->statut == 'rejete') bg-danger
                                        @else bg-warning @endif">
                                        {{ ucfirst(str_replace('_', ' ', $demande->statut)) }}
                                    </span>
                                </td>
                                <td>
                                    @if($demande->fraude_detectee)
                                        <span class="badge bg-danger">⚠️ {{ $demande->raison_fraude }}</span>
                                    @else
                                        <span class="badge bg-success">✅ Normal</span>
                                    @endif
                                </td>
                                <td>{{ $demande->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group">
                                        @if($demande->statut == 'en_attente')
                                            <a href="{{ route('admin.paiements.payer', $demande->id) }}" 
                                               class="btn btn-sm btn-primary">
                                                Payer
                                            </a>
                                           
                                            <button type="button" class="btn btn-sm btn-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#rejeterModal{{ $demande->id }}">
                                                Rejeter
                                            </button>
                                        @elseif($demande->statut == 'approuve')
                                            <a href="{{ route('admin.paiements.payer', $demande->id) }}" 
                                               class="btn btn-sm btn-primary">
                                                Procéder au Paiement
                                            </a>
                                        @else
                                            <span class="text-muted">Aucune action</span>
                                        @endif
                                    </div>

                                    <!-- Modal pour rejeter -->
                                    <div class="modal fade" id="rejeterModal{{ $demande->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST" action="{{ route('admin.paiements.rejeter', $demande->id) }}">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Rejeter la demande</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label>Raison du rejet</label>
                                                            <textarea name="raison" class="form-control" rows="3" required 
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $demandes->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('[data-bs-toggle="tooltip"]').tooltip();
});
</script>
@endsection