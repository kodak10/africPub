<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>AFRICPUB - Votre Plateforme de Publication Africaine</title>
    <link href="{{ asset('assets/css/css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/css2') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors.bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.bundle.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">

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
                            <p class="font-weight-semi m-0"> <a class="link-alt" href="#">Annonceur 1</a></p>
                            <p class="text-small text-muted m-0">15 min ago</p>
                        </div>
                        <p class="text-muted text-small mb-sm">On <a href="">Ajout d'une nouvelle publicité</a></p>
                    </div>
                </div>
                
            </div>
            <div class="px-xl py-md"><a class="btn btn-opacity btn-primary w-full">Voir toutes les notifications</a></div>
        </div>
        <!--end::sidebar-panel-notification content-->
    </div>
    <!--end::sidebar-panel-notification-->
   

    <div class="ul-sidebar-panel-overlay"></div>

    <script src="{{ asset('assets/js/vendors.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables/scrollDatatable.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/echarts/dist/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/js/data/series.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/plug-ins/2.3.5/i18n/fr-FR.json"></script> --}}

    <script>
    // Définition de la traduction française pour DataTable
    const frenchTranslation = {
        "sProcessing": "Traitement en cours...",
        "sSearch": "Rechercher :",
        "sLengthMenu": "Afficher _MENU_ éléments",
        "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
        "sInfoEmpty": "Affichage de 0 à 0 sur 0 éléments",
        "sInfoFiltered": "(filtré de _MAX_ éléments au total)",
        "sInfoPostFix": "",
        "sLoadingRecords": "Chargement en cours...",
        "sZeroRecords": "Aucun élément à afficher",
        "sEmptyTable": "Aucune donnée disponible dans le tableau",
        "oPaginate": {
            "sFirst": "Premier",
            "sPrevious": "Précédent",
            "sNext": "Suivant",
            "sLast": "Dernier"
        },
        "oAria": {
            "sSortAscending": ": activer pour trier la colonne par ordre croissant",
            "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
        },
        "sDecimal": ",",
        "sThousands": " "
    };

    $(document).ready(function() {
        // Vérification de la présence de messages de session
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @elseif (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        // Configuration de Toastr
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000"
        };

        // Vérification et destruction de l'instance DataTable existante
        if ($.fn.dataTable.isDataTable('#datatableScrollXY')) {
            $('#datatableScrollXY').DataTable().destroy();
        }

        // Initialisation de DataTable avec la traduction française intégrée
        var table = $('#datatableScrollXY').DataTable({
            scrollY: "400px",
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            searching: true,
            ordering: true,
            responsive: false,
            autoWidth: false,
            language: frenchTranslation, // Utilisation de la traduction intégrée
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                 '<"row"<"col-sm-12"tr>>' +
                 '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
        });
        
        // Forcer les styles CSS pour le conteneur du tableau
        $('#datatableScrollXY').css('width', '100%');
        setTimeout(function() {
            $('.dataTables_scrollBody').css({
                'overflow-x': 'auto',
                'overflow-y': 'auto'
            });
        }, 100);
    });
</script>

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

    @yield('scripts')

</body>

</html>