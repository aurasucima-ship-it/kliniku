@extends('layouts.app')

@section('title', 'Dashboard Pasien')

@section('content')
<div class="max-w-6xl mx-auto py-12">

    <!-- Ucapan Selamat Datang -->
    <div class="card card-pink mb-12 text-center p-12">
        <div class="card-header custom-pink text-5xl font-extrabold mb-6">
            Selamat Datang di Klinik Kami, {{ $pasien->nama ?? Auth::user()->name }} 👋
        </div>
        <p class="text-gray-700 text-xl">
            Gunakan menu di bawah untuk melakukan 
            <span class="font-semibold">pendaftaran</span> atau melihat 
            <span class="font-semibold">rekam medis</span> Anda.
        </p>
    </div>

    <!-- Menu Aksi Cepat: Pendaftaran & Rekam Medis -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Pendaftaran -->
        <div class="card card-pink p-8 text-center hover:shadow-lg transition">
            <h5 class="card-header custom-pink text-2xl font-bold mb-4">Pendaftaran</h5>
            <p class="text-gray-500 mb-6">Lihat daftar pendaftaran dan tambah baru</p>
            <a href="{{ route('pasien.pendaftaran.index') }}" class="btn btn-pink px-6 py-3 text-lg">
                Lihat Pendaftaran
            </a>
        </div>

        <!-- Rekam Medis -->
        <div class="card card-pink p-8 text-center hover:shadow-lg transition">
            <h5 class="card-header custom-pink text-2xl font-bold mb-4">Rekam Medis</h5>
            <p class="text-gray-500 mb-6">Lihat riwayat pemeriksaan kamu</p>
            <a href="{{ route('pasien.rekam_medis') }}" class="btn btn-pink px-6 py-3 text-lg">
                Lihat Rekam Medis
            </a>
        </div>
    </div>

</div>
@endsection
