@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Rekam Medis</h2>

    <form action="{{ route('rekam_medis.update', $rekamMedis->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="pasien_id" class="form-label">Pasien</label>
            <select name="pasien_id" id="pasien_id" class="form-control" required>
                @foreach($pasiens as $pasien)
                    <option value="{{ $pasien->id }}" {{ $rekamMedis->pasien_id == $pasien->id ? 'selected' : '' }}>
                        {{ $pasien->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="dokter_id" class="form-label">Dokter</label>
            <select name="dokter_id" id="dokter_id" class="form-control" required>
                @foreach($dokters as $dokter)
                    <option value="{{ $dokter->id }}" {{ $rekamMedis->dokter_id == $dokter->id ? 'selected' : '' }}>
                        {{ $dokter->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="keluhan" class="form-label">Keluhan</label>
            <textarea name="keluhan" id="keluhan" class="form-control" required>{{ $rekamMedis->keluhan }}</textarea>
        </div>

        <div class="mb-3">
            <label for="diagnosa" class="form-label">Diagnosa</label>
            <textarea name="diagnosa" id="diagnosa" class="form-control">{{ $rekamMedis->diagnosa }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tindakan" class="form-label">Tindakan</label>
            <textarea name="tindakan" id="tindakan" class="form-control">{{ $rekamMedis->tindakan }}</textarea>
        </div>

        <div class="mb-3">
            <label for="resep_obat" class="form-label">Resep Obat</label>
            <textarea name="resep_obat" id="resep_obat" class="form-control">{{ $rekamMedis->resep_obat }}</textarea>
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan Tambahan</label>
            <textarea name="catatan" id="catatan" class="form-control">{{ $rekamMedis->catatan }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tanggal_pemeriksaan" class="form-label">Tanggal Pemeriksaan</label>
            <input type="date" name="tanggal_pemeriksaan" id="tanggal_pemeriksaan" 
                   class="form-control" value="{{ $rekamMedis->tanggal_pemeriksaan }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('rekam_medis.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
