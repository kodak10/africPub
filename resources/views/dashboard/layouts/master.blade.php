<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Management - Arctic Admin Dashboard</title>
    <link href="{{ asset('assets/css/css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/css2') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors.bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.bundle.min.css') }}">
</head>

<body>
    <div class="app-admin-wrap-layout-1 sidebar-full sidebar-theme-slate subheader-fixed">
        <div class="sidebar-panel">
            <div class="sidebar-compact-switch"><span></span>
                <div></div><span></span>
            </div>
            <div class="brand"><img src="../assets/images/arctic-admin-circle.svg" alt=""><span class="app-logo-text ms-2 text-20">Arctic</span></div>
            <!-- Start:: user-->
            <div class="scroll-nav" data-perfect-scrollbar="" data-suppress-scroll-x="true">
                <div class="app-user text-center">
                    <div class="app-user-photo"><img src="../assets/images/faces/1.jpg" alt=""></div>
                    <div class="app-user-info"><span class="app-user-name">Watson Joyce</span>
                        <div class="app-user-control"><a class="control-item" href="#"><i class="material-icons"> settings</i></a><a class="control-item" href="#"><i class="material-icons"> email</i></a><a class="control-item" href="#"><i class="material-icons"> exit_to_app</i></a></div>
                    </div>
                </div>
                <!-- End:: user-->
                <!-- Start:: side-nav-->
                <div class="side-nav">
                    <div class="main-menu">
                        <nav class="sidebar-nav">
                            <ul class="metismenu show-on-load" id="ul-menu">
                                <li class="mm-active"><a class="has-arrow" href="#"><i class="material-icons nav-icon">dashboard</i>Dashboards</a>
                                    <ul class="mm-collapse">
                                        <li><a href="dashboard.learningManagement.html"><i class="bullet-icon"></i>Learning Management</a></li>
                                        <li class="mm-active"><a href="dashboard.jobManagement.html"><i class="bullet-icon"></i>Job Management</a></li>
                                        <li><a href="dashboards/dashboard.analytic-2.html"><i class="bullet-icon"></i>Analytic</a></li>
                                        <li><a href="dashboard.cryptoCurrency.html"><i class="bullet-icon"></i>Cryptocurrency</a></li>
                                        <li><a href="dashboards/dashboard.sales2.html"><i class="bullet-icon"></i>Sales</a></li>
                                        <li><a href="dashboard.subscription.html"><i class="bullet-icon"></i>Subscription</a></li>
                                    </ul>
                                </li><span class="main-menu-title">CUSTOM</span>
                                <li><a class="has-arrow" href="#"><i class="material-icons nav-icon">web_asset</i>Pages</a>
                                    <ul class="mm-collapse">
                                        <li><a class="has-arrow" href="#"><i class="material-icons nav-icon">feedback</i>FAQ</a>
                                            <ul class="mm-collapse">
                                                <li><a href="../pages/faq/faq.v1.html"><i class="bullet-icon"></i>FAQ V1</a></li>
                                                <li><a href="../pages/faq/faq.v2.html"><i class="bullet-icon"></i>FAQ V2</a></li>
                                                <li><a href="../pages/faq/faq.v3.html"><i class="bullet-icon"></i>FAQ V3</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="has-arrow" href="#"><i class="material-icons nav-icon">list</i>List</a>
                                            <ul class="mm-collapse">
                                                <li><a href="../pages/list/column-list.html"><i class="bullet-icon"></i>List Column</a></li>
                                                <li><a href="../pages/list/column-list-2.html"><i class="bullet-icon"></i>List Column 2</a></li>
                                                <li><a href="../pages/list/column-list-3.html"><i class="bullet-icon"></i>List Column 3</a></li>
                                                <li><a href="../pages/list/column-list-row.html"><i class="bullet-icon"></i>List Column Row</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="has-arrow" href="#"><i class="material-icons nav-icon">monetization_on</i>Pricing</a>
                                            <ul class="mm-collapse">
                                                <li><a href="../pages/pricing/pricing.v1.html"><i class="bullet-icon"></i>Pricing v1</a></li>
                                                <li><a href="../pages/pricing/pricing.v2.html"><i class="bullet-icon"></i>Pricing v2</a></li>
                                                <li><a href="../pages/pricing/pricing.v3.html"><i class="bullet-icon"></i>Pricing v3</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="has-arrow" href="#"><i class="material-icons nav-icon">all_inbox</i>Invoice</a>
                                            <ul class="mm-collapse">
                                                <li><a href="../pages/invoice/invoice.v1.html"><i class="bullet-icon"></i>Invoice v1</a></li>
                                                <li><a href="../pages/invoice/invoice.v2.html"><i class="bullet-icon"></i>Invoice v2</a></li>
                                                <li><a href="../pages/invoice/invoice.edit.v2.html"><i class="bullet-icon"></i>Edit Invoice</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="has-arrow" href="#"><i class="material-icons nav-icon">person</i>Profile</a>
                                            <ul class="mm-collapse">
                                                <li><a href="../pages/profile/profile.v1.html"><i class="bullet-icon"></i>Profile v1</a></li>
                                                <li><a href="../pages/profile/profile.v2.html"><i class="bullet-icon"></i>Profile v2</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="../pages/dragAndDrop.html"><i class="material-icons nav-icon">open_with</i>Drag &amp; Drop</a></li>
                                        <li><a href="../pages/photo-grid.html"><i class="material-icons nav-icon">open_with</i>Photo Grid</a></li>
                                        <li><a class="has-arrow" href="#"><i class="material-icons nav-icon">settings_applications</i>Session</a>
                                            <ul class="mm-collapse">
                                                <li><a href="../pages/sessions/404.html"><i class="bullet-icon"></i>404</a></li>
                                                <li><a href="../pages/sessions/error.html"><i class="bullet-icon"></i>error</a></li>
                                                <li><a href="../pages/sessions/forgot.html"><i class="bullet-icon"></i>forgot</a></li>
                                                <li><a href="../pages/sessions/lockscreen.html"><i class="bullet-icon"></i>lockscreen</a></li>
                                                <li><a href="../pages/sessions/signin.html"><i class="bullet-icon"></i>signin</a></li>
                                                <li><a href="../pages/sessions/signin2.html"><i class="bullet-icon"></i>signin 2</a></li>
                                                <li><a href="../pages/sessions/signin3.html"><i class="bullet-icon"></i>signin 3</a></li>
                                                <li><a href="../pages/sessions/signin4.html"><i class="bullet-icon"></i>signin 4</a></li>
                                                <li><a href="../pages/sessions/signup.html"><i class="bullet-icon"></i>signup</a></li>
                                                <li><a href="../pages/sessions/signup2.html"><i class="bullet-icon"></i>signup 2</a></li>
                                                <li><a href="../pages/sessions/signup3.html"><i class="bullet-icon"></i>signup 3</a></li>
                                                <li><a href="../pages/sessions/signup4.html"><i class="bullet-icon"></i>signup 4</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="has-arrow" href="#"><i class="material-icons nav-icon">web</i>Apps</a>
                                    <ul class="mm-collapse">
                                        <li><a href="../apps/app.note.html"><i class="material-icons nav-icon">book</i>Note</a></li>
                                        <li><a href="../apps/app.filemanager.html"><i class="material-icons nav-icon">save</i>File Manager</a></li>
                                        <li><a href="../apps/inbox.html"><i class="material-icons nav-icon">all_inbox</i>Inbox</a></li>
                                        <li><a href="../apps/app.scrumBoard.html"><i class="material-icons nav-icon">all_inbox</i>Scrumboard</a></li>
                                        <li><a href="../apps/chat.html"><i class="material-icons nav-icon">chat</i>Chat</a></li>
                                    </ul>
                                </li><span class="main-menu-title">DESIGN SYSTEM</span>
                                <li><a class="has-arrow" href="#"><i class="material-icons nav-icon">settings_input_component</i>Components</a>
                                    <ul class="mm-collapse">
                                        <li><a href="../components/components.accordion.html"><i class="bullet-icon"></i>Accordion</a></li>
                                        <li><a href="../components/components.alert.html"><i class="bullet-icon"></i>Alert</a></li>
                                        <li><a href="../components/components.avatar.html"><i class="bullet-icon"></i>Avatars</a></li>
                                        <li><a href="../components/components.badge.html"><i class="bullet-icon"></i>Badge</a></li>
                                        <li><a href="../components/components.breadcrumb.html"><i class="bullet-icon"></i>Breadcrumb</a></li>
                                        <li><a href="../components/components.buttons.html"><i class="bullet-icon"></i>Buttons</a></li>
                                        <li><a href="../components/components.dropdown.html"><i class="bullet-icon"></i>Dropdown</a></li>
                                        <li><a href="../components/components.carousel.html"><i class="bullet-icon"></i>Carousel</a></li>
                                        <li><a href="../components/components.forms.html"><i class="bullet-icon"></i>Forms</a></li>
                                        <li><a href="../components/components.formsLayout.html"><i class="bullet-icon"></i>Forms Layout</a></li>
                                        <li><a href="../components/components.list.html"><i class="bullet-icon"></i>List</a></li>
                                        <li><a href="../components/components.pagination.html"><i class="bullet-icon"></i>Pagination</a></li>
                                        <li><a href="../components/components.popovers.html"><i class="bullet-icon"></i>Popovers</a></li>
                                        <li><a href="../components/components.progressbar.html"><i class="bullet-icon"></i>Progressbar</a></li>
                                        <li><a href="../components/components.toast.html"><i class="bullet-icon"></i>Toast</a></li>
                                        <li><a href="../components/components.tab.html"><i class="bullet-icon"></i>Tab</a></li>
                                        <li><a href="../components/sweetAlert2.html"><i class="bullet-icon"></i>SweetAlert 2</a></li>
                                        <li><a href="../components/components.tooltip.html"><i class="bullet-icon"></i>Tooltip</a></li>
                                        <li><a href="../components/components.tour.html"><i class="bullet-icon"></i>Tour</a></li>
                                    </ul>
                                </li>
                                <li><a class="has-arrow" href="#"><i class="material-icons nav-icon">text_format</i>Form Widgets</a>
                                    <ul class="mm-collapse">
                                        <li><a href="../form-widgets/forms.validation.html"><i class="bullet-icon"></i>Form Validation</a></li>
                                        <li><a href="../form-widgets/forms.datepicker.html"><i class="bullet-icon"></i>Datepicker</a></li>
                                        <li><a href="../form-widgets/forms.form-repeater.html"><i class="bullet-icon"></i>Form Repeater</a></li>
                                        <li><a href="../form-widgets/forms.timePicker.html"><i class="bullet-icon"></i>Time Picker</a></li>
                                        <li><a href="../form-widgets/forms.touchspin.html"><i class="bullet-icon"></i>Touch Spin</a></li>
                                        <li><a href="../form-widgets/forms.bootstrap-maxlength.html"><i class="bullet-icon"></i>Bootstrap Maxlength</a></li>
                                        <li><a href="../form-widgets/forms.bootstrap-tagify.html"><i class="bullet-icon"></i>Bootstrap Tagify</a></li>
                                        <li><a href="../form-widgets/forms.select2.html"><i class="bullet-icon"></i>Select2</a></li>
                                        <li><a href="../form-widgets/forms.typeahead.html"><i class="bullet-icon"></i>Typeahead</a></li>
                                        <li><a href="../form-widgets/forms.inputmask.html"><i class="bullet-icon"></i>Inputmask</a></li>
                                        <li><a href="../form-widgets/forms.nouislider.html"><i class="bullet-icon"></i>Nouislider</a></li>
                                        <li><a href="../form-widgets/forms.clipboard.html"><i class="bullet-icon"></i>Clipboard</a></li>
                                        <li><a href="../form-widgets/forms.dropzone.html"><i class="bullet-icon"></i>Dropzone</a></li>
                                        <li><a href="../form-widgets/forms.uppy.html"><i class="bullet-icon"></i>Uppy</a></li>
                                        <li><a href="../form-widgets/file.pond.html"><i class="bullet-icon"></i>FilePond</a></li>
                                        <li><a href="../form-widgets/editor.html"><i class="bullet-icon"></i>Editor</a></li>
                                        <li><a href="../form-widgets/imagecrop.html"><i class="bullet-icon"></i>Image Crop</a></li>
                                        <li><a class="has-arrow" href="#"><i class="bullet-icon"></i>Wizard</a>
                                            <ul class="mm-collapse">
                                                <li><a href="../form-widgets/wizards/wizard.v1.html"><i class="bullet-icon"></i>Wizard v1</a></li>
                                                <li><a href="../form-widgets/wizards/wizard.v2.html"><i class="bullet-icon"></i>Wizard v2</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="has-arrow" href="#"><i class="material-icons nav-icon">widgets</i>Widgets</a>
                                    <ul class="mm-collapse">
                                        <li><a href="../widgets/widgets.general.html"><i class="bullet-icon"></i>General</a></li>
                                        <li><a href="../widgets/widgets.table.html"><i class="bullet-icon"></i>Table widgets</a></li>
                                        <li><a href="../widgets/widgets.charts.html"><i class="bullet-icon"></i>Charts</a></li>
                                    </ul>
                                </li>
                                <li><a class="has-arrow" href="#"><i class="material-icons nav-icon">table_chart</i>DataTables</a>
                                    <ul class="mm-collapse">
                                        <li><a class="has-arrow" href="#"><i class="bullet-icon"></i>Basic</a>
                                            <ul class="mm-collapse">
                                                <li><a href="../datatables/basic/table.datatables.html"><i class="bullet-icon"></i>Datatable Basic</a></li>
                                                <li><a href="../datatables/basic/table.datatableScrollable.html"><i class="bullet-icon"></i>Scrollable</a></li>
                                                <li><a href="../datatables/basic/table.datatableComplexHeader.html"><i class="bullet-icon"></i>Complex Header</a></li>
                                                <li><a href="../datatables/basic/table.datatablePagintaionOption.html"><i class="bullet-icon"></i>Pagination Option</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="has-arrow" href="#"><i class="bullet-icon"></i>Advanced</a>
                                            <ul class="mm-collapse">
                                                <li><a href="../datatables/advanced/table.datatableColumnRendering.html"><i class="bullet-icon"></i>Column Rendering</a></li>
                                                <li><a href="../datatables/advanced/table.datatableMultipleControl.html"><i class="bullet-icon"></i>Multiple Controls</a></li>
                                                <li><a href="../datatables/advanced/table.datatableRowGrouping.html"><i class="bullet-icon"></i>Row Grouping</a></li>
                                                <li><a href="../datatables/advanced/table.datatableFooterCallback.html"><i class="bullet-icon"></i>Footer Callback</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="has-arrow" href="#"><i class="bullet-icon"></i>Data Source</a>
                                            <ul class="mm-collapse">
                                                <li><a href="../datatables/data-source/table.datatableHTML.html"><i class="bullet-icon"></i>Datatable HTML</a></li>
                                                <li><a href="../datatables/data-source/table.datatableAjax.html"><i class="bullet-icon"></i>Ajax</a></li>
                                                <li><a href="../datatables/data-source/table.datatableJavascript.html"><i class="bullet-icon"></i>Javascript</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="has-arrow" href="#"><i class="bullet-icon"></i>Search Options</a>
                                            <ul class="mm-collapse">
                                                <li><a href="../datatables/search/table.datatableColumnSelect.html"><i class="bullet-icon"></i>Column Select</a></li>
                                                <li><a href="../datatables/search/table.datatableColumnSearch.html"><i class="bullet-icon"></i>Column Search</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="has-arrow" href="#"><i class="bullet-icon"></i>Extensions</a>
                                            <ul class="mm-collapse">
                                                <li><a href="../datatables/extension/table.datatableButton.html"><i class="bullet-icon"></i>Datatable Button</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="../datatables/gijgo.grid.html"><i class="bullet-icon"></i>Gijgo Grid</a></li>
                                    </ul>
                                </li>
                                <li><a class="has-arrow" href="#"><i class="material-icons nav-icon">pie_chart</i>Charts</a>
                                    <ul class="mm-collapse">
                                        <li><a href="../charts/charts.eChart.html"><i class="bullet-icon"></i>ECharts</a></li>
                                        <li><a href="../charts/charts.chartjs.html"><i class="bullet-icon"></i>ChartJS</a></li>
                                        <li><a class="has-arrow" href="#"><i class="bullet-icon"></i>ApexChart</a>
                                            <ul class="mm-collapse">
                                                <li><a href="../charts/apexCharts/apexCharts.area.html"><i class="bullet-icon"></i>Area</a></li>
                                                <li><a href="../charts/apexCharts/apexCharts.bar.html"><i class="bullet-icon"></i>Bar</a></li>
                                                <li><a href="../charts/apexCharts/apexCharts.bubble.html"><i class="bullet-icon"></i>Bubble</a></li>
                                                <li><a href="../charts/apexCharts/apexCharts.candleStick.html"><i class="bullet-icon"></i>Candlestick</a></li>
                                                <li><a href="../charts/apexCharts/apexCharts.column.html"><i class="bullet-icon"></i>Column</a></li>
                                                <li><a href="../charts/apexCharts/apexCharts.line.html"><i class="bullet-icon"></i>Line</a></li>
                                                <li><a href="../charts/apexCharts/apexCharts.mix.html"><i class="bullet-icon"></i>Mix</a></li>
                                                <li><a href="../charts/apexCharts/apexCharts.pie.html"><i class="bullet-icon"></i>Pie</a></li>
                                                <li><a href="../charts/apexCharts/apexCharts.radar.html"><i class="bullet-icon"></i>Radar</a></li>
                                                <li><a href="charts/apexCharts/apexCharts.RadialBar.html"><i class="bullet-icon"></i>Radialbar</a></li>
                                                <li><a href="../charts/apexCharts/apexCharts.sparkline.html"><i class="bullet-icon"></i>Sparkline</a></li>
                                                <li><a href="../charts/apexCharts/apexCharts.scatter.html"><i class="bullet-icon"></i>Scatter</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="has-arrow" href="#"><i class="material-icons nav-icon">view_array</i>Blocks</a>
                                    <ul class="mm-collapse">
                                        <li><a href="../blocks/blocks.sidebar.html"><i class="bullet-icon"></i>Sidebars</a></li>
                                        <li><a href="../blocks/blocks.credit-cards.html"><i class="bullet-icon"></i>Credit Cards</a></li>
                                    </ul>
                                </li><span class="main-menu-title">SYSTEM UTILITIES</span>
                                <li><a href="../system-utilities/sass.variable.html"><i class="material-icons nav-icon text-16">style</i>Sass Variables</a></li>
                                <li><a href="../system-utilities/utilities.background.html"><i class="material-icons nav-icon text-16">style</i>Backgrounds</a></li>
                                <li><a href="../system-utilities/utilities.color.html"><i class="material-icons nav-icon text-16">color_lens</i>Colors</a></li>
                                <li><a href="../system-utilities/utilities.shadow.html"><i class="material-icons nav-icon text-16">flip_to_front</i>Shadows</a></li>
                                <li><a href="../system-utilities/utilities.spacing.html"><i class="material-icons nav-icon text-16">space_bar</i>Spacings</a></li>
                                <li><a href="../system-utilities/utilities.typography.html"><i class="material-icons nav-icon text-16">text_fields</i>Typography</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content-wrap">
            <!-- Start::Mobile header-->
            <div class="ul-mobile-top-header bg-slate"><img class="ul-brand-mobile" src="../assets/images/arctic-admin-circle.svg" alt="">
                <div class="flex-grow-1"></div>
                <button class="sidebar-full-toggle btn btn-icon btn-primary rounded-circle text-white mx-2"><i class="material-icons">menu</i></button>
                <button class="btn btn-icon ul-header-menu-toggle btn-icon btn-primary rounded-circle text-white"><i class="material-icons">more_vert</i></button><i class="material-icons text-white ul-mobile-header-toggle mx-2">more_horiz</i>
            </div>
            <!-- End::Mobile header  -->
            <!-- Start::Main header  -->
            <header class="main-header bg-card d-flex flex-row justify-content-between align-items-center px-lg">
                <!-- Start::Header menu-->
                <div>
                    <div class="ul-header-menu-wrap"><i class="material-icons ul-header-menu-toggle">close</i>
                        <div class="ul-header-menu">
                            <ul class="ul-header-nav">
                                <li class="ul-menu-item ul-menu-item--active"><a class="ul-menu-link" href="dashboard.jobManagement.html">Dashboards</a></li>
                                <li class="ul-menu-item ul-menu-item-submenu"><a class="ul-menu-link" href="#">Components</a>
                                    <div class="ul-menu-submenu">
                                        <ul class="ul-menu-subnav">
                                            <li class="ul-menu-item ul-menu-item-submenu"><a class="ul-menu-link" href="#"> <i class="material-icons ul-menu-item-icon">home</i>UI Kits</a>
                                                <div class="ul-menu-submenu">
                                                    <ul class="ul-menu-subnav">
                                                        <li class="ul-menu-item ul-menu-item-submenu"><a class="ul-menu-link" href="#"> <i class="material-icons ul-menu-item-icon">remove</i>Buttons 1</a>
                                                            <div class="ul-menu-submenu">
                                                                <ul class="ul-menu-subnav">
                                                                    <li class="ul-menu-item"><a class="ul-menu-link" href="#"> <i class="material-icons ul-menu-item-icon">done</i>Child 1</a></li>
                                                                    <li class="ul-menu-item"><a class="ul-menu-link" href="#"> <i class="material-icons ul-menu-item-icon">done</i>Child 2</a></li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <li class="ul-menu-item"><a class="ul-menu-link" href="#"> <i class="material-icons ul-menu-item-icon">remove</i>Badges</a></li>
                                                        <li class="ul-menu-item ul-menu-item-submenu"><a class="ul-menu-link" href="#"> <i class="material-icons ul-menu-item-icon">remove</i>Alerts</a>
                                                            <div class="ul-menu-submenu">
                                                                <ul class="ul-menu-subnav">
                                                                    <li class="ul-menu-item"><a class="ul-menu-link" href="#">Child 3</a></li>
                                                                    <li class="ul-menu-item"><a class="ul-menu-link" href="#">Child 4</a></li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="ul-menu-item"><a class="ul-menu-link" href="#"> <i class="material-icons ul-menu-item-icon">dashboard</i>Apps</a></li>
                                            <li class="ul-menu-item"><a class="ul-menu-link" href="#"> <i class="material-icons ul-menu-item-icon">settings</i>Pages</a></li>
                                            <li class="ul-menu-item"><a class="ul-menu-link" href="#"> <i class="material-icons ul-menu-item-icon">reply_all</i>Plugins</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End::Header menu-->
                <div class="ul-header-topbar">
                    <div class="flex-grow-1"></div>
                    <div class="ul-search-full-width">
                        <button class="toggle-search btn btn-opacity-default rounded-circle btn-icon mx-xs" type="button"><i class="material-icons">search</i></button>
                        <div class="ul-search-input-area">
                            <input id="app-search" type="text" placeholder="Explore Arctic..." aria-label="Search">
                            <button class="btn btn-opacity-default rounded-circle btn-icon toggle-search" type="button"><i class="material-icons">close</i></button>
                        </div>
                        <div class="ul-search-result-area">
                            <div class="search-result"></div>
                        </div>
                    </div>
                    <div class="dropdown language-dropdown mx-xx">
                        <div class="header-btn-group">
                            <button class="btn btn-opacity-default rounded-circle btn-icon" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar-xs rounded-circle" src="../assets/images/flags/1x1/us.svg" alt=""></button>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#"> <img class="avatar-xxs rounded-circle me-sm" src="../assets/images/flags/1x1/us.svg" alt="">English</a><a class="dropdown-item" href="#"> <img class="avatar-xxs rounded-circle me-sm" src="../assets/images/flags/1x1/es.svg" alt="">Spanish</a><a class="dropdown-item" href="#"> <img class="avatar-xxs rounded-circle me-sm" src="../assets/images/flags/1x1/in.svg" alt="">Hindi</a></div>
                        </div>
                    </div>
                    <button class="btn btn-opacity-default rounded-circle btn-icon btn-badge" data-sidebar-panel="asideNotification"><span class="badge badge-danger">3</span><i class="material-icons">notifications</i></button>
                    <div class="profile-dropdown">
                        <div class="dropdown header-btn-group">
                            <button class="btn d-flex py-1 ps-2 pe-0 rounded" id="dropdownTopUserProfile" type="button" data-sidebar-panel="asideProfile"><span class="m-0 me-2 font-weight-normal">Hi, Watson</span><img class="avatar-sm rounded-circle me-1" src="../assets/images/faces/1.jpg"></button>
                        </div>
                    </div>
                </div>
            </header>
            <!-- End::Main header-->
            <!-- Start:: content body-->
            <div class="main-content-body">
                <!-- Start:: content (Your custom content)-->
                <div class="subheader px-lg">
                    <div class="subheader-container">
                        <div class="subheader-main d-none d-lg-flex">
                            <h3 class="subheader-title">Dashboard</h3>
                            <nav class="ul-breadcrumb" aria-label="breadcrumb">
                                <ol class="ul-breadcrumb-items">
                                    <li class="breadcrumb-home"><a href="#"> <i class="material-icons">home</i></a></li>
                                    <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Job Management</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="flex-grow-1"></div>
                        <div class="subheader-toolbar">
                            <button class="btn btn-sm btn-opacity btn-primary" id="reportrange"><i class="fa fa-calendar me-sm"></i><span></span></button>
                        </div>
                    </div>
                </div>
                <div class="container mt-lg">
                    <div class="row">
                        <div class="col-xl-9 col-lg-8">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 mb-lg">
                                    <div class="card">
                                        <div class="card-body py-0 d-flex justify-content-between align-items-center">
                                            <div class="mb-3"><span class="text-small text-muted">Total </span>
                                                <h3 class="font-weight-bold">5672</h3>
                                                <div class="d-flex align-items-center"><span class="badge badge-opacity badge-primary rounded-circle badge-xxs me-1"><i class="material-icons">call_made</i></span><span class="text-primary text-small font-weight-bold">+14% Inc</span></div>
                                            </div>
                                            <div id="management-chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 mb-lg">
                                    <div class="card">
                                        <div class="card-body py-0 d-flex justify-content-between align-items-center">
                                            <div class="mb-3"><span class="text-small text-muted">Shortlist</span>
                                                <h3 class="font-weight-bold">3045</h3>
                                                <div class="d-flex align-items-center"><span class="badge badge-opacity badge-warning rounded-circle badge-xxs me-1"><i class="material-icons">call_made</i></span><span class="text-warning text-small font-weight-bold">+04% Inc</span></div>
                                            </div>
                                            <div id="management-chartTwo"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-12 mb-lg">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-lg">
                                                <div class="card-title m-0">Job Applications Last Week</div>
                                                <div class="dropdown">
                                                    <button class="btn btn-opacity btn-primary rounded-circle btn-sm btn-icon" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons text-14">date_range</i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#">Year</a><a class="dropdown-item" href="#">Month</a><a class="dropdown-item" href="#">Week</a></div>
                                                </div>
                                            </div>
                                            <div id="jobManagement_chart4" style="height:320px"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-12 mb-lg">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center flex-wrap mb-md">
                                                <div class="card-title m-0">Acquisitions</div>
                                                <div class="dropdown">
                                                    <button class="btn btn-opacity btn-primary rounded-circle btn-sm btn-icon" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons text-14">date_range</i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                                                </div>
                                            </div>
                                            <div class="d-flex jsutify-content-between align-items-center my-lg">
                                                <div class="d-flex align-items-center w-50"><i class="material-icons text-10 text-primary me-2">lens</i>
                                                    <p class="font-weight-medium m-0">All</p>
                                                </div>
                                                <div class="flex-grow-1 me-md w-30">
                                                    <div class="progress-wrapper">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0">1290</p>
                                            </div>
                                            <div class="d-flex jsutify-content-between align-items-center my-lg">
                                                <div class="d-flex align-items-center w-50"><i class="material-icons text-10 text-warning me-2">lens</i>
                                                    <p class="font-weight-medium m-0">Shortlisted</p>
                                                </div>
                                                <div class="flex-grow-1 me-md w-30">
                                                    <div class="progress-wrapper">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 15%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0">15%</p>
                                            </div>
                                            <div class="d-flex jsutify-content-between align-items-center my-lg">
                                                <div class="d-flex align-items-center w-50"><i class="material-icons text-10 text-primary me-2">lens</i>
                                                    <p class="font-weight-medium m-0">Contacted</p>
                                                </div>
                                                <div class="flex-grow-1 me-md w-30">
                                                    <div class="progress-wrapper">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 65%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0">65%</p>
                                            </div>
                                            <div class="d-flex jsutify-content-between align-items-center my-lg">
                                                <div class="d-flex align-items-center w-50"><i class="material-icons text-10 text-danger me-2">lens</i>
                                                    <p class="font-weight-medium m-0">Rejected</p>
                                                </div>
                                                <div class="flex-grow-1 me-md w-30">
                                                    <div class="progress-wrapper">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 35%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0">35%</p>
                                            </div>
                                            <div class="d-flex jsutify-content-between align-items-center my-lg">
                                                <div class="d-flex align-items-center w-50"><i class="material-icons text-10 text-info me-2">lens</i>
                                                    <p class="font-weight-medium m-0">On Hold</p>
                                                </div>
                                                <div class="flex-grow-1 me-md w-30">
                                                    <div class="progress-wrapper">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 35%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0">35%</p>
                                            </div>
                                            <div class="d-flex jsutify-content-between align-items-center my-lg">
                                                <div class="d-flex align-items-center w-50"><i class="material-icons text-10 text-primary me-2">lens</i>
                                                    <p class="font-weight-medium m-0">Finalised</p>
                                                </div>
                                                <div class="flex-grow-1 me-md w-30">
                                                    <div class="progress-wrapper">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 25%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0">25%</p>
                                            </div>
                                            <div class="d-flex jsutify-content-between align-items-center my-lg">
                                                <div class="d-flex align-items-center w-50"><i class="material-icons text-10 text-success me-2">lens</i>
                                                    <p class="font-weight-medium m-0">Hired</p>
                                                </div>
                                                <div class="flex-grow-1 me-md w-30">
                                                    <div class="progress-wrapper">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0">15%</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 mb-lg">
                                    <div class="table-responsive shadow-6dp bg-card rounded">
                                        <table class="table borderless table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-muted border-0">Job Post</th>
                                                    <th scope="col" class="text-muted border-0">Posted at</th>
                                                    <th scope="col" class="text-muted border-0">Applicants</th>
                                                    <th scope="col" class="text-muted border-0"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="align-middle font-weight-semi border-0"><a class="text-body" href="">Senior Fullstack Engineer</a></td>
                                                    <td class="align-middle border-0">
                                                        <span class="text-muted">01/10/2020</span>
                                                    </td>
                                                    <td class="align-middle border-0">
                                                        <div class="col-md-4 d-flex align-items-center avatar-group m-0">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/001-man.svg" data-toggle="tooltip" data-placement="top" title="John M">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/002-woman.svg" data-toggle="tooltip" data-placement="top" title="Alison W">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/007-woman-2.svg" data-toggle="tooltip" data-placement="top" title="Alisa J">
                                                            <span class="badge rounded-circle gray-300 badge-sm">10+</span>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle border-0">
                                                        <div class="dropdown d-inline">
                                                            <button class="btn btn-light btn-icon btn-sm rounded-circle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">more_horiz</i></button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">assignment</i>View Job Post</a>
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">group</i>View Applicants</a>
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">person_add</i>Invite Applicant</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle font-weight-semi border-0"><a class="text-body" href="">Freelance Java Developer</a></td>
                                                    <td class="align-middle border-0">
                                                        <span class="text-muted">01/10/2020</span>
                                                    </td>
                                                    <td class="align-middle border-0">
                                                        <div class="col-md-4 d-flex align-items-center avatar-group m-0">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/003-man-1.svg" data-toggle="tooltip" data-placement="top" title="John M">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/004-bald.svg" data-toggle="tooltip" data-placement="top" title="Alison W">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/006-woman-1.svg" data-toggle="tooltip" data-placement="top" title="Alisa J">
                                                            <span class="badge rounded-circle gray-300 badge-sm">6+</span>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle border-0">
                                                        <div class="dropdown d-inline">
                                                            <button class="btn btn-light btn-icon btn-sm rounded-circle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">more_horiz</i></button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">assignment</i>View Job Post</a>
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">group</i>View Applicants</a>
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">person_add</i>Invite Applicant</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle font-weight-semi border-0"><a class="text-body" href="">Python Developer</a></td>
                                                    <td class="align-middle border-0">
                                                        <span class="text-muted">01/10/2020</span>
                                                    </td>
                                                    <td class="align-middle border-0">
                                                        <div class="col-md-4 d-flex align-items-center avatar-group m-0">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/006-woman-1.svg" data-toggle="tooltip" data-placement="top" title="John M">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/002-woman.svg" data-toggle="tooltip" data-placement="top" title="Alison W">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/007-woman-2.svg" data-toggle="tooltip" data-placement="top" title="Alisa J">
                                                            <span class="badge rounded-circle gray-300 badge-sm">4+</span>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle border-0">
                                                        <div class="dropdown d-inline">
                                                            <button class="btn btn-light btn-icon btn-sm rounded-circle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">more_horiz</i></button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">assignment</i>View Job Post</a>
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">group</i>View Applicants</a>
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">person_add</i>Invite Applicant</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle font-weight-semi border-0"><a class="text-body" href="">Product Designer</a></td>
                                                    <td class="align-middle border-0">
                                                        <span class="text-muted">01/10/2020</span>
                                                    </td>
                                                    <td class="align-middle border-0">
                                                        <div class="col-md-4 d-flex align-items-center avatar-group m-0">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/003-man-1.svg" data-toggle="tooltip" data-placement="top" title="John M">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/004-bald.svg" data-toggle="tooltip" data-placement="top" title="Alison W">
                                                            <img class="avatar-sm rounded-circle" src="../assets/images/avatars/006-woman-1.svg" data-toggle="tooltip" data-placement="top" title="Alisa J">
                                                            <span class="badge rounded-circle gray-300 badge-sm">9+</span>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle border-0">
                                                        <div class="dropdown d-inline">
                                                            <button class="btn btn-light btn-icon btn-sm rounded-circle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">more_horiz</i></button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">assignment</i>View Job Post</a>
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">group</i>View Applicants</a>
                                                                <a class="dropdown-item" href="#"><i class="material-icons icon icon-sm">person_add</i>Invite Applicant</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 mb-md">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-md">
                                                <div class="card-title m-0">Application Received Time</div>
                                                <div class="dropdown">
                                                    <button class="btn btn-opacity btn-primary rounded-circle btn-sm btn-icon" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons text-14">date_range</i>
                                                        <div class="ripple-container"></div>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: top, left; top: 38px; left: 0px;"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                                                </div>
                                            </div>
                                            <div id="jobManagement_chart5"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 p-0">
                            <div class="col-xl-12 col-lg-12 mb-md">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 text-center mb-lg"><img class="rounded-circle avatar-xl mb-md" src="../assets/images/faces/15.jpg" alt="" srcset="">
                                                <div class="card-title m-0">Jhon Doe</div>
                                                <p class="text-muted mb-xs">HR Manager</p>
                                                <div class="d-flex align-items-center justify-content-center"><span class="badge badge-opacity badge-primary rounded-circle badge-xxs me-sm"><i class="material-icons text-14 align-middle">location_on</i></span><span class="text-primary text-12">New York, US</span></div>
                                            </div>
                                            <div class="col-12 mb-xxl">
                                                <div class="heading-label">Jobs Posted</div>
                                                <div class="card bg-primary text-white">
                                                    <div class="card-body pe-sm d-flex justify-content-between">
                                                        <div class="flex-1">
                                                            <div class="card-title text-white mb-xs text-15">Sr. Software Developer</div>
                                                            <p class="m-0 text-12"><span class="badge badge-warning badge-xxs rounded-circle me-xs">95</span>Total Applications</p>
                                                        </div>
                                                        <div class="dropdown d-flex align-items-center">
                                                            <button class="btn btn-primary btn-icon btn-sm rounded-circle" id="dropdownMenuButton322" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons text-white">more_vert</i>
                                                                <div class="ripple-container"></div>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton322" x-placement="bottom-start" style="position: absolute; will-change: top, left; top: 38px; left: 0px;"><a class="dropdown-item" href="#"> <i class="material-icons icon icon-sm">visibility_off</i>Unpublish</a><a class="dropdown-item" href="#"> <i class="material-icons icon icon-sm">edit</i>Edit Job Post</a><a class="dropdown-item" href="#"> <i class="material-icons icon icon-sm">delete</i>Delete</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="ul-list-group-1">
                                                    <h6 class="heading-label">Reminder</h6>
                                                    <div class="ul-list-item mb-md">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span class="badge badge-opacity rounded-circle badge-light me-md"> <i class="material-icons text-muted">view_week</i></span>
                                                            <div class="flex-grow-1">
                                                                <h6 class="text-small font-weight-semi m-0">Subscription expires today</h6>
                                                                <small class="text-muted text-small">23 December 2019</small>
                                                            </div>
                                                            <div class="ul-reminder-action">
                                                                <button class="btn rounded-circle btn-icon">
                                                                    <i class="material-icons text-muted">more_horiz</i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ul-list-item mb-md">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span class="badge badge-opacity rounded-circle badge-light me-md"> <i class="material-icons text-muted">close</i></span>
                                                            <div class="flex-grow-1">
                                                                <h6 class="text-small font-weight-semi m-0">You unpublished a Job</h6>
                                                                <small class="text-muted text-small">23 December 2019</small>
                                                            </div>
                                                            <div class="ul-reminder-action">
                                                                <button class="btn rounded-circle btn-icon">
                                                                    <i class="material-icons text-muted">more_horiz</i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ul-list-item mb-md">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span class="badge badge-opacity rounded-circle badge-light me-md"> <i class="material-icons text-muted">person</i></span>
                                                            <div class="flex-grow-1">
                                                                <h6 class="text-small font-weight-semi m-0">5 New applicants</h6>
                                                                <small class="text-muted text-small">23 December 2019</small>
                                                            </div>
                                                            <div class="ul-reminder-action">
                                                                <button class="btn rounded-circle btn-icon">
                                                                    <i class="material-icons text-muted">more_horiz</i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ul-list-item mb-md">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span class="badge badge-opacity rounded-circle badge-light me-md"> <i class="material-icons text-muted">textsms</i></span>
                                                            <div class="flex-grow-1">
                                                                <h6 class="text-small font-weight-semi m-0">New Commnet on job post</h6>
                                                                <small class="text-muted text-small">23 December 2019</small>
                                                            </div>
                                                            <div class="ul-reminder-action">
                                                                <button class="btn rounded-circle btn-icon">
                                                                    <i class="material-icons text-muted">more_horiz</i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 mb-md">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-md flex-wrap">
                                            <div class="card-title m-0">Candidates by Gender</div>
                                            <div class="dropdown">
                                                <button class="btn btn-opacity btn-primary rounded-circle btn-icon btn-sm" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons text-14">date_range</i>
                                                    <div class="ripple-container"></div>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: top, left; top: 38px; left: 0px;"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                                            </div>
                                        </div>
                                        <div id="jobManagement_chart6"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start:: content (Your custom content)-->
                <!-- Start:: Footer-->
                <div class="flex-grow-1"></div>
                <div class="bg-card px-lg py-md d-flex justify-content-between align-items-center flex-wrap shadow-6dp"><a class="btn btn-flat btn-warning">Buy Arctic</a>
                    <p class="text-muted m-0">All rights reserved &copy; UI Lib 2024</p>
                </div>
                <!-- End:: Footer-->
            </div>
            <!-- End:: content body-->
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
    <script src="{{ asset('assets/vendors/echarts/dist/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/data/series.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard/jobManagement.min.js') }}"></script>
</body>

</html>