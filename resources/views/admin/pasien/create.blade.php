@extends('layouts.app')

@section('title', 'Tambah Pasien')

@section('content')

<div class="card border border-pink-400 shadow-sm mx-auto" style="max-width:600px;">

    <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2" 
        style="font-family: 'Poppins', sans-serif; color:#db2777;">
        <i class="fas fa-user-plus"></i> FORM TAMBAH PASIEN
    </h5>

    <div class="card-body">
        <form action="{{ route('admin.pasien.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nama" class="form-label fw-semibold" style="color:#db2777;">Nama Pasien</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
                @error('nama')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label fw-semibold" style="color:#db2777;">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" rows="3">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label fw-semibold" style="color:#db2777;">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option value="L" {{ old('jenis_kelamin')=='L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin')=='P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="no_telp" class="form-label fw-semibold" style="color:#db2777;">No. Telepon</label>
                <input type="text" name="no_telp" id="no_telp" class="form-control" value="{{ old('no_telp') }}">
                @error('no_telp')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="keluhan" class="form-label fw-semibold" style="color:#db2777;">Keluhan</label>
                <textarea name="keluhan" id="keluhan" class="form-control" rows="2">{{ old('keluhan') }}</textarea>
                @error('keluhan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal_berobat" class="form-label fw-semibold" style="color:#db2777;">Tanggal Berobat</label>
                <input type="date" name="tanggal_berobat" id="tanggal_berobat" class="form-control" value="{{ old('tanggal_berobat') }}" required>
                @error('tanggal_berobat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="dokter_id" class="form-label fw-semibold" style="color:#db2777;">Dokter</label>
                <select name="dokter_id" id="dokter_id" class="form-select">
                    <option value="">-- Pilih Dokter --</option>
                    @foreach($dokters as $dokter)
                        <option value="{{ $dokter->id }}" {{ old('dokter_id')==$dokter->id ? 'selected' : '' }}>
                            {{ $dokter->nama }}
                        </option>
                    @endforeach
                </select>
                @error('dokter_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.pasien.index') }}" class="btn text-white flex-1" style="background-color:#f9a8d4;">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn text-white flex-1" style="background-color:#db2777;">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
