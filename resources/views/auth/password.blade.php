@extends('layouts.app')

@section('contents')
    <div class="container">
        <div class="content"  style="margin-top: 20px margin-bottom: 200px;">
        <h2>Ubah Password</h2>
        <br>
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
                    @error('current_password')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <br>
            <div class="form-group">
                <label for="new_password">Password Baru :</label>
                <div class="input-group">
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                        id="new_password" name="new_password" required>
                    @error('new_password')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <br>
            <div class="form-group">
                <label for="new_password_confirmation">Konfirmasi Password Baru :</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="new_password_confirmation"
                        name="new_password_confirmation" required>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('dashboard') }}" class="btn btn-secondary w-20">Kembali</a>
        </form>
    </div>
    </div>
@endsection
