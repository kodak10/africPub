@extends('dashboard.layouts.master')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
@endsection

@section('content')
<div class="subheader px-lg">
    <div class="subheader-container">
        <h3 class="subheader-title">Rapport Financier Administrateur</h3>
    </div>
</div>
<div class="container my-4">

    <!-- Résumé Global -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card p-3 text-white bg-primary">
                <h5>Total Revenu Médias</h5>
                <h3>{{ number_format($total_revenu_medias, 2, ',', ' ') }} FCFA</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 text-white bg-success">
                <h5>Total Paiements Annonceurs</h5>
                <h3>{{ number_format($total_revenu_annonceurs, 2, ',', ' ') }} FCFA</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 text-white bg-danger">
                <h5>Total Remboursements</h5>
                <h3>{{ number_format($total_remboursements, 2, ',', ' ') }} FCFA</h3>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="row mb-5">
        <div class="col-md-6">
            <div class="card p-3">
                <h5>Revenus par Média</h5>
                <canvas id="mediaPieChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <h5>Revenus par Forfait</h5>
                <canvas id="forfaitBarChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Paiements et Remboursements en attente -->
    <div class="row">
        <div class="col-md-6">
            <div class="card p-3">
                <h5>Paiements Médias en Attente</h5>
                <ul>
                    @foreach($paiements_en_attente as $paiement)
                        <li>{{ $paiement->media->nom_du_media }} - {{ number_format($paiement->montant, 2, ',', ' ') }} FCFA</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <h5>Remboursements en Attente</h5>
                <ul>
                    @foreach($remboursements_en_attente as $remb)
                        <li>{{ $remb->annonceur->nom }} - {{ number_format($remb->montant, 2, ',', ' ') }} FCFA</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const mediaPieChart = new Chart(document.getElementById('mediaPieChart'), {
    type: 'pie',
    data: {
        labels: @json($media_labels),
        datasets: [{
            label: 'Revenus Médias',
            data: @json($media_revenus),
            backgroundColor: [
                '#007bff','#28a745','#dc3545','#ffc107','#6f42c1','#fd7e14'
            ],
        }]
    },
    options: {
        responsive: true,
    }
});

const forfaitBarChart = new Chart(document.getElementById('forfaitBarChart'), {
    type: 'bar',
    data: {
        labels: @json($forfait_labels),
        datasets: [{
            label: 'Revenus Forfaits',
            data: @json($forfait_revenus),
            backgroundColor: '#17a2b8',
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>
@endsection
