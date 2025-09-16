@extends('layouts.app')

@section('title', 'Tambah Pasien')

@section('content')
<div class="card border-pink-400 shadow-sm mx-auto" style="max-width:600px;">
    <h5 class="card-header bg-pink-500 text-white">Tambah Pasien</h5>
    <div class="card-body">
        <form action="{{ route('pasien.store') }}" method="POST">
            @csrf

            {{-- Nama Pasien --}}
            <div class="mb-2">
                <label for="nama" class="form-label">Nama Pasien</label>
                <input type="text" name="nama" id="nama" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1" value="{{ old('nama') }}" required>
            </div>

            {{-- Alamat --}}
            <div class="mb-2">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1" rows="2">{{ old('alamat') }}</textarea>
            </div>

            {{-- Jenis Kelamin --}}
            <div class="mb-2">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1" required>
                    <option value="">-- Pilih --</option>
                    <option value="L" {{ old('jenis_kelamin')=='L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin')=='P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            {{-- No. Telepon --}}
            <div class="mb-2">
                <label for="no_telp" class="form-label">No. Telepon</label>
                <input type="text" name="no_telp" id="no_telp" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1" value="{{ old('no_telp') }}">
            </div>

            {{-- Keluhan --}}
            <div class="mb-2">
                <label for="keluhan" class="form-label">Keluhan</label>
                <textarea name="keluhan" id="keluhan" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1" rows="2">{{ old('keluhan') }}</textarea>
            </div>

            {{-- Tanggal Berobat --}}
            <div class="mb-2">
                <label for="tanggal_berobat" class="form-label">Tanggal Berobat</label>
                <input type="date" name="tanggal_berobat" id="tanggal_berobat" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1" value="{{ old('tanggal_berobat') }}" required>
            </div>

            {{-- Dokter --}}
            <div class="mb-3">
                <label for="dokter_id" class="form-label">Dokter</label>
                <select name="dokter_id" id="dokter_id" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1">
                    <option value="">-- Pilih Dokter --</option>
                    @foreach($dokters as $dokter)
                        <option value="{{ $dokter->id }}" {{ old('dokter_id')==$dokter->id ? 'selected' : '' }}>
                            {{ $dokter->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tombol --}}
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-pink bg-pink-500 hover:bg-pink-600 text-white flex-grow-1">Simpan</button>
                <a href="{{ route('pasien.index') }}" class="btn btn-pink bg-pink-300 hover:bg-pink-400 text-white flex-grow-1">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
