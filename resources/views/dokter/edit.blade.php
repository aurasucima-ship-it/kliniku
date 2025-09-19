@extends('layouts.app')

@section('title', 'Edit Dokter')

@section('content')
<div class="card border border-pink-400 shadow-sm p-4">
    <h5 class="card-header mb-4 text-center">Edit Dokter</h5>

    <form action="{{ route('dokter.update', $dokter->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Nama Dokter -->
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Dokter</label>
            <input type="text" name="nama" id="nama" 
                   class="form-control @error('nama') is-invalid @enderror" 
                   value="{{ old('nama', $dokter->nama) }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Spesialis -->
        <div class="mb-3">
            <label for="spesialis" class="form-label">Spesialis</label>
            <input type="text" name="spesialis" id="spesialis" 
                   class="form-control @error('spesialis') is-invalid @enderror" 
                   value="{{ old('spesialis', $dokter->spesialis) }}" required>
            @error('spesialis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Alamat -->
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" 
                      class="form-control @error('alamat') is-invalid @enderror" 
                      rows="3">{{ old('alamat', $dokter->alamat) }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Foto Dokter -->
        <div class="mb-4">
            <label for="foto" class="form-label">Foto Dokter</label>
            
            <!-- Preview foto lama -->
            @if($dokter->foto)
            <div class="mb-2">
                <img src="{{ $dokter->foto_url }}" 
                     alt="{{ $dokter->nama }}" 
                     class="rounded-lg w-32 h-32 object-cover border border-pink-300">
            </div>
            @endif

            <input type="file" name="foto" id="foto" 
                   class="form-control @error('foto') is-invalid @enderror" accept="image/*">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>

            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tombol -->
        <div class="d-flex gap-2 justify-content-center">
            <button type="submit" class="btn btn-pink">Simpan Perubahan</button>
            <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
