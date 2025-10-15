@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="min-h-screen py-10 px-4" style="background-color: #ffe4ef; font-family: 'Poppins', sans-serif;">

        <div class="row mb-4 g-4">

            <div class="col-lg-3 col-md-6">
                <div class="card shadow-lg rounded-3xl text-center p-4" style="background: linear-gradient(135deg,#FBCFE8,#F9A8D4);">
                    <div class="d-flex justify-content-center align-items-center mb-2" style="font-size:2.5rem; color:#fff;">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h6 class="text-white fw-semibold">Total Admin</h6>
                    <p class="fs-4 fw-bold text-white">{{ $totalAdmin }}</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card shadow-lg rounded-3xl text-center p-4" style="background: linear-gradient(135deg,#F9A8D4,#F472B6);">
                    <div class="d-flex justify-content-center align-items-center mb-2" style="font-size:2.5rem; color:#fff;">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h6 class="text-white fw-semibold">Total Dokter</h6>
                    <p class="fs-4 fw-bold text-white">{{ $totalDokter }}</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card shadow-lg rounded-3xl text-center p-4" style="background: linear-gradient(135deg,#F472B6,#EC4899);">
                    <div class="d-flex justify-content-center align-items-center mb-2" style="font-size:2.5rem; color:#fff;">
                        <i class="fas fa-users"></i>
                    </div>
                    <h6 class="text-white fw-semibold">Total Pasien</h6>
                    <p class="fs-4 fw-bold text-white">{{ $totalPasien }}</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card shadow-lg rounded-3xl text-center p-4" style="background: linear-gradient(135deg,#EC4899,#DB2777);">
                    <div class="d-flex justify-content-center align-items-center mb-2" style="font-size:2.5rem; color:#fff;">
                        <i class="fas fa-file-medical"></i>
                    </div>
                    <h6 class="text-white fw-semibold">Total Rekam Medis</h6>
                    <p class="fs-4 fw-bold text-white">{{ $totalRekamMedis }}</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card shadow-lg rounded-3xl text-center p-4" style="background: linear-gradient(135deg,#DB2777,#BE185D);">
                    <div class="d-flex justify-content-center align-items-center mb-2" style="font-size:2.5rem; color:#fff;">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h6 class="text-white fw-semibold">Total Pembayaran</h6>
                    <p class="fs-4 fw-bold text-white">{{ $totalPembayaran }}</p>
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
            labels: ['Admin', 'Dokter', 'Pasien', 'Rekam Medis', 'Pembayaran'],
            datasets: [{
                label: 'Jumlah',
                data: [{{ $totalAdmin }}, {{ $totalDokter }}, {{ $totalPasien }}, {{ $totalRekamMedis }}, {{ $totalPembayaran }}],
                backgroundColor: ['#FBCFE8', '#F9A8D4', '#F472B6', '#EC4899', '#DB2777'],
                borderWidth: 0,
                borderRadius: 12,
                barPercentage: 0.5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } },
                x: { grid: { display: false } }
            }
        }
    });
});
</script>
@endpush
