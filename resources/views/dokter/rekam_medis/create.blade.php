@extends('layouts.app')

@section('title', 'Tambah Rekam Medis')

@section('content')
<div class="card border-pink-400 shadow-sm mx-auto" style="max-width:600px;">
    <h5 class="card-header bg-pink-500 text-white">Tambah Rekam Medis</h5>
    <div class="card-body">
        <form action="{{ route('dokter.rekam_medis.store') }}" method="POST">
            @csrf

            <!-- Pilih Pasien -->
            <div class="mb-2">
                <label for="pasien_id" class="form-label">Pasien</label>
                <select name="pasien_id" id="pasien_id" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1" required>
                    <option value="">-- Pilih Pasien --</option>
                    @foreach($pasiens as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dokter otomatis dari login -->
            <input type="hidden" name="dokter_id" value="{{ auth()->user()->dokter->id }}">

            <!-- Keluhan, Diagnosa, Tindakan, Resep Obat, Catatan -->
            @php
            $fields = ['keluhan', 'diagnosa', 'tindakan', 'resep_obat', 'catatan'];
            @endphp

            @foreach($fields as $field)
                <div class="mb-2">
                    <label for="{{ $field }}" class="form-label">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                    @if($field == 'catatan')
                        <textarea name="{{ $field }}" id="{{ $field }}" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1" rows="2"></textarea>
                    @else
                        <input type="text" name="{{ $field }}" id="{{ $field }}" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1">
                    @endif
                </div>
            @endforeach

            <!-- Tanggal Pemeriksaan -->
            <div class="mb-2">
                <label for="tanggal_pemeriksaan" class="form-label">Tanggal Pemeriksaan</label>
                <input type="date" name="tanggal_pemeriksaan" id="tanggal_pemeriksaan" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 py-1" value="{{ date('Y-m-d') }}" required>
            </div>

            <!-- Tombol Simpan / Batal -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-pink bg-pink-500 hover:bg-pink-600 text-white flex-grow-1">Simpan</button>
                <a href="{{ route('dokter.rekam_medis.index') }}" class="btn btn-pink bg-pink-300 hover:bg-pink-400 text-white flex-grow-1">Batal</a>
            </div>

        </form>
    </div>
</div>
@endsection
