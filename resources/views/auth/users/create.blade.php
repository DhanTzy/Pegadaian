@extends('layouts.app')

@section('contents')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="content">
        <h1 class="fw-bold fs-3 text-center">Tambah Data Akun</h1>
        <div class="mb-4 pb-4 border-bottom">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="" disabled selected>Silahkan Pilih Role Akses</option>
                        <option value="approval">Approval</option>
                        <option value="appraisal">Appraisal</option>
                        <option value="customer service">Customer Service</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="background-color: #183354;"
                    onclick="return confirm('Apakah Anda yakin ingin menambah akun ini?')"><i class="bi bi-send"></i> Tambah
                    Data</button>
                <a href="{{ url('users') }}" class="btn btn-danger w-20"><i class="bi bi-x-lg"></i> Batal</a>
            </form>
        </div>
    </div>
@endsection
