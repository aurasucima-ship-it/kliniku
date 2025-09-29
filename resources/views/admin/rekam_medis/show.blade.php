@extends('layouts.app')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="container mx-auto p-4 max-w-2xl">
    <h1 class="text-2xl font-semibold mb-4 text-pink-600">Detail Rekam Medis</h1>

    <div class="bg-pink-50 border border-pink-200 rounded p-4 shadow">
        <p><strong>Pasien:</strong> {{ $rekamMedis->pasien->nama ?? '-' }}</p>
        <p><strong>Dokter:</strong> {{ $rekamMedis->dokter->nama ?? '-' }}</p>
        <p><strong>Keluhan:</strong> {{ $rekamMedis->keluhan }}</p>
        <p><strong>Diagnosa:</strong> {{ $rekamMedis->diagnosa }}</p>
        <p><strong>Tindakan:</strong> {{ $rekamMedis->tindakan }}</p>
        <p><strong>Resep Obat:</strong> {{ $rekamMedis->resep_obat }}</p>
        <p><strong>Catatan:</strong> {{ $rekamMedis->catatan }}</p>
        <p><strong>Tanggal Pemeriksaan:</strong> {{ $rekamMedis->tanggal_pemeriksaan }}</p>
    </div>

    <div class="mt-4 flex gap-2">
        <a href="{{ route('admin.rekam_medis.index') }}" class="bg-pink-300 hover:bg-pink-400 text-white px-4 py-2 rounded font-medium shadow">Kembali</a>
        <a href="{{ route('admin.rekam_medis.edit', $rekamMedis->id) }}" class="bg-pink-200 hover:bg-pink-300 text-pink-800 px-4 py-2 rounded font-medium shadow">Edit</a>
    </div>
</div>
@endsection
