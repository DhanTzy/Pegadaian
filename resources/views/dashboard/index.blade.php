@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="fw-bold fs-3">Dashboard</h1>
                        <p class="fw-bold" id="current-info" style="margin: 0; font-size: 16px; color:red"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card d-flex flex-row align-items-center">
            <div class="flex-grow-1">
                <div class="d-flex flex-column">
                    <h1 class="fw-bold fs-3 text-center">Welcome Goat</h1>
                    {{-- <h1 class="fw-bold fs-3" style="text-align: left;">Kompak</h1>
                    <h2 class="fw-bold fs-3" style="text-align: center;">Berintegritas</h2>
                    <h3 class="fw-bold fs-3" style="text-align: right;">Sukses Bersama</h3> --}}
                </div>
            </div>
    </main>

    <script>
        function updateTime() {
            const now = new Date();
            const dayString = now.toLocaleDateString('id-ID', {
                weekday: 'long'
            });
            const dateString = now.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
            const timeString = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
            const fullString = `${dayString}, ${dateString} . ${timeString}`;

            document.getElementById('current-info').innerText = fullString;
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>
@endsection
