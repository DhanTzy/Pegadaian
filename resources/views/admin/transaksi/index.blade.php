@extends('layouts.app')

@section('title', 'Home Transaksi List')

@section('contents')
    <div>
        <h1 class="fw-bold fs-3">Daftar Transaksi</h1>
        <a href="{{ route('admin.transaksi.create') }}" class="btn btn-primary float-left mb-2">Input Data Transaksi</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table id="myTable" class="table table-striped table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nama Nasabah</th>
                    <th>Tanggal</th>
                    <th>Metode Pencairan</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Bunga</th>
                    <th>Jangka Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $tran)
                    <tr>
                        <td>{{ $tran->id }}</td>
                        <td>{{ $tran->nama_nasabah }}</td>
                        <td>{{ $tran->tanggal }}</td>
                        <td>{{ $tran->metode_pencairan }}</td>
                        <td>{{ $tran->jumlah_pinjaman }}</td>
                        <td>{{ $tran->bunga }}</td>
                        <td>{{ $tran->jangka_waktu }}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm me-2" data-bs-toggle="modal"
                                data-bs-target="#detailModal-{{ $tran->id }}">Detail</button> <!-- Tombol Detail -->
                            <a href="{{ route('admin.transaksi.edit', $tran->id) }}"
                                class="btn btn-success btn-sm me-2">Edit</a>
                            <form action="{{ route('admin.transaksi.destroy', $tran->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda Yakin Menghapus Data Ini?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal untuk Detail Transaksi -->
                    <div class="modal fade" id="detailModal-{{ $tran->id }}" tabindex="-1"
                        aria-labelledby="detailModalLabel-{{ $tran->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel-{{ $tran->id }}">Detail Transaksi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>No Rekening</strong> {{ $tran->no_rekening }}</p>
                                    <p><strong>Bank :</strong> {{ $tran->bank }}</p>
                                    <hr>
                                    <h5>Foto Jaminan</h5>
                                    @if ($tran->jaminan->isNotEmpty())
                                        <div class="row">
                                            @foreach ($tran->jaminan as $jaminan)
                                                <div class="col-md-4 mb-3">
                                                    <img src="{{ asset('storage/' . $jaminan->foto_jaminan) }}"
                                                        class="img-fluid" alt="Foto Jaminan">
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p>Tidak ada foto jaminan.</p>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
