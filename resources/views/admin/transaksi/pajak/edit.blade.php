@extends('admin.layouts.app')

@section('contents')
<div class="content">
    <h1>Edit Pajak</h1>
    <form action="{{ route('admin.transaksi.pajak.update', $pajak->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="bunga" class="form-label">Bunga</label>
            <input type="text" step="0.01" class="form-control" id="bunga" name="bunga" value="{{ $pajak->bunga }}" required>
        </div>
        <div class="mb-3">
            <label for="bulan" class="form-label">Bulan</label>
            <input type="text" class="form-control" id="bulan" name="bulan" value="{{ $pajak->bulan }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ url('admin/transaksi/pajak') }}" class="btn btn-secondary w-20">Kembali</a>
    </form>
</div>
@endsection
