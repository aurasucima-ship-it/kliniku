@extends('layouts.app')

@section('title', 'Tambah Rekam Medis')

@section('content')

<div class="card border border-pink-400 shadow-sm mx-auto" style="max-width:600px;">

    <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-center items-center gap-2 text-pink-600">
        <i class="fas fa-notes-medical"></i> FORM TAMBAH REKAM MEDIS
    </h5>

    <div class="card-body">

        @if($errors->any())
            <div class="bg-pink-100 text-pink-700 px-4 py-3 rounded shadow mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.rekam_medis.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="pasien_id" class="form-label fw-semibold text-pink-700">Pasien</label>
                <select name="pasien_id" id="pasien_id" class="form-select border-pink-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-200" required>
                    <option value="">-- Pilih Pasien --</option>
                    @foreach($pasiens as $pasien)
                        <option value="{{ $pasien->id }}" {{ old('pasien_id')==$pasien->id ? 'selected' : '' }}>
                            {{ $pasien->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="dokter_id" class="form-label fw-semibold text-pink-700">Dokter</label>
                <select name="dokter_id" id="dokter_id" class="form-select border-pink-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-200" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach($dokters as $dokter)
                        <option value="{{ $dokter->id }}" {{ old('dokter_id')==$dokter->id ? 'selected' : '' }}>
                            {{ $dokter->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            @php
                $fields = [
                    'keluhan' => 'textarea',
                    'diagnosa' => 'textarea',
                    'tindakan' => 'textarea',
                    'resep_obat' => 'textarea',
                    'catatan_tambahan' => 'textarea'
                ];
            @endphp

            @foreach($fields as $name => $type)
                <div class="mb-3">
                    <label for="{{ $name }}" class="form-label fw-semibold text-pink-700">{{ ucwords(str_replace('_',' ',$name)) }}</label>
                    @if($type === 'textarea')
                        <textarea name="{{ $name }}" id="{{ $name }}" class="form-control border-pink-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-200">{{ old($name) }}</textarea>
                    @else
                        <input type="text" name="{{ $name }}" id="{{ $name }}" class="form-control border-pink-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-200" value="{{ old($name) }}">
                    @endif
                </div>
            @endforeach

            <div class="mb-3">
                <label for="tanggal_pemeriksaan" class="form-label fw-semibold text-pink-700">Tanggal Pemeriksaan</label>
                <input type="date" name="tanggal_pemeriksaan" id="tanggal_pemeriksaan" class="form-control border-pink-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-200" value="{{ old('tanggal_pemeriksaan', date('Y-m-d')) }}" required>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.rekam_medis.index') }}" class="btn btn-secondary flex-grow-1">Batal</a>
                <button type="submit" class="btn btn-pink flex-grow-1" style="background-color:#db2777; color:#fff;">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
