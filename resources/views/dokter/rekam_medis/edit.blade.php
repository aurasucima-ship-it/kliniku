@extends('layouts.app')

@section('title', 'Edit Rekam Medis')

@section('content')
<div class="card border-pink-400 shadow-sm mx-auto" style="max-width:600px;">
    <h5 class="card-header bg-pink-500 text-white">Edit Rekam Medis</h5>
    <div class="card-body">
        <form action="{{ route('dokter.rekam_medis.update', $rekamMedis->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-2">
                <label for="pasien_id" class="form-label">Pasien</label>
                <select name="pasien_id" id="pasien_id" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1" required>
                    @foreach($pasiens as $p)
                        <option value="{{ $p->id }}" {{ old('pasien_id', $rekamMedis->pasien_id) == $p->id ? 'selected' : '' }}>
                            {{ $p->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label for="keluhan" class="form-label">Keluhan</label>
                <input type="text" name="keluhan" id="keluhan" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1"
                       value="{{ old('keluhan', $rekamMedis->keluhan) }}">
            </div>

            <div class="mb-2">
                <label for="diagnosa" class="form-label">Diagnosa</label>
                <input type="text" name="diagnosa" id="diagnosa" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1"
                       value="{{ old('diagnosa', $rekamMedis->diagnosa) }}">
            </div>

            <div class="mb-2">
                <label for="tindakan" class="form-label">Tindakan</label>
                <input type="text" name="tindakan" id="tindakan" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1"
                       value="{{ old('tindakan', $rekamMedis->tindakan) }}">
            </div>

            <div class="mb-2">
                <label for="resep_obat" class="form-label">Resep Obat</label>
                <input type="text" name="resep_obat" id="resep_obat" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1"
                       value="{{ old('resep_obat', $rekamMedis->resep_obat) }}">
            </div>

            <div class="mb-2">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea name="catatan" id="catatan" rows="2"
                          class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1">{{ old('catatan', $rekamMedis->catatan) }}</textarea>
            </div>

            <div class="mb-2">
                <label for="tanggal_pemeriksaan" class="form-label">Tanggal Pemeriksaan</label>
                <input type="date" name="tanggal_pemeriksaan" id="tanggal_pemeriksaan"
                       class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1"
                       value="{{ old('tanggal_pemeriksaan', $rekamMedis->tanggal_pemeriksaan) }}">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn bg-pink-500 hover:bg-pink-600 text-white flex-grow-1">Simpan</button>
                <a href="{{ route('dokter.rekam_medis.index') }}" class="btn btn-secondary flex-grow-1">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
