@extends('home.layouts.master')
@section('content')

<div class="hero4-section-area">
    <div class="container">
        <div class="row">
          <div class="space60"></div>
            <div class="col-lg-8 m-auto">
                <div class="hero4-header text-center heading7">
                  <h1 class="text-anime-style-1">Diffusez vos annonces sur les <span>grands médias <img src="{{asset('home/assets/img/elements/line-img1.png')}}" alt=""></span> en ligne.</h1>

                  
                    <div class="space20"></div>
                    <p data-aos="fade-up" data-aos-duration="1000">Atteignez votre audience, augmentez votre visibilité et développez votre business en quelques clics.</p>
                    <div class="btn-area1" data-aos="fade-up" data-aos-duration="1200">
                        <a href="#signUp" class="header-btn6">S'INSCRIRE</a>
                        <a href="/login" class="header-btn7">SE CONNECTER</a>
                    </div>
                </div>
            </div>
            <div class="space60"></div>
            
        </div>
    </div>
</div>

<div class="works4-section-area sp2" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="works4-header heading8">
                  <h5 data-aos="fade-up" data-aos-duration="800">
                      <img src="{{asset('home/assets/img/icons/logo-icons3.svg')}}" alt="">
                      À PROPOS DE NOUS
                  </h5>

                  <h2 class="text-anime-style-1">
                      Votre plateforme pour diffuser vos annonces sur les 
                      <span>médias en ligne 
                          <img src="{{asset('home/assets/img/elements/line-img1.png')}}" alt="">
                      </span>
                  </h2>

                  <div class="space10 d-lg-block d-none"></div>

                  <p data-aos="fade-up" data-aos-duration="1000">
                      Nous aidons les entreprises et particuliers à publier facilement leurs annonces 
                      sur plusieurs sites médias afin d'atteindre une audience plus large et qualifiée.
                  </p>

                  <div class="space32"></div>

                  <div class="btn-area1" data-aos="fade-up" data-aos-duration="1200">
                      <a href="/#howTo" class="header-btn6">PLUS D'INFORMATIONS</a>
                  </div>
              </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-7">
                <div class="case-images" data-aos="zoom-in" data-aos-duration="1000">
                    <figure class="image-anime reveal">
                        <img src="{{asset('home/assets/img/all-images/case-img8.png')}}" alt="">
                    </figure>
                </div>
            </div>
            <div class="space50"></div>
        </div>

    </div>
</div>

<div class="slider-section-area slider-inner sp5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-2">
          <div class="sldier-head">
            <p>Partenaires <br class="d-lg-block d-none"> <a href="/#signUp">Devenir partenaire ?</a></p>
          </div>
        </div>
        <div class="col-lg-10">
          <div class="slider-images-area owl-carousel">
            <div class="img1">
              <img src="{{asset('home/assets/img/elements/brand-img1.png')}}" alt="Partenaire 1">
            </div>
            <div class="img1">
              <img src="{{asset('home/assets/img/elements/brand-img2.png')}}" alt="Partenaire 2">
            </div>
            <div class="img1">
              <img src="{{asset('home/assets/img/elements/brand-img3.png')}}" alt="Partenaire 3">
            </div>
            <div class="img1">
              <img src="{{asset('home/assets/img/elements/brand-img4.png')}}" alt="Partenaire 4">
            </div>
            <div class="img1">
              <img src="{{asset('home/assets/img/elements/brand-img5.png')}}" alt="Partenaire 5">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="service4-section-area sp1 work2-section-area" id="howTo">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="service4-header heading8 text-center">
                    <h5 data-aos="fade-up" data-aos-duration="1000">
                        <img src="{{asset('home/assets/img/icons/logo-icons3.svg')}}" alt="">
                        Comment ça marche ?
                    </h5>

                    <h2 class="text-anime-style-1">
                        Diffusez vos annonces sur les <span>médias en ligne
                        <img src="{{asset('home/assets/img/elements/line-img2.png')}}" alt=""></span>
                    </h2>
                </div>
            </div>
        </div>
            <div class="row align-items-center">
      <div class="col-lg-6">
        <div class="work-images reveal">
          <img src="{{asset('home/assets/img/all-images/work-img1.png')}}" alt="Comment ça marche">
        </div>
      </div>
      <div class="col-lg-1"></div>
      <div class="col-lg-5">
        <div class="all-boxes-area">
          <div class="work-process-area" data-aos="fade-left" data-aos-duration="1200">
            <div class="icons">
              <img src="{{asset('home/assets/img/icons/works-icon1.png')}}" alt="Développement stratégique">
            </div>
            <div class="content-area">
              <a href="/#howTo">1. Créez votre compte</a>
              <p>Inscrivez-vous gratuitement et créez votre première campagne d'annonces en quelques minutes.</p>
            </div>
          </div>
          <div class="space30"></div>
          <div class="work-process-area work2" data-aos="fade-left" data-aos-duration="1400">
            <div class="icons">
              <img src="{{asset('home/assets/img/icons/works-icon2.png')}}" alt="Sélection des médias">
            </div>
            <div class="content-area">
              <a href="/#howTo">2. Choisissez vos médias</a>
              <p>Sélectionnez parmi nos médias partenaires ceux qui correspondent le mieux à votre audience cible.</p>
            </div>
          </div>
          <div class="space30"></div>
          <div class="work-process-area">
            <div class="icons">
              <img src="{{asset('home/assets/img/icons/works-icon3.png')}}" alt="Diffusion et suivi">
            </div>
            <div class="content-area">
              <a href="/#howTo">3. Diffusez et analysez</a>
              <p>Validez votre campagne et suivez ses performances en temps réel depuis votre tableau de bord.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
</div>

<div class="service1-section-area sp9">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 m-auto">
        <div class="service-header-area heading2 text-center">
          <img src="{{asset('home/assets/img/elements/star2.png')}}" alt="" class="star2 keyframe5">
          <img src="{{asset('home/assets/img/elements/star2.png')}}" alt="" class="star3 keyframe5">
          <h2 class="text-anime-style-3">Nos solutions pour <br class="d-md-block d-none"> développer votre visibilité</h2>
          <p data-aos="fade-up" data-aos-duration="1000">Notre équipe d'experts vous accompagne avec des solutions sur mesure pour <br class="d-md-block d-none"> maximiser l'impact de vos annonces sur les grands médias.</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="service-all-boxes-area">
          <div class="service-boxarea" data-aos="zoom-in" data-aos-duration="800">
            <a href="/#howTo">Diffusion sur les grands médias</a>
            <div class="space40"></div>
            <img src="{{asset('home/assets/img/icons/service-icon1.svg')}}" alt="">
            <div class="space40"></div>
            <p>Publiez vos annonces sur les plus grands sites médias et bénéficiez d'une visibilité exceptionnelle.</p>
          </div>

          <div class="service-boxarea box2" data-aos="zoom-in" data-aos-duration="1000">
            <a href="/#howTo">Ciblage avancé</a>
            <div class="space40"></div>
            <img src="{{asset('home/assets/img/icons/service-icon2.svg')}}" alt="">
            <div class="space40"></div>
            <p>Atteignez précisément votre audience grâce à nos options de ciblage géographique et thématique.</p>
          </div>

          <div class="service-boxarea box3" data-aos="zoom-in" data-aos-duration="1200">
            <a href="/#howTo">Gestion de campagnes</a>
            <div class="space66"></div>
            <img src="{{asset('home/assets/img/icons/service-icon3.svg')}}" alt="">
            <div class="space40"></div>
            <p>Nos experts optimisent vos campagnes en continu pour maximiser votre retour sur investissement.</p>
          </div>

          <div class="service-boxarea box4" data-aos="zoom-in" data-aos-duration="1400">
            <a href="/#howTo">Rapports détaillés</a>
            <div class="space40"></div>
            <img src="{{asset('home/assets/img/icons/service-icon4.svg')}}" alt="">
            <div class="space40"></div>
            <p>Suivez vos performances avec des tableaux de bord clairs et des analyses détaillées en temps réel.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="contact5-section-area sp1" id="signUp">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 m-auto">
          <div class="contact-header-area text-center heading10">
            <h5><img src="{{asset('home/assets/img/icons/logo-icons6.svg')}}" alt="">Contact</h5>
            <h2 class="text-anime-style-3">Contactez notre équipe</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-5" data-aos="zoom-in" data-aos-duration="1200">
          <div class="contact-info-area">
            <h3>Nos coordonnées</h3>
            <p>Notre équipe est à votre écoute pour répondre à vos questions et vous accompagner dans vos projets de diffusion d'annonces.</p>
            <div class="space32"></div>
            <div class="contact-auhtor-box">
              <div class="icons">
                <img src="{{asset('home/assets/img/icons/location2.svg')}}" alt="">
              </div>
              <div class="content">
                <h4>Notre adresse</h4>
                <a href="#">Lorem ipsum dolor sit amet consectetur adipisicing e, <br class="d-lg-block d-none"> Abidan, Côte D'Ivoire</a>
              </div>
            </div>
            <div class="space40"></div>
            <div class="contact-auhtor-box">
              <div class="icons">
                <img src="{{asset('home/assets/img/icons/phone2.svg')}}" alt="">
              </div>
              <div class="content">
                <h4>Téléphone</h4>
                <a href="tel:+225123456789">+225 1 23 45 67 89</a>
              </div>
            </div>
            <div class="space40"></div>
            <div class="contact-auhtor-box">
              <div class="icons">
                <img src="{{asset('home/assets/img/icons/email2.svg')}}" alt="">
              </div>
              <div class="content">
                <h4>Email</h4>
                <a href="mailto:contact@africpub.net">contact@africpub.net</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-7" data-aos="zoom-in" data-aos-duration="1200">
    <div class="contact-boxarea">
        <h3>Créez votre compte</h3>
        <p>Inscrivez-vous gratuitement et commencez à diffuser vos annonces <br class="d-lg-block d-none"> sur les grands médias en quelques clics.</p>

        @if ($errors->any())
            <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Bootstrap Tabs -->
        <ul class="nav nav-tabs mb-4" id="registerTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="media-tab" data-bs-toggle="tab" data-bs-target="#media" type="button" role="tab" aria-controls="media" aria-selected="true">
                    Je suis un Média
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="annonceur-tab" data-bs-toggle="tab" data-bs-target="#annonceur" type="button" role="tab" aria-controls="annonceur" aria-selected="false">
                    Je suis un Annonceur
                </button>
            </li>
        </ul>

        <div class="tab-content" id="registerTabContent">
            <!-- Formulaire Média -->
            <div class="tab-pane fade show active" id="media" role="tabpanel" aria-labelledby="media-tab">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role_type" value="media">
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="input-area">
                                <label class="form-label">Nom du média *</label>
                                <input type="text" name="name" placeholder="Nom du média" required value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="input-area">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" placeholder="Adresse email" required value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="input-area">
                                <label class="form-label">URL du site *</label>
                                <input type="url" name="url_site" placeholder="https://votresite.com" required value="{{ old('url_site') }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="input-area">
                                <label class="form-label">Numéro RCCM *</label>
                                <input type="text" name="numero_rccm" placeholder="Numéro RCCM" required value="{{ old('numero_rccm') }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="input-area">
                                <label class="form-label">Téléphone *</label>
                                <input type="tel" name="telephone" placeholder="Téléphone" required value="{{ old('telephone') }}">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="input-area">
                                <label class="form-label">Adresse *</label>
                                <input type="text" name="adresse" placeholder="Adresse complète" required value="{{ old('adresse') }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="input-area">
                                <label class="form-label">Mot de passe *</label>
                                <input type="password" name="password" placeholder="Mot de passe" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="input-area">
                                <label class="form-label">Confirmer le mot de passe *</label>
                                <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="input-area">
                                <button type="submit" class="header-btn11 w-100">S'inscrire en tant que Média <span><i class="fa-solid fa-arrow-right"></i></span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Formulaire Annonceur -->
            <div class="tab-pane fade" id="annonceur" role="tabpanel" aria-labelledby="annonceur-tab">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role_type" value="annonceur">
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="input-area">
                                <label class="form-label">Nom de l'annonceur *</label>
                                <input type="text" name="name" placeholder="Nom de l'annonceur" required value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="input-area">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" placeholder="Adresse email" required value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="input-area">
                                <label class="form-label">Téléphone</label>
                                <input type="tel" name="telephone_annonceur" placeholder="Téléphone" value="{{ old('telephone_annonceur') }}">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="input-area">
                                <label class="form-label">Adresse</label>
                                <input type="text" name="adresse_annonceur" placeholder="Adresse" value="{{ old('adresse_annonceur') }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="input-area">
                                <label class="form-label">Mot de passe *</label>
                                <input type="password" name="password" placeholder="Mot de passe" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="input-area">
                                <label class="form-label">Confirmer le mot de passe *</label>
                                <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="input-area">
                                <button type="submit" class="header-btn11 w-100">S'inscrire en tant qu'Annonceur <span><i class="fa-solid fa-arrow-right"></i></span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" style="color: var(--primary-color);">
                Déjà un compte ? Connectez-vous
            </a>
        </div>
    </div>
</div>

      </div>
    </div>
</div>

<div class="cta5-section-area sp1" style="background-image: url({{asset('home/assets/img/bg/header-bg5.png')}}); background-repeat: no-repeat; background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="cta-header-area text-center heading10">
                    <h2 class="text-anime-style-3">Prêt à diffuser vos annonces sur les grands médias ?</h2>
                    <p data-aos="fade-up" data-aos-duration="1000">Rejoignez des milliers d'annonceurs qui nous font confiance pour <br class="d-lg-block d-none"> développer leur visibilité et atteindre leurs objectifs.</p>
                    <div class="btn-area1" data-aos="fade-up" data-aos-duration="1200">
                        <a href="#signUp" class="header-btn9">Commencez maintenant <i class="fa-solid fa-arrow-right"></i></a>
                        <a href="#about" class="header-btn10">En savoir plus <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection