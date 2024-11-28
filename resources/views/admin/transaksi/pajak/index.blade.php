@extends('admin.layouts.app')

@section('contents')
    <div class="content">
        <div>
            <main class="app-main">
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h1 class="fw-bold fs-3">Daftar Pajak</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-content">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Bordered Table</h3>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('admin.transaksi.pajak.create') }}"
                                class="btn btn-primary float-left mb-2">Tambah Pajak</a>

                            @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            <table id="myTable" class="table table-striped table-bordered">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Bulan</th>
                                        <th>Bunga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pajaks as $pajak)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pajak->bulan }}</td>
                                            <td>{{ $pajak->bunga }}</td>
                                            <td>
                                                <a href="{{ route('admin.transaksi.pajak.edit', $pajak->id) }}"
                                                    class="btn btn-warning btn-sm me-2">Edit</a>
                                                <form action="{{ route('admin.transaksi.pajak.destroy', $pajak->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm me-2"
                                                        onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endsection
