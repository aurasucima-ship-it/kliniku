@extends('layouts.app')

@section('title', 'Detail Rekam Medis')

@section('content')
<div style="background-color:#fde6ef; min-height:100vh; padding:50px 0;">
    <div class="container mx-auto max-w-2xl">
        <h1 class="text-2xl font-semibold mb-4 text-pink-600">Detail Rekam Medis</h1>

        <div class="bg-pink-50 border border-pink-200 rounded-3xl p-5 shadow-lg">
            <p><strong>Pasien:</strong> {{ $rekamMedis->pasien->nama ?? '-' }}</p>
            <p><strong>Dokter:</strong> {{ $rekamMedis->dokter->nama ?? '-' }}</p>
            <p><strong>Keluhan:</strong> {{ $rekamMedis->keluhan }}</p>
            <p><strong>Diagnosa:</strong> {{ $rekamMedis->diagnosa }}</p>
            <p><strong>Tindakan:</strong> {{ $rekamMedis->tindakan }}</p>
            <p><strong>Resep Obat:</strong> {{ $rekamMedis->resep_obat }}</p>
            <p><strong>Catatan:</strong> {{ $rekamMedis->catatan }}</p>
<p><strong>Tanggal Pemeriksaan:</strong> {{ $rekamMedis->tanggal_pemeriksaan->format('d/m/Y') }}</p>

        <div class="mt-4 flex gap-2">
            <a href="{{ route('dokter.rekam_medis.index') }}" 
               class="bg-pink-300 hover:bg-pink-400 text-white px-4 py-2 rounded-2xl font-medium shadow">
               Kembali
            </a>
            <a href="{{ route('dokter.rekam_medis.edit', $rekamMedis->id) }}" 
               class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-2xl font-medium shadow">
               Edit
            </a>
        </div>
    </div>
</div>
@endsection
