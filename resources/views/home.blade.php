@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard Statistik Lembaga</h1>

    {{-- BARIS 1: KARTU STATISTIK (SEKARANG 4 KARTU) --}}
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Lembaga</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalLembaga }}</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-school fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Izin Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $izinAktif }}</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-check-circle fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Hampir Habis (< 30 Hari)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $izinHampirHabis }}</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-clock fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Izin Expired</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $izinExpired }}</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BARIS 2: CHART JENIS LEMBAGA & KATEGORI PAUD (TETAP ADA) --}}
    <div class="row">
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Komposisi Jenis Lembaga</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="position: relative; height: 300px;">
                        <canvas id="jenisLembagaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sebaran Kategori PAUD</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="position: relative; height: 300px;">
                        <canvas id="kategoriPaudChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JAVASCRIPT --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Set default Chart.js configuration
    Chart.defaults.font.family = 'Nunito, -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.color = '#858796';

    // 1. Donut Chart - Jenis Lembaga
    const ctxJenis = document.getElementById('jenisLembagaChart');
    new Chart(ctxJenis, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($jenisLembagaData->pluck('nama')) !!},
            datasets: [{
                data: {!! json_encode($jenisLembagaData->pluck('lembaga_count')) !!},
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'], // Tambahkan warna jika jenis banyak
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dda20a'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            cutout: '80%', // Properti cutout terbaru (pengganti cutoutPercentage)
            plugins: {
                legend: { display: true, position: 'bottom' }
            }
        }
    });

    // 2. Bar Chart - Kategori PAUD (TETAP ADA)
    const ctxPaud = document.getElementById('kategoriPaudChart');
    new Chart(ctxPaud, {
        type: 'bar',
        data: {
            labels: {!! json_encode($kategoriPaudData->pluck('nama')) !!},
            datasets: [{
                label: "Jumlah Lembaga",
                backgroundColor: "#4e73df",
                hoverBackgroundColor: "#2e59d9",
                borderColor: "#4e73df",
                data: {!! json_encode($kategoriPaudData->pluck('lembaga_count')) !!},
                maxBarThickness: 50, // Atur agar batang tidak terlalu lebar
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }, // Sembunyikan legenda label tunggal
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: "rgb(234, 236, 244)", drawBorder: false },
                    ticks: { stepSize: 1, precision: 0 } // Pastikan angka bulat
                },
                x: {
                    grid: { display: false, drawBorder: false },
                    ticks: { maxRotation: 45, minRotation: 0 } // Putar label jika panjang
                }
            }
        }
    });
</script>
@endsection