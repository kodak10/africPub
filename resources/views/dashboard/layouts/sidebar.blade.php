<div class="sidebar-panel">
    <div class="sidebar-compact-switch"><span></span><div></div><span></span></div>

    <div class="brand">
        <img src="../assets/images/arctic-admin-circle.svg" alt="">
        <span class="app-logo-text ms-2 text-20">Afric-Pub</span>
    </div>

    <div class="scroll-nav" data-perfect-scrollbar data-suppress-scroll-x="true">

        <!-- User section -->
        <div class="app-user text-center">
            <div class="app-user-photo">
                <img src="../assets/images/faces/1.jpg" alt="">
            </div>
            <div class="app-user-info">
                <span class="app-user-name">Watson Joyce</span>

                <div class="app-user-control">
                    <a class="control-item" href="#">
                        <i class="material-icons">settings</i>
                    </a>
                    <a class="control-item" href="#">
                        <i class="material-icons">email</i>
                    </a>
                    <a class="control-item" href="#">
                        <i class="material-icons">logout</i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar Navigation -->
        <div class="side-nav">
            <div class="main-menu">
                <nav class="sidebar-nav">
                    <ul class="metismenu show-on-load" id="ul-menu">

                        <!-- Dashboards -->
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="material-icons nav-icon">dashboard</i>
                                Dashboard | Administrateurs
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('annonceur.dashboard') }}">
                                <i class="material-icons nav-icon">dashboard_customize</i>
                                Dashboard | Annonceurs
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('media.dashboard') }}">
                                <i class="material-icons nav-icon">monitor</i>
                                Dashboard | Médias
                            </a>
                        </li>

                        <!-- ADMIN -->
                        <span class="main-menu-title">Administrateurs</span>

                        <li>
                            <a class="has-arrow" href="#">
                                <i class="material-icons nav-icon">group</i>Utilisateurs
                            </a>
                            <ul class="mm-collapse">
                                <li><a href="{{ route('admin.medias.index') }}"><i class="bullet-icon"></i>Medias</a></li>
                                <li><a href="{{ route('admin.annonceurs.index') }}"><i class="bullet-icon"></i>Annonceurs</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{ route('admin.publicites.index') }}">
                                <i class="material-icons nav-icon">campaign</i>
                                Gestion des Publictés
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.publicites.assign-media') }}">
                                <i class="material-icons nav-icon">playlist_add_check</i>
                                Attributions des Publicités
                            </a>
                        </li>

                        <li>
                            <a class="has-arrow" href="#">
                                <i class="material-icons nav-icon">payments</i>Paiements
                            </a>

                            <ul class="mm-collapse">

                                <!-- Sous-menu Paiement -->
                               <li>
                                    <a class="has-arrow" href="#">
                                        <i class="material-icons">account_balance_wallet</i>Paiement
                                    </a>
                                    <ul class="mm-collapse">
                                        <li>
                                            <a href="{{ route('admin.paiements.index') }}">
                                                <i class="bullet-icon"></i>Demandes de Paiement
                                            </a>
                                        </li>
                                            <a href="{{ route('admin.paiements.historique') }}">
                                                <i class="bullet-icon"></i>Historique des Paiements
                                            </a>
                                    </ul>
                                </li>

                                <!-- Sous-menu Remboursement -->
                                <li>
                                        <a class="has-arrow" href="#">
                                            <i class="material-icons">restore_page</i>Remboursement
                                        </a>
                                        <ul class="mm-collapse">

                                        <!-- Réclamation de remboursement -->
                                        <li>
                                            <a href="{{ route('admin.paiements.remboursements.index') }}">
                                                <i class="bullet-icon"></i>Réclamation de Remboursement
                                            </a>
                                        </li>                                        
                                    </ul>
                                </li>


                            </ul>
                        </li>


                        <li>
                            <a href="{{ route('admin.rapport_financier') }}">
                                <i class="material-icons nav-icon">assessment</i>
                                Rapport financier
                            </a>
                        </li>

                        <!-- ANNONCEURS -->
                        <span class="main-menu-title">Annonceurs</span>

                        <li><a href="{{ route('annonceur.create_publicites') }}"><i class="material-icons nav-icon">add_box</i>Créer une Publicité</a></li>
                        <li><a href="{{ route('annonceur.index_publicites') }}"><i class="material-icons nav-icon">view_list</i>Mes Publicités</a></li>
                        <li><a href="{{ route('annonceur.rapports') }}"><i class="material-icons nav-icon">analytics</i>Rapports</a></li>

                        <li>
                            <a class="has-arrow" href="#">
                                <i class="material-icons nav-icon">account_balance_wallet</i>Paiements
                            </a>
                            <ul class="mm-collapse">
                                <li><a href="{{ route('annonceur.paiements.historique') }}"><i class="bullet-icon"></i>Historique</a></li>
                                <li><a href="{{ route('annonceur.paiements.remboursement') }}"><i class="bullet-icon"></i>Réclamer un remboursement</a></li>
                            </ul>
                        </li>

                        <!-- MEDIAS -->
                        <span class="main-menu-title">Médias</span>

                        <li><a href="{{ route('media.rapports') }}"><i class="material-icons nav-icon">trending_up</i>Rapports</a></li>

                        <li>
                            <a class="has-arrow" href="#">
                                <i class="material-icons nav-icon">wallet</i>Paiements
                            </a>
                            <ul class="mm-collapse">
                                <li><a href="{{ route('media.paiements.historique') }}"><i class="bullet-icon"></i>Historique</a></li>
                                <li><a href="{{ route('media.paiements.reclamation') }}"><i class="bullet-icon"></i>Réclamer un Paiement</a></li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
