@extends('layouts.app')

@section('title', 'Edit Pasien')

@section('content')

<div class="card border border-pink-400 shadow-sm mx-auto" style="max-width:600px;">

    <!-- Header -->
    <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2" 
        style="font-family: 'Poppins', sans-serif; color:#db2777;">
        <i class="fas fa-user-edit"></i> FORM EDIT PASIEN
    </h5>

    <div class="card-body">
        <form action="{{ route('admin.pasien.update', $pasien->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Pasien</label>
                <input type="text" name="nama" class="form-control" 
                       value="{{ old('nama', $pasien->nama) }}" required>
            </div>

            <!-- Alamat -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $pasien->alamat) }}</textarea>
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="Laki-laki" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <!-- Dokter -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Dokter</label>
                <select name="dokter_id" class="form-select" required>
                    @foreach($dokters as $dokter)
                        <option value="{{ $dokter->id }}" 
                            {{ old('dokter_id', $pasien->dokter_id) == $dokter->id ? 'selected' : '' }}>
                            {{ $dokter->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.pasien.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn" 
                        style="background-color:#db2777; color:#fff; font-weight:500;">
                    <i class="fas fa-save"></i> Update
                </button>
            </div>
        </form>

<div class="container">
    <div class="card border-pink-300 shadow-sm">
        <h5 class="card-header text-white" style="background-color:#db2777;">
            Edit Pasien
        </h5>
        <div class="card-body">
            <form action="{{ route('admin.pasien.update', $pasien->id) }}" method="POST">
                @csrf
                @method('PUT')

             
                <div class="mb-3">
                    <label for="nama" class="form-label" style="color:#db2777;">Nama Pasien</label>
                    <input type="text" name="nama" id="nama" class="form-control" 
                        value="{{ old('nama', $pasien->nama) }}" required>
                </div>

             
                <div class="mb-3">
                    <label for="alamat" class="form-label" style="color:#db2777;">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" rows="2">{{ old('alamat', $pasien->alamat) }}</textarea>
                </div>

             
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label" style="color:#db2777;">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

            
                <div class="mb-3">
                    <label for="no_telp" class="form-label" style="color:#db2777;">No. Telepon</label>
                    <input type="text" name="no_telp" id="no_telp" class="form-control" 
                        value="{{ old('no_telp', $pasien->no_telp) }}">
                </div>

               
                <div class="mb-3">
                    <label for="keluhan" class="form-label" style="color:#db2777;">Keluhan</label>
                    <textarea name="keluhan" id="keluhan" class="form-control" rows="2">{{ old('keluhan', $pasien->keluhan) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="tanggal_berobat" class="form-label" style="color:#db2777;">Tanggal Berobat</label>
                    <input type="date" name="tanggal_berobat" id="tanggal_berobat" class="form-control" 
                        value="{{ old('tanggal_berobat', $pasien->tanggal_berobat) }}" required>
                </div>

                <div class="mb-3">
                    <label for="dokter_id" class="form-label" style="color:#db2777;">Dokter</label>
                    <select name="dokter_id" id="dokter_id" class="form-control">
                        <option value="">-- Pilih Dokter --</option>
                        @foreach($dokters as $dokter)
                            <option value="{{ $dokter->id }}" 
                                {{ old('dokter_id', $pasien->dokter_id) == $dokter->id ? 'selected' : '' }}>
                                {{ $dokter->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn text-white" style="background-color:#db2777;">
                        Update
                    </button>
                    <a href="{{ route('admin.pasien.index') }}" class="btn text-white" style="background-color:#f9a8d4;">
                        Batal
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
