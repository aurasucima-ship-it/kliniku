@extends('layouts.app')

@section('title', 'Detail Pasien')

@section('content')
<div style="background-color:#fde6ef; min-height:100vh; padding:50px 0;">
    <div class="container">
        <div class="mx-auto rounded-4 shadow-lg p-5"
             style="max-width:650px; font-family:'Poppins', sans-serif; background-color:#fff0f6; border:2px solid #f9a8d4;">

            <h1 class="text-center fw-bold mb-4" style="color:#db2777; font-size:2rem;">
                📝 DETAIL PASIEN
            </h1>

            <div style="color:#9d174d; font-weight:500;">
                <p><strong>Nama:</strong> {{ $pasien->nama }}</p>
                <p><strong>Alamat:</strong> {{ $pasien->alamat ?? '-' }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $pasien->jenis_kelamin_text }}</p>
                <p><strong>No. Telepon:</strong> {{ $pasien->no_telp ?? '-' }}</p>
                <p><strong>Keluhan:</strong> {{ $pasien->keluhan ?? '-' }}</p>
                <p><strong>Tanggal Berobat:</strong> {{ $pasien->tanggal_berobat->format('d/m/Y') }}</p>
            </div>

            <div class="text-center mt-4 d-flex gap-2">
                <a href="{{ route('dokter.pasien.edit', $pasien->id) }}" 
                   class="btn px-4 py-2 flex-grow-1" style="background-color:#ec4899; color:white; border-radius:10px;">
                   Edit
                </a>
                <a href="{{ route('dokter.pasien.index') }}" 
                   class="btn px-4 py-2 flex-grow-1" style="background-color:#f9a8d4; color:white; border-radius:10px;">
                   ⬅ Kembali
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
