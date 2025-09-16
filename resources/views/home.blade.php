@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-bold mb-4">Grafik Kunjungan Pasien</h2>
        <canvas id="chartPasien"></canvas>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartPasien');

    new Chart(ctx, {
        type: 'bar', // ✅ pakai diagram batang
        data: {
            labels: {!! json_encode($tanggal ?? ['Ahad','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']) !!},
            datasets: [{
                label: 'Jumlah Pasien',
                data: {!! json_encode($jumlahPasien ?? [950, 600, 450, 850, 700, 250, 900]) !!},
                backgroundColor: 'rgba(59, 130, 246, 0.8)', // biru solid
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
            }]
        },
        options: { 
            responsive: true,
            plugins: {
                legend: {
                    display: false // sembunyikan legenda supaya mirip contoh
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 100
                    },
                    grid: {
                        color: function(context) {
                            // buat garis horizontal merah putus-putus seperti contoh
                            if (context.tick.value % 100 === 0) {
                                return 'rgba(255, 0, 0, 0.5)';
                            }
                            return 'rgba(0,0,0,0.05)';
                        },
                        borderDash: [5, 5]
                    }
                }
            }
        }
    });
</script>
@endpush
