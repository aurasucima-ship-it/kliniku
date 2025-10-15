@extends('layouts.app')

@section('title', 'Isi Pendaftaran Pasien')

@section('content')
<div style="background-color:#fde6ef; min-height:100vh; padding:50px 0;">
    <div class="container">
        <div class="mx-auto bg-white rounded-4 shadow-lg p-5" style="max-width:650px; font-family:'Poppins', sans-serif;">
            <h1 class="text-center fw-bold mb-4" style="color:#db2777; font-size:2rem;">
                <i class="fas fa-heart"></i> ISI PENDAFTARAN PASIEN
            </h1>

            <form action="{{ route('pasien.pendaftaran.store') }}" method="POST" style="color:#db2777;">
                @csrf

                <div class="mb-4">
                    <label for="nama" class="form-label fw-semibold">Nama Pasien</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', Auth::user()->name) }}"
                        class="form-control border-2 rounded-3" style="border-color:#f472b6;" required>
                </div>

                <div class="mb-4">
                    <label for="jenis_kelamin" class="form-label fw-semibold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin"
                        class="form-control border-2 rounded-3" style="border-color:#f472b6;" required>
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="no_telp" class="form-label fw-semibold">No. Telepon</label>
                    <input type="text" name="no_telp" id="no_telp" value="{{ old('no_telp') }}"
                        class="form-control border-2 rounded-3" style="border-color:#f472b6;" required>
                </div>

                <div class="mb-4">
                    <label for="tanggal_berobat" class="form-label fw-semibold">Tanggal Berobat</label>
                    <input type="date" name="tanggal_berobat" id="tanggal_berobat" value="{{ old('tanggal_berobat') }}"
                        class="form-control border-2 rounded-3" style="border-color:#f472b6;" required>
                </div>

                <div class="mb-4">
                    <label for="alamat" class="form-label fw-semibold">Alamat</label>
                    <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}"
                        class="form-control border-2 rounded-3" style="border-color:#f472b6;" required>
                </div>

                <div class="mb-4">
                    <label for="dokter_id" class="form-label fw-semibold">Pilih Dokter</label>
                    <select name="dokter_id" id="dokter_id"
                        class="form-control border-2 rounded-3" style="border-color:#f472b6;" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach($dokters as $dokter)
                            <option value="{{ $dokter->id }}" {{ old('dokter_id') == $dokter->id ? 'selected' : '' }}>
                                {{ $dokter->nama }} ({{ $dokter->spesialis }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label for="keluhan" class="form-label fw-semibold">Keluhan</label>
                    <textarea name="keluhan" id="keluhan" rows="3"
                        class="form-control border-2 rounded-3" style="border-color:#f472b6;" required>{{ old('keluhan') }}</textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn px-4 py-2 me-2"
                        style="background-color:#ec4899; color:white; border-radius:10px;">
                        Simpan
                    </button>
                    <a href="{{ route('pasien.pendaftaran.index') }}" class="btn px-4 py-2"
                        style="background-color:#f9a8d4; color:white; border-radius:10px;">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
