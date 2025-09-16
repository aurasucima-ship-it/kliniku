@extends('layouts.app')

@section('content')
<div class="container py-4">



    <h2 class="fw-bold text-primary mb-4">Dashboard Dokter</h2>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 text-center p-3">
                <h5>Total Pasien</h5>
                <h2>{{ $totalPasien }}</h2>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 text-center p-3">
                <h5>Rekam Medis</h5>
                <h2>{{ $rekamMedis }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection
