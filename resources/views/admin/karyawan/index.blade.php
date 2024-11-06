@extends('admin.layouts.app')

@section('title', 'Home Karyawan List')

@section('contents')
    <div class="content">
        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h1 class="fw-bold fs-3">Daftar Data Karyawan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <button class="btn btn-primary">Tambah Karyawan</button>
                            </ol>
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
                        <a href="{{ route('admin.karyawan.create') }}" class="btn btn-primary float-left mb-2">Input Data
                            Karyawan</a>
                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <div class="mb-3 d-flex align-items-end">
                                <div class="me-2">
                                    <label for="namaFilter" class="form-label mb-0">Nama Lengkap :</label>
                                    <input type="text" id="namaFilter" placeholder="Search Nama Karyawan"
                                        class="form-control form-control-sm me-2" style="width: auto;">
                                </div>

                                <div class="me-2">
                                    <label for="pekerjaanFilter" class="form-label mb-0">Pekerjaan :</label>
                                    <select id="pekerjaanFilter" class="form-select form-select-sm me-2">
                                        <option value=""> -- Pilih Pekerjaan --</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Administrasi">Administrasi</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Marketing Officer">Marketing Officer</option>
                                        <option value="Collection Officer">Collection Officer</option>
                                        <option value="Kasir">Kasir</option>
                                        <option value="Customer Service">Customer Service</option>
                                        <option value="Teller">Teller</option>
                                        <option value="Security">Security</option>
                                    </select>
                                </div>

                                <div class="me-2">
                                    <label for="tanggalGabungFilter" class="form-label mb-0">Tanggal Gabung :</label>
                                    <input type="date" id="tanggalGabungFilter" class="form-control form-control-sm"
                                        style="width: auto;">
                                </div>

                                <button id="filterButton" class="btn btn-success btn-sm">Filter</button>
                            </div>
                            <table id="karyawanTable" class="table table-bordered" style="margin-top: 10px; margin-bottom: 10px">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Lengkap</th>
                                        <th>Posisi Pekerjaan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Agama</th>
                                        <th>No. Telp.</th>
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

            <!-- Modal -->
            <div class="modal fade" id="karyawanDetailModal" tabindex="-1" aria-labelledby="karyawanDetailModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="karyawanDetailModalLabel">Detail Karyawan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Kewarganegaraan :</strong> <span id="detailKewarganegaraan"></span></p>
                            <p><strong>Status Perkawinan :</strong> <span id="detailStatusPerkawinan"></span></p>
                            <p><strong>Email :</strong> <span id="detailEmail"></span></p>
                            <p><strong>Alamat Lengkap :</strong> <span id="detailAlamatLengkap"></span></p>
                            <p><strong>Kode Pos :</strong> <span id="detailKodePos"></span></p>
                            <p><strong>Riwayat Pendidikan :</strong> <span id="detailRiwayatPendidikan"></span></p>
                            <p><strong>Foto KTP :</strong> <br>
                                <img id="detailFotoKTP" src="" alt="Foto KTP" style="width: 100px; height: auto;">
                            </p>
                            <p><strong>Foto KK:</strong> <br>
                                <img id="detailFotoKK" src="" alt="Foto KK" style="width: 100px; height: auto;">
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main> <!--end::App Main--> <!--begin::Footer-->



    <!-- Include DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#karyawanTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.karyawan.data') }}',
                    data: function(d) {
                        d.nama_lengkap = $('#namaFilter').val(); // Mengirimkan filter ke server
                        d.posisi_pekerjaan = $('#pekerjaanFilter').val();
                        d.tanggal_gabung = $('#tanggalGabungFilter').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap'
                    },
                    {
                        data: 'posisi_pekerjaan',
                        name: 'posisi_pekerjaan'
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin'
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
                        data: 'agama',
                        name: 'agama'
                    },
                    {
                        data: 'no_telepon',
                        name: 'no_telepon'
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


        // Script untuk modal detail karyawan
        var karyawanDetailModal = document.getElementById('karyawanDetailModal');
        karyawanDetailModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var kewarganegaraan = button.getAttribute('data-kewarganegaraan');
            var statusPerkawinan = button.getAttribute('data-status_perkawinan');
            var email = button.getAttribute('data-email');
            var alamatLengkap = button.getAttribute('data-alamat_lengkap');
            var kodePos = button.getAttribute('data-kode_pos');
            var riwayatPendidikan = JSON.parse(button.getAttribute('data-riwayat_pendidikan'));
            var fotoKTP = button.getAttribute('data-foto_ktp');
            var fotoKK = button.getAttribute('data-foto_kk');

            karyawanDetailModal.querySelector('#detailKewarganegaraan').textContent = kewarganegaraan;
            karyawanDetailModal.querySelector('#detailStatusPerkawinan').textContent = statusPerkawinan;
            karyawanDetailModal.querySelector('#detailEmail').textContent = email;
            karyawanDetailModal.querySelector('#detailAlamatLengkap').textContent = alamatLengkap;
            karyawanDetailModal.querySelector('#detailKodePos').textContent = kodePos;

            var detailRiwayatPendidikan = karyawanDetailModal.querySelector('#detailRiwayatPendidikan');
            detailRiwayatPendidikan.innerHTML = ""; // Bersihkan konten yang ada

            riwayatPendidikan.forEach(function(pendidikan) {
                let pendidikanDetail = [];
                if (pendidikan.pendidikan) {
                    pendidikanDetail.push("Pendidikan : " + pendidikan.pendidikan);
                }
                if (pendidikan.jurusan) {
                    pendidikanDetail.push("Jurusan : " + pendidikan.jurusan);
                }
                if (pendidikan.jenjang_pendidikan) {
                    pendidikanDetail.push("Jenjang Pendidikan : " + pendidikan.jenjang_pendidikan);
                }
                if (pendidikan.tahun_lulus) {
                    pendidikanDetail.push("Tahun Lulus : " + pendidikan.tahun_lulus);
                }
                if (pendidikan.ipk_nilai) {
                    pendidikanDetail.push("Nilai IPK: " + pendidikan.ipk_nilai);
                }
                if (pendidikanDetail.length > 0) {
                    detailRiwayatPendidikan.innerHTML += pendidikanDetail.join(", ") + "<br>";
                }
            });

            karyawanDetailModal.querySelector('#detailFotoKTP').src = fotoKTP;
            karyawanDetailModal.querySelector('#detailFotoKK').src = fotoKK;
        });
    </script>
@endsection
