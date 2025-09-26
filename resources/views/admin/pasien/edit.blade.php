@extends('layouts.app')

@section('title', 'Edit Pasien')

@section('content')
<div class="card border border-pink-400 shadow-sm mx-auto" style="max-width:600px;">

    <!-- Header -->
    <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2" 
        style="font-family: 'Poppins', sans-serif; color:#db2777;">
        <i class="fas fa-user-edit"></i> FORM EDIT PASIEN
    </h5>

    <div class="card-body">
        <form action="{{ route('admin.pasien.update', $pasien->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Pasien</label>
                <input type="text" name="nama" class="form-control" 
                       value="{{ old('nama', $pasien->nama) }}" required>
            </div>

            <!-- Alamat -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $pasien->alamat) }}</textarea>
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="Laki-laki" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <!-- Dokter -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Dokter</label>
                <select name="dokter_id" class="form-select" required>
                    @foreach($dokters as $dokter)
                        <option value="{{ $dokter->id }}" 
                            {{ old('dokter_id', $pasien->dokter_id) == $dokter->id ? 'selected' : '' }}>
                            {{ $dokter->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.pasien.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn" 
                        style="background-color:#db2777; color:#fff; font-weight:500;">
                    <i class="fas fa-save"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
