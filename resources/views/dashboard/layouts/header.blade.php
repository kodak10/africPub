<header class="main-header bg-card d-flex flex-row justify-content-between align-items-center px-lg">
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

        <!-- Dropdown utilisateur -->
        <div class="dropdown ms-3">
            <button class="btn btn-link dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-icons me-1">account_circle</i>
                <span>{{ Auth::user()->name }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li>
                    <a class="dropdown-item" href="">
                        <i class="material-icons me-2">person</i>
                        Mon profil
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="material-icons me-2">logout</i>
                        Se déconnecter
                    </a>
                </li>
            </ul>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    </div>
</header>