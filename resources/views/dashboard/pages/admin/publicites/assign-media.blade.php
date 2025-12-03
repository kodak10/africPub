@extends('dashboard.layouts.master')

@section('content')

<div class="subheader px-lg">
    <div class="subheader-container">
        <h3 class="subheader-title">Affectation des Publicités aux Médias</h3>
    </div>
</div>

<div class="container">
    <!-- FORMULAIRE DE RECHERCHE -->
    <div class="card shadow mb-4">
        <div class="card-body">
           <form method="GET" action="{{ route('admin.publicites.assign-media') }}" class="d-flex align-items-center justify-content-between w-100">

                <!-- Filtre par Annonceur -->
                <div class="me-3">
                    <label>Annonceur</label>
                    <select name="annonceur_id" class="form-select select2-init">
                        <option value="">--Tous--</option>
                        @foreach($annonceurs as $ann)
                            <option value="{{ $ann->id }}" {{ request('annonceur_id') == $ann->id ? 'selected' : '' }}>
                                {{ $ann->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtre par Forfait -->
                <div class="me-3">
                    <label>Forfait</label>
                    <select name="forfait_id" class="form-select select2-init">
                        <option value="">--Tous--</option>
                        @foreach($forfaits as $forfait)
                            <option value="{{ $forfait->id }}" {{ request('forfait_id') == $forfait->id ? 'selected' : '' }}>
                                {{ $forfait->libelle }} 
                                — {{ number_format($forfait->objectif_vues, 0, ',', ' ') }} vues 
                                — {{ number_format($forfait->montant, 0, ',', ' ') }} FCFA
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Boutons de soumission alignés à droite -->
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary me-2">Rechercher</button>
                    <a href="{{ route('admin.publicites.assign-media') }}" class="btn btn-secondary">Réinitialiser</a>
                </div>

            </form>
        </div>
    </div>

    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    </div>

    <!-- Liste des publicités approuvées -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Annonceur</th>
                        <th>Statut</th>
                        <th>Vues Actuelles</th>
                        <th>Objectif</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($publicites as $publicite)
                        <tr>
                            <td>{{ $publicite->titre }}</td>
                            <td>{{ $publicite->annonceur->nom }}</td>
                            <td>{{ ucfirst($publicite->statut) }}</td>
                            <td>{{ $publicite->nombre_vues }}</td>
                            <td>{{ $publicite->objectif_vues }}</td>
                            <td>
                                <!-- Bouton pour ouvrir le modal d'affectation des médias -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#assignMediaModal{{ $publicite->id }}">
                                    Affecter à des Médias
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal pour l'affectation des médias -->
@foreach($publicites as $publicite)
    <div class="modal fade" id="assignMediaModal{{ $publicite->id }}" tabindex="-1" aria-labelledby="assignMediaModalLabel{{ $publicite->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignMediaModalLabel{{ $publicite->id }}">Affecter des Médias à la Publicité : {{ $publicite->titre }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.publicites.assign-media-store', $publicite->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label>Médias</label>
                            <select name="media_ids[]" class="form-select select2-modal" multiple="multiple" id="select2-modal-{{ $publicite->id }}">
                                @foreach($medias as $media)
                                    <option value="{{ $media->id }}" 
                                        @if($publicite->medias->contains($media)) selected @endif>
                                        {{ $media->nom_du_media }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Affecter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    console.log("DOM prêt, initialisation des Select2 hors modals.");

    // Select2 global hors modals
    $('.select2-init').each(function() {
        console.log("Initialisation Select2 hors modal pour:", this);
        $(this).select2({
            placeholder: "Sélectionner...",
            allowClear: true,
            width: '100%'
        });
    });

    // Select2 dans les modals existants
    $('.modal').each(function() {
        var $modal = $(this);
        console.log("Initialisation Select2 dans modal:", $modal.attr('id'));

        $modal.find('.select2-modal').each(function() {
            console.log("  - Select2 modal trouvé:", this);
            if (!$(this).hasClass('select2-hidden-accessible')) {
                $(this).select2({
                    placeholder: "Sélectionner...",
                    allowClear: true,
                    width: '100%',
                    dropdownParent: $modal
                });
                console.log("    -> Select2 initialisé pour:", this);
            } else {
                console.log("    -> Select2 déjà initialisé pour:", this);
            }
        });
    });

    // Gestion à l'ouverture du modal (dynamic ou déjà existant)
    $('.modal').on('shown.bs.modal', function () {
        console.log("Modal ouvert:", $(this).attr('id'));
        $(this).find('.select2-modal').each(function () {
            console.log("  - Vérification Select2 pour:", this);
            if (!$(this).hasClass('select2-hidden-accessible')) {
                $(this).select2({
                    placeholder: "Sélectionner...",
                    allowClear: true,
                    width: '100%',
                    dropdownParent: $(this).closest('.modal')
                });
                console.log("    -> Select2 initialisé après ouverture du modal:", this);
            } else {
                console.log("    -> Select2 déjà initialisé après ouverture:", this);
            }
        });
    });

    // Debug à la fermeture du modal
    $('.modal').on('hidden.bs.modal', function () {
        console.log("Modal fermé:", $(this).attr('id'));
    });
});

</script>
@endsection