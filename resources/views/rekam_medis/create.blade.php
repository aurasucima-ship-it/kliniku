@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-semibold mb-4 text-center d-flex justify-content-center align-items-center gap-2" 
        style="font-family: 'Poppins', sans-serif; color:#db2777;">
        <i class="fas fa-notes-medical"></i>
        Tambah Rekam Medis
    </h2>

    <form action="{{ route('rekam_medis.store') }}" method="POST">
        @csrf

        <div class="mb-2">
            <label for="pasien_id" class="form-label" style="color:#db2777;">Pasien</label>
            <select name="pasien_id" id="pasien_id" class="form-control form-control-sm border-pink" required>
                <option value="">-- Pilih Pasien --</option>
                @foreach($pasiens as $pasien)
                    <option value="{{ $pasien->id }}">{{ $pasien->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label for="dokter_id" class="form-label" style="color:#db2777;">Dokter</label>
            <select name="dokter_id" id="dokter_id" class="form-control form-control-sm border-pink" required>
                <option value="">-- Pilih Dokter --</option>
                @foreach($dokters as $dokter)
                    <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label for="keluhan" class="form-label" style="color:#db2777;">Keluhan</label>
            <textarea name="keluhan" id="keluhan" class="form-control form-control-sm border-pink" rows="2" required></textarea>
        </div>

        <div class="mb-2">
            <label for="diagnosa" class="form-label" style="color:#db2777;">Diagnosa</label>
            <textarea name="diagnosa" id="diagnosa" class="form-control form-control-sm border-pink" rows="2"></textarea>
        </div>

        <div class="mb-2">
            <label for="tindakan" class="form-label" style="color:#db2777;">Tindakan</label>
            <textarea name="tindakan" id="tindakan" class="form-control form-control-sm border-pink" rows="2"></textarea>
        </div>

        <div class="mb-2">
            <label for="resep_obat" class="form-label" style="color:#db2777;">Resep Obat</label>
            <textarea name="resep_obat" id="resep_obat" class="form-control form-control-sm border-pink" rows="2"></textarea>
        </div>

        <div class="mb-2">
            <label for="catatan" class="form-label" style="color:#db2777;">Catatan Tambahan</label>
            <textarea name="catatan" id="catatan" class="form-control form-control-sm border-pink" rows="2"></textarea>
        </div>

        <div class="mb-3">
            <label for="tanggal_pemeriksaan" class="form-label" style="color:#db2777;">Tanggal Pemeriksaan</label>
            <input type="date" name="tanggal_pemeriksaan" id="tanggal_pemeriksaan" 
                   class="form-control form-control-sm border-pink" required>
        </div>

        <div class="d-flex gap-2">
            <!-- Tombol Simpan -->
            <button type="submit" 
                    class="btn btn-sm"
                    style="background-color:#ec4899; color:white;">
                Simpan
            </button>

            <!-- Tombol Batal -->
            <a href="{{ route('rekam_medis.index') }}" 
               class="btn btn-sm"
               style="background-color:#f9a8d4; color:white;">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
