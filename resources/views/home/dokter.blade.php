@extends('layouts.app')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="min-h-screen py-10 px-4" style="background-color: #ffe4ef; font-family: 'Poppins', sans-serif;">

    <div class="max-w-7xl mx-auto">

        <div class="card shadow-lg rounded-3xl text-center p-8 mb-8" style="background-color: #ffe4ef; border: 2px solid #f9b7d0; color: #5a0025;">
            <h2 class="text-4xl fw-bold mb-3" style="font-family: 'Fredoka', sans-serif;">
                Selamat Datang, {{ Auth::user()->name }}! 
            </h2>
            <p class="text-lg mb-4">
                Pantau pasien, rekam medis, dan pembayaran masuk dengan mudah di dashboard ini.
            </p>
        </div>

        <div class="row g-4 mb-8">
            <div class="col-md-4 d-flex">
                <div class="card flex-fill p-4 text-center shadow-sm" style="background: linear-gradient(135deg,#FBCFE8,#F9A8D4); border-radius:1.5rem;">
                    <h5 class="mb-2 fw-bold text-white">👨‍👩‍👧 Total Pasien</h5>
                    <p class="fs-3 fw-bold text-white">{{ $totalPasien }}</p>
                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="card flex-fill p-4 text-center shadow-sm" style="background: linear-gradient(135deg,#F9A8D4,#F472B6); border-radius:1.5rem;">
                    <h5 class="mb-2 fw-bold text-white">📝 Total Rekam Medis</h5>
                    <p class="fs-3 fw-bold text-white">{{ $totalRekamMedis }}</p>
                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="card flex-fill p-4 text-center shadow-sm" style="background: linear-gradient(135deg,#F472B6,#EC4899); border-radius:1.5rem;">
                    <h5 class="mb-2 fw-bold text-white">💳 Total Pembayaran Masuk</h5>
                    <p class="fs-3 fw-bold text-white">{{ $totalPembayaran }}</p>
                </div>
            </div>
        </div>

        <div class="card shadow-sm rounded-3xl p-4">
            <div class="card-header d-flex align-items-center gap-2 fw-semibold text-pink-600" style="letter-spacing:0.5px;">
                <i class="fas fa-chart-bar"></i> Grafik Data Dokter
            </div>
            <div class="card-body" style="height: 350px;">
                <canvas id="chartDokter" style="height:100%; width:100%;"></canvas>
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
    const ctx = document.getElementById('chartDokter').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pasien', 'Rekam Medis', 'Pembayaran'],
            datasets: [{
                label: 'Jumlah',
                data: [{{ $totalPasien }}, {{ $totalRekamMedis }}, {{ $totalPembayaran }}],
                backgroundColor: [
                    'rgba(251, 182, 206, 0.8)', 
                    'rgba(251, 207, 232, 0.8)', 
                    'rgba(253, 164, 175, 0.8)' 
                ],
                borderColor: [
                    'rgba(251, 182, 206, 1)',
                    'rgba(251, 207, 232, 1)',
                    'rgba(253, 164, 175, 1)'
                ],
                borderWidth: 2,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
});
</script>
@endpush
