@extends('layouts.admin')

@section('title', 'Edit Rekam Medis')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Edit Rekam Medis</h2>

    <form action="{{ route('admin.rekam_medis.update', $rekamMedis->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block mb-2">Pasien</label>
        <select name="pasien_id" class="w-full border rounded p-2 mb-4">
            <option value="">-- Pilih Pasien --</option>
            @foreach($pasiens as $pasien)
                <option value="{{ $pasien->id }}" {{ $rekamMedis->pasien_id == $pasien->id ? 'selected' : '' }}>{{ $pasien->nama }}</option>
            @endforeach
        </select>

        <label class="block mb-2">Dokter</label>
        <select name="dokter_id" class="w-full border rounded p-2 mb-4">
            <option value="">-- Pilih Dokter --</option>
            @foreach($dokters as $dokter)
                <option value="{{ $dokter->id }}" {{ $rekamMedis->dokter_id == $dokter->id ? 'selected' : '' }}>{{ $dokter->nama }}</option>
            @endforeach
        </select>

        <label class="block mb-2">Keluhan</label>
        <textarea name="keluhan" class="w-full border rounded p-2 mb-4">{{ $rekamMedis->keluhan }}</textarea>

        <label class="block mb-2">Diagnosa</label>
        <textarea name="diagnosa" class="w-full border rounded p-2 mb-4">{{ $rekamMedis->diagnosa }}</textarea>

        <label class="block mb-2">Tindakan</label>
        <textarea name="tindakan" class="w-full border rounded p-2 mb-4">{{ $rekamMedis->tindakan }}</textarea>

        <label class="block mb-2">Resep Obat</label>
        <textarea name="resep_obat" class="w-full border rounded p-2 mb-4">{{ $rekamMedis->resep_obat }}</textarea>

        <label class="block mb-2">Catatan Tambahan</label>
        <textarea name="catatan_tambahan" class="w-full border rounded p-2 mb-4">{{ $rekamMedis->catatan_tambahan }}</textarea>

        <label class="block mb-2">Tanggal Pemeriksaan</label>
        <input type="date" name="tanggal_pemeriksaan" value="{{ $rekamMedis->tanggal_pemeriksaan }}" class="w-full border rounded p-2 mb-4">

        <button type="submit" class="bg-yellow-400 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
