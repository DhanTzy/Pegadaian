@extends('admin.layouts.app')

@section('title', 'Home Karyawan List')

@section('contents')
    <div>
        <h1 class="fw-bold fs-3">Daftar Data Karyawan</h1>
        <a href="{{ route('admin.karyawan.create') }}" class="btn btn-primary float-left mb-2">Input Data Karyawan</a>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <table id="karyawanTable" class="table table-striped table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th scope="col">ID Karyawan</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Posisi Pekerjaan</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Tempat Lahir</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Agama</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be loaded here via AJAX -->
            </tbody>
        </table>
    </div>

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
                    <p><strong>No Telepon :</strong> <span id="detailNoTelepon"></span></p>
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

    <!-- Include DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#karyawanTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("admin.karyawan.data") }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'nama_lengkap', name: 'nama_lengkap' },
                    { data: 'posisi_pekerjaan', name: 'posisi_pekerjaan'},
                    { data: 'jenis_kelamin', name: 'jenis_kelamin' },
                    { data: 'tempat_lahir', name: 'tempat_lahir' },
                    { data: 'tanggal_lahir', name: 'tanggal_lahir' },
                    { data: 'agama', name: 'agama' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, },
                ],
            });
        });

        // Script untuk modal detail karyawan
        var karyawanDetailModal = document.getElementById('karyawanDetailModal');
        karyawanDetailModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var kewarganegaraan = button.getAttribute('data-kewarganegaraan');
            var statusPerkawinan = button.getAttribute('data-status_perkawinan');
            var noTelepon = button.getAttribute('data-no_telepon');
            var email = button.getAttribute('data-email');
            var alamatLengkap = button.getAttribute('data-alamat_lengkap');
            var kodePos = button.getAttribute('data-kode_pos');
            var riwayatPendidikan = JSON.parse(button.getAttribute('data-riwayat_pendidikan'));
            var fotoKTP = button.getAttribute('data-foto_ktp');
            var fotoKK = button.getAttribute('data-foto_kk');

            karyawanDetailModal.querySelector('#detailKewarganegaraan').textContent = kewarganegaraan;
            karyawanDetailModal.querySelector('#detailStatusPerkawinan').textContent = statusPerkawinan;
            karyawanDetailModal.querySelector('#detailNoTelepon').textContent = noTelepon;
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
