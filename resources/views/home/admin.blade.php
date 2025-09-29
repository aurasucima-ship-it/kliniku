@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Judul -->
    <h4 class="fw-bold py-3 mb-4 text-pink-600 d-flex align-items-center gap-2">
        <i class="fas fa-hospital"></i> Dashboard Admin
    </h4>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <!-- Total Admin -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card text-white" style="background-color: rgba(255, 182, 193, 0.8);">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Admin</h5>
                    <p class="card-text fs-4">{{ $totalAdmin }}</p>
                </div>
            </div>
        </div>

        <!-- Total Dokter -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card text-white" style="background-color: rgba(255, 192, 203, 0.8);">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Dokter</h5>
                    <p class="card-text fs-4">{{ $totalDokter }}</p>
                </div>
            </div>
        </div>

        <!-- Total Pasien -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card text-white" style="background-color: rgba(255, 105, 180, 0.8);">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Pasien</h5>
                    <p class="card-text fs-4">{{ $totalPasien }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Data -->
    <div class="card mb-4">
        <div class="card-header text-pink-600 d-flex align-items-center gap-2">
            <i class="fas fa-chart-bar"></i>
            Grafik Data Sistem
        </div>
        <div class="card-body" style="height: 300px;">
            <canvas id="chartData" style="height:100%; width:100%;"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://kit.fontawesome.com/a2e0e6ad65.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('chartData').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Admin', 'Dokter', 'Pasien'],
            datasets: [{
                label: 'Jumlah',
                data: [{{ $totalAdmin }}, {{ $totalDokter }}, {{ $totalPasien }}],
                backgroundColor: [
                    'rgba(255, 182, 193, 0.8)',
                    'rgba(255, 192, 203, 0.8)',
                    'rgba(255, 105, 180, 0.8)'
                ],
                borderColor: [
                    'rgba(255, 182, 193, 1)',
                    'rgba(255, 192, 203, 1)',
                    'rgba(255, 105, 180, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, 
            animation: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
});
</script>
@endpush
