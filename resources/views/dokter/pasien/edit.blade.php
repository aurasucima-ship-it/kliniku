@extends('layouts.app')

@section('title', 'Edit Pasien')

@section('content')
<div class="card border-pink-400 shadow-sm mx-auto" style="max-width:600px;">
    <h5 class="card-header bg-pink-500 text-white">Edit Pasien</h5>
    <div class="card-body">
        <form action="{{ route('dokter.pasien.update', $pasien->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="mb-2">
                <label for="nama" class="form-label">Nama Pasien</label>
                <input type="text" name="nama" id="nama" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1" value="{{ old('nama', $pasien->nama) }}" required>
            </div>

            <!-- Alamat -->
            <div class="mb-2">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1" rows="2">{{ old('alamat', $pasien->alamat) }}</textarea>
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-2">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1" required>
                    <option value="L" {{ old('jenis_kelamin', $pasien->jenis_kelamin)=='L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $pasien->jenis_kelamin)=='P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <!-- No Telepon -->
            <div class="mb-2">
                <label for="no_telp" class="form-label">No. Telepon</label>
                <input type="text" name="no_telp" id="no_telp" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1" value="{{ old('no_telp', $pasien->no_telp) }}">
            </div>

            <!-- Keluhan -->
            <div class="mb-2">
                <label for="keluhan" class="form-label">Keluhan</label>
                <textarea name="keluhan" id="keluhan" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1" rows="2">{{ old('keluhan', $pasien->keluhan) }}</textarea>
            </div>

            <!-- Tanggal Berobat -->
            <div class="mb-2">
                <label for="tanggal_berobat" class="form-label">Tanggal Berobat</label>
                <input type="date" name="tanggal_berobat" id="tanggal_berobat" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1" value="{{ old('tanggal_berobat', $pasien->tanggal_berobat->format('Y-m-d')) }}" required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-pink bg-pink-500 hover:bg-pink-600 text-white flex-grow-1">Simpan</button>
                <a href="{{ route('dokter.pasien.index') }}" class="btn btn-secondary flex-grow-1">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
