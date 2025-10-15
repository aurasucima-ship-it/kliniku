@extends('layouts.app')

@section('title', 'Dashboard Pasien')

@section('content')
<div class="container py-6">

    <div class="card shadow-sm rounded-2xl mb-8 text-center p-8" style="background: linear-gradient(135deg, rgba(251,182,206,0.3), rgba(253,164,175,0.2));">
        <h2 class="text-4xl font-extrabold text-pink-600 mb-4">
            Selamat Datang di kliniku adakah yang bisa kami, {{ $pasien->nama ?? Auth::user()->name }} 👋
        </h2>
        <p class="text-gray-700 text-lg">
            Gunakan menu di bawah untuk melakukan 
            <span class="font-semibold">pendaftaran</span>, melihat 
            <span class="font-semibold">rekam medis</span>, atau mengecek 
            <span class="font-semibold">pembayaran</span> Anda.
        </p>
    </div>

    <div class="row g-4">
        <div class="col-md-4 d-flex">
            <div class="card shadow-sm border-0 rounded-4 text-white text-center p-8 flex-fill hover:shadow-lg transition" style="background: linear-gradient(135deg, rgba(251,182,206,1), rgba(251,182,206,0.8));">
                <h5 class="card-title mb-4 text-lg font-bold">Pendaftaran</h5>
                <p class="card-text fs-5 mb-6">Lihat daftar pendaftaran dan tambah baru</p>
                <a href="{{ route('pasien.pendaftaran.index') }}" class="btn mt-3 bg-white text-pink-600 font-semibold px-6 py-3 rounded-full hover:bg-pink-50 transition">
                   Lihat Pendaftaran
                </a>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card shadow-sm border-0 rounded-4 text-white text-center p-8 flex-fill hover:shadow-lg transition" style="background: linear-gradient(135deg, rgba(251,207,232,1), rgba(251,207,232,0.8));">
                <h5 class="card-title mb-4 text-lg font-bold">Rekam Medis</h5>
                <p class="card-text fs-5 mb-6">Lihat riwayat pemeriksaan kamu</p>
                <a href="{{ route('pasien.rekam_medis.index') }}" class="btn mt-3 bg-white text-pink-600 font-semibold px-6 py-3 rounded-full hover:bg-pink-50 transition">
                   Lihat Rekam Medis
                </a>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card shadow-sm border-0 rounded-4 text-white text-center p-8 flex-fill hover:shadow-lg transition" style="background: linear-gradient(135deg, rgba(253,164,175,1), rgba(253,164,175,0.8));">
                <h5 class="card-title mb-4 text-lg font-bold">Pembayaran</h5>
                <p class="card-text fs-5 mb-6">Cek status dan riwayat pembayaran</p>
                <a href="{{ route('pasien.pembayaran.index') }}" class="btn mt-3 bg-white text-pink-600 font-semibold px-6 py-3 rounded-full hover:bg-pink-50 transition">
                   Lihat Pembayaran
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
