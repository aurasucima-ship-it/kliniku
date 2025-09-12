@extends('layouts.app')

@section('title', 'Edit Pasien')

@section('content')
<div class="card">
    <h5 class="card-header">Edit Pasien</h5>
    <div class="card-body">
        <form action="{{ route('pasien.update', $pasien->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pasien</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $pasien->nama) }}" required>
            </div>

            {{-- Alamat --}}
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" rows="2">{{ old('alamat', $pasien->alamat) }}</textarea>
            </div>

            {{-- Jenis Kelamin --}}
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="L" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            {{-- No. Telepon --}}
            <div class="mb-3">
                <label for="no_telp" class="form-label">No. Telepon</label>
                <input type="text" name="no_telp" id="no_telp" class="form-control" value="{{ old('no_telp', $pasien->no_telp) }}">
            </div>

            {{-- Keluhan --}}
            <div class="mb-3">
                <label for="keluhan" class="form-label">Keluhan</label>
                <textarea name="keluhan" id="keluhan" class="form-control" rows="2">{{ old('keluhan', $pasien->keluhan) }}</textarea>
            </div>

            {{-- Tanggal Berobat --}}
            <div class="mb-3">
                <label for="tanggal_berobat" class="form-label">Tanggal Berobat</label>
                <input type="date" name="tanggal_berobat" id="tanggal_berobat" class="form-control" value="{{ old('tanggal_berobat', $pasien->tanggal_berobat) }}" required>
            </div>

            {{-- Dokter --}}
            <div class="mb-3">
                <label for="dokter_id" class="form-label">Dokter</label>
                <select name="dokter_id" id="dokter_id" class="form-control">
                    <option value="">-- Pilih Dokter --</option>
                    @foreach($dokters as $dokter)
                        <option value="{{ $dokter->id }}" {{ old('dokter_id', $pasien->dokter_id) == $dokter->id ? 'selected' : '' }}>
                            {{ $dokter->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
