@extends('layouts.app')

@section('title', 'Form Pembayaran')

@section('content')
<div style="background-color:#fde6ef; min-height:100vh; padding:50px 0;">
    <div class="container">
        <div class="mx-auto rounded-4 shadow-lg p-5"
             style="max-width:650px; font-family:'Poppins', sans-serif; background-color:#fff0f6; border:2px solid #f9a8d4;">

            <h1 class="text-center fw-bold mb-4" style="color:#db2777; font-size:2rem;">
                💸 FORM PEMBAYARAN
            </h1>

            <form action="{{ route('pasien.pembayaran.proses', $pembayaran->id) }}" method="POST" enctype="multipart/form-data" style="color:#db2777;">
                @csrf

                <div class="mb-4">
                    <label class="form-label fw-semibold">Nama Pasien</label>
                    <input type="text" value="{{ $pasien->nama }}" 
                           class="form-control border-2 rounded-3" 
                           style="border-color:#f472b6; background-color:#fde6ef;" readonly>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Nama Dokter</label>
                    <input type="text" value="{{ $dokter->nama ?? '-' }}" 
                           class="form-control border-2 rounded-3" 
                           style="border-color:#f472b6; background-color:#fde6ef;" readonly>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Total Biaya</label>
                    <input type="text" value="Rp {{ number_format($biaya, 0, ',', '.') }}" 
                           class="form-control border-2 rounded-3" 
                           style="border-color:#f472b6; background-color:#fde6ef;" readonly>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Metode Pembayaran</label>
                    <select name="metode" id="metode-pembayaran" 
                            class="form-control border-2 rounded-3" 
                            style="border-color:#f472b6; background-color:#fff;" required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                    </select>
                </div>

                <div class="mb-4" id="bukti-transfer-wrapper" style="display:none;">
                    <label class="form-label fw-semibold">Upload Bukti Transfer</label>
                    <input type="file" name="bukti_transfer" id="bukti_transfer" 
                           class="form-control border-2 rounded-3" 
                           style="border-color:#f472b6; background-color:#fde6ef;" 
                           accept="image/*">
                    <small class="text-muted d-block mt-1">Format: JPG/PNG, Maks. 2MB</small>

                    <div id="preview-container" class="mt-3 text-center" style="display:none;">
                        <img id="preview-image" src="#" alt="Preview" 
                             class="rounded-3 shadow-sm" 
                             style="max-width:100%; height:auto; border:2px solid #f9a8d4;">
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn px-4 py-2 me-2"
                            style="background-color:#ec4899; color:white; border-radius:10px;">
                        Bayar Sekarang
                    </button>
                    <a href="{{ route('pasien.pembayaran.index') }}" 
                       class="btn px-4 py-2" 
                       style="background-color:#f9a8d4; color:white; border-radius:10px;">
                        ⬅ Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const metodeSelect = document.getElementById('metode-pembayaran');
        const buktiWrapper = document.getElementById('bukti-transfer-wrapper');
        const buktiInput = document.getElementById('bukti_transfer');
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');

        // Tampilkan kolom upload jika saat reload value sudah "transfer"
        if (metodeSelect.value.toLowerCase() === 'transfer') {
            buktiWrapper.style.display = 'block';
        }

        // Event saat dropdown berubah
        metodeSelect.addEventListener('change', function () {
            const selected = this.value.toLowerCase();
            buktiWrapper.style.display = selected === 'transfer' ? 'block' : 'none';

            if (selected !== 'transfer') {
                previewContainer.style.display = 'none';
                buktiInput.value = '';
            }
        });

        // Preview gambar saat file dipilih
        buktiInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
            }
        });
    });
</script>
@endsection
