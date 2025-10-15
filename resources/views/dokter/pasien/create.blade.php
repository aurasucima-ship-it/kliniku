@extends('layouts.app')

@section('title', 'Tambah Pasien')

@section('content')
<div style="background-color:#fde6ef; min-height:100vh; padding:50px 0;">
    <div class="container">
        <div class="mx-auto rounded-4 shadow-lg p-5"
             style="max-width:650px; font-family:'Poppins', sans-serif; background-color:#fff0f6; border:2px solid #f9a8d4;">

            <h1 class="text-center fw-bold mb-4" style="color:#db2777; font-size:2rem;">
                🏥 TAMBAH PASIEN
            </h1>

            <form action="{{ route('dokter.pasien.store') }}" method="POST" style="color:#db2777;">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Pasien</label>
                    <input type="text" name="nama" id="nama" class="form-control border-2 rounded-3" 
                           style="border-color:#f472b6; background-color:#fde6ef;" value="{{ old('nama') }}" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label fw-semibold">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control border-2 rounded-3"
                              style="border-color:#f472b6; background-color:#fde6ef;" rows="2">{{ old('alamat') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label fw-semibold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control border-2 rounded-3"
                            style="border-color:#f472b6; background-color:#fff;" required>
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin')=='L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin')=='P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="no_telp" class="form-label fw-semibold">No. Telepon</label>
                    <input type="text" name="no_telp" id="no_telp" class="form-control border-2 rounded-3"
                           style="border-color:#f472b6; background-color:#fde6ef;" value="{{ old('no_telp') }}">
                </div>

                <div class="mb-3">
                    <label for="keluhan" class="form-label fw-semibold">Keluhan</label>
                    <textarea name="keluhan" id="keluhan" class="form-control border-2 rounded-3"
                              style="border-color:#f472b6; background-color:#fde6ef;" rows="2">{{ old('keluhan') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="tanggal_berobat" class="form-label fw-semibold">Tanggal Berobat</label>
                    <input type="date" name="tanggal_berobat" id="tanggal_berobat" class="form-control border-2 rounded-3"
                           style="border-color:#f472b6; background-color:#fde6ef;" value="{{ old('tanggal_berobat', date('Y-m-d')) }}" required>
                </div>

                <div class="text-center mt-4 d-flex gap-2">
                    <button type="submit" class="btn px-4 py-2 flex-grow-1" style="background-color:#ec4899; color:white; border-radius:10px;">
                        Simpan
                    </button>
                    <a href="{{ route('dokter.pasien.index') }}" class="btn px-4 py-2 flex-grow-1" style="background-color:#f9a8d4; color:white; border-radius:10px;">
                        ⬅ Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
