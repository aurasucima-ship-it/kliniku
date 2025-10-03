@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="card shadow-sm rounded-2xl mb-4" style="background: #fff;">
        <h5 class="card-header text-center fs-4 fw-bold d-flex justify-content-center align-items-center gap-2"
            style="color:#f73e88; letter-spacing:1px; border-radius:1rem; padding:1rem 0;">
            <i class="fas fa-user-doctor"></i> DASHBOARD DOKTER
        </h5>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 text-white" 
                 style="background: linear-gradient(135deg, rgba(251,182,206,1), rgba(251,182,206,0.8));">
                <div class="card-body text-center py-4">
                    <h5 class="card-title mb-2">Total Pasien</h5>
                    <p class="card-text fs-3 fw-bold">{{ $totalPasien }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 text-white" 
                 style="background: linear-gradient(135deg, rgba(251,207,232,1), rgba(251,207,232,0.8));">
                <div class="card-body text-center py-4">
                    <h5 class="card-title mb-2">Total Rekam Medis</h5>
                    <p class="card-text fs-3 fw-bold">{{ $totalRekamMedis }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 text-white" 
                 style="background: linear-gradient(135deg, rgba(253,164,175,1), rgba(253,164,175,0.8));">
                <div class="card-body text-center py-4">
                    <h5 class="card-title mb-2">Total Pembayaran Masuk</h5>
                    <p class="card-text fs-3 fw-bold">{{ $totalPembayaran }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 shadow-sm rounded-2xl">
        <div class="card-header d-flex align-items-center gap-2 fw-semibold"
             style="color:#f73e88; letter-spacing:0.5px;">
            <i class="fas fa-chart-bar"></i> Grafik Data Dokter
        </div>
        <div class="card-body" style="height: 320px;">
            <canvas id="chartData" style="height:100%; width:100%;"></canvas>
        </div>
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
