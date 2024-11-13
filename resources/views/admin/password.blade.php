{{-- @extends('admin.layouts.app')

@section('title', 'Ubah Password')

@section('contents')
<div class="content">
    <h2>Ubah Password</h2>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form action="{{ route('admin.password.update') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="current_password">Password Saat Ini</label>
            <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
            @error('current_password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password Baru</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Ubah Password</button>
    </form>
</div>
@endsection --}}
