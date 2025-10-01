@extends('layouts.app')

@section('title', 'Detail Pasien')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="card border border-pink-400 shadow-sm mb-4">

        <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2" 
            style="font-family: 'Poppins', sans-serif; color:#db2777;">
            <i class="fas fa-user"></i> DETAIL PASIEN
        </h5>

        <div class="card-body">
            <p class="mb-2"><strong style="color:#db2777;">Nama:</strong> {{ $pasien->nama }}</p>
            <p class="mb-2"><strong style="color:#db2777;">Alamat:</strong> {{ $pasien->alamat }}</p>
            <p class="mb-2"><strong style="color:#db2777;">Jenis Kelamin:</strong> {{ $pasien->jenis_kelamin }}</p>
            <p class="mb-2"><strong style="color:#db2777;">No. Telepon:</strong> {{ $pasien->no_telp ?? '-' }}</p>
            <p class="mb-2"><strong style="color:#db2777;">Keluhan:</strong> {{ $pasien->keluhan ?? '-' }}</p>
            <p class="mb-2"><strong style="color:#db2777;">Tanggal Berobat:</strong> 
                {{ \Carbon\Carbon::parse($pasien->tanggal_berobat)->format('d M Y') }}
            </p>
            <p class="mb-0"><strong style="color:#db2777;">Dokter:</strong> {{ $pasien->dokter->nama ?? '-' }}</p>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('admin.pasien.index') }}" 
           class="btn btn-pink px-4 py-2 shadow">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

</div>

@endsection
