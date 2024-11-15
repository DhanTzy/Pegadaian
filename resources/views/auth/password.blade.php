@extends('admin.layouts.app')

@section('contents')
    <div class="container">
        <h2>Ubah Password</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('password.change.save') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="current_password">Password Lama :</label>
                <div class="input-group">
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                        id="current_password" name="current_password" required>
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePassword('current_password')">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>
                    @error('current_password')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="new_password">Password Baru :</label>
                <div class="input-group">
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                        id="new_password" name="new_password" required>
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePassword('new_password')">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>
                    @error('new_password')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="new_password_confirmation">Konfirmasi Password Baru :</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="new_password_confirmation"
                        name="new_password_confirmation" required>
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePassword('new_password_confirmation')">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('admin/home') }}" class="btn btn-secondary w-20">Kembali</a>
        </form>
    </div>

    <script>
        function togglePassword(fieldId) {
            var field = document.getElementById(fieldId);
            var icon = field.nextElementSibling.querySelector('i');
            if (field.type === "password") {
                field.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
