@extends('layouts.app')

@section('title', 'Home Karyawan List')

@section('contents')
    <div>
        <h1 h1 class="fw-bold fs-3">Daftar Data Karyawan</h1>
        <a href="{{ route('admin.karyawan.create') }}" class="btn btn-primary float-left mb-2">Input Data Karyawan</a>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <table id="myTable" class="table table-striped table-bordered">
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
                @if ($karyawan->count() > 0)
                    @foreach ($karyawan as $rs)
                        <tr>
                            <td class="text-center">{{ $rs->id }}</td>
                            <td>{{ $rs->nama_lengkap }}</td>
                            <td>{{ $rs->posisi_pekerjaan }}</td>
                            <td>{{ $rs->jenis_kelamin }}</td>
                            <td>{{ $rs->tempat_lahir }}</td>
                            <td>{{ $rs->tanggal_lahir }}</td>
                            <td>{{ $rs->agama }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info btn-sm me-2" data-bs-toggle="modal"
                                    data-bs-target="#karyawanDetailModal"
                                    data-kewarganegaraan="{{ $rs->kewarganegaraan }}"
                                    data-status_perkawinan="{{ $rs->status_perkawinan }}"
                                    data-no_telepon="{{ $rs->no_telepon }}" data-email="{{ $rs->email }}"
                                    data-alamat_lengkap="{{ $rs->alamat_lengkap }}"
                                    data-kode_pos="{{ $rs->kode_pos }}"
                                    data-riwayat_pendidikan="{{ json_encode($rs->riwayatPendidikan) }}"
                                    data-foto_ktp="{{ asset('storage/' . $rs->foto_ktp) }}"
                                    data-foto_kk="{{ asset('storage/' . $rs->foto_kk) }}">
                                    Detail
                                </button>
                                <a href="{{ route('admin.karyawan.edit', $rs->id) }}"
                                    class="btn btn-success btn-sm me-2">Edit</a>
                                <form action="{{ route('admin.karyawan.destroy', $rs->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda Yakin Menghapus Data Ini?')" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    
                @endif
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

    <script>
        var karyawanDetailModal = document.getElementById('karyawanDetailModal');
        karyawanDetailModal.addEventListener('show.bs.modal', function(event) {

            var button = event.relatedTarget;
            // Ambil data dari atribut
            var kewarganegaraan = button.getAttribute('data-kewarganegaraan');
            var statusPerkawinan = button.getAttribute('data-status_perkawinan');
            var noTelepon = button.getAttribute('data-no_telepon');
            var email = button.getAttribute('data-email');
            var alamatLengkap = button.getAttribute('data-alamat_lengkap');
            var kodePos = button.getAttribute('data-kode_pos');
            var riwayatPendidikan = JSON.parse(button.getAttribute('data-riwayat_pendidikan')); // Mengubah ke JSON
            var fotoKTP = button.getAttribute('data-foto_ktp');
            var fotoKK = button.getAttribute('data-foto_kk');

            // Menyimpan ke elemen modal
            karyawanDetailModal.querySelector('#detailKewarganegaraan').textContent = kewarganegaraan;
            karyawanDetailModal.querySelector('#detailStatusPerkawinan').textContent = statusPerkawinan;
            karyawanDetailModal.querySelector('#detailNoTelepon').textContent = noTelepon;
            karyawanDetailModal.querySelector('#detailEmail').textContent = email;
            karyawanDetailModal.querySelector('#detailAlamatLengkap').textContent = alamatLengkap;
            karyawanDetailModal.querySelector('#detailKodePos').textContent = kodePos;
            // Menampilkan foto
            karyawanDetailModal.querySelector('#detailFotoKTP').src = fotoKTP;
            karyawanDetailModal.querySelector('#detailFotoKK').src = fotoKK;

            // Menampilkan riwayat pendidikan
            var detailRiwayatPendidikan = karyawanDetailModal.querySelector('#detailRiwayatPendidikan');
            detailRiwayatPendidikan.innerHTML = ""; // Bersihkan konten yang ada

            riwayatPendidikan.forEach(function(pendidikan) {
                let pendidikanDetail = [];

                // Tambahkan detail pendidikan jika ada
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
                // Gabungkan detail pendidikan menjadi string
                if (pendidikanDetail.length > 0) {
                    detailRiwayatPendidikan.innerHTML += pendidikanDetail.join(", ") + "<br>";
                }
            });
        });
    </script>
@endsection
