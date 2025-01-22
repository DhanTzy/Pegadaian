@extends('layouts.app')

@section('title', 'Home Nasabah List')

@section('contents')

    <div class="content">
        <div>
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1 class="fw-bold fs-3">Daftar Data Nasabah</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="card mb-4">
                    <div class="card-header" style="display: flex; justify-content: center; align-items: center;">
                        <p class="fw-bold" id="current-info" style="margin: 0; font-size: 16px; color:red"></p>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('nasabah.create') }}" class="btn btn-primary float-left mb-3" style="background-color : #0095FF;"><i class="bi bi-plus-lg"></i> Tambah Daftar Nasabah</a>
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
                                        <th scope="col">Nama Lengkap</th>
                                        <th scope="col">NIK</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Kelurahan</th>
                                        <th scope="col">Kecamatan</th>
                                        <th scope="col">Kabupaten</th>
                                        <th scope="col">Propinsi</th>
                                        <th scope="col">Tempat Lahir</th>
                                        <th scope="col">Tanggal Lahir</th>
                                        <th scope="col">Telepon</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
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
                                        <p><strong>Nama Lengkap:</strong> <span id="detailNamaLengkap"></span></p>
                                        <p><strong>Nik:</strong> <span id="detailNomorIdentitas"></span></p>
                                        <p><strong>Alamat Lengkap:</strong> <span id="detailAlamatLengkap"></span></p>
                                        <p><strong>Kelurahan:</strong> <span id="detailKelurahan"></span></p>
                                        <p><strong>Kecamatan:</strong> <span id="detailKecamatan"></span></p>
                                        <p><strong>Kabupaten:</strong> <span id="detailKabupaten"></span></p>
                                        <p><strong>Propinsi:</strong> <span id="detailPropinsi"></span></p>
                                        <p><strong>Tempat Lahir:</strong> <span id="detailTempatLahir"></span></p>
                                        <p><strong>Tanggal Lahir:</strong> <span id="detailTanggalLahir"></span></p>
                                        <p><strong>Telepon:</strong> <span id="detailTelepon"></span></p>
                                        <p><strong>Tanggal Daftar:</strong> <span id="detailTanggalDaftar"></span></p>
                                        <p><strong>Pengajuan Pinjaman:</strong> <span id="detailPengajuanPinjaman"></span>
                                        </p>
                                        <p><strong>Jangka Waktu:</strong> <span id="detailJangkaWaktu"></span></p>
                                        <p><strong>Jenis Jaminan:</strong> <span id="detailJenisJaminan"></span></p>
                                        <p><strong>Foto KTP:</strong> <br>
                                            <img id="detailFotoKtp" src="" alt="Foto KTP/SIM"
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
        function updateTime() {
            const now = new Date();
            const dayString = now.toLocaleDateString('id-ID', {
                weekday: 'long'
            });
            const dateString = now.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
            const timeString = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
            const fullString = `${dayString}, ${dateString} . ${timeString}`;

            document.getElementById('current-info').innerText = fullString;
        }
        setInterval(updateTime, 1000);
        updateTime();

        $(document).ready(function() {
            var table = $('#nasabahTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('nasabah.data') }}',
                    data: function(d) {
                        d.nama_lengkap = $('#namaFilter').val();
                        d.nomor_identitas = $('#identitasFilter').val();
                        d.tanggal_daftar = $('#tanggalDaftarFilter').val();
                        d.tanggal_akhir = $('#tanggalAkhirFilter').val();
                    }
                },

                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'nama_lengkap', name: 'nama_lengkap' },
                    { data: 'nomor_identitas', name: 'nomor_identitas' },
                    { data: 'alamat_lengkap', name: 'alamat_lengkap' },
                    { data: 'kelurahan', name: 'kelurahan' },
                    { data: 'kecamatan', name: 'kecamatan' },
                    { data: 'kabupaten', name: 'kabupaten' },
                    { data: 'propinsi', name: 'propinsi' },
                    { data: 'tempat_lahir', name: 'tempat_lahir' },
                    { data: 'tanggal_lahir', name: 'tanggal_lahir' },
                    { data: 'telepon', name: 'telepon' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
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
            var namaLengkap = button.getAttribute('data-nama_lengkap');
            var nomorIdentitas = button.getAttribute('data-nomor_identitas');
            var alamatLengkap = button.getAttribute('data-alamat_lengkap');
            var kelurahan = button.getAttribute('data-kelurahan');
            var kecamatan = button.getAttribute('data-kecamatan');
            var kabupaten = button.getAttribute('data-kabupaten');
            var propinsi = button.getAttribute('data-propinsi');
            var tempatLahir = button.getAttribute('data-tempat_lahir');
            var tanggalLahir = button.getAttribute('data-tanggal_lahir');
            var telepon = button.getAttribute('data-telepon');
            var tanggalDaftar = button.getAttribute('data-created_at');
            var pengajuanPinjaman = button.getAttribute('data-pengajuan_pinjaman');
            var jangkaWaktu = button.getAttribute('data-jangka_waktu');
            var jenisJaminan = button.getAttribute('data-jenis_jaminan');
            var fotoKtp = button.getAttribute('data-foto_ktp');

            document.querySelector('#detailNamaLengkap').textContent = namaLengkap;
            document.querySelector('#detailNomorIdentitas').textContent = nomorIdentitas;
            document.querySelector('#detailAlamatLengkap').textContent = alamatLengkap;
            document.querySelector('#detailKelurahan').textContent = kelurahan;
            document.querySelector('#detailKecamatan').textContent = kecamatan;
            document.querySelector('#detailKabupaten').textContent = kabupaten;
            document.querySelector('#detailPropinsi').textContent = propinsi;
            document.querySelector('#detailTempatLahir').textContent = tempatLahir;
            document.querySelector('#detailTanggalLahir').textContent = tanggalLahir;
            document.querySelector('#detailTelepon').textContent = telepon;
            document.querySelector('#detailTanggalDaftar').textContent = tanggalDaftar;
            document.querySelector('#detailPengajuanPinjaman').textContent = pengajuanPinjaman;
            document.querySelector('#detailJangkaWaktu').textContent = jangkaWaktu;
            document.querySelector('#detailJenisJaminan').textContent = jenisJaminan;
            document.querySelector('#detailFotoKtp').src = fotoKtp;
        });
    </script>
@endsection
