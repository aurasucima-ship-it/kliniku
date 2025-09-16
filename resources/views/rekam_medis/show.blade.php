@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-pink-600 text-center fw-semibold mb-4 d-flex justify-content-center align-items-center gap-2" style="font-family: 'Poppins', sans-serif;">
        <i class="fas fa-notes-medical"></i>
        Detail Rekam Medis
    </h2>

    <div class="card border-pink-300 shadow-sm mb-3">
        <div class="card-body">
            <p class="mb-2"><strong class="text-pink-600">Pasien:</strong> {{ $rekamMedis->pasien->nama }}</p>
            <p class="mb-2"><strong class="text-pink-600">Dokter:</strong> {{ $rekamMedis->dokter->nama }}</p>
            <p class="mb-2"><strong class="text-pink-600">Keluhan:</strong> {{ $rekamMedis->keluhan }}</p>
            <p class="mb-2"><strong class="text-pink-600">Diagnosa:</strong> {{ $rekamMedis->diagnosa ?? '-' }}</p>
            <p class="mb-2"><strong class="text-pink-600">Tindakan:</strong> {{ $rekamMedis->tindakan ?? '-' }}</p>
            <p class="mb-2"><strong class="text-pink-600">Resep Obat:</strong> {{ $rekamMedis->resep_obat ?? '-' }}</p>
            <p class="mb-2"><strong class="text-pink-600">Catatan:</strong> {{ $rekamMedis->catatan ?? '-' }}</p>
            <p class="mb-0"><strong class="text-pink-600">Tanggal Pemeriksaan:</strong> {{ \Carbon\Carbon::parse($rekamMedis->tanggal_pemeriksaan)->format('d M Y') }}</p>
        </div>
    </div>

    <a href="{{ route('rekam_medis.index') }}" class="btn bg-pink-500 hover:bg-pink-600 text-white">← Kembali</a>
</div>
@endsection
