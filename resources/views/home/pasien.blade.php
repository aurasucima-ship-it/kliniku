@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-6">

    <!-- Ucapan Selamat Datang -->
    <div class="bg-white shadow-md rounded-xl p-8 mb-8 text-center">
        <h2 class="text-4xl font-bold text-pink-600 mb-4">
            Selamat Datang, {{ $pasien->nama ?? Auth::user()->name }} 👋
        </h2>
        <p class="text-lg text-gray-600">
            Gunakan menu di bawah untuk melakukan 
            <span class="font-semibold">pendaftaran</span> atau melihat 
            <span class="font-semibold">rekam medis</span> Anda.
        </p>
    </div>

    <!-- Menu Aksi Cepat -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Pendaftaran -->
        <div class="bg-white shadow-md rounded-xl p-6 text-center hover:shadow-lg transition">
            <h5 class="text-xl font-bold text-pink-500 mb-2">Pendaftaran</h5>
            <p class="text-gray-500 mb-4">Lihat daftar pendaftaran dan tambah baru</p>
            <a href="{{ route('pasien.pendaftaran.index') }}" 
               class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-semibold px-5 py-2.5 rounded-lg shadow transition">
                Lihat Pendaftaran
            </a>
        </div>

        <!-- Rekam Medis -->
        <div class="bg-white shadow-md rounded-xl p-6 text-center hover:shadow-lg transition">
            <h5 class="text-xl font-bold text-pink-500 mb-2">Rekam Medis</h5>
            <p class="text-gray-500 mb-4">Lihat riwayat pemeriksaan kamu</p>
            <a href="{{ route('pasien.rekam_medis') }}" 
               class="inline-block bg-pink-600 hover:bg-pink-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow transition">
                Lihat Rekam Medis
            </a>
        </div>
    </div>

</div>
@endsection
