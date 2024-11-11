@extends('admin.layouts.app')

@section('title', 'Profile Settings')

@section('contents')
    <div class="content">
        @if (session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
        @endif

        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.profile.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="image" class="form-label">Foto Profile :</label>
                <input id="image" name="image" type="file" class="form-control @error('image') is-invalid @enderror"
                    accept="image/*" onchange="previewImage(event)" />
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <img id="preview"
                    src="{{ auth()->user()->image ? asset('storage/profile_images/' . auth()->user()->image) : '' }}"
                    alt="Preview" width="100" class="mt-2" />
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name :</label>
                <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}"
                    class="form-control @error('name') is-invalid @enderror" required />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- NIP Field -->
            <div class="mb-3">
                <label for="nip" class="form-label">NIP :</label>
                <input id="nip" name="nip" type="text"
                    value="{{ old('nip', auth()->user()->profile ? auth()->user()->profile->nip : '') }}"
                    class="form-control @error('nip') is-invalid @enderror" />
                @error('nip')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nomor Identitas Field -->
            <div class="mb-3">
                <label for="nomor_identitas" class="form-label">Nomor Identitas :</label>
                <input id="nomor_identitas" name="nomor_identitas" type="text"
                    value="{{ old('nomor_identitas', auth()->user()->profile ? auth()->user()->profile->nomor_identitas : '') }}"
                    class="form-control @error('nomor_identitas') is-invalid @enderror" />
                @error('nomor_identitas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tempat Tanggal Lahir Field -->
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir :</label>
                <input id="tempat_lahir" name="tempat_lahir" type="text"
                    value="{{ old('tempat_lahir', auth()->user()->profile ? auth()->user()->profile->tempat_lahir : '') }}"
                    class="form-control @error('tempat_lahir') is-invalid @enderror" />
                @error('tempat_lahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tanggal Lahir Field -->
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir :</label>
                <input id="tanggal_lahir" name="tanggal_lahir" type="date"
                    value="{{ old('tanggal_lahir', auth()->user()->profile ? \Carbon\Carbon::parse(auth()->user()->profile->tanggal_lahir)->format('Y-m-d') : '') }}"
                    class="form-control @error('tanggal_lahir') is-invalid @enderror" />
                @error('tanggal_lahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status Perkawinan Field -->
            <div class="mb-3">
                <label for="status_perkawinan" class="form-label">Status Perkawinan :</label>
                <select id="status_perkawinan" name="status_perkawinan"
                    class="form-select @error('status_perkawinan') is-invalid @enderror">
                    <option value="">Pilih Status</option>
                    <option value="Menikah"
                        {{ old('status_perkawinan', auth()->user()->profile ? auth()->user()->profile->status_perkawinan : '') == 'Menikah' ? 'selected' : '' }}>
                        Menikah</option>
                    <option value="Belum Menikah"
                        {{ old('status_perkawinan', auth()->user()->profile ? auth()->user()->profile->status_perkawinan : '') == 'Belum Menikah' ? 'selected' : '' }}>
                        Belum Menikah</option>
                </select>
                @error('status_perkawinan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Alamat Lengkap Field  -->
            <div class="mb-3">
                <label for="alamat_lengkap" class="form-label">Alamat Lengkap :</label>
                <textarea id="alamat_lengkap" name="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror">{{ old('alamat_lengkap', auth()->user()->profile ? auth()->user()->profile->alamat_lengkap : '') }}</textarea>
                @error('alamat_lengkap')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Kode Pos Field -->
            <div class="mb-3">
                <label for="kode_pos" class="form-label">Kode Pos :</label>
                <input id="kode_pos" name="kode_pos" type="text"
                    value="{{ old('kode_pos', auth()->user()->profile ? auth()->user()->profile->kode_pos : '') }}"
                    class="form-control @error('kode_pos') is-invalid @enderror" />
                @error('kode_pos')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Pekerjaan Field -->
            <div class="mb-3">
                <label for="pekerjaan" class="form-label">Posisi Pekerjaan :</label>
                <select id="pekerjaan" name="pekerjaan" class="form-select @error('pekerjaan') is-invalid @enderror">
                    <option value="">Pilih Status</option>
                    <option value="Admin"
                        {{ old('pekerjaan', auth()->user()->profile ? auth()->user()->profile->pekerjaan : '') == 'Admin' ? 'selected' : '' }}>
                        Admin</option>
                    <option value="Approval"
                        {{ old('pekerjaan', auth()->user()->profile ? auth()->user()->profile->pekerjaan : '') == 'Approval' ? 'selected' : '' }}>
                        Approval</option>
                    <option value="Appraisal"
                        {{ old('pekerjaan', auth()->user()->profile ? auth()->user()->profile->pekerjaan : '') == 'Appraisal' ? 'selected' : '' }}>
                        Appraisal</option>
                    <option value="Customer Service"
                        {{ old('pekerjaan', auth()->user()->profile ? auth()->user()->profile->pekerjaan : '') == 'Customer Service' ? 'selected' : '' }}>
                        Customer Service</option>
                </select>
                @error('pekerjaan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input id="email" name="email" type="email" value="{{ auth()->user()->email }}"
                    class="form-control" readonly />
            </div>

            <!-- Telepon Field -->
            <div class="mb-3">
                <label for="telepon" class="form-label">Telepon :</label>
                <input id="telepon" name="telepon" type="text"
                    value="{{ old('telepon', auth()->user()->profile ? auth()->user()->profile->telepon : '') }}"
                    class="form-control @error('telepon') is-invalid @enderror" />
                @error('telepon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nama Orang Tua Field -->
            <div class="mb-3">
                <label for="nama_orang_tua" class="form-label">Nama Orang Tua :</label>
                <input id="nama_orang_tua" name="nama_orang_tua" type="text"
                    value="{{ old('nama_orang_tua', auth()->user()->profile ? auth()->user()->profile->nama_orang_tua : '') }}"
                    class="form-control @error('nama_orang_tua') is-invalid @enderror" />
                @error('nama_orang_tua')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Modal Konfirmasi -->
            <div class="modal fade" id="editConfirmModal" tabindex="-1" aria-labelledby="editConfirmModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editConfirmModalLabel">Konfirmasi Perubahan Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin mengubah data ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" id="confirmEditSubmit">Ya</button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary w-20" data-bs-toggle="modal"
                data-bs-target="#editConfirmModal">Perbarui Data</button>
            <a href="{{ url('admin/home') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection

@push('script')
    <script>
        document.getElementById('confirmEditSubmit').addEventListener('click', function() {
            // Submit form after confirmation
            document.querySelector('form').submit();
        });

        function previewImage(event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
