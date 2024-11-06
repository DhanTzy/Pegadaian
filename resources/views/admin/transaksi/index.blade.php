@extends('admin.layouts.app')

@section('title', 'Home Transaksi List')

@section('contents')
    <div class="content">
        <div>
            <main class="app-main"> <!--begin::App Content Header-->
                <div class="app-content-header"> <!--begin::Container-->
                    <div class="container-fluid"> <!--begin::Row-->
                        <div class="row">
                            <div class="col-sm-6">
                                <h1 class="fw-bold fs-3">Daftar Data Transaksi</h1>
                            </div>
                        </div> <!--end::Row-->
                    </div> <!--end::Container-->
                </div> <!--end::App Content Header--> <!--begin::App Content-->
                <div class="app-content">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Bordered Table</h3>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('admin.transaksi.create') }}" class="btn btn-primary float-left mb-2">Input
                                Data Transaksi</a>
                            @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            <div class="table-responsive">
                                <div class="mb-3 d-flex align-items-end">
                                    <div class="me-2">
                                        <label for="namaFilter" class="form-label mb-0">Nama Nasabah :</label>
                                        <input type="text" id="namaFilter" placeholder="Search Nama" class="form-control form-control-sm me-2" style="width: auto;">
                                     </div>

                                     <div class="me-2">
                                        <label for="transaksiFilter" class="form-label mb-0">Tanggal Transaksi :</label>
                                        <input type="date" id="transaksiFilter" class="form-control form-control-sm" style="width: auto;">
                                    </div>

                                    <div class="me-2">
                                        <input type="date" id="tanggalFilter" class="form-control form-control-sm" style="width: auto;">
                                    </div>

                                    <div class="me-2">
                                        <label for="rekeningFilter" class="form-label mb-0">Rekening :</label>
                                        <input type="text" id="rekeningFilter" placeholder="Search Rekening" class="form-control form-control-sm me-2" style="width: auto;">
                                    </div>

                                    <div class="me-2">
                                        <label for="metodeFilter" class="form-label mb-0">Metode Pencairan :</label>
                                        <select id="metodeFilter" class="form-select form-select-sm me-2">
                                            <option value=""> -- Pilih Metode Pencairan -- </option>
                                            <option value="Transfer">Transfer</option>
                                            <option value="Cash">Cash</option>
                                        </select>
                                    </div>

                                    <div class="me-2">
                                        <label for="jangkaFilter" class="form-label mb-0">Jangka Waktu :</label>
                                        <select id="jangkaFilter" class="form-select form-select-sm me-2">
                                            <option value=""> -- Pilih Jangka Waktu -- </option>
                                            <option value="1 Bulan">1 Bulan</option>
                                            <option value="4 Bulan">4 Bulan</option>
                                            <option value="8 Bulan">8 Bulan</option>
                                        </select>
                                     </div>

                                    <button id="filterButton" class="btn btn-success btn-sm">Filter</button>
                                    <button id="resetButton" class="btn btn-secondary btn-sm ms-2">Reset</button>
                                </div>

                                <table id="transaksiTable" class="table table-striped table-bordered">
                                    <thead class="table-dark text-center">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Nasabah</th>
                                            <th>Tanggal</th>
                                            <th>Metode Pencairan</th>
                                            <th>No Rekening</th>
                                            <th>Bank</th>
                                            <th>Pengajuan Pinjaman</th>
                                            <th>Bunga</th>
                                            <th>Jangka Waktu</th>
                                            <th>Action</th>
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


    </div>

    <!-- Modal -->
    <div class="modal fade" id="transaksiDetailModal" tabindex="-1" aria-labelledby="transaksiDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transaksiDetailModalLabel">Detail Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama Nasabah :</strong> <span id="detailNamaNasabah"></span></p>
                    <p><strong>Tanggal :</strong> <span id="detailTanggal"></span></p>
                    <p><strong>Metode Pencairan :</strong> <span id="detailMetodePencairan"></span></p>
                    <p><strong>Nomor Rekening :</strong> <span id="detailNoRekening"></span></p>
                    <p><strong>Bank :</strong> <span id="detailBank"></span></p>
                    <p><strong>Pengajuan Pinjaman :</strong> <span id="detailPengajuanPinjaman"></span></p>
                    <p><strong>Bunga :</strong> <span id="detailBunga"></span></p>
                    <p><strong>Jangka Waktu :</strong> <span id="detailJangkaWaktu"></span></p>
                    <p><strong>Foto Jaminan (Barang) :</strong> <br>
                        <div id="detailFotoJaminan" style="display: flex; flex-wrap: wrap;"></div>
                    </p>
                    <p><strong>Jenis Agunan :</strong> <span id="detailJenisAgunan"></span></p>
                    <p><strong>Nilai Pasar Agunan :</strong> <span id="detailNilaiPasar"></span></p>
                    <p><strong>NIlai Likuiditas Agunan :</strong> <span id="detailNilaiLikuiditas"></span></p>
                    <p><strong>Catatan Barang :</strong> <span id="detailCatatan"></span></p>
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
            var table = $('#transaksiTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.transaksi.data") }}',
                    data: function(d) {
                        d.nama_nasabah = $('#namaFilter').val();
                        d.tanggal_transaksi = $('#transaksiFilter').val();
                        d.tanggal = $('#tanggalFilter').val();
                        d.jangka_waktu = $('#jangkaFilter').val();
                        d.no_rekening = $('#rekeningFilter').val(); // Mengirimkan filter ke server
                        d.metode_pencairan = $('#metodeFilter').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'nama_nasabah', name: 'nama_nasabah' },
                    { data: 'tanggal', name: 'tanggal' },
                    { data: 'metode_pencairan', name: 'metode_pencairan' },
                    { data: 'no_rekening', name: 'no_rekening'},
                    { data: 'bank', name: 'bank'},
                    { data: 'pengajuan_pinjaman', name: 'pengajuan_pinjaman' },
                    { data: 'bunga', name: 'bunga' },
                    { data: 'jangka_waktu', name: 'jangka_waktu'},
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
            });

            $('#filterButton').on(' keyup click', function(){
                table.draw();
            });

            $('#resetButton').on('click', function(){
                $('#namaFilter').val('');
                $('#transaksiFilter').val('');
                $('#tanggalFilter').val('');
                $('#jangkaFilter').val('');
                $('#rekeningFilter').val('');
                $('#metodeFilter').val('');
                table.draw();
            });
        });

        var transaksiDetailModal = document.getElementById('transaksiDetailModal');
        transaksiDetailModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var namaNasabah = button.getAttribute('data-nama_nasabah');
            var tanggal = button.getAttribute('data-tanggal');
            var metodePencairan = button.getAttribute('data-metode_pencairan');
            var noRekening = button.getAttribute('data-no_rekening');
            var bank = button.getAttribute('data-bank');
            var pengajuanPinjaman = button.getAttribute('data-pengajuan_pinjaman');
            var bunga = button.getAttribute('data-bunga');
            var jangkaWaktu = button.getAttribute('data-jangka_waktu');
            var jenisAgunan = button.getAttribute('data-jenis_agunan');
            var nilaiPasar = button.getAttribute('data-nilai_pasar');
            var nilaiLikuiditas = button.getAttribute('data-nilai_likuiditas');
            var catatan = button.getAttribute('data-catatan');
            var fotoJaminan = button.getAttribute('data-foto_jaminan');

            // Tampilkan semua foto jaminan
            document.querySelector('#detailNamaNasabah').textContent = namaNasabah;
            document.querySelector('#detailTanggal').textContent = tanggal;
            document.querySelector('#detailMetodePencairan').textContent = metodePencairan;
            document.querySelector('#detailNoRekening').textContent = noRekening;
            document.querySelector('#detailBank').textContent = bank;
            document.querySelector('#detailPengajuanPinjaman').textContent = pengajuanPinjaman;
            document.querySelector('#detailBunga').textContent = bunga;
            document.querySelector('#detailJangkaWaktu').textContent = jangkaWaktu;
            document.querySelector('#detailJenisAgunan').textContent = jenisAgunan;
            document.querySelector('#detailNilaiPasar').textContent = nilaiPasar;
            document.querySelector('#detailNilaiLikuiditas').textContent = nilaiLikuiditas;
            document.querySelector('#detailCatatan').textContent = catatan;
            document.querySelector('#detailFotoJaminan').innerHTML = fotoJaminan; // Menggunakan innerHTML untuk menampilkan beberapa gambar
        });
    </script>
@endsection
