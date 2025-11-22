<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Afric-Pub</title>
    <link href="{{ asset('assets/css/css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/css2') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors.bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.bundle.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body>
    <div class="app-admin-wrap-layout-1 sidebar-full sidebar-theme-slate subheader-fixed">
        @include('dashboard.layouts.sidebar')
        <div class="main-content-wrap">

            @include('dashboard.layouts.sidebar-mobile')

            @include('dashboard.layouts.header')

            <div class="main-content-body">
                @yield('content')
                
                <div class="flex-grow-1"></div>
                @include('dashboard.layouts.footer')
            </div>

        </div>
        <div class="narrow-sidebar"><span class="m-auto"> </span>
            <button class="btn btn-raised btn-raised-primary rounded-circle btn-sm btn-icon me-0 my-12 sidebar-customizer-settings open" data-toggle="tooltip" data-placement="left" title="Theme Settings"><i class="material-icons">settings</i></button>
            <div class="ul-customizer bg-white">
                <div class="ul-customizer-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center"><span class="material-icons me-1 text-primary">
                            settings
                        </span>
                        <h6 class="m-0">Theme Settings</h6>
                    </div>
                    <button class="btn rounded-circle btn-sm btn-icon m-0 customizer-close"><i class="material-icons">close</i></button>
                </div>
                <div class="ul-customizer-body p-md">
                    <div class="mt-0 mb-lg">
                        <p class="text-gray-700 font-weight-normal">Sidebar Theme</p>
                        <div class="colors" id="colors">
                            <div class="color" id="color1" data-sidebar-color="sidebar-theme-white">
                                <div class="sub-color light"></div>
                            </div>
                            <div class="color bg-slate" id="color2" data-sidebar-color="sidebar-theme-slate">
                                <div class="sub-color dark"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><span class="m-auto"></span>
            <button class="btn btn-raised btn-raised-primary rounded-circle btn-sm btn-icon me-0 narrow-sidebar-toggle-button open"><i class="material-icons">
                    keyboard_arrow_right
                </i></button>
            <div class="toggle"></div>
        </div>
    </div>
    <!--begin::sidebar-panel-notification-->
    <div class="ul-sidebar-panel" id="asideNotification" data-position="right">
        <!--begin::sidebar-panel-notification content-->
        <div class="pt-lg pb-md">
            <div class="ul-sidebar-panel-top pb-lg px-lg">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="heading-label p-0">Notifications</div><i class="material-icons icon icon-sm hover-gray ul-sidebar-panel-close">close</i>
                </div>
            </div>
            <div data-perfect-scrollbar="" data-suppress-scroll-x="true" style="height: calc(100vh - 170px)">
                <div class="notification-item d-flex border-bottom mb-lg pb-lg px-lg"><span class="badge badge-opacity rounded-circle badge-primary me-md"><i class="material-icons">cloud_upload</i></span>
                    <div class="d-flex flex-column justify-content-center w-full">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="font-weight-semi m-0"> <a class="link-alt" href="#">Watson uploaded a file</a></p>
                            <p class="text-small text-muted m-0">15 min ago</p>
                        </div>
                        <p class="text-muted text-small mb-sm">On <a href="">Project alpha</a></p>
                        <div class="px-md py-sm gray-100 rounded"><img class="icon-sm" src="../assets/images/file-types/001-pdf.svg"><span class="text-small font-weight-semi"> <a class="text-body" href="#">progress_report.pdf</a></span></div>
                    </div>
                </div>
                <div class="notification-item d-flex border-bottom mb-lg pb-lg px-lg"><span class="badge badge-opacity rounded-circle badge-primary me-md"><i class="material-icons">description</i></span>
                    <div class="d-flex flex-column justify-content-center w-full">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="font-weight-semi m-0"> <a class="link-alt" href="#">John commented on a task</a></p>
                            <p class="text-small text-muted m-0">5 min ago</p>
                        </div>
                        <p class="text-muted text-small mb-sm">On <a href="">Project alpha</a></p>
                        <div class="px-md py-sm gray-100 rounded"><span class="text-small">
                                What's the progress of this project? <br>Can you send me the files?</span></div>
                    </div>
                </div>
                <div class="notification-item d-flex border-bottom mb-lg pb-lg px-lg"><span class="badge badge-opacity rounded-circle badge-warning me-md"><i class="material-icons">announcement</i></span>
                    <div class="d-flex flex-column justify-content-center w-full">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="font-weight-semi m-0"> <a class="link-alt" href="#">John opened a new Topic</a></p>
                            <p class="text-small text-muted m-0">45 min ago</p>
                        </div>
                        <p class="text-muted text-small mb-sm">On <a href="">Project alpha</a></p>
                    </div>
                </div>
                <div class="notification-item d-flex border-bottom mb-lg pb-lg px-lg"><span class="badge badge-opacity rounded-circle badge-primary me-md"><i class="material-icons">cloud_upload</i></span>
                    <div class="d-flex flex-column justify-content-center w-full">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="font-weight-semi m-0"> <a class="link-alt" href="#">John uploaded a file</a></p>
                            <p class="text-small text-muted m-0">15 min ago</p>
                        </div>
                        <p class="text-muted text-small mb-sm">On <a href="">Project alpha</a></p>
                        <div class="px-md py-sm gray-100 rounded"><img class="icon-sm" src="../assets/images/file-types/004-xlsx.svg"><span class="text-small font-weight-semi"> <a class="text-body" href="#">budget_report.xlsx</a></span></div>
                    </div>
                </div>
                <div class="notification-item d-flex border-bottom mb-lg pb-lg px-lg"><span class="badge badge-opacity rounded-circle badge-warning me-md"><i class="material-icons">announcement</i></span>
                    <div class="d-flex flex-column justify-content-center w-full">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="font-weight-semi m-0"> <a class="link-alt" href="#">John opened a new Topic</a></p>
                            <p class="text-small text-muted m-0">45 min ago</p>
                        </div>
                        <p class="text-muted text-small mb-sm">On <a href="">Project alpha</a></p>
                    </div>
                </div>
            </div>
            <div class="px-xl py-md"><a class="btn btn-opacity btn-primary w-full">View All Notificaitons</a></div>
        </div>
        <!--end::sidebar-panel-notification content-->
    </div>
    <!--end::sidebar-panel-notification-->
    <!--Sidebar panel Profile-->
    <div class="ul-sidebar-panel" id="asideProfile" data-position="right">
        <div class="pt-lg pb-md px-lg">
            <div class="ul-sidebar-panel-top mb-md">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="heading-label p-0">Profile</div>
                    <div class="flex-grow-1"></div><i class="material-icons icon icon-sm hover-gray ul-sidebar-panel-close">close</i>
                </div>
            </div>
            <div data-perfect-scrollbar="" data-suppress-scroll-x="true" style="height: calc(100vh - 112px)">
                <div class="ul-sidebar-aside-profile d-flex mb-xxl align-items-center"><img class="rounded-circle avatar-lg" src="../assets/images/faces/1.jpg" alt="">
                    <div class="ul-sidebar-aside-info ms-md"><a class="link-alt" href="#">
                            <div class="font-weight-semi">Tim Clarkson</div>
                        </a>
                        <p class="text-small text-muted mb-sm">Front End Developer</p>
                        <div class="d-flex ms--xs"><a class="link-alt" href="#"><i class="fab fa-google text-muted icon icon-xs hover-gray"></i></a><a class="link-alt" href="#"><i class="fab fa-twitter text-muted icon icon-xs hover-gray"></i></a><a class="link-alt" href="#"><i class="fab fa-facebook-f text-muted icon icon-xs hover-gray"></i></a></div>
                    </div>
                </div>
                <div class="heading-label">Skills </div>
                <div class="d-flex justify-content-between"><span class="badge rounded-circle badge-primary me-sm">A</span>
                    <div class="flex-grow-1">
                        <p class="font-weight-semi m-0">Angular</p>
                        <p class="text-muted text-small">Frontend framework</p>
                    </div>
                    <div class="flex-grow-1">
                        <div class="progress-wrapper mb-xl">
                            <div class="progress-info"><span></span>
                                <div class="progress-percentage"><span>80%</span></div>
                            </div>
                            <div class="progress mb-md">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between"><span class="badge rounded-circle badge-primary me-sm">V</span>
                    <div class="flex-grow-1">
                        <p class="font-weight-semi m-0">Vue Js</p>
                        <p class="text-muted text-small">Frontend framework</p>
                    </div>
                    <div class="flex-grow-1">
                        <div class="progress-wrapper mb-xl">
                            <div class="progress-info"><span></span>
                                <div class="progress-percentage"><span>30%</span></div>
                            </div>
                            <div class="progress mb-md">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between"><span class="badge rounded-circle badge-primary me-sm">R</span>
                    <div class="flex-grow-1">
                        <p class="font-weight-semi m-0">React </p>
                        <p class="text-muted text-small">Frontend framework</p>
                    </div>
                    <div class="flex-grow-1">
                        <div class="progress-wrapper mb-xl">
                            <div class="progress-info"><span></span>
                                <div class="progress-percentage"><span>50%</span></div>
                            </div>
                            <div class="progress mb-md">
                                <div class="progress-bar bg-warning" role="success" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between"><span class="badge rounded-circle badge-primary me-sm">W</span>
                    <div class="flex-grow-1">
                        <p class="font-weight-semi m-0">Wordpress Website</p>
                        <p class="text-muted text-small">CMS</p>
                    </div>
                    <div class="flex-grow-1">
                        <div class="progress-wrapper mb-xl">
                            <div class="progress-info"><span></span>
                                <div class="progress-percentage"><span>30%</span></div>
                            </div>
                            <div class="progress mb-md">
                                <div class="progress-bar bg-success" role="warning" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-lg"></div>
                <div class="heading-label">Activity</div>
                <div class="d-flex mb-md align-items-center"><span class="badge rounded-circle badge-primary me-sm">JH</span>
                    <div class="d-flex flex-column justify-content-center">
                        <p class="text-small font-weight-semi m-0"> <a class="link-alt" href="#">Urgent task completed</a></p><span class="text-small text-muted">By Jhon at 3:30 PM</span>
                    </div>
                </div>
                <div class="d-flex mb-md align-items-center"><span class="badge rounded-circle badge-success me-sm">W</span>
                    <div class="d-flex flex-column justify-content-center">
                        <p class="text-small font-weight-semi m-0"> <a class="link-alt" href="#">Task from project Alpha</a></p><span class="text-small text-muted">By Watson at 1:30 PM</span>
                    </div>
                </div>
                <div class="d-flex mb-md align-items-center"><span class="badge rounded-circle badge-success me-sm">R</span>
                    <div class="d-flex flex-column justify-content-center">
                        <p class="text-small font-weight-semi m-0"> <a class="link-alt" href="#">Task from project Beta</a></p><span class="text-small text-muted">By Rafi at 9:30 AM</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ul-sidebar-panel-overlay"></div>

    <script src="{{ asset('assets/js/vendors.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables/scrollDatatable.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/echarts/dist/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/data/series.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard/jobManagement.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https:////cdn.datatables.net/plug-ins/2.3.5/i18n/fr-FR.json"></script>

    <script>
        $(document).ready(function() {
            // Vérification de la présence de messages de session
            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @elseif (session('error'))
                toastr.error("{{ session('error') }}");
            @endif

            // Configuration de Toastr
            toastr.options = {
                "closeButton": true,        // Bouton de fermeture
                "progressBar": true,        // Barre de progression
                "positionClass": "toast-top-right", // Position du toast
                "timeOut": "5000"           // Durée d'affichage (en ms)
            };


            // Vérification si DataTable a déjà été initialisé
            if ($.fn.dataTable.isDataTable('#datatableScrollXY')) {
                $('#datatableScrollXY').DataTable().destroy();  // Détruire l'instance existante
            }

            // Initialisation de DataTable
            var table = $('#datatableScrollXY').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/2.3.5/i18n/fr-FR.json', // Chargement de la traduction
                },
            });

            
        });
    </script>

</body>

</html>