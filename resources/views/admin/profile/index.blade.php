@extends('admin.layouts.app')

@section('title', 'Profile Settings')

@section('contents')
<form method="POST" enctype="multipart/form-data" action="">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input id="name" name="name" type="text" value="{{ auth()->user()->name }}" class="form-control" readonly />
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input id="email" name="email" type="email" value="{{ auth()->user()->email }}" class="form-control" readonly />
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
