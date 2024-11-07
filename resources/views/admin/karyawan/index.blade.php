@extends('admin.layouts.app')

@section('title', 'Home Karyawan List')

@section('contents')
    <div class="content">
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1 class="fw-bold fs-3">Daftar Data Karyawan</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Bordered Table</h3>
                    </div>
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
                                    <label for="nipFilter" class="form-label mb-0">NIP :</label>
                                    <input type="text" id="nipFilter" placeholder="Nomor Induk Pegawai"
                                        class="form-control form-control-sm me-2" style="width: auto;">
                                </div>

                                <div class="me-2">
                                    <label for="pekerjaanFilter" class="form-label mb-0">Pekerjaan :</label>
                                    <select id="pekerjaanFilter" class="form-select form-select-sm me-2">
                                        <option value=""> -- Pilih Pekerjaan --</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Administrasi">Administrasi</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Approval">Approval</option>
                                        <option value="Appraisal">Appraisal</option>
                                        <option value="Kasir">Kasir</option>
                                        <option value="Customer Service">Customer Service</option>
                                        <option value="Security">Security</option>
                                    </select>
                                </div>

                                <div class="me-2">
                                    <label for="tanggalGabungFilter" class="form-label mb-0">Tanggal Gabung :</label>
                                    <input type="date" id="tanggalGabungFilter" class="form-control form-control-sm"
                                        style="width: auto;">
                                </div>

                                <button id="filterButton" class="btn btn-success btn-sm">Filter</button>
                                <button id="resetButton" class="btn btn-secondary btn-sm ms-2">Reset</button>
                            </div>

                            <table id="karyawanTable" class="table table-striped table-bordered">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">NIP</th>
                                        <th scope="col">Nama Lengkap</th>
                                        <th scope="col">Posisi Pekerjaan</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Kewarganegaraan</th>
                                        <th scope="col">Agama</th>
                                        <th scope="col">Telepon</th>
                                        <th scope="col">Tanggal Gabung</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be loaded here via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div class="modal fade" id="karyawanDetailModal" tabindex="-1" aria-labelledby="karyawanDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="karyawanDetailModalLabel">Detail Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nip :</strong> <span id="detailNip"></span></p>
                    <p><strong>Nama Lengkap :</strong> <span id="detailNamaLengkap"></span></p>
                    <p><strong>Posisi Pekerjaan :</strong> <span id="detailPosisiPekerjaan"></span></p>
                    <p><strong>Jenis Kelamin :</strong> <span id="detailJenisKelamin"></span></p>
                    <p><strong>Tempat Lahir :</strong> <span id="detailTempatLahir"></span></p>
                    <p><strong>Tanggal Lahir :</strong> <span id="detailTanggalLahir"></span></p>
                    <p><strong>Agama :</strong> <span id="detailAgama"></span></p>
                    <p><strong>Telepon :</strong> <span id="detailNoTelepon"></span></p>
                    <p><strong>Tanggal Gabung :</strong> <span id="detailTanggalGabung"></span></p>
                    <p><strong>Kewarganegaraan :</strong> <span id="detailKewarganegaraan"></span></p>
                    <p><strong>Status Perkawinan :</strong> <span id="detailStatusPerkawinan"></span></p>
                    <p><strong>Email :</strong> <span id="detailEmail"></span></p>
                    <p><strong>Alamat Lengkap :</strong> <span id="detailAlamatLengkap"></span></p>
                    <p><strong>Kode Pos :</strong> <span id="detailKodePos"></span></p>
                    <p><strong>Anggota Keluarga :</strong></p>
                    <ul id="detailAnggotaKeluarga">
                        <!-- Daftar anggota keluarga akan dimuat di sini -->
                    </ul>
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
                        d.nip = $('#nipFilter').val();
                        d.posisi_pekerjaan = $('#pekerjaanFilter').val();
                        d.tanggal_gabung = $('#tanggalGabungFilter').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nip',
                        name: 'nip'
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
                        data: 'kewarganegaraan',
                        name: 'kewarganegaraan'
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
                $('#nipFilter').val('');
                $('#pekerjaanFilter').val('');
                $('#tanggalGabungFilter').val('');
                table.draw();
            });
        });


        // Script untuk modal detail karyawan
        var karyawanDetailModal = document.getElementById('karyawanDetailModal');
        karyawanDetailModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var nip = button.getAttribute('data-nip');
            var namaLengkap = button.getAttribute('data-nama_lengkap');
            var posisiPekerjaan = button.getAttribute('data-posisi_pekerjaan');
            var jenisKelamin = button.getAttribute('data-jenis_kelamin');
            var tempatLahir = button.getAttribute('data-tempat_lahir');
            var tanggalLahir = button.getAttribute('data-tanggal_lahir');
            var agama = button.getAttribute('data-agama');
            var noTelepon = button.getAttribute('data-no_telepon');
            var tanggalGabung = button.getAttribute('data-created_at');
            var kewarganegaraan = button.getAttribute('data-kewarganegaraan');
            var statusPerkawinan = button.getAttribute('data-status_perkawinan');
            var email = button.getAttribute('data-email');
            var alamatLengkap = button.getAttribute('data-alamat_lengkap');
            var kodePos = button.getAttribute('data-kode_pos');
            var anggotaKeluarga = JSON.parse(button.getAttribute('data-anggota_keluarga'));
            var fotoKTP = button.getAttribute('data-foto_ktp');
            var fotoKK = button.getAttribute('data-foto_kk');

            karyawanDetailModal.querySelector('#detailNip').textContent = nip;
            karyawanDetailModal.querySelector('#detailNamaLengkap').textContent = namaLengkap;
            karyawanDetailModal.querySelector('#detailPosisiPekerjaan').textContent = posisiPekerjaan;
            karyawanDetailModal.querySelector('#detailJenisKelamin').textContent = jenisKelamin;
            karyawanDetailModal.querySelector('#detailTempatLahir').textContent = tempatLahir;
            karyawanDetailModal.querySelector('#detailTanggalLahir').textContent = tanggalLahir;
            karyawanDetailModal.querySelector('#detailAgama').textContent = agama;
            karyawanDetailModal.querySelector('#detailNoTelepon').textContent = noTelepon;
            karyawanDetailModal.querySelector('#detailTanggalGabung').textContent = tanggalGabung;
            karyawanDetailModal.querySelector('#detailKewarganegaraan').textContent = kewarganegaraan;
            karyawanDetailModal.querySelector('#detailStatusPerkawinan').textContent = statusPerkawinan;
            karyawanDetailModal.querySelector('#detailEmail').textContent = email;
            karyawanDetailModal.querySelector('#detailAlamatLengkap').textContent = alamatLengkap;
            karyawanDetailModal.querySelector('#detailKodePos').textContent = kodePos;
            karyawanDetailModal.querySelector('#detailFotoKTP').src = fotoKTP;
            karyawanDetailModal.querySelector('#detailFotoKK').src = fotoKK;
            // Menampilkan anggota keluarga
            var anggotaKeluargaList = karyawanDetailModal.querySelector('#detailAnggotaKeluarga');
            anggotaKeluargaList.innerHTML = ''; // reset dulu

            anggotaKeluarga.forEach(function(anggota) {
                var div = document.createElement('div'); // Ganti li dengan div untuk menampilkan vertikal

                // Membuat elemen paragraf untuk setiap data
                var statusKekeluargaan = document.createElement('p');
                statusKekeluargaan.textContent = `* Status Kekeluargaan : ${anggota.status_kekeluargaan}`;

                var nama = document.createElement('p');
                nama.textContent = `Nama : ${anggota.nama}`;

                var nik = document.createElement('p');
                nik.textContent = `NIK : ${anggota.nik}`;

                // Menambahkan paragraf ke dalam div
                div.appendChild(statusKekeluargaan);
                div.appendChild(nama);
                div.appendChild(nik);

                // Menambahkan div ke dalam list anggota keluarga
                anggotaKeluargaList.appendChild(div);
            });
        });
    </script>
@endsection
