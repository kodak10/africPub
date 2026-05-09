@extends('dashboard.layouts.master')

@section('content')

<!-- SUBHEADER -->
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">Historique des Paiements</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('media.dashboard') }}">Tableau de Bord</a></li>
                    <li class="breadcrumb-item"><a href="#">Paiements</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Historique</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid mt-3">
    <!-- STATISTIQUES PAIEMENTS -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Payé
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($statistiquesPaiements['total_paye'], 0, ',', ' ') }} FCFA
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons text-gray-300">payments</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Paiements Reçus
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $statistiquesPaiements['paiements_total'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons text-gray-300">list_alt</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Montant Moyen
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($statistiquesPaiements['montant_moyen'], 0, ',', ' ') }} FCFA
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons text-gray-300">trending_up</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Dernier Paiement
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @if($statistiquesPaiements['dernier_paiement'])
                                    {{ number_format($statistiquesPaiements['dernier_paiement']->montant, 0, ',', ' ') }} FCFA
                                @else
                                    Aucun
                                @endif
                            </div>
                            <div class="text-xs text-muted mt-1">
                                @if($statistiquesPaiements['dernier_paiement'])
                                    {{ $statistiquesPaiements['dernier_paiement']->date_paiement->format('d/m/Y') }}
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="material-icons text-gray-300">update</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages Flash -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="material-icons me-1">check_circle</i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="material-icons me-1">error</i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- TABLEAU DES PAIEMENTS -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="material-icons me-2">history</i>
                Historique des Paiements
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped w-100" id="datatablePaiements">
                    <thead>
                        <tr>
                            <th>Référence</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Méthode</th>
                            <th>Date Demande</th>
                            <th>Date Paiement</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paiements as $paiement)
                        <tr>
                            <td>
                                <strong>#PAY-{{ str_pad($paiement->id, 6, '0', STR_PAD_LEFT) }}</strong>
                                <br>
                                <small class="text-muted">ID: #{{ $paiement->id }}</small>
                            </td>
                            <td>
                                <strong class="text-success">{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</strong>
                            </td>
                            <td>
                                @switch($paiement->statut)
                                    @case('complet')
                                        <span class="badge bg-success">
                                            <i class="material-icons me-1" style="font-size: 14px;">check_circle</i>
                                            Complet
                                        </span>
                                        @break
                                    @case('attente_confirmation')
                                        <span class="badge bg-warning">
                                            <i class="material-icons me-1" style="font-size: 14px;">schedule</i>
                                            En Attente
                                        </span>
                                        @break
                                    @case('initie')
                                        <span class="badge bg-info">
                                            <i class="material-icons me-1" style="font-size: 14px;">play_circle</i>
                                            Initié
                                        </span>
                                        @break
                                    @case('echec')
                                        <span class="badge bg-danger">
                                            <i class="material-icons me-1" style="font-size: 14px;">error</i>
                                            Échec
                                        </span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ $paiement->statut }}</span>
                                @endswitch
                            </td>
                            <td>
                                <span class="badge bg-primary">
                                    @switch($paiement->methode_paiement)
                                        @case('orange_money')
                                            Orange Money
                                            @break
                                        @case('mtn_money')
                                            MTN Money
                                            @break
                                        @case('wave')
                                            Wave
                                            @break
                                        @case('virement')
                                            Virement Bancaire
                                            @break
                                        @default
                                            {{ $paiement->methode_paiement }}
                                    @endswitch
                                </span>
                            </td>
                            <td>
                                <small>
                                    {{ $paiement->created_at->format('d/m/Y') }}<br>
                                    <span class="text-muted">{{ $paiement->created_at->format('H:i') }}</span>
                                </small>
                            </td>
                            <td>
                                @if($paiement->date_paiement)
                                    <small>
                                        {{ $paiement->date_paiement->format('d/m/Y') }}<br>
                                        <span class="text-muted">{{ $paiement->date_paiement->format('H:i') }}</span>
                                    </small>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('media.paiements.detail', $paiement->id) }}" 
                                       class="btn btn-info" title="Voir détails">
                                        <i class="material-icons">visibility</i>
                                    </a>
                                    @if($paiement->statut == 'complet')
                                        <button class="btn btn-success" 
                                                onclick="telechargerRecu({{ $paiement->id }})"
                                                title="Télécharger reçu">
                                            <i class="material-icons">receipt</i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- RÉSUMÉ ANNÉE EN COURS -->
    @if($paiements->count() > 0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h6 class="card-title mb-0">
                        <i class="material-icons me-2">analytics</i>
                        Résumé de l'Année {{ now()->year }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        @php
                            $paiementsAnnee = $media->paiementsComplets()
                                ->whereYear('date_paiement', now()->year)
                                ->get();
                            
                            $totalAnnee = $paiementsAnnee->sum('montant');
                            $moyenneAnnee = $paiementsAnnee->avg('montant') ?? 0;
                            $paiementsMois = $paiementsAnnee->groupBy(function($date) {
                                return $date->date_paiement->format('m');
                            });
                        @endphp

                        <div class="col-md-3 col-sm-6 mb-3">
                            <h4 class="text-primary">{{ number_format($totalAnnee, 0, ',', ' ') }} FCFA</h4>
                            <p class="text-muted">Total Année</p>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <h4 class="text-success">{{ $paiementsAnnee->count() }}</h4>
                            <p class="text-muted">Paiements Reçus</p>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <h4 class="text-info">{{ number_format($moyenneAnnee, 0, ',', ' ') }} FCFA</h4>
                            <p class="text-muted">Moyenne par Paiement</p>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <h4 class="text-warning">{{ $paiementsMois->count() }}</h4>
                            <p class="text-muted">Mois avec Paiements</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function () {
    // Initialisation de DataTable (sans re-déclarer frenchTranslation car déjà dans master)
    if ($.fn.DataTable.isDataTable('#datatablePaiements')) {
        $('#datatablePaiements').DataTable().destroy();
    }
    
    // Initialisation de DataTable avec responsive
    var table = $('#datatablePaiements').DataTable({
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        paging: true,
        searching: true,
        ordering: true,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tous"]],
        // Utiliser la variable du master si elle existe, sinon utiliser une traduction par défaut
        language: typeof frenchTranslation !== 'undefined' ? frenchTranslation : {
            "sProcessing": "Traitement en cours...",
            "sSearch": "Rechercher :",
            "sLengthMenu": "Afficher _MENU_ éléments",
            "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
            "sInfoEmpty": "Affichage de 0 à 0 sur 0 éléments",
            "sInfoFiltered": "(filtré de _MAX_ éléments au total)",
            "sZeroRecords": "Aucun élément à afficher",
            "sEmptyTable": "Aucune donnée disponible dans le tableau",
            "oPaginate": {
                "sFirst": "Premier",
                "sPrevious": "Précédent",
                "sNext": "Suivant",
                "sLast": "Dernier"
            }
        },
        columnDefs: [
            { responsivePriority: 1, targets: 0 },  // Référence - priorité haute
            { responsivePriority: 2, targets: 6 },  // Actions - priorité haute
            { responsivePriority: 3, targets: 2 },  // Statut - priorité moyenne
            { responsivePriority: 4, targets: 1 },  // Montant - priorité moyenne
            { responsivePriority: 5, targets: 3 },  // Méthode - priorité moyenne
            { responsivePriority: 6, targets: 4 },  // Date demande - priorité basse
            { responsivePriority: 7, targets: 5 }   // Date paiement - priorité basse
        ],
        autoWidth: false,
        order: [[4, 'desc']] // Tri par date demande décroissante
    });
    
    // Configuration de Toastr
    if (typeof toastr !== 'undefined') {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000"
        };
        
        // Messages flash
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        
        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    }
});

// Fonction pour télécharger le reçu
function telechargerRecu(paiementId) {
    window.open('/media/paiements/recu/' + paiementId, '_blank');
}
</script>
@endsection

@push('styles')
<style>
.border-left-success { border-left: 0.25rem solid #1cc88a !important; }
.border-left-info { border-left: 0.25rem solid #36b9cc !important; }
.border-left-warning { border-left: 0.25rem solid #f6c23e !important; }
.border-left-primary { border-left: 0.25rem solid #4e73df !important; }

.card {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}
</style>
@endpush