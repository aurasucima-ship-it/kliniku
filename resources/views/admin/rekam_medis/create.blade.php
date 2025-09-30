
@extends('layouts.admin')

@extends('layouts.app')


@section('title', 'Tambah Rekam Medis')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Tambah Rekam Medis</h2>

<div class="container mx-auto p-4 max-w-2xl">
    <h1 class="text-2xl font-semibold mb-4 text-pink-600">Tambah Rekam Medis</h1>

    @if($errors->any())
        <div class="bg-pink-100 text-pink-700 px-4 py-3 rounded shadow mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif


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

        <!-- Pilih pasien -->
        <div class="mb-3">
            <label class="form-label text-pink-700">Pasien</label>
            <select name="pasien_id" class="form-select border-pink-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-200">
                @foreach($pasiens as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Pilih dokter -->
        <div class="mb-3">
            <label class="form-label text-pink-700">Dokter</label>
            <select name="dokter_id" class="form-select border-pink-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-200">
                @foreach($dokters as $d)
                    <option value="{{ $d->id }}">{{ $d->nama }}</option>
                @endforeach
            </select>
        </div>

        @php
        $fields = ['keluhan', 'diagnosa', 'tindakan', 'resep_obat', 'catatan'];
        @endphp

        @foreach($fields as $field)
            <div class="mb-3">
                <label class="form-label text-pink-700">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                @if($field == 'catatan')
                    <textarea name="{{ $field }}" class="form-control border-pink-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-200"></textarea>
                @else
                    <input type="text" name="{{ $field }}" class="form-control border-pink-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-200">
                @endif
            </div>
        @endforeach

        <!-- Tanggal pemeriksaan -->
        <div class="mb-3">
            <label class="form-label text-pink-700">Tanggal Pemeriksaan</label>
            <input type="date" name="tanggal_pemeriksaan" class="form-control border-pink-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-200" value="{{ date('Y-m-d') }}">
        </div>

        <!-- Tombol aksi -->
        <div class="flex gap-2">
            <button type="submit" class="btn btn-pink px-4 py-2 rounded shadow">Simpan</button>
            <a href="{{ route('admin.rekam_medis.index') }}" class="btn btn-secondary px-4 py-2 rounded shadow">Batal</a>
        </div>

    </form>
</div>
@endsection
