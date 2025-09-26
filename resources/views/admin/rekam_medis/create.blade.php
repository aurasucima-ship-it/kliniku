@extends('layouts.admin')

@section('title', 'Tambah Rekam Medis')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Tambah Rekam Medis</h2>

    <form action="{{ route('admin.rekam_medis.store') }}" method="POST">
        @csrf

        <label class="block mb-2">Pasien</label>
        <select name="pasien_id" class="w-full border rounded p-2 mb-4">
            <option value="">-- Pilih Pasien --</option>
            @foreach($pasiens as $pasien)
                <option value="{{ $pasien->id }}">{{ $pasien->nama }}</option>
            @endforeach
        </select>

        <label class="block mb-2">Dokter</label>
        <select name="dokter_id" class="w-full border rounded p-2 mb-4">
            <option value="">-- Pilih Dokter --</option>
            @foreach($dokters as $dokter)
                <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
            @endforeach
        </select>

        <label class="block mb-2">Keluhan</label>
        <textarea name="keluhan" class="w-full border rounded p-2 mb-4"></textarea>

        <label class="block mb-2">Diagnosa</label>
        <textarea name="diagnosa" class="w-full border rounded p-2 mb-4"></textarea>

        <label class="block mb-2">Tindakan</label>
        <textarea name="tindakan" class="w-full border rounded p-2 mb-4"></textarea>

        <label class="block mb-2">Resep Obat</label>
        <textarea name="resep_obat" class="w-full border rounded p-2 mb-4"></textarea>

        <label class="block mb-2">Catatan Tambahan</label>
        <textarea name="catatan_tambahan" class="w-full border rounded p-2 mb-4"></textarea>

        <label class="block mb-2">Tanggal Pemeriksaan</label>
        <input type="date" name="tanggal_pemeriksaan" class="w-full border rounded p-2 mb-4">

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
