@extends('layouts.app')

@section('title', 'Tambah Pembayaran')

@section('content')
<div class="card border border-pink-400 shadow-sm">

    <!-- Header -->
    <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2 text-pink-600">
        <i class="fas fa-credit-card"></i>
        TAMBAH PEMBAYARAN
    </h5>

    <div class="p-4">
        <form action="{{ route('admin.pembayaran.store') }}" method="POST">
            @csrf

            <!-- Pasien -->
            <div class="mb-3">
                <label for="pasien_id" class="form-label fw-semibold">Pasien</label>
                <select name="pasien_id" id="pasien_id" class="form-select @error('pasien_id') is-invalid @enderror" required>
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

            <!-- Jumlah -->
            <div class="mb-3">
                <label for="jumlah" class="form-label fw-semibold">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}" placeholder="Masukkan jumlah pembayaran" required>
                @error('jumlah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Metode -->
            <div class="mb-3">
                <label for="metode" class="form-label fw-semibold">Metode Pembayaran</label>
                <select name="metode" id="metode" class="form-select @error('metode') is-invalid @enderror" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="tunai" {{ old('metode') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                    <option value="transfer" {{ old('metode') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                    <option value="e-wallet" {{ old('metode') == 'e-wallet' ? 'selected' : '' }}>E-Wallet</option>
                    <option value="kartu-kredit" {{ old('metode') == 'kartu-kredit' ? 'selected' : '' }}>Kartu Kredit</option>
                    <option value="asuransi" {{ old('metode') == 'asuransi' ? 'selected' : '' }}>Asuransi</option>
                </select>
                @error('metode')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tanggal -->
            <div class="mb-3">
                <label for="tanggal" class="form-label fw-semibold">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Keterangan -->
            <div class="mb-3">
                <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit -->
            <div class="mt-4 flex gap-2">
                <button type="submit" class="btn btn-pink px-4 py-2 rounded-full shadow-sm text-white font-medium hover:bg-pink-500">
                    Simpan Pembayaran
                </button>
                <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary px-4 py-2 rounded-full shadow-sm">Batal</a>
            </div>

        </form>
    </div>

</div>
@endsection
