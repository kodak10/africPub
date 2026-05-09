<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kodak Presse - Votre actualité</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
        }
        
        .site-header {
            background: #1a1a2e;
            color: white;
            padding: 20px 5%;
        }
        
        .site-header-inner {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .logo h1 { font-size: 28px; }
        .logo p { font-size: 12px; color: #ccc; }
        
        .main-nav {
            background: white;
            padding: 12px 5%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 99;
        }
        
        .main-nav-inner {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }
        
        .main-nav a {
            text-decoration: none;
            color: #333;
            font-weight: 600;
        }
        
        .main-nav a:hover { color: #e74c3c; }
        
        .main-layout {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 5%;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }
        
        .articles {
            background: white;
            border-radius: 8px;
            padding: 20px;
        }
        
        .article {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .article h2 { color: #1a1a2e; margin-bottom: 10px; }
        .article-meta { color: #888; font-size: 12px; margin-bottom: 15px; }
        
        .sidebar {
            position: sticky;
            top: 80px;
            align-self: start;
        }
        
        .ad-widget {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .widget-title {
            background: #e74c3c;
            color: white;
            padding: 12px 15px;
            font-size: 16px;
            font-weight: bold;
        }
        
        .ad-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .ad-item:hover {
            background: #f9f9f9;
        }
        
        .ad-media-container {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
            overflow: hidden;
            position: relative;
            background: #000;
            min-height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .ad-media-container img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .ad-media-container video {
            width: 100%;
            max-height: 200px;
            object-fit: contain;
            cursor: pointer;
        }
        
        /* Overlay pour indiquer que c'est une vidéo */
        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
        }
        
        .ad-media-container:hover .video-overlay {
            opacity: 1;
        }
        
        .video-overlay span {
            background: rgba(0,0,0,0.7);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }
        
        .ad-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .ad-description {
            font-size: 12px;
            color: #666;
            margin-bottom: 8px;
        }
        
        .ad-annonceur {
            font-size: 11px;
            color: #e74c3c;
        }
        
        .ad-link {
            display: inline-block;
            margin-top: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 11px;
        }
        
        .ad-link:hover {
            transform: scale(1.05);
        }
        
        .loading {
            text-align: center;
            padding: 40px;
            color: #666;
        }
        
        .footer {
            background: #1a1a2e;
            color: white;
            text-align: center;
            padding: 30px;
            margin-top: 30px;
        }
        
        @media (max-width: 768px) {
            .main-layout { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="site-header">
        <div class="site-header-inner">
            <div class="logo">
                <h1>📰 Kodak Presse</h1>
                <p>L'information en continu depuis 1995</p>
            </div>
            <div class="date" id="currentDate"></div>
        </div>
    </div>
    
    <div class="main-nav">
        <div class="main-nav-inner">
            <a href="#">🏠 Accueil</a>
            <a href="#">📰 Actualité</a>
            <a href="#">⚽ Sport</a>
            <a href="#">💰 Économie</a>
            <a href="#">🎨 Culture</a>
            <a href="#">🌍 International</a>
        </div>
    </div>
    
    <div class="main-layout">
        <div class="articles">
            <div class="article">
                <h2>Élection présidentielle : les candidats en lice</h2>
                <div class="article-meta">Publié le 15 mars 2024 | Par La Rédaction</div>
                <p>La campagne électorale bat son plein à quelques semaines du premier tour. Les principaux candidats ont présenté leurs programmes respectifs lors des meetings de ce week-end. Les sondages placent trois candidats en tête des intentions de vote...</p>
            </div>
            
            <div class="article">
                <h2>Économie : le FMI revoit ses prévisions à la hausse</h2>
                <div class="article-meta">Publié le 14 mars 2024 | Par Jean Dupont</div>
                <p>Le Fonds Monétaire International a publié ses nouvelles prévisions de croissance pour l'Afrique subsaharienne. Une bonne nouvelle pour l'économie régionale qui devrait connaître une croissance de 4,5% cette année...</p>
            </div>
            
            <div class="article">
                <h2>CAN 2025 : les dates officielles dévoilées</h2>
                <div class="article-meta">Publié le 13 mars 2024 | Par Marc Zongo</div>
                <p>La Confédération Africaine de Football a annoncé les dates de la prochaine Coupe d'Afrique des Nations. La compétition se déroulera du 15 juin au 15 juillet 2025 dans 5 villes hôtes...</p>
            </div>
            
            <div class="article">
                <h2>Innovation : une start-up locale révolutionne le secteur agricole</h2>
                <div class="article-meta">Publié le 12 mars 2024 | Par Sophie Kaboré</div>
                <p>Une jeune entreprise basée à Ouagadougou a développé une application mobile qui permet aux agriculteurs d'optimiser leurs récoltes grâce à l'intelligence artificielle...</p>
            </div>
        </div>
        
        <div class="sidebar">
            <div class="ad-widget">
                <div class="widget-title">📢 PUBLICITÉS</div>
                <div id="ads-container">
                    <div class="loading">Chargement des publicités...</div>
                </div>
            </div>
            
            <div class="ad-widget">
                <div class="widget-title">📊 À LA UNE</div>
                <div style="padding: 15px;">
                    <p>• Les 5 infos à retenir</p>
                    <p>• Éditorial de la semaine</p>
                    <p>• Interview exclusive</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer">
        <p>© 2024 Kodak Presse - Tous droits réservés</p>
        <p style="font-size: 12px; margin-top: 10px;">Plateforme publicitaire intégrée à Afric-Pub</p>
    </div>
    
    <script>
        const MEDIA_TOKEN = 'media-token-1';
        const API_BASE_URL = 'http://192.168.1.17:8080/api/media';
        
        const recordedViews = new Set();
        
        async function fetchPublicites() {
            try {
                const response = await fetch(`${API_BASE_URL}/publicites`, {
                    method: 'GET',
                    headers: {
                        'X-Media-Token': MEDIA_TOKEN,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                
                if (data.success && data.publicites && data.publicites.length > 0) {
                    displayPublicites(data.publicites);
                } else {
                    displayNoAds();
                }
            } catch (error) {
                console.error('Erreur:', error);
                displayError();
            }
        }
        
        function initVideo(video, container) {
            if (!video) return;
            
            // Désactiver les contrôles natifs
            video.controls = false;
            
            // Ajouter un overlay
            const overlay = document.createElement('div');
            overlay.className = 'video-overlay';
            overlay.innerHTML = '<span>▶️</span>';
            container.appendChild(overlay);
            
            // Lecture/Pause au clic sur la vidéo ou l'overlay
            const togglePlay = (e) => {
                e.stopPropagation();
                if (video.paused) {
                    video.play();
                    overlay.style.opacity = '0';
                } else {
                    video.pause();
                    overlay.style.opacity = '1';
                }
            };
            
            video.addEventListener('click', togglePlay);
            overlay.addEventListener('click', togglePlay);
            
            // Cacher l'overlay quand la vidéo joue
            video.addEventListener('play', () => {
                overlay.style.opacity = '0';
            });
            
            video.addEventListener('pause', () => {
                if (video.currentTime > 0 && !video.ended) {
                    overlay.style.opacity = '1';
                }
            });
            
            video.addEventListener('ended', () => {
                overlay.style.opacity = '1';
                overlay.innerHTML = '<span>🔄</span>';
                setTimeout(() => {
                    overlay.innerHTML = '<span>▶️</span>';
                }, 2000);
            });
            
            // Auto-play quand la vidéo devient visible
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && video.paused && video.currentTime === 0) {
                        video.play().catch(e => console.log('Auto-play bloqué:', e));
                    }
                });
            }, { threshold: 0.5 });
            observer.observe(container);
        }
        
        function displayPublicites(publicites) {
            const container = document.getElementById('ads-container');
            container.innerHTML = '';
            
            publicites.forEach(ad => {
                const adDiv = document.createElement('div');
                adDiv.className = 'ad-item';
                adDiv.setAttribute('data-id', ad.id);
                adDiv.setAttribute('data-url', ad.url_cible);
                
                let mediaContent = '';
                
                if (ad.type_media === 'image') {
                    mediaContent = `
                        <div class="ad-media-container">
                            <img src="${ad.media_path}" alt="${ad.titre}" loading="lazy">
                        </div>
                    `;
                } else if (ad.type_media === 'video') {
                    mediaContent = `
                        <div class="ad-media-container" id="video-container-${ad.id}">
                            <video id="video-${ad.id}" 
                                   src="${ad.media_path}" 
                                   preload="auto"
                                   muted
                                   loop>
                            </video>
                        </div>
                    `;
                }
                
                adDiv.innerHTML = `
                    ${mediaContent}
                    <div class="ad-title">${ad.titre}</div>
                    <div class="ad-description">${ad.description || 'Découvrez cette offre exclusive'}</div>
                    <div class="ad-annonceur">📢 ${ad.annonceur_nom}</div>
                    <a href="#" class="ad-link" data-link="${ad.url_cible}" data-id="${ad.id}">Voir l'offre →</a>
                `;
                
                // Observer pour les vues
                const viewObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && !recordedViews.has(ad.id)) {
                            recordedViews.add(ad.id);
                            recordView(ad.id);
                        }
                    });
                }, { threshold: 0.5 });
                viewObserver.observe(adDiv);
                
                // Initialiser la vidéo
                if (ad.type_media === 'video') {
                    const video = document.getElementById(`video-${ad.id}`);
                    const videoContainer = document.getElementById(`video-container-${ad.id}`);
                    if (video && videoContainer) {
                        initVideo(video, videoContainer);
                    }
                }
                
                // Gestion du clic sur le lien
                const link = adDiv.querySelector('.ad-link');
                if (link) {
                    link.addEventListener('click', async (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        const url = link.getAttribute('data-link');
                        const id = link.getAttribute('data-id');
                        await recordClick(id);
                        if (url) {
                            window.open(url, '_blank');
                        }
                    });
                }
                
                container.appendChild(adDiv);
            });
        }
        
        async function recordView(publiciteId) {
            try {
                const response = await fetch(`${API_BASE_URL}/record-view`, {
                    method: 'POST',
                    headers: {
                        'X-Media-Token': MEDIA_TOKEN,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ publicite_id: publiciteId })
                });
                
                const data = await response.json();
                if (data.success) {
                    console.log(`✅ Vue enregistrée pour la publicité ${publiciteId}`);
                }
            } catch (error) {
                console.error('Erreur enregistrement vue:', error);
            }
        }
        
        async function recordClick(publiciteId) {
            try {
                const response = await fetch(`${API_BASE_URL}/record-click`, {
                    method: 'POST',
                    headers: {
                        'X-Media-Token': MEDIA_TOKEN,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ publicite_id: publiciteId })
                });
                
                const data = await response.json();
                if (data.success) {
                    console.log(`✅ Clic enregistré pour la publicité ${publiciteId}`);
                    return true;
                }
                return false;
            } catch (error) {
                console.error('Erreur enregistrement clic:', error);
                return false;
            }
        }
        
        function displayNoAds() {
            document.getElementById('ads-container').innerHTML = `
                <div style="padding: 40px; text-align: center; color: #666;">
                    📢 Aucune publicité pour le moment
                </div>
            `;
        }
        
        function displayError() {
            document.getElementById('ads-container').innerHTML = `
                <div style="padding: 40px; text-align: center; color: #e74c3c;">
                    ⚠️ Impossible de charger les publicités
                    <br>
                    <small>Vérifiez que le serveur est accessible</small>
                </div>
            `;
        }
        
        function displayDate() {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('currentDate').textContent = new Date().toLocaleDateString('fr-FR', options);
        }
        
        displayDate();
        fetchPublicites();
        setInterval(fetchPublicites, 300000);
    </script>
</body>
</html>