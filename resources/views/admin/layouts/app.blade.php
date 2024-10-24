<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="d-flex">
        <nav class="bg-dark text-white p-3" style="width: 250px; height: 100vh; position: fixed;">
            <div class="sidebar">
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/logo/Pegadaian_logo.png') }}" alt="Logo" class="img-fluid"
                        style="max-width: 75%; height: auto;">
                </div>

                <!-- Menu Items -->
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white {{ Route::is('admin.home') ? 'active bg-primary' : '' }}"
                            href="{{ route('admin.home') }}">
                            <i class="bi bi-bar-chart-line"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white {{ Route::is('admin.transaksi') ? 'active bg-primary' : '' }}"
                            href="{{ route('admin.transaksi') }}">
                            <i class="bi bi-cash-stack"></i> Transaksi
                        </a>
                    </li>

                    <!-- Data Master Collapse without Sub Collapse -->
                    <li class="nav-item">
                        <a class="nav-link text-white d-flex justify-content-between align-items-center"
                            data-bs-toggle="collapse" href="#dataMasterCollapse" role="button" aria-expanded="false"
                            aria-controls="dataMasterCollapse">
                            <span><i class="bi bi-archive"></i> Data Master</span>
                            <i class="bi bi-chevron-down rotate-icon"></i>
                        </a>
                        <div class="collapse {{ Route::is('admin.nasabah', 'admin.karyawan') ? 'show' : '' }}"
                            id="dataMasterCollapse">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link text-white {{ Route::is('admin.nasabah') ? 'active bg-primary' : '' }}"
                                        href="{{ route('admin.nasabah') }}"><i class="bi bi-person"></i> List Nasabah</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white {{ Route::is('admin.karyawan') ? 'active bg-primary' : '' }}"
                                        href="{{ route('admin.karyawan') }}"><i class="bi bi-people"></i> List Karyawan</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="flex-grow-1 p-4" style="margin-left: 250px;">
            <!-- Bagian Profil di Pinggir Kanan Atas-->
            <div class="d-flex justify-content-end mb-3">
                <div class="dropdown">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle"
                        id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('storage/logo/demaz.jpeg') }}" alt="Profile" class="rounded-circle"
                            width="50" height="50">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-light text-small shadow"
                        aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#logoutModal">Logout</a></li>
                    </ul>
                </div>
            </div>
            <hr />
            <div>
                @yield('contents')
            </div>
        </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
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
    </div>

    <script>
        // Mengatur ikon panah untuk collapse
        document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(collapseLink => {
            collapseLink.addEventListener('click', function() {
                const icon = this.querySelector('.rotate-icon');
                const collapseTarget = document.querySelector(this.getAttribute('href'));

                collapseTarget.addEventListener('shown.bs.collapse', function() {
                    icon.classList.remove('bi-chevron-down');
                    icon.classList.add('bi-chevron-up');
                });
                collapseTarget.addEventListener('hidden.bs.collapse', function() {
                    icon.classList.remove('bi-chevron-up');
                    icon.classList.add('bi-chevron-down');
                });
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</body>
</html>
