@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard Statistik Lembaga</h1>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
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

        <div class="col-xl-4 col-md-6 mb-4">
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

        <div class="col-xl-4 col-md-6 mb-4">
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

    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Komposisi Jenis Lembaga</h6>
                </div>
                <div class="card-body">
                    <canvas id="jenisLembagaChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sebaran Kategori PAUD</h6>
                </div>
                <div class="card-body">
                    <canvas id="kategoriPaudChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. Donut Chart - Jenis Lembaga
    const ctxJenis = document.getElementById('jenisLembagaChart');
    new Chart(ctxJenis, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($jenisLembagaData->pluck('nama')) !!},
            datasets: [{
                data: {!! json_encode($jenisLembagaData->pluck('lembaga_count')) !!},
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: { maintainAspectRatio: false, cutoutPercentage: 80 }
    });

    // 2. Bar Chart - Kategori PAUD
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
            }],
        },
        options: {
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endsection