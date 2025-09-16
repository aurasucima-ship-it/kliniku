@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Judul Dashboard -->
    <h1 class="text-3xl font-bold text-pink-600 text-center mb-6 d-flex justify-content-center align-items-center gap-2" style="font-family: 'Poppins', sans-serif;">
        <i class="fas fa-hospital"></i>
        Dashboard Admin
    </h1>

    <div class="row mb-4">
        <!-- Total Admin -->
        <div class="col-md-4">
            <div class="card mb-3 text-white" style="background-color: rgba(255, 182, 193, 0.8);">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Admin</h5>
                    <p class="card-text fs-4">{{ $totalAdmin }}</p>
                </div>
            </div>
        </div>

        <!-- Total Dokter -->
        <div class="col-md-4">
            <div class="card mb-3 text-white" style="background-color: rgba(255, 192, 203, 0.8);">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Dokter</h5>
                    <p class="card-text fs-4">{{ $totalDokter }}</p>
                </div>
            </div>
        </div>

        <!-- Total Pasien -->
        <div class="col-md-4">
            <div class="card mb-3 text-white" style="background-color: rgba(255, 105, 180, 0.8);">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Pasien</h5>
                    <p class="card-text fs-4">{{ $totalPasien }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik -->
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-pink-600 mb-4 text-center d-flex justify-content-center align-items-center gap-2">
            <i class="fas fa-chart-bar"></i>
            Grafik Data Sistem
        </h2>
        <canvas id="chartData"></canvas>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://kit.fontawesome.com/a2e0e6ad65.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartData');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Admin', 'Dokter', 'Pasien'],
            datasets: [{
                label: 'Jumlah',
                data: [{{ $totalAdmin }}, {{ $totalDokter }}, {{ $totalPasien }}],
                backgroundColor: [
                    'rgba(255, 182, 193, 0.6)',  // soft pink Admin
                    'rgba(255, 192, 203, 0.6)',  // soft pink Dokter
                    'rgba(255, 105, 180, 0.6)'   // vibrant pink Pasien
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
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endpush
