@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-pink-600 text-center fw-semibold mb-4 d-flex justify-content-center align-items-center gap-2" style="font-family: 'Poppins', sans-serif;">
        <i class="fas fa-notes-medical"></i>
        Edit Rekam Medis
    </h2>

    <form action="{{ route('rekam_medis.update', $rekamMedis->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-2">
            <label for="pasien_id" class="form-label text-pink-600">Pasien</label>
            <select name="pasien_id" id="pasien_id" class="form-control form-control-sm border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200" required>
                @foreach($pasiens as $pasien)
                    <option value="{{ $pasien->id }}" {{ $rekamMedis->pasien_id == $pasien->id ? 'selected' : '' }}>
                        {{ $pasien->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label for="dokter_id" class="form-label text-pink-600">Dokter</label>
            <select name="dokter_id" id="dokter_id" class="form-control form-control-sm border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200" required>
                @foreach($dokters as $dokter)
                    <option value="{{ $dokter->id }}" {{ $rekamMedis->dokter_id == $dokter->id ? 'selected' : '' }}>
                        {{ $dokter->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label for="keluhan" class="form-label text-pink-600">Keluhan</label>
            <textarea name="keluhan" id="keluhan" class="form-control form-control-sm border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200" rows="2" required>{{ $rekamMedis->keluhan }}</textarea>
        </div>

        <div class="mb-2">
            <label for="diagnosa" class="form-label text-pink-600">Diagnosa</label>
            <textarea name="diagnosa" id="diagnosa" class="form-control form-control-sm border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200" rows="2">{{ $rekamMedis->diagnosa }}</textarea>
        </div>

        <div class="mb-2">
            <label for="tindakan" class="form-label text-pink-600">Tindakan</label>
            <textarea name="tindakan" id="tindakan" class="form-control form-control-sm border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200" rows="2">{{ $rekamMedis->tindakan }}</textarea>
        </div>

        <div class="mb-2">
            <label for="resep_obat" class="form-label text-pink-600">Resep Obat</label>
            <textarea name="resep_obat" id="resep_obat" class="form-control form-control-sm border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200" rows="2">{{ $rekamMedis->resep_obat }}</textarea>
        </div>

        <div class="mb-2">
            <label for="catatan" class="form-label text-pink-600">Catatan Tambahan</label>
            <textarea name="catatan" id="catatan" class="form-control form-control-sm border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200" rows="2">{{ $rekamMedis->catatan }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tanggal_pemeriksaan" class="form-label text-pink-600">Tanggal Pemeriksaan</label>
            <input type="date" name="tanggal_pemeriksaan" id="tanggal_pemeriksaan" 
                   class="form-control form-control-sm border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200" 
                   value="{{ $rekamMedis->tanggal_pemeriksaan }}" required>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-sm bg-pink-500 hover:bg-pink-600 text-white">Update</button>
            <a href="{{ route('rekam_medis.index') }}" class="btn btn-sm bg-pink-300 hover:bg-pink-400 text-white">Batal</a>
        </div>
    </form>
</div>
@endsection
