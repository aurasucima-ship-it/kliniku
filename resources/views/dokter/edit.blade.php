@extends('layouts.app')

@section('title', 'Edit Dokter')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-lg font-bold mb-4">Edit Dokter</h2>

    <form action="{{ route('dokter.update', $dokter->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $dokter->nama) }}" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block">Spesialis</label>
            <input type="text" name="spesialis" value="{{ old('spesialis', $dokter->spesialis) }}" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block">Alamat</label>
            <input type="text" name="alamat" value="{{ old('alamat', $dokter->alamat) }}" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
    </form>
</div>
@endsection
