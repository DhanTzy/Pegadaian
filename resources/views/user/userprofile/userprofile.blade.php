@extends('user.layouts.app')

@section('title', 'Pengaturan Profil')

@section('contents')
<header class="bg-white">
    <div class="container py-6">
        <h1 class="display-4 font-weight-bold text-dark">
            Profil
        </h1>
    </div>
</header>
<hr />
<form method="POST" enctype="multipart/form-data" action="">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input id="name" name="name" type="text" value="{{ auth()->user()->name }}" class="form-control" readonly />
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input id="email" name="email" type="email" value="{{ auth()->user()->email }}" class="form-control" readonly />
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
