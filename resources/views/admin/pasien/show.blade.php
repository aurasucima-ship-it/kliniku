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
</div>
@endsection
