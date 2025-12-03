@extends('dashboard.layouts.master')

@section('content')
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">
                @if($paiement)
                    Détail du Paiement #PAY-{{ str_pad($paiement->id, 6, '0', STR_PAD_LEFT) }}
                @else
                    Demande de Paiement
                @endif
            </h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('media.dashboard') }}">Tableau de Bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('media.paiements.historique') }}">Historique Paiements</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        @if($paiement) Détail Paiement @else Demande Paiement @endif
                    </li>
                </ol>
            </nav>
        </div>
        
    </div>
</div>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- Formulaire de demande de paiement --}}
            @if(!$paiement && !$demandeEnCours)
                @if(!$eligibilite['eligible'])
                    <div class="alert alert-danger">
                        Solde insuffisant pour demander un paiement.<br>
                        Minimum requis: <strong>{{ number_format($eligibilite['montant_minimum'],0,',',' ') }} FCFA</strong><br>
                        Votre solde: <strong>{{ number_format($eligibilite['solde_actuel'],0,',',' ') }} FCFA</strong>
                    </div>
                @else
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0"><i class="material-icons me-2">payment</i> Faire une Demande de Paiement</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('media.paiements.demander') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="methode_paiement" class="form-label">Méthode de Paiement</label>
                                    <select name="methode_paiement" id="methode_paiement" class="form-select" required>
                                        <option value="orange_money">Orange Money</option>
                                        <option value="mtn_money">MTN Money</option>
                                        <option value="wave">Wave</option>
                                        <option value="virement">Virement Bancaire</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="numero_compte" class="form-label">Numéro de Compte / Portefeuille</label>
                                    <input type="text" name="numero_compte" id="numero_compte" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <i class="material-icons me-1">send</i> Envoyer la Demande
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @endif

            {{-- Détail du paiement existant --}}
            @if($paiement)
                @include('dashboard.pages.media.paiements._detail', [
                    'paiement' => $paiement,
                    'statistiquesPaiement' => $statistiquesPaiement
                ])
            @endif

        </div>
    </div>
</div>
@endsection
