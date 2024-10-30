@extends('admin.layouts.app')

@section('title', 'Home Nasabah List')

@section('contents')
    <div>
        <h1 class="fw-bold fs-3">Daftar Data Nasabah</h1>

        <a href="{{ route('admin.nasabah.create') }}" class="btn btn-primary float-left mb-2">Input Data Nasabah</a>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="mb-3 d-flex align-items-end">
            <div class="me-2">
                <label for="namaFilter" class="form-label mb-0">Nama Nasabah :</label>
                <input type="text" id="namaFilter" placeholder="Search Nama Nasabah" class="form-control form-control-sm me-2" style="width: auto;">
             </div>

             <div class="me-2">
                <label for="identitasFilter" class="form-label mb-0">Nomor Identitas :</label>
                <input type="text" id="identitasFilter" placeholder="Search Identitas" class="form-control form-control-sm me-2" style="width: auto;">
            </div>

            <div class="me-2">
                <label for="tanggalJoinFilter" class="form-label mb-0">Tanggal Join :</label>
                <input type="date" id="tanggalJoinFilter" class="form-control form-control-sm" style="width: auto;">
            </div>

            <div class="me-2">
                <label for="tanggalAkhirFilter" class="form-label mb-0">Tanggal Akhir :</label>
                <input type="date" id="tanggalAkhirFilter" class="form-control form-control-sm" style="width: auto;">
            </div>

            <button id="filterButton" class="btn btn-success btn-sm">Filter</button>
        </div>


        <table id="nasabahTable" class="table table-striped table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nomor Identitas</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Tempat Lahir</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Status Perkawinan</th>
                    <th scope="col">Pekerjaan</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be loaded here via AJAX -->
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="nasabahDetailModal" tabindex="-1" aria-labelledby="nasabahDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nasabahDetailModalLabel">Detail Nasabah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Alamat Lengkap:</strong> <span id="detailAlamatLengkap"></span></p>
                    <p><strong>Kode Pos:</strong> <span id="detailKodePos"></span></p>
                    <p><strong>Email:</strong> <span id="detailEmail"></span></p>
                    <p><strong>Nama Orang Tua:</strong> <span id="detailNamaOrangTua"></span></p>
                    <p><strong>Foto KTP/SIM:</strong> <br>
                        <img id="detailFotoKTP" src="" alt="Foto KTP/SIM" style="width: 100px; height: auto;">
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
            var table = $('#nasabahTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.nasabah.data") }}',
                    data: function(d) {
                        d.nama_lengkap = $('#namaFilter').val();
                        d.nomor_identitas = $('#identitasFilter').val();
                        d.tanggal_join = $('#tanggalJoinFilter').val();
                        d.tanggal_akhir = $('#tanggalAkhirFilter').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'nomor_identitas', name: 'nomor_identitas' },
                    { data: 'nama_lengkap', name: 'nama_lengkap' },
                    { data: 'tempat_lahir', name: 'tempat_lahir' },
                    { data: 'tanggal_lahir', name: 'tanggal_lahir' },
                    { data: 'status_perkawinan', name: 'status_perkawinan' },
                    { data: 'pekerjaan', name: 'pekerjaan' },
                    { data: 'telepon', name: 'telepon'},
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
            });

            $('#filterButton').on('keyup click', function(){
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
