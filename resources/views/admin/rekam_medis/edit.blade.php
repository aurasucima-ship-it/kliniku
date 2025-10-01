@extends('layouts.app')

@section('title', 'Edit Rekam Medis')

@section('content')
<div class="max-w-3xl mx-auto py-8">

    <div class="card border border-pink-400 shadow-sm rounded-lg">

        <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2" 
            style="font-family: 'Poppins', sans-serif; color:#db2777;">
            <i class="fas fa-notes-medical"></i> FORM EDIT REKAM MEDIS
        </h5>

        <div class="card-body p-4">
            <form action="{{ route('admin.rekam_medis.update', $rekamMedis->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="pasien_id" class="form-label fw-semibold" style="color:#db2777;">Pasien</label>
                    <select name="pasien_id" id="pasien_id" class="form-select @error('pasien_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Pasien --</option>
                        @foreach($pasiens as $pasien)
                            <option value="{{ $pasien->id }}" {{ $rekamMedis->pasien_id == $pasien->id ? 'selected' : '' }}>
                                {{ $pasien->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('pasien_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="dokter_id" class="form-label fw-semibold" style="color:#db2777;">Dokter</label>
                    <select name="dokter_id" id="dokter_id" class="form-select @error('dokter_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach($dokters as $dokter)
                            <option value="{{ $dokter->id }}" {{ $rekamMedis->dokter_id == $dokter->id ? 'selected' : '' }}>
                                {{ $dokter->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('dokter_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="keluhan" class="form-label fw-semibold" style="color:#db2777;">Keluhan</label>
                    <textarea name="keluhan" id="keluhan" class="form-control @error('keluhan') is-invalid @enderror" rows="2">{{ old('keluhan', $rekamMedis->keluhan) }}</textarea>
                    @error('keluhan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="diagnosa" class="form-label fw-semibold" style="color:#db2777;">Diagnosa</label>
                    <textarea name="diagnosa" id="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror" rows="2">{{ old('diagnosa', $rekamMedis->diagnosa) }}</textarea>
                    @error('diagnosa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tindakan" class="form-label fw-semibold" style="color:#db2777;">Tindakan</label>
                    <textarea name="tindakan" id="tindakan" class="form-control @error('tindakan') is-invalid @enderror" rows="2">{{ old('tindakan', $rekamMedis->tindakan) }}</textarea>
                    @error('tindakan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="resep_obat" class="form-label fw-semibold" style="color:#db2777;">Resep Obat</label>
                    <textarea name="resep_obat" id="resep_obat" class="form-control @error('resep_obat') is-invalid @enderror" rows="2">{{ old('resep_obat', $rekamMedis->resep_obat) }}</textarea>
                    @error('resep_obat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="catatan" class="form-label fw-semibold" style="color:#db2777;">Catatan Tambahan</label>
                    <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="2">{{ old('catatan', $rekamMedis->catatan) }}</textarea>
                    @error('catatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal_pemeriksaan" class="form-label fw-semibold" style="color:#db2777;">Tanggal Pemeriksaan</label>
                    <input type="date" name="tanggal_pemeriksaan" id="tanggal_pemeriksaan" class="form-control @error('tanggal_pemeriksaan') is-invalid @enderror" 
                           value="{{ old('tanggal_pemeriksaan', $rekamMedis->tanggal_pemeriksaan) }}" required>
                    @error('tanggal_pemeriksaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2 justify-center">
                    <a href="{{ route('admin.rekam_medis.index') }}" class="btn text-white flex-1" style="background-color:#f9a8d4;">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn text-white flex-1" style="background-color:#db2777;">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>

            </form>
        </div>

    </div>

</div>
@endsection
