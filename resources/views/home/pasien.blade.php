@extends('layouts.app')

@section('title', 'Dashboard Pasien')

@section('content')
<div class="min-h-screen py-10 px-4" style="background-color: #ffe4ef; font-family: 'Poppins', sans-serif;">

    <div class="max-w-6xl mx-auto">

        <div class="card shadow-lg rounded-3xl text-center p-10 mb-10" style="background-color: #ffe4ef; border: 2px solid #f9b7d0; color: #5a0025;">
            <h2 class="text-4xl fw-bold mb-4" style="font-family: 'Fredoka', sans-serif;">
                Selamat Datang di Aplikasi Kliniku, {{ $pasien->nama ?? Auth::user()->name }}! 💕
            </h2>
            <p class="text-lg mb-5">
                Apakah ada yang bisa kami bantu hari ini? 
                Kamu bisa melakukan <span class="fw-semibold">pendaftaran</span>, melihat 
                <span class="fw-semibold">rekam medis</span>, atau memantau 
                <span class="fw-semibold">pembayaran</span> kamu dengan mudah di sini.
            </p>
            <div class="mt-4">
                <a href="{{ route('pasien.pendaftaran.create') }}" class="btn px-5 py-2 rounded-pill fw-semibold" style="background-color: white; color: #db2777; border: 2px solid #f9b7d0;">
                    💗 Daftar Sekarang
                </a>
            </div>
        </div>

        <div class="row g-4 mb-10">
            <div class="col-md-4 d-flex">
                <div class="card text-center p-4 flex-fill" style="background-color: #ffe4ef; border: 2px solid #f9b7d0;">
                    <h5 class="mb-3 fw-bold text-pink-800">📝 Pendaftaran</h5>
                    <p class="mb-4 text-pink-900">Lihat daftar pendaftaran dan tambah pendaftaran baru dengan mudah.</p>
                    <a href="{{ route('pasien.pendaftaran.index') }}" class="btn px-4 py-2 rounded-pill fw-semibold" style="background-color: white; color: #db2777; border: 2px solid #f9b7d0;">
                        Lihat Pendaftaran
                    </a>
                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="card text-center p-4 flex-fill" style="background-color: #ffe4ef; border: 2px solid #f9b7d0;">
                    <h5 class="mb-3 fw-bold text-pink-800">🩺 Rekam Medis</h5>
                    <p class="mb-4 text-pink-900">Pantau riwayat kesehatanmu dengan tampilan yang mudah dipahami.</p>
                    <a href="{{ route('pasien.rekam_medis.index') }}" class="btn px-4 py-2 rounded-pill fw-semibold" style="background-color: white; color: #db2777; border: 2px solid #f9b7d0;">
                        Lihat Rekam Medis
                    </a>
                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="card text-center p-4 flex-fill" style="background-color: #ffe4ef; border: 2px solid #f9b7d0;">
                    <h5 class="mb-3 fw-bold text-pink-800">💳 Pembayaran</h5>
                    <p class="mb-4 text-pink-900">Cek status tagihan dan riwayat pembayaran kamu di sini.</p>
                    <a href="{{ route('pasien.pembayaran.index') }}" class="btn px-4 py-2 rounded-pill fw-semibold" style="background-color: white; color: #db2777; border: 2px solid #f9b7d0;">
                        Lihat Pembayaran
                    </a>
                </div>
            </div>
        </div>
<div class="card p-4 mb-4 text-center" style="background-color: #ffe4ef; border: 2px solid #f9b7d0;">
    <h3 class="fw-bold mb-3 text-pink-800">👨‍⚕️ Daftar Dokter</h3>
    <p class="text-pink-900 mb-4">Berikut daftar dokter yang tersedia di klinik kami:</p>
    <div class="row g-4 justify-content-center">
        @forelse($dokter ?? [] as $d)
            <div class="col-md-4">
                <div class="card h-100 p-3 shadow-sm" style="border: 2px solid #f9b7d0; background-color: #fff0f6; color: #5a0025;">
                    <h5 class="fw-bold mb-2 text-pink-800">{{ $d->nama }}</h5>
                    <p class="mb-1"><span class="fw-semibold">Alamat:</span> {{ $d->alamat }}</p>
                    <p class="mb-0"><span class="fw-semibold">Spesialis:</span> {{ $d->spesialis }}</p>
                </div>
            </div>
        @empty
            <p class="text-pink-900">Belum ada dokter yang terdaftar.</p>
        @endforelse
    </div>
</div>


        <div class="card p-4 mb-4 text-center" style="background-color: #ffe4ef; border: 2px solid #f9b7d0;">
            <h3 class="fw-bold mb-3 text-pink-800">📍 Lokasi Kami</h3>
            <p class="mb-3 text-pink-900">Cek lokasi kami di bawah ini untuk mengetahui rute menuju Klinik. 🌸</p>
            <button onclick="window.open('https://www.google.com/maps/place/Universitas+Tlogorejo+Semarang', '_blank')" 
                    class="btn px-5 py-2 rounded-pill fw-semibold" 
                    style="background-color: white; color: #db2777; border: 2px solid #f9b7d0;">
                💗 Buka Lokasi di Google Maps
            </button>
        </div>

        <div class="card p-4 mb-5 text-center" style="background-color: #ffe4ef; border: 2px solid #f9b7d0;">
            <h3 class="fw-bold mb-3 text-pink-800">✨ Tips Kesehatan Hari Ini</h3>
            @php
                $tips = [
                    'Minum air putih minimal 8 gelas per hari untuk menjaga tubuh tetap terhidrasi.',
                    'Istirahat cukup dan hindari stres berlebih agar sistem imun tetap kuat.',
                    'Rajin mencuci tangan sebelum makan dan setelah beraktivitas.',
                    'Perbanyak konsumsi sayur dan buah agar tubuh tetap fit dan segar.',
                    'Luangkan waktu untuk berolahraga ringan minimal 30 menit setiap hari.',
                ];
                $randomTip = $tips[array_rand($tips)];
            @endphp
            <p class="text-pink-900">"{{ $randomTip }}"</p>
        </div>

        <div class="text-center mt-4 text-pink-800">
            Terima kasih telah mempercayakan pelayanan kesehatanmu kepada <span class="fw-semibold text-pink-600">Kliniku</span> 🌷
        </div>

    </div>
</div>
@endsection
