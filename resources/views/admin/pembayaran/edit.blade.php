@extends('layouts.app')

@section('title', 'Edit Pembayaran')

@section('content')
<div class="card border border-pink-400 shadow-sm">
    <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2 text-pink-600">
        <i class="fas fa-credit-card"></i>
        EDIT PEMBAYARAN
    </h5>

    <div class="p-4">
        <form action="{{ route(Auth::user()->role . '.pembayaran.update', $pembayaran->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="pasien_id" class="form-label fw-semibold">Pasien</label>
                <select name="pasien_id" id="pasien_id" class="form-select @error('pasien_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Pasien --</option>
                    @foreach($pasiens as $pasien)
                        <option value="{{ $pasien->id }}" {{ $pembayaran->pasien_id == $pasien->id ? 'selected' : '' }}>
                            {{ $pasien->nama }}
                        </option>
                    @endforeach
                </select>
                @error('pasien_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jumlah" class="form-label fw-semibold">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah', $pembayaran->jumlah) }}" required>
                @error('jumlah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="metode" class="form-label fw-semibold">Metode Pembayaran</label>
                <select name="metode" id="metode" class="form-select @error('metode') is-invalid @enderror" required>
                    <option value="">-- Pilih Metode --</option>
                    @foreach(['cash','transfer'] as $met)
                        <option value="{{ $met }}" {{ $pembayaran->metode == $met ? 'selected' : '' }}>
                            {{ ucfirst($met) }}
                        </option>
                    @endforeach
                </select>
                @error('metode')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label fw-semibold">Status</label>
                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                    @foreach(['lunas' => 'Lunas', 'menunggu konfirmasi' => 'Menunggu Konfirmasi', 'belum lunas' => 'Belum Lunas'] as $key => $label)
                        <option value="{{ $key }}" {{ $pembayaran->status == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label fw-semibold">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $pembayaran->tanggal->format('Y-m-d')) }}" required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
                @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-pink px-4 py-2 rounded-full shadow-sm text-white font-medium hover:bg-pink-500">
                    Update Pembayaran
                </button>
                <a href="{{ route(Auth::user()->role . '.pembayaran.index') }}" class="btn btn-secondary px-4 py-2 rounded-full shadow-sm">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
