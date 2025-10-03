@extends('layouts.app')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="max-w-4xl mx-auto py-6">

    <div class="card border border-pink-300 shadow-sm rounded-2xl">

        <!-- Header -->
        <h5 class="card-header text-center fs-4 fw-bold d-flex justify-content-center align-items-center gap-2"
            style="background: linear-gradient(90deg, #ffffff, #ffffff); color:#f73e88; letter-spacing:1px; border-top-left-radius:1rem; border-top-right-radius:1rem;">
            <i class="fas fa-file-medical"></i>
            DETAIL REKAM MEDIS
        </h5>

        <!-- Body -->
        <div class="p-6">
            <div class="mb-4">
                <strong class="text-pink-600">Tanggal Pemeriksaan:</strong><br>
                {{ \Carbon\Carbon::parse($rekamMedis->tanggal_pemeriksaan)->format('d/m/Y') }}
            </div>

            <div class="mb-4">
                <strong class="text-pink-600">Dokter:</strong><br>
                {{ optional($rekamMedis->dokter)->nama ?? '-' }}
            </div>

            <div class="mb-4">
                <strong class="text-pink-600">Keluhan:</strong><br>
                {{ $rekamMedis->keluhan ?? '-' }}
            </div>

            <div class="mb-4">
                <strong class="text-pink-600">Diagnosa:</strong><br>
                {{ $rekamMedis->diagnosa ?? '-' }}
            </div>

            <div class="mb-4">
                <strong class="text-pink-600">Tindakan:</strong><br>
                {{ $rekamMedis->tindakan ?? '-' }}
            </div>

            <div class="mb-4">
                <strong class="text-pink-600">Resep Obat:</strong><br>
                {{ $rekamMedis->resep_obat ?? '-' }}
            </div>

            <div class="mb-4">
                <strong class="text-pink-600">Catatan:</strong><br>
                {{ $rekamMedis->catatan ?? '-' }}
            </div>

            <div class="text-center mt-6">
                <a href="{{ route('pasien.rekam_medis.index') }}" 
                   class="btn btn-sm px-4 py-2 text-white" 
                   style="background-color:#f73e88; border-radius:0.75rem;">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
