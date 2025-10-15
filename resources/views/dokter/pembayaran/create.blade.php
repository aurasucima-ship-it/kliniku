@extends('layouts.app')

@section('title', 'Tambah Pembayaran')

@section('content')
<div style="background-color:#fde6ef; min-height:100vh; padding:50px 0;">
    <div class="container">
        <div class="mx-auto rounded-4 shadow-lg p-5"
             style="max-width:600px; font-family:'Poppins', sans-serif; background-color:#fff0f6; border:2px solid #f9a8d4;">

            <h1 class="text-center fw-bold mb-4" style="color:#db2777; font-size:2rem;">
                💸 TAMBAH PEMBAYARAN
            </h1>

            <form action="{{ route('dokter.pembayaran.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="pasien_id" class="form-label fw-semibold">Pasien</label>
                    <select name="pasien_id" id="pasien_id" 
                            class="form-select border-2 rounded-3" 
                            style="border-color:#f472b6; background-color:#fde6ef;" required>
                        <option value="">-- Pilih Pasien --</option>
                        @foreach($pasiens as $pasien)
                            <option value="{{ $pasien->id }}" {{ old('pasien_id') == $pasien->id ? 'selected' : '' }}>
                                {{ $pasien->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('pasien_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="jumlah" class="form-label fw-semibold">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" 
                           class="form-control border-2 rounded-3" 
                           style="border-color:#f472b6; background-color:#fde6ef;" 
                           value="{{ old('jumlah') }}" placeholder="Masukkan jumlah pembayaran" required>
                    @error('jumlah')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="tanggal" class="form-label fw-semibold">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" 
                           class="form-control border-2 rounded-3" 
                           style="border-color:#f472b6; background-color:#fde6ef;" 
                           value="{{ old('tanggal', date('Y-m-d')) }}" required>
                    @error('tanggal')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="3" 
                              class="form-control border-2 rounded-3" 
                              style="border-color:#f472b6; background-color:#fde6ef;">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
    <label class="form-label fw-semibold">Metode Pembayaran</label>
    <div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="metode" value="cash" {{ old('metode') == 'cash' ? 'checked' : '' }} required>
            <label class="form-check-label">Cash</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="metode" value="transfer" {{ old('metode') == 'transfer' ? 'checked' : '' }} required>
            <label class="form-check-label">Transfer</label>
        </div>
    </div>
    @error('metode')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>


                <div class="text-center mt-4">
                    <button type="submit" class="btn px-4 py-2 me-2"
                            style="background-color:#ec4899; color:white; border-radius:10px;">
                        Simpan Pembayaran
                    </button>
                    <a href="{{ route('dokter.pembayaran.index') }}" 
                       class="btn px-4 py-2" 
                       style="background-color:#f9a8d4; color:white; border-radius:10px;">
                        ⬅ Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
