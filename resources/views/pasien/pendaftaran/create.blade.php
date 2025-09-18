@extends('layouts.app')

@section('title', 'Isi Pendaftaran Pasien')

@section('content')
<div class="container my-6">

    <!-- Container Putih Seluruh Halaman -->
    <div class="bg-white shadow-lg rounded-3xl p-6">

        <!-- Judul Halaman -->
        <div class="text-center mb-5">
            <h1 class="fw-bold d-flex justify-content-center align-items-center gap-2"
                style="font-family: 'Poppins', sans-serif; font-size: 2rem; color:#db2777;">
                <i class="fas fa-pencil-alt"></i> ISI PENDAFTARAN PASIEN
            </h1>
        </div>

        <form action="{{ route('pasien.pendaftaran.store') }}" method="POST">
            @csrf

            <!-- Baris 1: Nama, Jenis Kelamin, No. Telepon -->
            <div class="d-flex flex-wrap gap-4 mb-3">
                <div style="flex: 1 1 250px;">
                    <label for="nama" class="form-label fw-semibold" style="color:#db2777; font-size:1.1rem;">Nama Pasien</label>
                    <input type="text" name="nama" id="nama" class="form-control form-control-sm border-pink" value="{{ old('nama') }}" required>
                </div>

                <div style="flex: 1 1 180px;">
                    <label for="jenis_kelamin" class="form-label fw-semibold" style="color:#db2777; font-size:1.1rem;">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control form-control-sm border-pink" required>
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div style="flex: 1 1 200px;">
                    <label for="no_telp" class="form-label fw-semibold" style="color:#db2777; font-size:1.1rem;">No. Telepon</label>
                    <input type="text" name="no_telp" id="no_telp" class="form-control form-control-sm border-pink" value="{{ old('no_telp') }}" required>
                </div>
            </div>

            <!-- Baris 2: Tanggal Berobat, Alamat, Dokter -->
            <div class="d-flex flex-wrap gap-4 mb-3">
                <div style="flex: 1 1 180px;">
                    <label for="tanggal_berobat" class="form-label fw-semibold" style="color:#db2777; font-size:1.1rem;">Tanggal Berobat</label>
                    <input type="date" name="tanggal_berobat" id="tanggal_berobat" class="form-control form-control-sm border-pink" value="{{ old('tanggal_berobat') }}" required>
                </div>

                <div style="flex: 1 1 250px;">
                    <label for="alamat" class="form-label fw-semibold" style="color:#db2777; font-size:1.1rem;">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control form-control-sm border-pink" value="{{ old('alamat') }}" required>
                </div>

                <div style="flex: 1 1 200px;">
                    <label for="dokter_id" class="form-label fw-semibold" style="color:#db2777; font-size:1.1rem;">Pilih Dokter</label>
                    <select name="dokter_id" id="dokter_id" class="form-control form-control-sm border-pink" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach($dokters as $dokter)
                            <option value="{{ $dokter->id }}" {{ old('dokter_id') == $dokter->id ? 'selected' : '' }}>
                                {{ $dokter->nama }} ({{ $dokter->spesialis }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Baris 3: Keluhan -->
            <div class="mb-3" style="max-width: 400px;">
                <label for="keluhan" class="form-label fw-semibold" style="color:#db2777; font-size:1.1rem;">Keluhan</label>
                <input type="text" name="keluhan" id="keluhan" class="form-control form-control-sm border-pink" value="{{ old('keluhan') }}" required>
            </div>

            <!-- Tombol Simpan & Batal -->
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn" style="background-color:#ec4899; color:white;">
                    Simpan
                </button>
                <a href="{{ route('pasien.pendaftaran.index') }}" class="btn" style="background-color:#f9a8d4; color:white;">
                    Batal
                </a>
            </div>

        </form>
    </div> <!-- End Container Putih -->

</div>
@endsection
