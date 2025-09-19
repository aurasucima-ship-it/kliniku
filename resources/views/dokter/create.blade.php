@extends('layouts.app')

@section('title', 'Tambah Dokter')

@section('content')
<div class="card border border-pink-400 shadow-sm p-4 mx-auto" style="max-width: 600px;">
    <h5 class="card-header mb-4 text-center">Tambah Dokter</h5>

    <form action="{{ route('dokter.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nama Dokter -->
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Dokter</label>
            <input type="text" name="nama" id="nama" 
                   class="form-control @error('nama') is-invalid @enderror" 
                   value="{{ old('nama') }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Spesialis -->
        <div class="mb-3">
            <label for="spesialis" class="form-label">Spesialis</label>
            <input type="text" name="spesialis" id="spesialis" 
                   class="form-control @error('spesialis') is-invalid @enderror" 
                   value="{{ old('spesialis') }}" required>
            @error('spesialis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Alamat -->
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" rows="3" 
                      class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Foto Dokter -->
        <div class="mb-4">
            <label for="foto" class="form-label">Foto Dokter</label>
            <input type="file" name="foto" id="foto" accept="image/*" 
                   class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <!-- Preview Foto -->
            <div class="mt-3">
                <img id="previewFoto" class="w-32 h-32 object-cover rounded-lg border border-gray-300" style="display:none;">
            </div>
        </div>

        <!-- Tombol -->
        <div class="d-flex gap-2 justify-content-center">
            <button type="submit" class="btn btn-pink">Simpan</button>
            <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Preview foto sebelum submit
    const fotoInput = document.getElementById('foto');
    const preview = document.getElementById('previewFoto');

    fotoInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });
});
</script>
@endpush
