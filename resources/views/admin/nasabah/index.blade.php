@extends('admin.layouts.app')

@section('title', 'Home Nasabah List')

@section('contents')

    <div class="content">
        <div>
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h1 class="fw-bold fs-3">Daftar Data Nasabah</h1>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content Header--> <!--begin::App Content-->
            <div class="app-content"> <!--begin::Container-->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Bordered Table</h3>
                    </div> <!-- /.card-header -->
                    <div class="card-body">
                        <a href="{{ route('admin.nasabah.create') }}" class="btn btn-primary float-left mb-2">Input Data
                            Nasabah</a>
                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <div class="mb-3 d-flex align-items-end">
                                <div class="me-2">
                                    <label for="namaFilter" class="form-label mb-0">Nama Nasabah :</label>
                                    <input type="text" id="namaFilter" placeholder="Search Nama Nasabah"
                                        class="form-control form-control-sm me-2" style="width: auto;">
                                </div>

                                <div class="me-2">
                                    <label for="identitasFilter" class="form-label mb-0">Nomor Identitas :</label>
                                    <input type="text" id="identitasFilter" placeholder="Search Identitas"
                                        class="form-control form-control-sm me-2" style="width: auto;">
                                </div>

                                <div class="me-2">
                                    <label for="identitasFilter" class="form-label mb-0">Identitas (KTP) :</label>
                                    <input type="text" id="identitasFilter" placeholder="Search Identitas"
                                        class="form-control form-control-sm me-2" style="width: auto;">
                                </div>

                                <div class="me-2">
                                    <label for="tanggalDaftarFilter" class="form-label mb-0">Tanggal Daftar :</label>
                                    <input type="date" id="tanggalDaftarFilter" class="form-control form-control-sm"
                                        style="width: auto;">
                                </div>

                                <div class="me-2">
                                    <input type="date" id="tanggalAkhirFilter" class="form-control form-control-sm"
                                        style="width: auto;">
                                </div>

                                <button id="filterButton" class="btn btn-success btn-sm">Filter</button>
                                <button id="resetButton" class="btn btn-secondary btn-sm ms-2">Reset</button>
                            </div>
                            <table id="nasabahTable" class="table table-striped table-bordered">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nomor Identitas (KTP)</th>
                                        <th scope="col">Nama Lengkap</th>
                                        <th scope="col">Tempat Lahir</th>
                                        <th scope="col">Tanggal Lahir</th>
                                        <th scope="col">Status Perkawinan</th>
                                        <th scope="col">Pekerjaan</th>
                                        <th scope="col">Telepon</th>
                                        <th scope="col">Tanggal Daftar</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be loaded here via AJAX -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="nasabahDetailModal" tabindex="-1"
                            aria-labelledby="nasabahDetailModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="nasabahDetailModalLabel">Detail Nasabah</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Nomor Identitas (KTP):</strong> <span id="detailNomorIdentitas"></span>
                                        </p>
                                        <p><strong>Nama Lengkap:</strong> <span id="detailNamaLengkap"></span></p>
                                        <p><strong>Tempat Lahir:</strong> <span id="detailTempatLahir"></span></p>
                                        <p><strong>Tanggal Lahir:</strong> <span id="detailTanggalLahir"></span></p>
                                        <p><strong>Status Perkawinan:</strong> <span id="detailStatusPerkawinan"></span></p>
                                        <p><strong>Pekerjaan:</strong> <span id="detailPekerjaan"></span></p>
                                        <p><strong>Telepom:</strong> <span id="detailTelepon"></span></p>
                                        <p><strong>Tanggal Daftar:</strong> <span id="detailTanggalDaftar"></span></p>
                                        <p><strong>Alamat Lengkap:</strong> <span id="detailAlamatLengkap"></span></p>
                                        <p><strong>Kode Pos:</strong> <span id="detailKodePos"></span></p>
                                        <p><strong>Email:</strong> <span id="detailEmail"></span></p>
                                        <p><strong>Nama Orang Tua:</strong> <span id="detailNamaOrangTua"></span></p>
                                        <p><strong>Foto KTP/SIM:</strong> <br>
                                            <img id="detailFotoKTP" src="" alt="Foto KTP/SIM"
                                                style="width: 100px; height: auto;">
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#nasabahTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.nasabah.data') }}',
                    data: function(d) {
                        d.nama_lengkap = $('#namaFilter').val();
                        d.nomor_identitas = $('#identitasFilter').val();
                        d.tanggal_daftar = $('#tanggalDaftarFilter').val();
                        d.tanggal_akhir = $('#tanggalAkhirFilter').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nomor_identitas',
                        name: 'nomor_identitas'
                    },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap'
                    },
                    {
                        data: 'tempat_lahir',
                        name: 'tempat_lahir'
                    },
                    {
                        data: 'tanggal_lahir',
                        name: 'tanggal_lahir'
                    },
                    {
                        data: 'status_perkawinan',
                        name: 'status_perkawinan'
                    },
                    {
                        data: 'pekerjaan',
                        name: 'pekerjaan'
                    },
                    {
                        data: 'telepon',
                        name: 'telepon'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            var date = new Date(data);
                            return date.toLocaleDateString('id-ID', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric'
                            });
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            $('#filterButton').on('keyup click', function() {
                table.draw();
            });

            $('#resetButton').on('click', function() {
                $('#namaFilter').val('');
                $('#identitasFilter').val('');
                $('#tanggalDaftarFilter').val('');
                $('#tanggalAkhirFilter').val('');
                table.draw();
            });
        });

        var nasabahDetailModal = document.getElementById('nasabahDetailModal');
        nasabahDetailModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var nomorIdentitas = button.getAttribute('data-nomor_identitas');
            var namaLengkap = button.getAttribute('data-nama_lengkap');
            var tempatLahir = button.getAttribute('data-tempat_lahir');
            var tanggalLahir = button.getAttribute('data-tanggal_lahir');
            var statusPerkawinan = button.getAttribute('data-status_perkawinan');
            var pekerjaan = button.getAttribute('data-pekerjaan');
            var telepon = button.getAttribute('data-telepon');
            var tanggalDaftar = button.getAttribute('data-created_at');
            var alamatLengkap = button.getAttribute('data-alamat_lengkap');
            var kodePos = button.getAttribute('data-kode_pos');
            var email = button.getAttribute('data-email');
            var namaOrangTua = button.getAttribute('data-nama_orang_tua');
            var fotoKTP = button.getAttribute('data-foto_ktp_sim');

            document.querySelector('#detailNomorIdentitas').textContent = nomorIdentitas;
            document.querySelector('#detailNamaLengkap').textContent = namaLengkap;
            document.querySelector('#detailTempatLahir').textContent = tempatLahir;
            document.querySelector('#detailTanggalLahir').textContent = tanggalLahir;
            document.querySelector('#detailStatusPerkawinan').textContent = statusPerkawinan;
            document.querySelector('#detailPekerjaan').textContent = pekerjaan;
            document.querySelector('#detailTelepon').textContent = telepon;
            document.querySelector('#detailTanggalDaftar').textContent = tanggalDaftar;
            document.querySelector('#detailAlamatLengkap').textContent = alamatLengkap;
            document.querySelector('#detailKodePos').textContent = kodePos;
            document.querySelector('#detailEmail').textContent = email;
            document.querySelector('#detailNamaOrangTua').textContent = namaOrangTua;
            document.querySelector('#detailFotoKTP').src = fotoKTP;
        });
    </script>
@endsection
