@extends('layouts.app')

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

        <table id="myTable" class="table table-striped table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nomor Identitas</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Tempat Lahir</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Status Perkawinan</th>
                    <th scope="col">Pekerjaan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($nasabah->count() > 0)
                    @foreach ($nasabah as $rs)
                        <tr>
                            <td class="text-center">{{ $rs->id }}</td>
                            <td>{{ $rs->nomor_identitas }}</td>
                            <td>{{ $rs->nama_lengkap }}</td>
                            <td>{{ $rs->tempat_lahir }}</td>
                            <td>{{ $rs->tanggal_lahir }}</td>
                            <td>{{ $rs->status_perkawinan }}</td>
                            <td>{{ $rs->pekerjaan }}</td>

                            <td class="text-center">
                                <button type="button" class="btn btn-info btn-sm me-2" data-bs-toggle="modal"
                                    data-bs-target="#nasabahDetailModal"
                                    data-alamat_lengkap="{{ $rs->alamat_lengkap }}"
                                    data-kode_pos="{{ $rs->kode_pos }}"
                                    data-email="{{ $rs->email }}"
                                    data-telepon="{{ $rs->telepon }}"
                                    data-nama_orang_tua="{{ $rs->nama_orang_tua }}"
                                    data-foto_ktp_sim="{{ asset('storage/' . $rs->foto_ktp_sim) }}">
                                    Detail
                                </button>
                                <a href="{{ route('admin.nasabah.edit', $rs->id) }}"
                                    class="btn btn-success btn-sm me-2">Edit</a>
                                <form action="{{ route('admin.nasabah.destroy', $rs->id) }}" method="POST"
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
    <div class="modal fade" id="nasabahDetailModal" tabindex="-1" aria-labelledby="nasabahDetailModalLabel"
        aria-hidden="true">
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
                    <p><strong>Telepon:</strong> <span id="detailTelepon"></span></p>
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

    <script>
        var nasabahDetailModal = document.getElementById('nasabahDetailModal');
        nasabahDetailModal.addEventListener('show.bs.modal', function(event) {

            // Ambil data dari atribut
            var button = event.relatedTarget;
            var alamatLengkap = button.getAttribute('data-alamat_lengkap');
            var kodePos = button.getAttribute('data-kode_pos');
            var email = button.getAttribute('data-email');
            var telepon = button.getAttribute('data-telepon');
            var namaOrangTua = button.getAttribute('data-nama_orang_tua');
            var fotoKTP = button.getAttribute('data-foto_ktp_sim');

            // Menyimpan ke elemen modal
            var detailAlamatLengkap = nasabahDetailModal.querySelector('#detailAlamatLengkap');
            var detailKodePos = nasabahDetailModal.querySelector('#detailKodePos');
            var detailEmail = nasabahDetailModal.querySelector('#detailEmail');
            var detailTelepon = nasabahDetailModal.querySelector('#detailTelepon');
            var detailNamaOrangTua = nasabahDetailModal.querySelector('#detailNamaOrangTua');
            var detailFotoKTP = nasabahDetailModal.querySelector('#detailFotoKTP');


            detailAlamatLengkap.textContent = alamatLengkap;
            detailKodePos.textContent = kodePos;
            detailEmail.textContent = email;
            detailTelepon.textContent = telepon;
            detailNamaOrangTua.textContent = namaOrangTua;
            detailFotoKTP.src = fotoKTP;
        });
    </script>
@endsection
