@extends('layouts.app')

@section('title', 'Tambah Dokter')

@section('content')
<div class="card border border-pink-400 shadow-sm p-4 mx-auto" style="max-width: 600px;">
    <h5 class="card-header mb-4 text-center">Tambah Dokter</h5>

    <form action="{{ route('dokter.store') }}" method="POST">
        @csrf

    
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Dokter</label>
            <input type="text" name="nama" id="nama" 
                   class="form-control @error('nama') is-invalid @enderror" 
                   value="{{ old('nama') }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    
        <div class="mb-3">
            <label for="spesialis" class="form-label">Spesialis</label>
            <input type="text" name="spesialis" id="spesialis" 
                   class="form-control @error('spesialis') is-invalid @enderror" 
                   value="{{ old('spesialis') }}" required>
            @error('spesialis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

     
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" rows="3" 
                      class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        
        <div class="d-flex gap-2 justify-content-center">
            <button type="submit" class="btn btn-pink">Simpan</button>
            <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
