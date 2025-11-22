@extends('dashboard.layouts.master')

@section('content')

<!-- SUBHEADER -->
<div class="subheader px-lg">
    <div class="subheader-container">
        <div class="subheader-main">
            <h3 class="subheader-title">Créer une Publicité</h3>
            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                <ol class="ul-breadcrumb-items">
                    <li class="breadcrumb-home">
                        <a href="#"><i class="material-icons">home</i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('annonceur.dashboard') }}">Tableau de Bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('annonceur.index_publicites') }}">Mes Publicités</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Créer une Publicité</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title mb-0">
                    <i class="material-icons me-2">add_circle</i>
                    Nouvelle Publicité
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('annonceur.store_publicite') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Titre de la publicité <span class="text-danger">*</span></label>
                                <input type="text" name="titre" class="form-control" required
                                       placeholder="Ex: Promotion Spéciale Été 2024">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Type de média <span class="text-danger">*</span></label>
                                <select name="type_media" class="form-select" required>
                                    <option value="">Sélectionner...</option>
                                    <option value="image">Image</option>
                                    <option value="video">Vidéo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Forfait <span class="text-danger">*</span></label>
                                <select name="forfait_id" class="form-select" required>
                                    <option value="">Sélectionner un forfait</option>
                                    @foreach($forfaits as $forfait)
                                        <option value="{{ $forfait->id }}">
                                            {{ $forfait->libelle }} - {{ number_format($forfait->montant, 0, ',', ' ') }} FCFA
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fichier média <span class="text-danger">*</span></label>
                        <input type="file" name="media_file" class="form-control" required
                               accept=".jpg,.jpeg,.png,.mp4,.mov,.avi">
                        <div class="form-text">
                            Formats acceptés: JPG, PNG, MP4, MOV, AVI. Maximum 10MB.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">URL de destination <span class="text-danger">*</span></label>
                        <input type="url" name="url_cible" class="form-control" required
                               placeholder="https://votresite.com/promotion">
                        <div class="form-text">
                            L'URL vers laquelle les utilisateurs seront redirigés en cliquant sur votre publicité
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description (optionnel)</label>
                        <textarea name="description" class="form-control" rows="3"
                                  placeholder="Description détaillée de votre publicité..."></textarea>
                    </div>

                    <div class="alert alert-info">
                        <h6><i class="material-icons me-2">info</i>Information importante</h6>
                        <p class="mb-0">
                            Votre publicité sera soumise pour validation par l'administration. 
                            Vous serez notifié une fois qu'elle sera approuvée et diffusée.
                        </p>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('annonceur.index_publicites') }}" class="btn btn-secondary me-md-2">
                            <i class="material-icons me-1">arrow_back</i>
                            Retour
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="material-icons me-1">send</i>
                            Soumettre la publicité
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection