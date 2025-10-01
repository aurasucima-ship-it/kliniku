@extends('layouts.app')

@section('title', 'Detail Dokter')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="card border border-pink-400 shadow-sm mb-4">

        <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2" 
            style="font-family: 'Poppins', sans-serif; color:#db2777;">
            <i class="fas fa-user-doctor"></i> DETAIL DOKTER
        </h5>

        <div class="card-body">
            <p class="mb-2"><strong style="color:#db2777;">Nama:</strong> {{ $dokter->nama }}</p>
            <p class="mb-2"><strong style="color:#db2777;">Spesialis:</strong> {{ $dokter->spesialis }}</p>
            <p class="mb-2"><strong style="color:#db2777;">Alamat:</strong> {{ $dokter->alamat }}</p>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('admin.dokter.index') }}" 
           class="btn btn-pink px-4 py-2 shadow">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

</div>

@endsection
