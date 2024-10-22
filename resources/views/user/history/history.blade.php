@extends('layouts.user')

@section('title', 'History')

@section('contents')
<div class="container mt-5">
    <h1 class="fw-bold fs-3 ms-3">Riwayat Gadai Anda</h1>

    <div class="table-responsive mt-4">
        <table class="table table-striped table-bordered text-center">
            <thead class="thead-dark">
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Barang Yang Digadai</th>
                    <th>Jumlah Uang Pinjaman</th>
                    <th>Alamat</th>
                    <th>Uang Yang Sudah Di</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 5; $i++)
                <tr>
                    <td>{{ $i }}</td>
                    <td>Saut</td>
                    <td>Motor Aerox</td>
                    <td>Rp. 1.000.000</td>
                    <td>Klakah-Miawang</td>
                    <td>Rp. 500.000</td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
@endsection
