<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link href="{{ asset('css/stylingapp.css') }}" rel="stylesheet">

    {{-- <link href="{{ asset('css/tes.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    @stack('style')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i> </a> </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i
                                data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i
                                data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a>
                    </li> <!--end::Fullscreen Toggle--> <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle"
                            data-bs-toggle="dropdown"> <img src="{{ asset('img/rp.png') }}"
                                class="user-image rounded-circle shadow" alt="User Image">
                            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
                                Rayhan Riyadhul Jinan
                                <a href="{{ route('admin.home') }}" class="btn btn-default btn-flat">Profile</a>
                                <a href="{{ route('logout') }}" class="btn btn-primary">Logout</a>
                            </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <div class="sidebar-brand"> <a href="" class="brand-link"><img src="{{ asset('img/Sidebar.png') }}"
                        alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
            </div>
            <div class="sidebar-wrapper">
                <nav class="mt-5">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item"> <a
                                class="nav-link {{ Route::is('admin.home') ? 'active bg-primary' : '' }}"
                                href="{{ route('admin.home') }}"> <i class="nav-icon bi bi-speedometer"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item"> <a
                                class="nav-link {{ Route::is('admin.transaksi') ? 'active bg-primary' : '' }}"
                                href="{{ route('admin.transaksi') }}"><i class="nav-icon bi bi-palette"></i>
                                <p>Transaksi</p>
                            </a>
                        </li>
                        <li class="nav-item"> <a href="#"
                                class="nav-link {{ Route::is('admin.nasabah', 'admin.karyawan') ? 'show' : '' }}"> <i
                                    class="nav-icon bi bi-table"></i>
                                <p>
                                    Data Master
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a
                                        class="nav-link {{ Route::is('admin.nasabah') ? 'active bg-primary' : '' }}"
                                        href="{{ route('admin.nasabah') }}"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Nasabah</p>
                                    </a> </li>
                                <li class="nav-item"> <a
                                        class="nav-link {{ Route::is('admin.karyawan') ? 'active bg-primary' : '' }}"
                                        href="{{ route('admin.karyawan') }}"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Karyawan</p>
                                    </a> </li>
                            </ul>
                        </li>
                        <!-- <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-clipboard-fill"></i>
                                <p>
                                    Layout Options
                                    <span class="nav-badge badge text-bg-secondary me-3">6</span> <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="./layout/unfixed-sidebar.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Default Sidebar</p>
                                    </a> </li>
                                <li class="nav-item"> <a href="./layout/fixed-sidebar.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Fixed Sidebar</p>
                                    </a> </li>
                                <li class="nav-item"> <a href="./layout/layout-custom-area.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Layout <small>+ Custom Area </small></p>
                                    </a> </li>
                                <li class="nav-item"> <a href="./layout/sidebar-mini.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Sidebar Mini</p>
                                    </a> </li>
                                <li class="nav-item"> <a href="./layout/collapsed-sidebar.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Sidebar Mini <small>+ Collapsed</small></p>
                                    </a> </li>
                                <li class="nav-item"> <a href="./layout/logo-switch.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Sidebar Mini <small>+ Logo Switch</small></p>
                                    </a> </li>
                                <li class="nav-item"> <a href="./layout/layout-rtl.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Layout RTL</p>
                                    </a> </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                                <p>
                                    Widgets
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="./widgets/small-box.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Small Box</p>
                                    </a> </li>
                                <li class="nav-item"> <a href="./widgets/info-box.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>info Box</p>
                                    </a> </li>
                                <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Cards</p>
                                    </a> </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-tree-fill"></i>
                                <p>
                                    UI Elements
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="./UI/general.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>General</p>
                                    </a> </li>
                                <li class="nav-item"> <a href="./UI/icons.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Icons</p>
                                    </a> </li>
                                <li class="nav-item"> <a href="./UI/timeline.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Timeline</p>
                                    </a> </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-pencil-square"></i>
                                <p>
                                    Forms
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="./forms/general.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>General Elements</p>
                                    </a> </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-table"></i>
                                <p>
                                    Tables
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="./tables/nasabah.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Nasabah</p>
                                    </a> </li>
                            </ul>
                        </li>
                        <li class="nav-header">EXAMPLES</li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Auth
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                        <p>
                                            Version 1
                                            <i class="nav-arrow bi bi-chevron-right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item"> <a href="./examples/login.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                                <p>Login</p>
                                            </a> </li>
                                        <li class="nav-item"> <a href="./examples/register.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                                <p>Register</p>
                                            </a> </li>
                                    </ul>
                                </li>
                                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                        <p>
                                            Version 2
                                            <i class="nav-arrow bi bi-chevron-right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item"> <a href="./examples/login-v2.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                                <p>Login</p>
                                            </a> </li>
                                        <li class="nav-item"> <a href="./examples/register-v2.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                                <p>Register</p>
                                            </a> </li>
                                    </ul>
                                </li>
                                <li class="nav-item"> <a href="./examples/lockscreen.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Lockscreen</p>
                                    </a> </li>
                            </ul>
                        </li>
                        <li class="nav-header">DOCUMENTATIONS</li>
                        <li class="nav-item"> <a href="./docs/introduction.html" class="nav-link"> <i class="nav-icon bi bi-download"></i>
                                <p>Installation</p>
                            </a> </li>
                        <li class="nav-item"> <a href="./docs/layout.html" class="nav-link"> <i class="nav-icon bi bi-grip-horizontal"></i>
                                <p>Layout</p>
                            </a> </li>
                        <li class="nav-item"> <a href="./docs/color-mode.html" class="nav-link"> <i class="nav-icon bi bi-star-half"></i>
                                <p>Color Mode</p>
                            </a> </li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-ui-checks-grid"></i>
                                <p>
                                    Components
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="./docs/components/main-header.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Main Header</p>
                                    </a> </li>
                                <li class="nav-item"> <a href="./docs/components/main-sidebar.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Main Sidebar</p>
                                    </a> </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-filetype-js"></i>
                                <p>
                                    Javascript
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="./docs/javascript/treeview.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Treeview</p>
                                    </a> </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <a href="./docs/browser-support.html" class="nav-link"> <i class="nav-icon bi bi-browser-edge"></i>
                                <p>Browser Support</p>
                            </a> </li>
                        <li class="nav-item"> <a href="./docs/how-to-contribute.html" class="nav-link"> <i class="nav-icon bi bi-hand-thumbs-up-fill"></i>
                                <p>How To Contribute</p>
                            </a> </li>
                        <li class="nav-item"> <a href="./docs/faq.html" class="nav-link"> <i class="nav-icon bi bi-question-circle-fill"></i>
                                <p>FAQ</p>
                            </a> </li>
                        <li class="nav-item"> <a href="./docs/license.html" class="nav-link"> <i class="nav-icon bi bi-patch-check-fill"></i>
                                <p>License</p>
                            </a> </li>
                        <li class="nav-header">MULTI LEVEL EXAMPLE</li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Level 1</p>
                            </a> </li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle-fill"></i>
                                <p>
                                    Level 1
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Level 2</p>
                                    </a> </li>
                                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>
                                            Level 2
                                            <i class="nav-arrow bi bi-chevron-right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-record-circle-fill"></i>
                                                <p>Level 3</p>
                                            </a> </li>
                                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-record-circle-fill"></i>
                                                <p>Level 3</p>
                                            </a> </li>
                                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-record-circle-fill"></i>
                                                <p>Level 3</p>
                                            </a> </li>
                                    </ul>
                                </li>
                                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Level 2</p>
                                    </a> </li>
                            </ul>
                        </li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle-fill"></i>
                                <p>Level 1</p>
                            </a> </li>
                        <li class="nav-header">LABELS</li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle text-danger"></i>
                                <p class="text">Important</p>
                            </a> </li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle text-warning"></i>
                                <p>Warning</p>
                            </a> </li>
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle text-info"></i>
                                <p>Informational</p>
                            </a> </li> -->
                    </ul> <!--end::Sidebar Menu-->
                </nav>
            </div> <!--end::Sidebar Wrapper-->
        </aside> <!--end::Sidebar--> <!--begin::App Main-->
        <main class="app-main"> <!--begin::App Content Header-->
            @yield('contents')
            <footer class="footercontainer align-items-center mt-5 bg-footer text-white">
                <!-- Hak Cipta -->
                <div class="d-flex align-items-center justify-content-center p-5">
                    <div class="text-white">
                        <p>© 2024 Pegadaian Hak Cipta. Segala hal yang dilakukan di website ini sudah terlindungi
                            oleh undang-undang hak cipta.</p>
                        <hr>
                        <div class="float-left">
                            <a class="text-white" href="#">Privasi</a> |
                            <a class="text-white" href="#">Hak Cipta</a> |
                            <a class="text-white" href="#">Instagram</a> |
                            <a class="text-white" href="#">Facebook</a>
                        </div>
                    </div>
                    <div class="footerlogo padding-auto p-5">
                        <img src="{{ asset('img/footer.png') }}" class="logo-footer" alt="logo" width="50"
                            width="50" height="auto">
                    </div>
                </div>
    </div>
    </footer>
    </main> <!--end::App Content-->
    </div> <!--end::Footer-->
    </div> <!--end::App Wrapper--> <!--begin::Script--> <!--begin::Third Party Plugin(OverlayScrollbars)-->

    <!-- Logout Modal -->
    {{-- <div class="modal fade" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="{{ route('logout') }}" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
    </div> --}}

    @stack('script')
    {{-- <script src="{{ asset('js/sidebar.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        // Inisialisasi DataTables
        $(document).ready(function() {
            $('#myTable').DataTable(); // Ganti '#myTable' dengan ID tabel Anda
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/adminlte.js') }}"></script>
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script> <!--end::OverlayScrollbars Configure--> <!-- OPTIONAL SCRIPTS --> <!-- sortablejs -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script> <!-- sortablejs -->
    <script>
        const connectedSortables =
            document.querySelectorAll(".connectedSortable");
        connectedSortables.forEach((connectedSortable) => {
            let sortable = new Sortable(connectedSortable, {
                group: "shared",
                handle: ".card-header",
            });
        });

        const cardHeaders = document.querySelectorAll(
            ".connectedSortable .card-header",
        );
        cardHeaders.forEach((cardHeader) => {
            cardHeader.style.cursor = "move";
        });
    </script> <!-- apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"></script> <!-- ChartJS -->
    <script>
        // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
        // IT'S ALL JUST JUNK FOR DEMO
        // ++++++++++++++++++++++++++++++++++++++++++

        const sales_chart_options = {
            series: [{
                    name: "Digital Goods",
                    data: [28, 48, 40, 19, 86, 27, 90],
                },
                {
                    name: "Electronics",
                    data: [65, 59, 80, 81, 56, 55, 40],
                },
            ],
            chart: {
                height: 300,
                type: "area",
                toolbar: {
                    show: false,
                },
            },
            legend: {
                show: false,
            },
            colors: ["#0d6efd", "#20c997"],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "smooth",
            },
            xaxis: {
                type: "datetime",
                categories: [
                    "2023-01-01",
                    "2023-02-01",
                    "2023-03-01",
                    "2023-04-01",
                    "2023-05-01",
                    "2023-06-01",
                    "2023-07-01",
                ],
            },
            tooltip: {
                x: {
                    format: "MMMM yyyy",
                },
            },
        };

        const sales_chart = new ApexCharts(
            document.querySelector("#revenue-chart"),
            sales_chart_options,
        );
        sales_chart.render();
    </script> <!-- jsvectormap -->
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"></script> <!-- jsvectormap -->
    <script>
        const visitorsData = {
            US: 398, // USA
            SA: 400, // Saudi Arabia
            CA: 1000, // Canada
            DE: 500, // Germany
            FR: 760, // France
            CN: 300, // China
            AU: 700, // Australia
            BR: 600, // Brazil
            IN: 800, // India
            GB: 320, // Great Britain
            RU: 3000, // Russia
        };

        // World map by jsVectorMap
        const map = new jsVectorMap({
            selector: "#world-map",
            map: "world",
        });

        // Sparkline charts
        const option_sparkline1 = {
            series: [{
                data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
            }, ],
            chart: {
                type: "area",
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: "straight",
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ["#DCE6EC"],
        };

        const sparkline1 = new ApexCharts(
            document.querySelector("#sparkline-1"),
            option_sparkline1,
        );
        sparkline1.render();

        const option_sparkline2 = {
            series: [{
                data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
            }, ],
            chart: {
                type: "area",
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: "straight",
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ["#DCE6EC"],
        };

        const sparkline2 = new ApexCharts(
            document.querySelector("#sparkline-2"),
            option_sparkline2,
        );
        sparkline2.render();

        const option_sparkline3 = {
            series: [{
                data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21],
            }, ],
            chart: {
                type: "area",
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: "straight",
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ["#DCE6EC"],
        };

        const sparkline3 = new ApexCharts(
            document.querySelector("#sparkline-3"),
            option_sparkline3,
        );
        sparkline3.render();
    </script> <!--end::Script-->
</body>

</html>
