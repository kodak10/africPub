@extends('dashboard.layouts.master')

@section('content')

<!-- SUBHEADER -->
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">Rapports et Statistiques</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('annonceur.dashboard') }}">Tableau de Bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Rapports</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('annonceur.rapports') }}" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Date début</label>
                <input type="date" name="date_debut" class="form-control" value="{{ $dateDebut }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Date fin</label>
                <input type="date" name="date_fin" class="form-control" value="{{ $dateFin }}">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="material-icons">search</i>
                    Appliquer
                </button>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <a href="{{ route('annonceur.rapports') }}" class="btn btn-secondary w-100">
                    <i class="material-icons">refresh</i>
                    Réinitialiser
                </a>
            </div>
        </form>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body text-center">
                <i class="material-icons mb-2" style="font-size: 40px;">visibility</i>
                <h3>{{ number_format($statsGlobales['total_vues']) }}</h3>
                <p class="mb-0">Vues Total</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <i class="material-icons mb-2" style="font-size: 40px;">touch_app</i>
                <h3>{{ number_format($statsGlobales['total_clics']) }}</h3>
                <p class="mb-0">Clics Total</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card bg-warning text-white">
            <div class="card-body text-center">
                <i class="material-icons mb-2" style="font-size: 40px;">payments</i>
                <h3>{{ number_format($statsGlobales['investissement_total'], 0, ',', ' ') }}</h3>
                <p class="mb-0">FCFA Investis</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="p-1 m-0 text-16 font-weight-semi">Performances par Publicité</h2>
    </div>
    <div class="card-body">
        @if($performancesPublicites->count() > 0)
            <div class="table-responsive">
                <table class="table nowrap table-hover" id="datatableRapports" style="width:100%">
                    <thead>
                        <tr>
                            <th>Publicité</th>
                            <th>Forfait</th>
                            <th>Statut</th>
                            <th>Vues</th>
                            <th>Clics</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($performancesPublicites as $publicite)
                        <tr>
                            <td>
                                <strong>{{ $publicite->titre }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $publicite->forfait->libelle }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $publicite->statut == 'validé' ? 'success' : 'warning' }}">
                                    {{ $publicite->statut }}
                                </span>
                            </td>
                            <td>
                                <strong class="text-info">{{ number_format($publicite->total_vues) }}</strong>
                            </td>
                            <td>
                                <strong class="text-success">{{ number_format($publicite->total_clics) }}</strong>
                            </td>
                            

                            
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="material-icons text-muted" style="font-size: 64px;">analytics</i>
                <h4 class="text-muted mt-3">Aucune donnée disponible</h4>
                <p class="text-muted">Aucune statistique n'est disponible pour la période sélectionnée.</p>
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
    $('#datatableRapports').DataTable({
        scrollY: "500px",
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        searching: true,
        ordering: true,
        responsive: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        },
        order: [[3, 'desc']]
    });
});
</script>
@endsection