@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center fw-semibold mb-4 d-flex justify-content-center align-items-center gap-2" 
        style="font-family: 'Poppins', sans-serif; color:#db2777;">
        <i class="fas fa-notes-medical"></i>
        Detail Rekam Medis
    </h2>

    <div class="card border-pink-300 shadow-sm mb-3">
        <div class="card-body">
            <p class="mb-2"><strong style="color:#db2777;">Pasien:</strong> {{ $rekamMedis->pasien->nama }}</p>
            <p class="mb-2"><strong style="color:#db2777;">Dokter:</strong> {{ $rekamMedis->dokter->nama }}</p>
            <p class="mb-2"><strong style="color:#db2777;">Keluhan:</strong> {{ $rekamMedis->keluhan }}</p>
            <p class="mb-2"><strong style="color:#db2777;">Diagnosa:</strong> {{ $rekamMedis->diagnosa ?? '-' }}</p>
            <p class="mb-2"><strong style="color:#db2777;">Tindakan:</strong> {{ $rekamMedis->tindakan ?? '-' }}</p>
            <p class="mb-2"><strong style="color:#db2777;">Resep Obat:</strong> {{ $rekamMedis->resep_obat ?? '-' }}</p>
            <p class="mb-2"><strong style="color:#db2777;">Catatan:</strong> {{ $rekamMedis->catatan ?? '-' }}</p>
            <p class="mb-0"><strong style="color:#db2777;">Tanggal Pemeriksaan:</strong> 
                {{ \Carbon\Carbon::parse($rekamMedis->tanggal_pemeriksaan)->format('d M Y') }}
            </p>
        </div>
    </div>

    <a href="{{ route('rekam_medis.index') }}" 
       class="btn text-white" 
       style="background-color:#ec4899;">
        ← Kembali
    </a>
</div>
@endsection
