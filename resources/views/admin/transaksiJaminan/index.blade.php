@extends('layouts.app')

@section('contents')
    <div>
        <h1 h1 class="fw-bold fs-3">Daftar Jaminan Transaksi</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID Transaksi</th>
                    <th>Nama</th>
                    <th>Foto Jaminan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi_jaminan as $jaminan)
                    <tr>
                        <td>{{ $jaminan->transaksi_id }}</td>
                        <td>{{ $jaminan->transaksi->nama }}</td>
                        <td class="text-center">
                            <img src="{{ asset('storage/' . $jaminan->foto_jaminan) }}" alt="Foto Jaminan"
                                style="width: 100px; height: auto; border: 1px solid #ddd;" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
