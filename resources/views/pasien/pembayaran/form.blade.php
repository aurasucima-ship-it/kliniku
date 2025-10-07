@extends('layouts.app')

@section('title', 'Form Pembayaran')

@section('content')
<div class="card border border-pink-400 shadow-sm p-4 mx-auto" style="max-width: 600px;">
    <h5 class="card-header mb-4 text-center text-pink-600 fw-bold">Form Pembayaran</h5>

    <form action="{{ route('pasien.pembayaran.proses', $pembayaran->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label text-pink-700 fw-semibold">Nama Pasien</label>
            <input type="text" value="{{ $pasien->name }}" class="form-control border-pink-300 bg-pink-50" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label text-pink-700 fw-semibold">Nama Dokter</label>
            <input type="text" value="{{ $dokter->name ?? '-' }}" class="form-control border-pink-300 bg-pink-50" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label text-pink-700 fw-semibold">Total Biaya</label>
            <input type="text" value="Rp {{ number_format($biaya, 0, ',', '.') }}" class="form-control border-pink-300 bg-pink-50" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label text-pink-700 fw-semibold">Metode Pembayaran</label>
            <select name="metode" class="form-select border-pink-300 bg-white" required>
                <option value="">-- Pilih Metode --</option>
                <option value="Tunai">Cash</option>
                <option value="Transfer">Transfer</option>
            </select>
        </div>

        <div class="d-flex gap-2 justify-content-center mt-4">
            <button type="submit" class="btn btn-pink px-4">Bayar Sekarang</button>
            <a href="{{ route('pasien.pembayaran.index') }}" class="btn btn-secondary px-4">Batal</a>
        </div>
    </form>
</div>
@endsection
