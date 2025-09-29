@extends('layouts.app')

@section('title', 'Edit Dokter')

@section('content')
<div class="card border border-pink-400 shadow-sm p-4">
    <h5 class="card-header mb-4 text-center">Edit Dokter</h5>

    <form action="{{ route('admin.dokter.update', $dokter->id) }}" method="POST">
        @csrf
        @method('PUT')

     
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Dokter</label>
            <input type="text" name="nama" id="nama" 
                   class="form-control @error('nama') is-invalid @enderror" 
                   value="{{ old('nama', $dokter->nama) }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

       
        <div class="mb-3">
            <label for="spesialis" class="form-label">Spesialis</label>
            <input type="text" name="spesialis" id="spesialis" 
                   class="form-control @error('spesialis') is-invalid @enderror" 
                   value="{{ old('spesialis', $dokter->spesialis) }}" required>
            @error('spesialis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" 
                      class="form-control @error('alamat') is-invalid @enderror" 
                      rows="3">{{ old('alamat', $dokter->alamat) }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    
        <div class="d-flex gap-2 justify-content-center">
            <button type="submit" class="btn btn-pink">Simpan Perubahan</button>
            <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
