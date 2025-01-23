@extends('layouts.app')

@section('title', 'Profile Details')

@section('contents')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="fw-bold">Informasi Akun</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 d-flex justify-content-center align-items-center">
                                <img src="{{ auth()->user()->image ? asset('storage/profile_images/' . auth()->user()->image) : asset('img/default.png') }}"
                                    class="img-thumbnail rounded-circle img-fluid mb-3" alt=""
                                    style="width: 250px; height: 250px; object-fit: cover;">
                            </div>

                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Nama</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">NIP</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->profile ? auth()->user()->profile->nip : 'Tidak tersedia' }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Nomor Identitas</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->profile ? auth()->user()->profile->nomor_identitas : 'Tidak tersedia' }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Tempat Lahir</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->profile ? auth()->user()->profile->tempat_lahir : 'Tidak tersedia' }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Tanggal Lahir</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->profile ? auth()->user()->profile->tanggal_lahir : 'Tidak tersedia' }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Jenis Kelamin</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->profile ? auth()->user()->profile->jenis_kelamin : 'Tidak tersedia' }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Alamat</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->profile ? auth()->user()->profile->alamat_lengkap : 'Tidak tersedia' }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Kode Pos</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->profile ? auth()->user()->profile->kode_pos : 'Tidak tersedia' }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Telepon</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->profile ? auth()->user()->profile->telepon : 'Tidak tersedia' }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->email }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Akun Dibuat</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->created_at->format('d M Y') }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
