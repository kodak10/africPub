<header class="main-header bg-card d-flex flex-row justify-content-between align-items-center px-lg">
    <!-- Start::Header menu-->
    <div>
        <div class="ul-header-menu-wrap"><i class="material-icons ul-header-menu-toggle">close</i>
            <div class="ul-header-menu">
                <ul class="ul-header-nav">
                    <li class="ul-menu-item ul-menu-item--active">
                        <a class="ul-menu-link" href="dashboard.jobManagement.html">Dashboards</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End::Header menu-->
    <div class="ul-header-topbar d-flex align-items-center">
        <div class="flex-grow-1"></div>
        
        <button class="btn btn-opacity-default rounded-circle btn-icon btn-badge" data-sidebar-panel="asideNotification">
            <span class="badge badge-danger">3</span>
            <i class="material-icons">notifications</i>
        </button>

        <!-- Profil utilisateur (statique) -->
        <div class="profile-info d-flex align-items-center ms-3">
            <span class="m-0 me-2 font-weight-normal">{{ Auth::user()->name }}</span>
            <img class="avatar-sm rounded-circle me-1" 
                src="{{ Auth::user()->avatar ?? asset('assets/images/faces/default.jpg') }}" 
                alt="Profil">
        </div>

    </div>
</header>
