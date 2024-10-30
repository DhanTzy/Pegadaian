@extends('admin.layouts.app')

@section('title', 'Create Nasabah')

@section('contents')
<div class="content">
    <h1 class="fw-bold fs-3 text-center">Input Data Nasabah</h1>
    <div class="mb-4 pb-4 border-bottom">
        <form action="{{ route('admin.nasabah.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Identitas yang Dipakai</label>
                <div>
                    <input type="radio" name="identitas" value="KTP" {{ old('identitas') == 'KTP' ? 'checked' : '' }}>KTP
                    <input type="radio" name="identitas" value="SIM"
                        {{ old('identitas') == 'SIM' ? 'checked' : '' }}>SIM
                </div>
                @error('identitas')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor Identitas (KTP/SIM)</label>
                <input id="nomor_identitas" name="nomor_identitas" type="text" class="form-control"
                    value="{{ old('nomor_identitas') }}" placeholder="Nomor Identitas Anda" required>
                @error('nomor_identitas')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input id="nama_lengkap" name="nama_lengkap" type="text" class="form-control"
                    value="{{ old('nama_lengkap') }}" placeholder="Nama Lengkap Anda" required>
                @error('nama_lengkap')
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
                <label class="form-label">Status Perkawinan</label>
                <div class="input-group">
                    <select name="status_perkawinan" class="form-select" required>
                        <option value="" disabled selected>Pilih Status Perkawinan</option>
                        <option value="Belum Menikah" {{ old('status_perkawinan') == 'Belum Menikah' ? 'selected' : '' }}>
                            Belum Menikah</option>
                        <option value="Menikah" {{ old('status_perkawinan') == 'Menikah' ? 'selected' : '' }}>Menikah
                        </option>
                    </select>

                </div>
                @error('status_perkawinan')
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
                <label class="form-label">Kode Pos</label>
                <input id="kode_pos" name="kode_pos" type="text" class="form-control" value="{{ old('kode_pos') }}"
                    placeholder="Kode Pos Anda" required>
                @error('kode_pos')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Pekerjaan</label>
                <input id="pekerjaan" name="pekerjaan" type="text" class="form-control" value="{{ old('pekerjaan') }}"
                    placeholder="Pekerjaan Anda" required>
                @error('pekerjaan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}"
                    placeholder="Email Anda" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
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
                <label class="form-label">Nama Orang Tua (Ayah/Ibu)</label>
                <input id="nama_orang_tua" name="nama_orang_tua" type="text" class="form-control"
                    value="{{ old('nama_orang_tua') }}" placeholder="Nama Orang Tua Anda" required>
                @error('nama_orang_tua')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Foto KTP/SIM</label>
                <input type="file" name="foto_ktp_sim" class="form-control" accept="image/*" required
                    onchange="previewImage(event)">
                @error('foto_ktp_sim')
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
            <button type="button" class="btn btn-primary w-20" data-bs-toggle="modal"
                data-bs-target="#confirmModal">Tambah Data
            </button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary w-20">Kembali</a>
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
