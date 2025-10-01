@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="card shadow-sm rounded-2xl mb-4" style="background: linear-gradient(90deg, #ffffff, #ffffff);">
    <h5 class="card-header text-center fs-4 fw-bold d-flex justify-content-center align-items-center gap-2"
        style="color:#f73e88; letter-spacing:1px; border-radius:1rem; padding:1rem 0;">
        <i class="fas fa-hospital"></i>
        Dashboard Admin
    </h5>
</div>


    <div class="row mb-4">
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card text-center shadow-sm rounded-2xl" style="background-color:#FBCFE8;">
                <div class="card-body">
                    <h5 class="card-title fw-semibold text-pink-700">Total Admin</h5>
                    <p class="card-text fs-4 fw-bold text-pink-900">{{ $totalAdmin }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card text-center shadow-sm rounded-2xl" style="background-color:#F9A8D4;">
                <div class="card-body">
                    <h5 class="card-title fw-semibold text-pink-700">Total Dokter</h5>
                    <p class="card-text fs-4 fw-bold text-pink-900">{{ $totalDokter }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card text-center shadow-sm rounded-2xl" style="background-color:#F472B6;">
                <div class="card-body">
                    <h5 class="card-title fw-semibold text-pink-700">Total Pasien</h5>
                    <p class="card-text fs-4 fw-bold text-pink-900">{{ $totalPasien }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 shadow-sm rounded-2xl">
        <div class="card-header d-flex align-items-center gap-2 text-pink-600 fw-semibold" 
             style="letter-spacing:0.5px;">
            <i class="fas fa-chart-bar"></i> Grafik Data Sistem
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
                backgroundColor: ['#FBCFE8', '#F9A8D4', '#F472B6'],
                borderColor: ['#F9A8D4', '#F472B6', '#EC4899'],
                borderWidth: 1,
                borderRadius: 6,
                barPercentage: 0.5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
});
</script>
@endpush
