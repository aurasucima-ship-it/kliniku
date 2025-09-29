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

    <form action="{{ route('admin.rekam_medis.update', $rekamMedis->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="block mb-1 font-medium text-pink-700">Pasien</label>
            <select name="pasien_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300">
                @foreach($pasiens as $p)
                    <option value="{{ $p->id }}" {{ $rekamMedis->pasien_id == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="block mb-1 font-medium text-pink-700">Dokter</label>
            <select name="dokter_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300">
                @foreach($dokters as $d)
                    <option value="{{ $d->id }}" {{ $rekamMedis->dokter_id == $d->id ? 'selected' : '' }}>{{ $d->nama }}</option>
                @endforeach
            </select>
        </div>

        @php
        $fields = ['keluhan', 'diagnosa', 'tindakan', 'resep_obat', 'catatan'];
        @endphp

        @foreach($fields as $field)
            <div class="mb-3">
                <label class="block mb-1 font-medium text-pink-700">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                @if($field == 'catatan')
                    <textarea name="{{ $field }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300">{{ $rekamMedis->$field }}</textarea>
                @else
                    <input type="text" name="{{ $field }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300" value="{{ $rekamMedis->$field }}">
                @endif
            </div>
        @endforeach

        <div class="mb-3">
            <label class="block mb-1 font-medium text-pink-700">Tanggal Pemeriksaan</label>
            <input type="date" name="tanggal_pemeriksaan" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300" value="{{ $rekamMedis->tanggal_pemeriksaan }}">
        </div>

        <div class="flex gap-2">
            <button class="bg-pink-300 hover:bg-pink-400 text-white px-4 py-2 rounded font-medium shadow">Update</button>
            <a href="{{ route('admin.rekam_medis.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded font-medium shadow">Batal</a>
        </div>
    </form>
</div>
@endsection
