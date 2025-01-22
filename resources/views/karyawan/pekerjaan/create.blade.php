@extends('layouts.app')

@section('contents')
<div class="content">
    <h1>Tambah Pekerjaan</h1>
    <form action="{{ route('admin.karyawan.pekerjaan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="posisi_pekerjaan" class="form-label">Posisi Pekerjaan</label>
            <input type="text" class="form-control" id="posisi_pekerjaan" name="posisi_pekerjaan" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ url('admin/karyawan/pekerjaan') }}" class="btn btn-secondary w-20">Kembali</a>
    </form>
</div>
@endsection
