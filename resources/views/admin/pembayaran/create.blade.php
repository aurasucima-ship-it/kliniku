@extends('layouts.app')

@section('title', 'Tambah Pembayaran')

@section('content')

<div class="card border border-pink-400 shadow-sm mx-auto" style="max-width:600px;">

    <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-center items-center gap-2 text-pink-600">
        <i class="fas fa-credit-card"></i> FORM TAMBAH PEMBAYARAN
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

        <form action="{{ route('admin.pembayaran.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="pasien_id" class="form-label fw-semibold text-pink-700">Pasien</label>
                <select name="pasien_id" id="pasien_id" class="form-select border-pink-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-200" required>
                    <option value="">-- Pilih Pasien --</option>
                    @foreach($pasiens as $pasien)
                        <option value="{{ $pasien->id }}" {{ old('pasien_id') == $pasien->id ? 'selected' : '' }}>
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
                        <option value="{{ $dokter->id }}" {{ old('dokter_id') == $dokter->id ? 'selected' : '' }}>
                            {{ $dokter->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="jumlah" class="form-label fw-semibold text-pink-700">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control border-pink-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-200" placeholder="Masukkan jumlah pembayaran" value="{{ old('jumlah') }}" required>
            </div>

            <div class="mb-3">
                <label for="metode" class="form-label fw-semibold text-pink-700">Metode Pembayaran</label>
                <select name="metode" id="metode" class="form-select border-pink-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-200" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="cash" {{ old('metode') == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="transfer" {{ old('metode') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label fw-semibold text-pink-700">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control border-pink-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-200" value="{{ old('tanggal', date('Y-m-d')) }}" required>
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label fw-semibold text-pink-700">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="3" class="form-control border-pink-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-200">{{ old('keterangan') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary flex-grow-1">Batal</a>
                <button type="submit" class="btn btn-pink flex-grow-1" style="background-color:#db2777; color:#fff;">
                    <i class="fas fa-save"></i> Simpan Pembayaran
                </button>
            </div>
        </form>

    </div>
</div>

@endsection
