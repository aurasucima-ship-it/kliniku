@extends('layouts.app')

@section('title', 'Detail Pasien')

@section('content')
<div class="card border-pink-400 shadow-sm mx-auto" style="max-width:600px;">
    <h5 class="card-header bg-pink-500 text-white">Detail Pasien</h5>
    <div class="card-body">

        <p><strong>Nama:</strong> {{ $pasien->nama }}</p>
        <p><strong>Alamat:</strong> {{ $pasien->alamat ?? '-' }}</p>
        <p><strong>Jenis Kelamin:</strong> {{ $pasien->jenis_kelamin_text }}</p>
        <p><strong>No. Telepon:</strong> {{ $pasien->no_telp ?? '-' }}</p>
        <p><strong>Keluhan:</strong> {{ $pasien->keluhan ?? '-' }}</p>
        <p><strong>Tanggal Berobat:</strong> {{ $pasien->tanggal_berobat->format('d/m/Y') }}</p>

        <div class="d-flex gap-2 mt-3">
            <a href="{{ route('dokter.pasien.edit', $pasien->id) }}" class="btn btn-pink bg-pink-500 hover:bg-pink-600 text-white flex-grow-1">Edit</a>
            <a href="{{ route('dokter.pasien.index') }}" class="btn btn-secondary flex-grow-1">Kembali</a>
        </div>

    </div>
</div>
@endsection
