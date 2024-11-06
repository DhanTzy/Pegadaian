@extends('user.layouts.app')

@section('title', 'Pengaturan Profil')

@section('contents')

    @if (session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif

    <!-- Form untuk mengedit profil -->
    <form method="POST" enctype="multipart/form-data" action="{{ route('user.profile.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="image" class="form-label">Foto Profil</label>
            <input id="image" name="image" type="file" class="form-control" accept="image/*"
                onchange="previewImage(event)" />

            <!-- Preview foto profil -->
            <img id="preview"
                src="{{ auth()->user()->image ? asset('storage/profile_images/' . auth()->user()->image) : asset('img/default_profile.png') }}"
                alt="Preview" width="100" class="mt-2" />
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}"
                class="form-control" required />
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="email" value="{{ auth()->user()->email }}" class="form-control"
                readonly />
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
        <button type="button" class="btn btn-primary w-20" data-bs-toggle="modal"
            data-bs-target="#editConfirmModal">Perbarui Data</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </form>

    <script>
         document.getElementById('confirmEditSubmit').addEventListener('click', function() {
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

@endsection
