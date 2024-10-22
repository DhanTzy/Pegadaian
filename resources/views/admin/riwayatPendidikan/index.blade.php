@extends('layouts.app')

@section('title', 'Pendidikan')

@section('contents')
<div>
    <h1 h1 class="fw-bold fs-3">Daftar Riwayat Pendidikan</h1>
    <!-- Form Pencarian -->
    <form action="{{ route('admin.riwayatPendidikan') }}" method="GET" class="mb-3 float-end" style="width: 30%;">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari Riwayat Pendidikan"
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary">Search</button>
        </div>
    </form>

    <table class="table table-striped table-bordered">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>ID Karyawan</th>
                <th>Nama Karyawan</th>
                <th>Pendidikan</th>
                <th>Jurusan</th>
                <th>Jenjang Pendidikan</th>
                <th>Tahun Lulus</th>
                <th>IPK/Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($riwayatPendidikan as $index => $pendidikan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pendidikan->karyawan->id }}</td>
                <td>{{ $pendidikan->karyawan->nama_lengkap }}</td>
                <td>{{ $pendidikan->pendidikan }}</td>
                <td>{{ $pendidikan->jurusan }}</td>
                <td>{{ $pendidikan->jenjang_pendidikan }}</td>
                <td>{{ $pendidikan->tahun_lulus }}</td>
                <td>{{ $pendidikan->ipk_nilai }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
