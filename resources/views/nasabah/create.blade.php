@extends('layouts.app')

@section('title', 'Home Nasabah List')

@section('contents')

<div class="content">
    <h1 class="fw-bold fs-3 text-center">Input Data Nasabah</h1>
    <div class="mb-4 pb-4 border-bottom">
        <form action="{{ route('nasabah.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input id="nama_lengkap" name="nama_lengkap" type="text" class="form-control"
                    value="{{ old('nama_lengkap') }}" placeholder="Nama Lengkap Anda" required>
                @error('nama_lengkap')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">NIK</label>
                <input id="nomor_identitas" name="nomor_identitas" type="text" class="form-control"
                    value="{{ old('nomor_identitas') }}" placeholder="Nomor Identitas Anda" required>
                @error('nomor_identitas')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="alamat_lengkap" rows="3" class="form-control" placeholder="Alamat Anda" required>{{ old('alamat_lengkap') }}</textarea>
                @error('alamat_lengkap')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Kelurahan</label>
                <input id="kelurahan" name="kelurahan" type="text" class="form-control" value="{{ old('kelurahan') }}"
                    placeholder="Kelurahan" required>
                @error('kelurahan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Kecamatan</label>
                <input id="kecamatan" name="kecamatan" type="text" class="form-control" value="{{ old('kecamatan') }}"
                    placeholder="kecamatan " required>
                @error('kecamatan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Kabupaten</label>
                <input id="kabupaten" name="kabupaten" type="text" class="form-control" value="{{ old('kabupaten') }}"
                    placeholder="kabupaten" required>
                @error('kabupaten')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Propinsi</label>
                <input id="propinsi" name="propinsi" type="text" class="form-control" value="{{ old('propinsi') }}"
                    placeholder="propinsi" required>
                @error('propinsi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control"
                        value="{{ old('tempat_lahir') }}"placeholder="Tempat Lahir Anda" required>
                    @error('tempat_lahir')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}"
                        required>
                    @error('tanggal_lahir')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" name="telepon" class="form-control" value="{{ old('telepon') }}"
                    placeholder="Nomor Telepon Anda" required>
                @error('telepon')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Foto KTP </label>
                <input type="file" name="foto_ktp" class="form-control" accept="image/*" required
                    onchange="previewImage(event)">
                @error('foto_ktp')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <img id="imagePreview" src="#" alt="Preview Foto"
                    style="display:none; margin-top:10px; max-width:200px;" />
            </div>

            <!-- Modal Konfirmasi -->
            <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Tambah Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menambah data ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" id="confirmSubmit">Ya</button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary w-20" style="background-color: #183354;" data-bs-toggle="modal"
                data-bs-target="#confirmModal"><i class="bi bi-send"></i> Tambah Data
            </button>
            <a href="{{ url('nasabah') }}" class="btn btn-danger w-20"><i class="bi bi-x-lg"></i> Batal</a>
        </form>
    </div>
</div>

    <script>
        document.getElementById('confirmSubmit').addEventListener('click', function() {
            document.querySelector('form').submit();
        });

        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function() {
                var imagePreview = document.getElementById('imagePreview');
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block';
            }

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
