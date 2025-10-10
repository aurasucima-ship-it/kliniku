@extends('layouts.app')

@section('title', 'Tambah Pembayaran')

@section('content')
<div class="card border border-pink-400 shadow-sm mx-auto" style="max-width:600px;">
    <h5 class="card-header bg-pink-500 text-white text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2">
        <i class="fas fa-credit-card"></i>
        TAMBAH PEMBAYARAN
    </h5>

    <div class="card-body">
        <form action="{{ route('dokter.pembayaran.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="pasien_id" class="form-label fw-semibold text-pink-700">Pasien</label>
                <select name="pasien_id" id="pasien_id" class="form-select border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 @error('pasien_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Pasien --</option>
                    @foreach($pasiens as $pasien)
                        <option value="{{ $pasien->id }}" {{ old('pasien_id') == $pasien->id ? 'selected' : '' }}>
                            {{ $pasien->nama }}
                        </option>
                    @endforeach
                </select>
                @error('pasien_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jumlah" class="form-label fw-semibold text-pink-700">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}" placeholder="Masukkan jumlah pembayaran" required>
                @error('jumlah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="metode" class="form-label fw-semibold text-pink-700">Metode Pembayaran</label>
                <select name="metode" id="metode" class="form-select border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 @error('metode') is-invalid @enderror" required>
                    <option value="">-- Pilih Metode --</option>
                  <option value="cash" {{ old('metode') == 'cash' ? 'selected' : '' }}>Cash</option>
                  <option value="transfer" {{ old('metode') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                </select>
                @error('metode')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label fw-semibold text-pink-700">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label fw-semibold text-pink-700">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 @error('keterangan') is-invalid @enderror" rows="3">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-pink bg-pink-500 hover:bg-pink-600 text-white flex-grow-1 shadow-sm">
                    Simpan Pembayaran
                </button>
                <a href="{{ route('dokter.pembayaran.index') }}" class="btn btn-pink bg-pink-300 hover:bg-pink-400 text-white flex-grow-1 shadow-sm">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
