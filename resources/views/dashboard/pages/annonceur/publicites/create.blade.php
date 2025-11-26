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
                                <label class="form-label">Forfait <span class="text-danger">*</span></label>
                                <select name="forfait_id" class="form-select">
                                    <option value="">Tous les forfaits</option>
                                    @foreach($forfaits as $forfait)
                                        <option value="{{ $forfait->id }}" {{ request('forfait_id') == $forfait->id ? 'selected' : '' }}>
                                            {{ $forfait->libelle }} 
                                            — {{ number_format($forfait->objectif_vues, 0, ',', ' ') }} vues 
                                            — {{ number_format($forfait->montant, 0, ',', ' ') }} FCFA
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>

                    <!-- Section Fichier média avec prévisualisation -->
                    <div class="mb-3">
                        <label class="form-label">Fichier média <span class="text-danger">*</span></label>
                        <input type="file" name="media_file" id="media_file" class="form-control" required
                               accept=".jpg,.jpeg,.png,.mp4,.mov,.avi,.webm">
                        <div class="form-text">
                            Formats acceptés: JPG, PNG, MP4, MOV, AVI, WEBM. Maximum 10MB.
                        </div>
                    </div>

                    <!-- Zone de prévisualisation -->
                    <div class="mb-3" id="preview-container" style="display: none;">
                        <label class="form-label">Aperçu du média</label>
                        <div class="card">
                            <div class="card-body">
                                <div id="preview-content" class="text-center">
                                    <!-- Le contenu de prévisualisation sera inséré ici -->
                                </div>
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <small class="text-muted" id="file-name"></small>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <small class="text-muted" id="file-size"></small>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" id="progress-bar" style="display: none; height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                                    </div>
                                </div>
                            </div>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mediaFileInput = document.getElementById('media_file');
    const previewContainer = document.getElementById('preview-container');
    const previewContent = document.getElementById('preview-content');
    const fileName = document.getElementById('file-name');
    const fileSize = document.getElementById('file-size');
    const progressBar = document.getElementById('progress-bar');
    const progressBarInner = progressBar.querySelector('.progress-bar');

    let currentRotation = 0;
    let currentVideo = null;

    mediaFileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            showLoadingPreview();
            
            // Afficher les informations du fichier
            fileName.textContent = `Nom: ${file.name}`;
            const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
            fileSize.textContent = `Taille: ${sizeInMB} MB`;
            
            // Simuler une progression
            simulateProgress();
            
            // Vérifier le type de fichier après un petit délai
            setTimeout(() => {
                const fileType = file.type;
                
                if (fileType.startsWith('image/')) {
                    previewImage(file);
                } else if (fileType.startsWith('video/')) {
                    previewVideo(file);
                } else {
                    previewUnsupported();
                }
                
                previewContainer.style.display = 'block';
                progressBar.style.display = 'none';
            }, 800);
            
        } else {
            previewContainer.style.display = 'none';
        }
    });

    function showLoadingPreview() {
        previewContent.innerHTML = `
            <div class="py-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Chargement...</span>
                </div>
                <p class="mt-2 mb-0">Chargement de l'aperçu...</p>
            </div>
        `;
        previewContainer.style.display = 'block';
        progressBar.style.display = 'block';
    }

    function simulateProgress() {
        let width = 0;
        const interval = setInterval(() => {
            if (width >= 100) {
                clearInterval(interval);
            } else {
                width += 10;
                progressBarInner.style.width = width + '%';
            }
        }, 50);
    }

    function previewImage(file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewContent.innerHTML = `
                <div class="position-relative d-inline-block">
                    <img src="${e.target.result}" alt="Aperçu de l'image" 
                         class="img-fluid rounded shadow" style="max-height: 250px; transform: rotate(${currentRotation}deg);">
                    <span class="position-absolute top-0 start-0 m-2 badge bg-success">
                        <i class="material-icons me-1" style="font-size: 14px;">image</i>Image
                    </span>
                </div>
                <div class="mt-3">
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="rotate-btn">
                        <i class="material-icons me-1" style="font-size: 14px;">rotate_right</i>Tourner
                    </button>
                </div>
            `;

            // Ajouter l'événement pour le bouton de rotation
            document.getElementById('rotate-btn').addEventListener('click', function() {
                const img = previewContent.querySelector('img');
                currentRotation += 90;
                img.style.transform = `rotate(${currentRotation}deg)`;
                img.style.transition = 'transform 0.3s ease';
            });
        };
        
        reader.readAsDataURL(file);
    }

    function previewVideo(file) {
        const videoURL = URL.createObjectURL(file);
        
        previewContent.innerHTML = `
            <div class="position-relative d-inline-block">
                <video controls class="rounded shadow" style="max-width: 100%; max-height: 250px;">
                    <source src="${videoURL}" type="${file.type}">
                    Votre navigateur ne supporte pas la lecture de vidéos.
                </video>
                <span class="position-absolute top-0 start-0 m-2 badge bg-info">
                    <i class="material-icons me-1" style="font-size: 14px;">videocam</i>Vidéo
                </span>
            </div>
            <div class="mt-3">
                <button type="button" class="btn btn-outline-secondary btn-sm" id="mute-btn">
                    <i class="material-icons me-1" style="font-size: 14px;">volume_off</i>Muet
                </button>
            </div>
        `;

        // Récupérer la référence à la vidéo
        currentVideo = previewContent.querySelector('video');
        
        // Ajouter l'événement pour le bouton muet
        document.getElementById('mute-btn').addEventListener('click', function() {
            if (currentVideo) {
                currentVideo.muted = !currentVideo.muted;
                const icon = this.querySelector('.material-icons');
                icon.textContent = currentVideo.muted ? 'volume_off' : 'volume_up';
            }
        });
    }

    function previewUnsupported() {
        previewContent.innerHTML = `
            <div class="text-center py-4">
                <i class="material-icons text-warning" style="font-size: 48px;">warning</i>
                <p class="mt-2 mb-1">Type de fichier non supporté pour la prévisualisation</p>
                <small class="text-muted">Le fichier sera tout de même téléchargé</small>
            </div>
        `;
    }

    // Validation de la taille du fichier
    mediaFileInput.addEventListener('change', function() {
        const file = this.files[0];
        const maxSize = 10 * 1024 * 1024; // 10MB en bytes
        
        if (file && file.size > maxSize) {
            alert('Le fichier est trop volumineux. La taille maximale autorisée est de 10MB.');
            this.value = '';
            previewContainer.style.display = 'none';
            
            // Réinitialiser les variables
            currentRotation = 0;
            currentVideo = null;
        }
    });

    // Réinitialiser lors du changement de fichier
    mediaFileInput.addEventListener('click', function() {
        currentRotation = 0;
        currentVideo = null;
    });
});
</script>

<style>
.preview-container {
    transition: all 0.3s ease;
}

#preview-content img,
#preview-content video {
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border: 1px solid #dee2e6;
    transition: transform 0.3s ease;
}

.badge {
    font-size: 0.8rem;
}

.material-icons {
    vertical-align: middle;
}

.progress {
    border-radius: 10px;
}

.progress-bar {
    transition: width 0.3s ease;
}
</style>
@endpush