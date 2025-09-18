@extends('layouts.app')

@section('title', 'Edit Dokter')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-lg font-bold mb-4">Edit Dokter</h2>

    <form action="{{ route('dokter.update', $dokter->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $dokter->nama) }}" 
                   class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Spesialis</label>
            <input type="text" name="spesialis" value="{{ old('spesialis', $dokter->spesialis) }}" 
                   class="form-control">
        </div>

        <div class="mb-4">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" value="{{ old('alamat', $dokter->alamat) }}" 
                   class="form-control">
        </div>

        <div class="d-flex gap-2">
            <!-- Tombol Simpan -->
            <button type="submit" class="btn text-white" 
                    style="background-color:#ec4899;">
                Simpan
            </button>

            <!-- Tombol Batal -->
            <a href="{{ route('dokter.index') }}" class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
