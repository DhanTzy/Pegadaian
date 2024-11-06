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
                        <a href="{{ route('admin.nasabah.create') }}" class="btn btn-primary float-left mb-2">Input Data Nasabah</a>
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
                                <label for="tanggalJoinFilter" class="form-label mb-0">Tanggal Join :</label>
                                <input type="date" id="tanggalJoinFilter" class="form-control form-control-sm"
                                    style="width: auto;">
                            </div>

                            <div class="me-2">
                                <label for="tanggalAkhirFilter" class="form-label mb-0">Tanggal Akhir :</label>
                                <input type="date" id="tanggalAkhirFilter" class="form-control form-control-sm"
                                    style="width: auto;">
                            </div>

                            <button id="filterButton" class="btn btn-success btn-sm">Filter</button>
                        </div>
                        <table id="nasabahTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Id Nasabah/Nomor HP</th>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>Alamat Lengkap</th>
                                    <th>Kode Pos</th>
                                    <th>Pekerjaan</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <!-- Data dari ajax -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div> <!-- /.card-body -->
                    <div class="modal fade" id="nasabahDetailModal" tabindex="-1" aria-labelledby="nasabahDetailModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="nasabahDetailModalLabel">Detail Nasabah</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
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
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-end">
                            <li class="page-item"> <a class="page-link" href="#">&laquo;</a> </li>
                            <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                            <li class="page-item"> <a class="page-link" href="#">2</a> </li>
                            <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                            <li class="page-item"> <a class="page-link" href="#">&raquo;</a> </li>
                        </ul>
                    </div>
                </div> <!-- /.card -->
            </div> <!--end::App Content-->
            </main> <!--end::App Main--> <!--begin::Footer-->

            <!-- Include DataTables CSS and JS -->
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
                                d.tanggal_join = $('#tanggalJoinFilter').val();
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
                });

                var nasabahDetailModal = document.getElementById('nasabahDetailModal');
                nasabahDetailModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var alamatLengkap = button.getAttribute('data-alamat_lengkap');
                    var kodePos = button.getAttribute('data-kode_pos');
                    var email = button.getAttribute('data-email');
                    var namaOrangTua = button.getAttribute('data-nama_orang_tua');
                    var fotoKTP = button.getAttribute('data-foto_ktp_sim');

                    document.querySelector('#detailAlamatLengkap').textContent = alamatLengkap;
                    document.querySelector('#detailKodePos').textContent = kodePos;
                    document.querySelector('#detailEmail').textContent = email;
                    document.querySelector('#detailNamaOrangTua').textContent = namaOrangTua;
                    document.querySelector('#detailFotoKTP').src = fotoKTP;
                });
            </script>
        @endsection
