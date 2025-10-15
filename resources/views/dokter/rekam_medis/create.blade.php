@extends('layouts.app')

@section('title', 'Tambah Rekam Medis')

@section('content')
<div style="background-color:#fde6ef; min-height:100vh; padding:50px 0;">
    <div class="container">
        <div class="mx-auto rounded-4 shadow-lg p-5"
             style="max-width:650px; font-family:'Poppins', sans-serif; background-color:#fff0f6; border:2px solid #f9a8d4;">

            <h1 class="text-center fw-bold mb-4" style="color:#db2777; font-size:2rem;">
                📝 TAMBAH REKAM MEDIS
            </h1>

            <form action="{{ route('dokter.rekam_medis.store') }}" method="POST" style="color:#9d174d;">
                @csrf

                <div class="mb-3">
                    <label for="pasien_id" class="form-label fw-semibold">Pasien</label>
                    <select name="pasien_id" id="pasien_id" class="form-control border-2 rounded-3"
                            style="border-color:#f472b6; background-color:#fff;" required>
                        <option value="">-- Pilih Pasien --</option>
                        @foreach($pasiens as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="dokter_id" value="{{ auth()->user()->dokter->id }}">

                @php
                $fields = ['keluhan', 'diagnosa', 'tindakan', 'resep_obat', 'catatan'];
                @endphp

                @foreach($fields as $field)
                    <div class="mb-3">
                        <label for="{{ $field }}" class="form-label fw-semibold">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                        @if($field == 'catatan')
                            <textarea name="{{ $field }}" id="{{ $field }}" class="form-control border-2 rounded-3"
                                      style="border-color:#f472b6; background-color:#fde6ef;" rows="2">{{ old($field) }}</textarea>
                        @else
                            <input type="text" name="{{ $field }}" id="{{ $field }}" class="form-control border-2 rounded-3"
                                   style="border-color:#f472b6; background-color:#fde6ef;" value="{{ old($field) }}">
                        @endif
                    </div>
                @endforeach

                <div class="mb-3">
                    <label for="tanggal_pemeriksaan" class="form-label fw-semibold">Tanggal Pemeriksaan</label>
                    <input type="date" name="tanggal_pemeriksaan" id="tanggal_pemeriksaan" class="form-control border-2 rounded-3"
                           style="border-color:#f472b6; background-color:#fde6ef;" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-pink bg-pink-500 hover:bg-pink-600 text-white flex-grow-1">Simpan</button>
                    <a href="{{ route('dokter.rekam_medis.index') }}" class="btn btn-pink bg-pink-300 hover:bg-pink-400 text-white flex-grow-1">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
