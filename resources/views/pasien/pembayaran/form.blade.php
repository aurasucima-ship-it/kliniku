@extends('layouts.app')

@section('title', 'Form Pembayaran')

@section('content')
<div class="card border border-pink-400 shadow-sm mx-auto" style="max-width:600px;">
    <h5 class="card-header bg-pink-500 text-white text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2">
        <i class="fas fa-credit-card"></i>
        FORM PEMBAYARAN
    </h5>

    <div class="card-body">
        <form action="{{ route('pasien.pembayaran.store') }}" method="POST">
            @csrf
            <input type="hidden" name="pendaftaran_id" value="{{ $pendaftaran->id }}">

            <div class="mb-3">
                <label class="form-label fw-semibold text-pink-700">Dokter</label>
                <input type="text" class="form-control border-pink-300" value="{{ $dokter->nama ?? '-' }}" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold text-pink-700">Total Biaya</label>
                <input type="text" class="form-control border-pink-300" value="Rp {{ number_format($biaya ?? 0, 0, ',', '.') }}" disabled>
            </div>

            <div class="mb-3">
                <label for="jumlah" class="form-label fw-semibold text-pink-700">Jumlah Dibayar</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}" required>
                @error('jumlah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="metode" class="form-label fw-semibold text-pink-700">Metode Pembayaran</label>
                <select name="metode" id="metode" class="form-select border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 @error('metode') is-invalid @enderror" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="transfer" {{ old('metode') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                    <option value="cash" {{ old('metode') == 'cash' ? 'selected' : '' }}>Tunai</option>
                    <option value="ewallet" {{ old('metode') == 'ewallet' ? 'selected' : '' }}>E-Wallet (Dana, OVO, Gopay)</option>
                </select>
                @error('metode')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4 d-flex gap-2">
                <a href="{{ route('pasien.pembayaran.index') }}" class="btn bg-pink-300 hover:bg-pink-400 text-white flex-grow-1 shadow-sm">Kembali</a>
                <button type="submit" class="btn bg-pink-500 hover:bg-pink-600 text-white flex-grow-1 shadow-sm">Kirim Pembayaran</button>
            </div>
        </form>
    </div>
</div>
@endsection
