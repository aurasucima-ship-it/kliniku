@extends('layouts.app')

@section('title', 'Edit Pembayaran')

@section('content')
<div style="background-color:#fde6ef; min-height:100vh; padding:50px 0;">
    <div class="container">
        <div class="mx-auto rounded-4 shadow-lg p-5"
             style="max-width:600px; font-family:'Poppins', sans-serif; background-color:#fff0f6; border:2px solid #f9a8d4;">

            <h1 class="text-center fw-bold mb-4" style="color:#db2777; font-size:2rem;">
                ✏️ EDIT PEMBAYARAN
            </h1>

            <form action="{{ route('dokter.pembayaran.update', $pembayaran->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="form-label fw-semibold">Pasien</label>
                    <select name="pasien_id" class="form-select border-2 rounded-3" style="border-color:#f472b6; background-color:#fde6ef;" required>
                        <option value="">-- Pilih Pasien --</option>
                        @foreach($pasiens as $pasien)
                            <option value="{{ $pasien->id }}" {{ old('pasien_id', $pembayaran->pasien_id) == $pasien->id ? 'selected' : '' }}>
                                {{ $pasien->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('pasien_id')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control border-2 rounded-3" style="border-color:#f472b6; background-color:#fde6ef;" value="{{ old('jumlah', $pembayaran->jumlah) }}" required>
                    @error('jumlah')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Metode Pembayaran</label>
                    <select name="metode" id="metode" class="form-select border-2 rounded-3" style="border-color:#f472b6; background-color:#fff;" required>
                        <option value="">-- Pilih Metode --</option>
                        @foreach(['cash','transfer'] as $met)
                            <option value="{{ $met }}" {{ old('metode', $pembayaran->metode) == $met ? 'selected' : '' }}>{{ ucwords($met) }}</option>
                        @endforeach
                    </select>
                    @error('metode')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4" id="bukti-transfer-wrapper" style="display: {{ old('metode', $pembayaran->metode) == 'transfer' ? 'block' : 'none' }};">
                    <label class="form-label fw-semibold">Upload Bukti Transfer</label>
                    <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control border-2 rounded-3" style="border-color:#f472b6; background-color:#fde6ef;" accept="image/*">
                    @if($pembayaran->bukti_transfer)
                        <div class="mt-2 text-center">
                            <img src="{{ asset('storage/'.$pembayaran->bukti_transfer) }}" alt="Bukti Transfer" class="rounded-3 shadow-sm" style="max-width:100%; border:2px solid #f9a8d4;">
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select border-2 rounded-3" style="border-color:#f472b6; background-color:#fff;" required>
                        @foreach(['belum lunas'=>'Belum Lunas','menunggu konfirmasi'=>'Menunggu Konfirmasi','lunas'=>'Lunas'] as $key=>$label)
                            <option value="{{ $key }}" {{ old('status', $pembayaran->status) == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('status')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control border-2 rounded-3" style="border-color:#f472b6; background-color:#fde6ef;" value="{{ old('tanggal', $pembayaran->tanggal->format('Y-m-d')) }}" required>
                    @error('tanggal')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Keterangan</label>
                    <textarea name="keterangan" rows="3" class="form-control border-2 rounded-3" style="border-color:#f472b6; background-color:#fde6ef;">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
                    @error('keterangan')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn px-4 py-2 me-2" style="background-color:#ec4899; color:white; border-radius:10px;">Update Pembayaran</button>
                    <a href="{{ route('dokter.pembayaran.index') }}" class="btn px-4 py-2" style="background-color:#f9a8d4; color:white; border-radius:10px;">⬅ Kembali</a>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const metode = document.getElementById('metode');
    const wrapper = document.getElementById('bukti-transfer-wrapper');
    metode.addEventListener('change', function(){
        wrapper.style.display = this.value === 'transfer' ? 'block' : 'none';
    });
});
</script>
@endsection
