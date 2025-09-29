@extends('layouts.app')

@section('title', 'Edit Rekam Medis')

@section('content')
<div class="container mx-auto p-4 max-w-2xl">
    <h1 class="text-2xl font-semibold mb-4 text-pink-600">Edit Rekam Medis</h1>

    @if($errors->any())
        <div class="bg-pink-100 text-pink-700 px-4 py-3 rounded shadow mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dokter.rekam_medis.update', $rekamMedis->id) }}" method="POST">
        @csrf @method('PUT')

        <!-- Pilih Pasien -->
        <div class="mb-3">
            <label class="block mb-1 font-medium text-pink-700">Pasien</label>
            <select name="pasien_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300">
                @foreach($pasiens as $p)
                    <option value="{{ $p->id }}" {{ $rekamMedis->pasien_id == $p->id ? 'selected' : '' }}>
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Dokter otomatis (hidden) -->
        <input type="hidden" name="dokter_id" value="{{ auth()->user()->dokter->id }}">

        @php
        $fields = ['keluhan', 'diagnosa', 'tindakan', 'resep_obat', 'catatan'];
        @endphp

        @foreach($fields as $field)
            <div class="mb-3">
                <label class="block mb-1 font-medium text-pink-700">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                @if($field == 'catatan')
                    <textarea name="{{ $field }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300">{{ old($field, $rekamMedis->$field) }}</textarea>
                @else
                    <input type="text" name="{{ $field }}" value="{{ old($field, $rekamMedis->$field) }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300">
                @endif
            </div>
        @endforeach

        <div class="mb-3">
            <label class="block mb-1 font-medium text-pink-700">Tanggal Pemeriksaan</label>
            <input type="date" name="tanggal_pemeriksaan" value="{{ old('tanggal_pemeriksaan', $rekamMedis->tanggal_pemeriksaan) }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300">
        </div>

        <div class="flex gap-2">
            <button class="bg-pink-400 hover:bg-pink-500 text-white px-4 py-2 rounded font-medium shadow">Update</button>
            <a href="{{ route('dokter.rekam_medis.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded font-medium shadow">Batal</a>
        </div>
    </form>
</div>
@endsection
