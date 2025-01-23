@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        {{-- <p class="fw-bold" id="current-info" style="margin: 0; font-size: 16px; color:red"></p> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle p-3 d-flex justify-content-center align-items-center"
                                    style="background-color: #183354;">
                                    <i class="fa-solid fa-money-bill fa-2x text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <p class="card-text fs-5 mb-0">Transaksi Pinjaman</p>
                                    <h5 class="card-title fw-bold fs-3 mb-0">{{ $totalTransaksi }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle p-3 d-flex justify-content-center align-items-center"
                                    style="background-color: #183354;">
                                    <i class="fa-solid fa-user-group fa-2x text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <p class="card-text fs-5 mb-0">Daftar Nasabah</p>
                                    <h5 class="card-title fw-bold fs-3 mb-0">{{ $totalNasabah }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle p-3 d-flex justify-content-center align-items-center"
                                    style="background-color: #183354;">
                                    <i class="fa-solid fa-user-group fa-2x text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <p class="card-text fs-5 mb-0">Total Karyawan</p>
                                    <h5 class="card-title fw-bold fs-3 mb-0">{{ $totalKaryawan }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Grafik Transaksi Pinjaman</h5>
                <canvas id="totalTransaksiChart" style="height: 100px;"></canvas>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const months = @json($months);
        const transactionData = @json($transactionCounts);
        const nasabahData = @json($nasabahCounts);

        const ctxTransaksi = document.getElementById('totalTransaksiChart').getContext('2d');
        const totalTransaksiChart = new Chart(ctxTransaksi, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                        label: 'Transaksi Pinjaman',
                        data: transactionData,
                        fill: false,
                        borderColor: '#ff0000',
                        tension: 0.1,
                        borderWidth: 2,
                        pointRadius: 3
                    },
                    {
                        label: 'Nasabah Terdaftar',
                        data: nasabahData,
                        fill: false,
                        borderColor: '#007bff',
                        tension: 0.1,
                        borderWidth: 2,
                        pointRadius: 3
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah'
                        },
                        beginAtZero: true
                    }
                }
            }
        });

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
