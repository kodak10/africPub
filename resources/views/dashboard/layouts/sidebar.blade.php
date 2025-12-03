<div class="sidebar-panel">
    <div class="sidebar-compact-switch"><span></span><div></div><span></span></div>

    <div class="brand">
        <img src="{{asset('assets/images/logo.jpg')}}" style="height: 60px; width:100%" alt="">
        <span class="app-logo-text text-20" style="margin-left: 50px;"></span>

    </div>

    <div class="scroll-nav" data-perfect-scrollbar data-suppress-scroll-x="true">

        <!-- User section -->
        <div class="app-user text-center">
            <div class="app-user-photo">
                <img src="{{ Auth::user()->profile_photo_url ?? asset('assets/images/faces/default.jpg') }}" alt="{{ Auth::user()->name }}">
            </div>
            <div class="app-user-info">
                <span class="app-user-name">{{ Auth::user()->name }}</span>

                <div class="app-user-control d-flex justify-content-between w-100">
                    {{-- Paramètres --}}
                    <a class="control-item" href="">
                        <i class="material-icons">settings</i>
                    </a>

                    {{-- Déconnexion --}}
                    <a class="control-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="material-icons">logout</i>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>


       

        <!-- Sidebar Navigation -->
        <div class="side-nav">
            <div class="main-menu">
                <nav class="sidebar-nav">
                    <ul class="metismenu show-on-load" id="ul-menu">

                        {{-- DASHBOARD PAR RÔLE --}}
                        @role('Admin')
                        <li class="{{ request()->routeIs('admin.dashboard') ? 'mm-active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="material-icons nav-icon">dashboard</i>
                                Dashboard | Administrateurs
                            </a>
                        </li>
                        @endrole

                        @role('Annonceur')
                        <li class="{{ request()->routeIs('annonceur.dashboard') ? 'mm-active' : '' }}">
                            <a href="{{ route('annonceur.dashboard') }}">
                                <i class="material-icons nav-icon">dashboard_customize</i>
                                Dashboard | Annonceurs
                            </a>
                        </li>
                        @endrole

                        @role('Media')
                        <li class="{{ request()->routeIs('media.dashboard') ? 'mm-active' : '' }}">
                            <a href="{{ route('media.dashboard') }}">
                                <i class="material-icons nav-icon">monitor</i>
                                Dashboard | Médias
                            </a>
                        </li>
                        @endrole

                        {{-- MENU ADMIN --}}
                        @role('Admin')
                        <span class="main-menu-title">Administrateurs</span>

                        <li class="{{ request()->routeIs('admin.medias.index') || request()->routeIs('admin.annonceurs.index') ? 'mm-active' : '' }}">
                            <a class="has-arrow" href="#">
                                <i class="material-icons nav-icon">group</i>Utilisateurs
                            </a>
                            <ul class="mm-collapse">
                                <li class="{{ request()->routeIs('admin.medias.index') ? 'mm-active' : '' }}">
                                    <a href="{{ route('admin.medias.index') }}">
                                        <i class="bullet-icon"></i>Medias
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.annonceurs.index') ? 'mm-active' : '' }}">
                                    <a href="{{ route('admin.annonceurs.index') }}">
                                        <i class="bullet-icon"></i>Annonceurs
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="{{ request()->routeIs('admin.publicites.index') ? 'mm-active' : '' }}">
                            <a href="{{ route('admin.publicites.index') }}">
                                <i class="material-icons nav-icon">campaign</i>
                                Gestion des Publicités
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('admin.publicites.assign-media') ? 'mm-active' : '' }}">
                            <a href="{{ route('admin.publicites.assign-media') }}">
                                <i class="material-icons nav-icon">playlist_add_check</i>
                                Attributions des Publicités
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('admin.paiements.index') || request()->routeIs('admin.paiements.historique') ? 'mm-active' : '' }}">
                            <a class="has-arrow" href="#">
                                <i class="material-icons nav-icon">payments</i>Paiements aux Medias
                            </a>
                            <ul class="mm-collapse">
                                <li class="{{ request()->routeIs('admin.paiements.index') ? 'mm-active' : '' }}">
                                    <a href="{{ route('admin.paiements.index') }}">
                                        <i class="bullet-icon"></i>Demandes de Paiement
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.paiements.historique') ? 'mm-active' : '' }}">
                                    <a href="{{ route('admin.paiements.historique') }}">
                                        <i class="bullet-icon"></i>Historique des Paiements
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="{{ request()->routeIs('admin.paiements.remboursements.index') ? 'mm-active' : '' }}">
                            <a href="{{ route('admin.paiements.remboursements.index') }}">
                                <i class="material-icons nav-icon">restore_page</i>Remboursement
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('admin.rapports') ? 'mm-active' : '' }}">
                            <a href="{{ route('admin.rapports') }}">
                                <i class="material-icons nav-icon">assessment</i>
                                Rapport financier
                            </a>
                        </li>
                        @endrole

                        {{-- MENU ANNONCEUR --}}
                        @role('Annonceur')
                        <span class="main-menu-title">Annonceurs</span>

                        <li class="{{ request()->routeIs('annonceur.create_publicites') ? 'mm-active' : '' }}">
                            <a href="{{ route('annonceur.create_publicites') }}">
                                <i class="material-icons nav-icon">add_box</i>Créer une Publicité
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('annonceur.index_publicites') ? 'mm-active' : '' }}">
                            <a href="{{ route('annonceur.index_publicites') }}">
                                <i class="material-icons nav-icon">view_list</i>Mes Publicités
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('annonceur.rapports') ? 'mm-active' : '' }}">
                            <a href="{{ route('annonceur.rapports') }}">
                                <i class="material-icons nav-icon">analytics</i>Rapports
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('annonceur.paiements.historique') || request()->routeIs('annonceur.paiements.remboursement') ? 'mm-active' : '' }}">
                            <a class="has-arrow" href="#">
                                <i class="material-icons nav-icon">account_balance_wallet</i>Paiements
                            </a>
                            <ul class="mm-collapse">
                                <li class="{{ request()->routeIs('annonceur.paiements.historique') ? 'mm-active' : '' }}">
                                    <a href="{{ route('annonceur.paiements.historique') }}">
                                        <i class="bullet-icon"></i>Historique
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('annonceur.paiements.remboursement') ? 'mm-active' : '' }}">
                                    <a href="{{ route('annonceur.paiements.remboursement') }}">
                                        <i class="bullet-icon"></i>Réclamer un remboursement
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endrole

                        {{-- MENU MEDIA --}}
                        @role('Media')
                        <span class="main-menu-title">Médias</span>

                        <li class="{{ request()->routeIs('media.rapports') ? 'mm-active' : '' }}">
                            <a href="{{ route('media.rapports') }}">
                                <i class="material-icons nav-icon">trending_up</i>Rapports
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('media.paiements.historique') || request()->routeIs('media.paiements.reclamation') ? 'mm-active' : '' }}">
                            <a class="has-arrow" href="#">
                                <i class="material-icons nav-icon">wallet</i>Paiements
                            </a>
                            <ul class="mm-collapse">
                                <li class="{{ request()->routeIs('media.paiements.historique') ? 'mm-active' : '' }}">
                                    <a href="{{ route('media.paiements.historique') }}">
                                        <i class="bullet-icon"></i>Historique
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('media.paiements.reclamation') ? 'mm-active' : '' }}">
                                    <a href="{{ route('media.paiements.reclamation') }}">
                                        <i class="bullet-icon"></i>Réclamer un Paiement
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endrole

                    </ul>
                </nav>
            </div>
        </div>


    </div>
</div>
