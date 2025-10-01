@extends('layouts.app')

@section('title', 'Edit Pasien')

@section('content')
<div class="max-w-3xl mx-auto py-8">

    @if(session('success'))
        <div class="bg-pink-100 border border-pink-300 text-pink-700 px-4 py-3 rounded mb-6 text-center font-semibold animate-fade">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border border-pink-400 shadow-sm">

        <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2" 
            style="font-family: 'Poppins', sans-serif; color:#db2777;">
            <i class="fas fa-user-edit"></i> FORM EDIT PASIEN
        </h5>

        <div class="card-body">
            <form action="{{ route('admin.pasien.update', $pasien->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold" style="color:#db2777;">Nama Pasien</label>
                    <input type="text" name="nama" id="nama" class="form-control" 
                           value="{{ old('nama', $pasien->nama) }}" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label fw-semibold" style="color:#db2777;">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" rows="3" required>{{ old('alamat', $pasien->alamat) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label fw-semibold" style="color:#db2777;">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                        <option value="L" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="no_telp" class="form-label fw-semibold" style="color:#db2777;">No. Telepon</label>
                    <input type="text" name="no_telp" id="no_telp" class="form-control" 
                           value="{{ old('no_telp', $pasien->no_telp) }}">
                </div>

                <div class="mb-3">
                    <label for="keluhan" class="form-label fw-semibold" style="color:#db2777;">Keluhan</label>
                    <textarea name="keluhan" id="keluhan" class="form-control" rows="2">{{ old('keluhan', $pasien->keluhan) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="tanggal_berobat" class="form-label fw-semibold" style="color:#db2777;">Tanggal Berobat</label>
                    <input type="date" name="tanggal_berobat" id="tanggal_berobat" class="form-control" 
                           value="{{ old('tanggal_berobat', $pasien->tanggal_berobat) }}" required>
                </div>

                <div class="mb-3">
                    <label for="dokter_id" class="form-label fw-semibold" style="color:#db2777;">Dokter</label>
                    <select name="dokter_id" id="dokter_id" class="form-select" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach($dokters as $dokter)
                            <option value="{{ $dokter->id }}" 
                                {{ old('dokter_id', $pasien->dokter_id) == $dokter->id ? 'selected' : '' }}>
                                {{ $dokter->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.pasien.index') }}" class="btn text-white flex-1" style="background-color:#f9a8d4;">
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

<style>
    .animate-fade {
        animation: fadeOut 4s forwards;
    }
    @keyframes fadeOut {
        0% { opacity: 1; }
        80% { opacity: 1; }
        100% { opacity: 0; display: none; }
    }
</style>
@endsection
