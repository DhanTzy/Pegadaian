@extends('admin.layouts.app')

@section('title', 'Profile Settings')

@section('contents')
    <div class="content">
        @if (session('success'))
            <div class="alert alert-warning">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <h2 class="fw-bold">Informasi Akun</h2>
                            </div>

                            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row my-4">
                                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                                        <div id="profileImageContainer">
                                            <img src="{{ auth()->user()->image ? asset('storage/profile_images/' . auth()->user()->image) : '' }}"
                                                alt="Foto Profil" class="rounded-circle" id="file-preview"
                                                style="width: 150px; height: 150px; object-fit: cover;">
                                        </div>
                                    </div>
                                    <div class="col-md-8 d-flex flex-column justify-content-center">
                                        <div class="upload-container">
                                            <div class="row d-flex">
                                                <div class="mt-5 mt-md-0">
                                                    <input type="file" class="form-control" id="file-upload"
                                                        name="image" accept=".jpg, .jpeg, .png">
                                                    @error('image')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label">Nama</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', auth()->user()->name) }}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nip" class="col-md-4 col-form-label">NIP</label>
                                    <div class="col-md-8">
                                        <input type="nip" class="form-control" id="nip" name="nip"
                                            value="{{ old('nip', auth()->user()->profile ? auth()->user()->profile->nip : '') }}">
                                        @error('nip')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nomor_identitas" class="col-md-4 col-form-label">Nomor Identitas</label>
                                    <div class="col-md-8">
                                        <input type="nomor_identitas" class="form-control" id="nomor_identitas"
                                            name="nomor_identitas"
                                            value="{{ old('nomor_identitas', auth()->user()->profile ? auth()->user()->profile->nomor_identitas : '') }}">
                                        @error('nomor_identitas')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="tempat_lahir" class="col-md-4 col-form-label">Tempat Lahir</label>
                                    <div class="col-md-8">
                                        <input type="tempat_lahir" class="form-control" id="tempat_lahir"
                                            name="tempat_lahir"
                                            value="{{ old('tempat_lahir', auth()->user()->profile ? auth()->user()->profile->tempat_lahir : '') }}">
                                        @error('tempat_lahir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="tanggal_lahir" class="col-md-4 col-form-label">Tanggal Lahir</label>
                                    <div class="col-md-8">
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                            value="{{ old('tanggal_lahir', auth()->user()->profile ? \Carbon\Carbon::parse(auth()->user()->profile->tanggal_lahir)->format('Y-m-d') : '') }}">
                                        @error('tanggal_lahir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="status_perkawinan" class="col-md-4 col-form-label">Status Perkawinan</label>
                                    <div class="col-md-8">
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
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="alamat_lengkap" class="col-md-4 col-form-label">Alamat Lengkap</label>
                                    <div class="col-md-8">
                                        <textarea id="alamat_lengkap" name="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror">{{ old('alamat_lengkap', auth()->user()->profile ? auth()->user()->profile->alamat_lengkap : '') }}</textarea>
                                        @error('alamat_lengkap')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="kode_pos" class="col-md-4 col-form-label">Kode Pos</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="kode_pos" name="kode_pos"
                                            value="{{ old('kode_pos', auth()->user()->profile ? auth()->user()->profile->kode_pos : '') }}">
                                        @error('kode_pos')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label">Email</label>
                                    <div class="col-md-8">
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email', Auth::user()->email) }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="telepon" class="col-md-4 col-form-label">Telepon</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" id="telepon" name="telepon"
                                            value="{{ old('telepon', auth()->user()->profile ? auth()->user()->profile->telepon : '') }}">
                                        @error('telepon')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nama_orang_tua" class="col-md-4 col-form-label">Nama Orang Tua</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="nama_orang_tua"
                                            name="nama_orang_tua"
                                            value="{{ old('nama_orang_tua', auth()->user()->profile ? auth()->user()->profile->nama_orang_tua : '') }}">
                                        @error('nama_orang_tua')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row mb-5">
                                    <label for="created_at" class="col-md-4 col-form-label">Akun Dibuat</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="created_at"
                                            value="{{ Auth::user()->created_at->format('d M Y') }}" disabled>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <a href="{{ url('admin/home') }}" class="btn btn-secondary">Kembali</a>
                                    <button type="button" class="btn btn-primary w-20" data-bs-toggle="modal"
                                        data-bs-target="#editConfirmModal">Perbarui Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi -->
        <div class="modal fade" id="editConfirmModal" tabindex="-1" aria-labelledby="editConfirmModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editConfirmModalLabel">Konfirmasi Perubahan Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
        </form>
    </div>
@endsection

@push('script')
    <script>
        document.getElementById('confirmEditSubmit').addEventListener('click', function() {
            // Submit form after confirmation
            document.querySelector('form').submit();
        });

        // function previewImage(event) {
        //     const preview = document.getElementById('preview');
        //     const file = event.target.files[0];

        //     if (file) {
        //         const reader = new FileReader();
        //         reader.onload = function(e) {
        //             preview.src = e.target.result;
        //         };
        //         reader.readAsDataURL(file);
        //     }
        // }

        const input = document.getElementById('file-upload');
        const previewPhoto = () => {
            const file = input.files[0];
            if (file) {
                const fileReader = new FileReader();
                const preview = document.getElementById('file-preview');
                fileReader.onload = function(event) {
                    preview.setAttribute('src', event.target.result);
                }
                fileReader.readAsDataURL(file);
            }
        }
        input.addEventListener("change", previewPhoto);
    </script>
@endpush
