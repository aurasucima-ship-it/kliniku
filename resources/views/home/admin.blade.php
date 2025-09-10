@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Admin</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Admin</h5>
                    <p class="card-text">{{ $totalAdmin }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Dokter</h5>
                    <p class="card-text">{{ $totalDokter }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Pasien</h5>
                    <p class="card-text">{{ $totalPasien }}</p>
                </div>
            </div>
        </div>
    </div>

    <h3>Grafik Kunjungan</h3>
    <canvas id="chartKunjungan"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartKunjungan');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: @json($data),
                borderColor: 'blue',
                backgroundColor: 'rgba(0,0,255,0.2)',
                tension: 0.4
            }]
        }
    });
</script>
@endsection
