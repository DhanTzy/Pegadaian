@extends('admin.layouts.app')

@section('title', 'Home Transaksi List')

@section('contents')
    <div>
        <h1 class="fw-bold fs-3">Daftar Data Transaksi</h1>

        <a href="{{ route('admin.transaksi.create') }}" class="btn btn-primary float-left mb-2">Input Data Transaksi</a>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="mb-3">
            <input type="text" id="namaFilter" placeholder="Search Nama Lengkap" class="form-control form-control-sm d-inline-block" style="width: auto;">
        </div>
        <button id="filterButton" class="btn btn-success btn-sm me-2">Filter</button>

        <table id="transaksiTable" class="table table-striped table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nama Nasabah</th>
                    <th>Tanggal</th>
                    <th>Metode Pencairan</th>
                    <th>Jumlah Pinjaman</th>
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

    <!-- Modal -->
    <div class="modal fade" id="transaksiDetailModal" tabindex="-1" aria-labelledby="transaksiDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transaksiDetailModalLabel">Detail Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>No Rekening:</strong> <span id="detailNoRekening"></span></p>
                    <p><strong>Bank:</strong> <span id="detailBank"></span></p>
                    <p><strong>Foto Jaminan:</strong> <br>
                        <div id="detailFotoJaminan" style="display: flex; flex-wrap: wrap;"></div>
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
            var table = $('#transaksiTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.transaksi.data") }}',
                    data: function(d) {
                        d.nama_nasabah = $('#namaFilter').val(); // Mengirimkan filter ke server
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'nama_nasabah', name: 'nama_nasabah' },
                    { data: 'tanggal', name: 'tanggal' },
                    { data: 'metode_pencairan', name: 'metode_pencairan' },
                    { data: 'jumlah_pinjaman', name: 'jumlah_pinjaman' },
                    { data: 'bunga', name: 'bunga' },
                    { data: 'jangka_waktu', name: 'jangka_waktu'},
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
            });

            $('#filterButton').on('click', function(){
                table.draw();
            });
        });


        var transaksiDetailModal = document.getElementById('transaksiDetailModal');
        transaksiDetailModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var noRekening = button.getAttribute('data-no_rekening');
            var bank = button.getAttribute('data-bank');
            var fotoJaminan = button.getAttribute('data-foto_jaminan');

            document.querySelector('#detailNoRekening').textContent = noRekening;
            document.querySelector('#detailBank').textContent = bank;

            // Tampilkan semua foto jaminan
            document.querySelector('#detailFotoJaminan').innerHTML = fotoJaminan; // Menggunakan innerHTML untuk menampilkan beberapa gambar
        });

    </script>
@endsection
