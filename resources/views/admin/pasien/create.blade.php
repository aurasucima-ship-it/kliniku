@extends('layouts.app')

@section('title', 'Tambah Pasien')

@section('content')
<div class="card border border-pink-400 shadow-sm mx-auto" style="max-width:600px;">

    <!-- Header -->
    <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2" 
        style="font-family: 'Poppins', sans-serif; color:#db2777;">
        <i class="fas fa-user-plus"></i> FORM TAMBAH PASIEN
    </h5>

    <div class="card-body">
        <form action="{{ route('admin.pasien.store') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Pasien</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <!-- Alamat -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required></textarea>
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <!-- Dokter -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Dokter</label>
                <select name="dokter_id" class="form-select" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach($dokters as $dokter)
                        <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.pasien.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn" 
                        style="background-color:#db2777; color:#fff; font-weight:500;">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
