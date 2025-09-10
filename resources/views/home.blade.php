@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-bold mb-4">Grafik Pasien</h2>
        <canvas id="chartPasien"></canvas>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartPasien');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($tanggal ?? ['21/08','22/08','23/08','24/08','25/08','26/08','27/08','28/08']) !!},
            datasets: [{
                label: 'Jumlah Pasien',
                data: {!! json_encode($jumlahPasien ?? [14, 11, 19, 15, 15, 10, 15, 1]) !!},
                backgroundColor: 'rgba(59, 130, 246, 0.5)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
            }]
        },
        options: { 
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush
