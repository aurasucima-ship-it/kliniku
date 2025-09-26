@extends('layouts.app')

@section('title', 'Form Pembayaran')

@section('content')
<div class="card border border-pink-400 shadow-sm p-3 mx-auto" style="max-width:600px;">
    <h5 class="card-header text-center fs-5 fw-semibold text-pink-600">
        <i class="ti ti-credit-card"></i> FORM PEMBAYARAN
    </h5>

    <div class="card-body">
        <form action="{{ route('pasien.pembayaran.proses', $pembayaran->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Layanan</label>
                <input type="text" class="form-control" value="{{ $pembayaran->layanan }}" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Biaya</label>
                <input type="text" class="form-control" value="Rp {{ number_format($pembayaran->biaya, 0, ',', '.') }}" disabled>
            </div>

            <div class="mb-3">
                <label for="metode" class="form-label">Metode Pembayaran</label>
                <select name="metode" id="metode" class="form-select" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="transfer">Transfer Bank</option>
                    <option value="cash">Tunai</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea name="catatan" id="catatan" rows="3" class="form-control"></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('pasien.pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-pink">Kirim Pembayaran</button>
            </div>
        </form>
    </div>
</div>
@endsection
