@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Rekam Medis</h2>

    <form action="{{ route('rekam_medis.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="pasien_id" class="form-label">Pasien</label>
            <select name="pasien_id" id="pasien_id" class="form-control" required>
                <option value="">-- Pilih Pasien --</option>
                @foreach($pasiens as $pasien)
                    <option value="{{ $pasien->id }}">{{ $pasien->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="dokter_id" class="form-label">Dokter</label>
            <select name="dokter_id" id="dokter_id" class="form-control" required>
                <option value="">-- Pilih Dokter --</option>
                @foreach($dokters as $dokter)
                    <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="keluhan" class="form-label">Keluhan</label>
            <textarea name="keluhan" id="keluhan" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="diagnosa" class="form-label">Diagnosa</label>
            <textarea name="diagnosa" id="diagnosa" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="tindakan" class="form-label">Tindakan</label>
            <textarea name="tindakan" id="tindakan" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="resep_obat" class="form-label">Resep Obat</label>
            <textarea name="resep_obat" id="resep_obat" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan Tambahan</label>
            <textarea name="catatan" id="catatan" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="tanggal_pemeriksaan" class="form-label">Tanggal Pemeriksaan</label>
            <input type="date" name="tanggal_pemeriksaan" id="tanggal_pemeriksaan" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('rekam_medis.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
