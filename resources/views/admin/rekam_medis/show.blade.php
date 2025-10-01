@extends('layouts.app')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="max-w-3xl mx-auto p-4">

    <div class="card border border-pink-400 shadow-sm mb-4">

        <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2" 
            style="font-family: 'Poppins', sans-serif; color:#db2777;">
            <i class="fas fa-notes-medical"></i> DETAIL REKAM MEDIS
        </h5>

        <div class="card-body">
            <p class="mb-2"><strong style="color:#db2777;">Pasien:</strong> {{ $rekamMedis->pasien->nama ?? '-' }}</p>
            <p class="mb-2"><strong style="color:#db2777;">Dokter:</strong> {{ $rekamMedis->dokter->nama ?? '-' }}</p>
            <p class="mb-2"><strong style="color:#db2777;">Keluhan:</strong> {{ $rekamMedis->keluhan ?? '-' }}</p>
            <p class="mb-2"><strong style="color:#db2777;">Diagnosa:</strong> {{ $rekamMedis->diagnosa ?? '-' }}</p>
            <p class="mb-2"><strong style="color:#db2777;">Tindakan:</strong> {{ $rekamMedis->tindakan ?? '-' }}</p>
            <p class="mb-2"><strong style="color:#db2777;">Resep Obat:</strong> {{ $rekamMedis->resep_obat ?? '-' }}</p>
            <p class="mb-2"><strong style="color:#db2777;">Catatan:</strong> {{ $rekamMedis->catatan ?? '-' }}</p>
            <p class="mb-0"><strong style="color:#db2777;">Tanggal Pemeriksaan:</strong> {{ \Carbon\Carbon::parse($rekamMedis->tanggal_pemeriksaan)->format('d M Y') }}</p>
        </div>
    </div>

    <div class="text-center flex justify-center gap-2">
        <a href="{{ route('admin.rekam_medis.index') }}" 
           class="btn btn-pink px-4 py-2 shadow">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    
    </div>

</div>
@endsection
