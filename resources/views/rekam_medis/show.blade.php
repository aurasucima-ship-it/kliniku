@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Rekam Medis</h2>

    <div class="card">
        <div class="card-body">
            <h5><strong>Pasien:</strong> {{ $rekamMedis->pasien->nama }}</h5>
            <p><strong>Dokter:</strong> {{ $rekamMedis->dokter->nama }}</p>
            <p><strong>Keluhan:</strong> {{ $rekamMedis->keluhan }}</p>
            <p><strong>Diagnosa:</strong> {{ $rekamMedis->diagnosa ?? '-' }}</p>
            <p><strong>Tindakan:</strong> {{ $rekamMedis->tindakan ?? '-' }}</p>
            <p><strong>Resep Obat:</strong> {{ $rekamMedis->resep_obat ?? '-' }}</p>
            <p><strong>Catatan:</strong> {{ $rekamMedis->catatan ?? '-' }}</p>
            <p><strong>Tanggal Pemeriksaan:</strong> {{ $rekamMedis->tanggal_pemeriksaan }}</p>
        </div>
    </div>

    <a href="{{ route('rekam_medis.index') }}" class="btn btn-primary mt-3">Kembali</a>
</div>
@endsection
