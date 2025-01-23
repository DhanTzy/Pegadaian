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
    <link href="{{ asset('css/stylingapp.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    @stack('style')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i> </a> </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i
                                data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i
                                data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('storage/profile_images/' . auth()->user()->image) }}"
                                alt="Photo Profile" class="rounded-circle"
                                style="width: 35px; height: 35px; object-fit: cover;">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                            <div class="message-body">
                                <a href="{{ route('profile.show') }}"
                                    class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="fa-solid fa-user"></i>
                                    <p class="mb-0 fs-6">Profile</p>
                                </a>
                                <a href="{{ route('password.change') }}"
                                    class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="fa-solid fa-lock"></i>
                                    <p class="mb-0 fs-6">Ubah Password</p>
                                </a>
                                <div class="d-flex justify-content-center">
                                    <a href="#" class="btn btn-outline-danger my-2 d-block w-75" id="logoutBtn">Logout</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <aside class="app-sidebar bg-body-secondary shadow " data-bs-theme="dark">
            <div class="sidebar-brand"> <a href="" class="brand-link"><img src="{{ asset('img/Sidebar.png') }}"
                        alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
            </div>
            <div class="sidebar-wrapper">
                <nav class="mt-5">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item"> <a
                                class="nav-link {{ Route::is('dashboard.index') ? 'active bg-primary' : '' }}"
                                href="{{ route('dashboard.index') }}"> <i class="nav-icon bi bi-speedometer"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        @php
                            $isTransaksi = Route::is(
                                'transaksi.index',
                                'transaksi.create',
                                'transaksi.edit',
                            );
                            $isNasabah = Route::is('nasabah.index', 'nasabah.create', 'nasabah.edit');
                        @endphp

                        <li class="nav-item {{ $isTransaksi || $isNasabah ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ $isTransaksi || $isNasabah ? 'active' : '' }}">
                                <i class="bi bi-person-fill-check"></i>
                                <p>
                                    Customer Service
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item {{ $isNasabah ? 'menu-open' : '' }}">
                                    <a href="#" class="nav-link {{ $isNasabah ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-table"></i>
                                        <p>
                                            Pendaftaran
                                            <i class="nav-arrow bi bi-chevron-right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a class="nav-link {{ $isNasabah ? 'active bg-primary' : '' }}"
                                                href="{{ route('nasabah.index') }}">
                                                <i class="nav-icon bi bi-circle"></i>
                                                <p>Nasabah</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $isTransaksi ? 'active bg-primary' : '' }}"
                                        href="{{ route('transaksi.index') }}">
                                        <i class="bi bi-wallet"></i>
                                        <p>Transaksi Pengajuan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item {{ Route::is('appraisal.index') ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ Route::is('appraisal.index') ? 'active' : '' }}">
                                <i class="bi bi-person-fill-exclamation"></i>
                                <p>
                                    Appraisal
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('appraisal.index') ? 'active bg-primary' : '' }}"
                                        href="{{ route('appraisal.index') }}">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Penilaian</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item {{ Route::is('approval.index') ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ Route::is('approval.index') ? 'active' : '' }}">
                                <i class="bi bi-person-fill-check"></i>
                                <p>
                                    Approval
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('approval.index') ? 'active bg-primary' : '' }}"
                                        href="{{ route('approval.index') }}">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Persetujuan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item {{ Route::is('karyawan.index', 'karyawan.create', 'karyawan.edit', 'users.index', 'users.create', 'users.edit', 'karyawan.pekerjaan.index', 'karyawan.pekerjaan.create', 'karyawan.pekerjaan.edit') ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ Route::is('karyawan.index', 'karyawan.create', 'karyawan.edit', 'users.index', 'users.create', 'users.edit', 'karyawan.pekerjaan.index', 'karyawan.pekerjaan.create', 'karyawan.pekerjaan.edit') ? 'active' : '' }}">
                                <i class="bi bi-gear"></i>
                                <p>
                                    Pengaturan
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('karyawan.index', 'karyawan.create', 'karyawan.edit') ? 'active bg-primary' : '' }}"
                                        href="{{ route('karyawan.index') }}">
                                        <i class="bi bi-person-lines-fill"></i>
                                        <p>Daftar Karyawan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('karyawan.pekerjaan.index', 'karyawan.pekerjaan.create', 'karyawan.pekerjaan.edit') ? 'active bg-primary' : '' }}"
                                        href="{{ route('karyawan.pekerjaan.index') }}">
                                        <i class="bi bi-list-columns"></i>
                                        <p>Daftar Posisi Pekerjaan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('users.index', 'users.create', 'users.edit') ? 'active bg-primary' : '' }}"
                                        href="{{ route('users.index') }}">
                                        <i class="bi bi-person-vcard"></i>
                                        <p>Daftar Pengelola Akun</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <main class="app-main">
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
                        <img src="{{ asset('img/sigma.png') }}" class="brand-image" alt="logo" width="100"
                            width="100" height="auto">
                    </div>
                </div>
    </div>
    </footer>
    </main>
    </div>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"></script> --}}
    @stack('script')
    {{-- <script src="{{ asset('js/sidebar.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        document.getElementById('logoutBtn').addEventListener('click', function(e) {
        e.preventDefault();
        const logoutConfirmed = confirm('Apakah Anda yakin ingin logout?');
        if (logoutConfirmed) {
            window.location.href = "{{ route('logout') }}";
        }
    });
        $(document).ready(function() {
            $('#myTable').DataTable();
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
    </script>
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
    </script>
</body>

</html>
