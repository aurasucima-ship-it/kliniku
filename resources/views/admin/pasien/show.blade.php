@extends('layouts.app')

@section('title', 'Detail Pasien')

@section('content')

<div class="card border border-pink-400 shadow-sm">

    <!-- Header -->
    <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2" 
        style="font-family: 'Poppins', sans-serif; color:#db2777;">
        <i class="fas fa-user"></i> DETAIL PASIEN
    </h5>

    <div class="card-body">
        <div class="mb-3">
            <strong>Nama:</strong> {{ $pasien->nama }}
        </div>
        <div class="mb-3">
            <strong>Alamat:</strong> {{ $pasien->alamat }}
        </div>
        <div class="mb-3">
            <strong>Jenis Kelamin:</strong> {{ $pasien->jenis_kelamin }}
        </div>
        <div class="mb-3">
            <strong>Dokter:</strong> {{ $pasien->dokter->nama ?? '-' }}
        </div>

        <a href="{{ route('admin.pasien.index') }}" class="btn" 
           style="background-color:#db2777; color:#fff; font-weight:500;">
           <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

<div class="container">
    <h2 class="text-center fw-semibold mb-4 d-flex justify-content-center align-items-center gap-2"
        style="font-family: 'Poppins', sans-serif; color:#db2777;">
        <i class="fas fa-user"></i>
        Detail Pasien
    </h2>

    <div class="card border-pink-300 shadow-sm mb-3">
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

    <a href="{{ route('admin.pasien.index') }}" 
       class="btn text-white"
       style="background-color:#ec4899;">
        ← Kembali
    </a>

</div>
@endsection
