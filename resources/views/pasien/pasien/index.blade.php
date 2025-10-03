@extends('layouts.app')

@section('title', 'Dashboard Pasien')

@section('content')
<div class="max-w-6xl mx-auto py-12">

    <div class="card card-pink mb-12 text-center p-12">
        <div class="card-header custom-pink text-5xl font-extrabold mb-6">
            Selamat Datang di Klinik Kami, {{ $pasien->nama ?? Auth::user()->name }} 👋
        </div>
        <p class="text-gray-700 text-xl">
            Gunakan menu di bawah untuk melakukan 
            <span class="font-semibold">pendaftaran</span>, melihat 
            <span class="font-semibold">rekam medis</span>, atau mengecek 
            <span class="font-semibold">pembayaran</span> Anda.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <div class="card card-pink p-8 text-center hover:shadow-lg transition">
            <h5 class="card-header custom-pink text-2xl font-bold mb-4">Pendaftaran</h5>
            <p class="text-gray-500 mb-6">Lihat daftar pendaftaran dan tambah baru</p>
            <a href="{{ route('pasien.pendaftaran.index') }}" class="btn btn-pink px-6 py-3 text-lg">
                Lihat Pendaftaran
            </a>
        </div>

        <div class="card card-pink p-8 text-center hover:shadow-lg transition">
            <h5 class="card-header custom-pink text-2xl font-bold mb-4">Rekam Medis</h5>
            <p class="text-gray-500 mb-6">Lihat riwayat pemeriksaan kamu</p>
            <a href="{{ route('pasien.rekam_medis.index') }}" class="btn btn-pink px-6 py-3 text-lg">
                Lihat Rekam Medis
            </a>
        </div>

        <div class="card card-pink p-8 text-center hover:shadow-lg transition">
            <h5 class="card-header custom-pink text-2xl font-bold mb-4">Pembayaran</h5>
            <p class="text-gray-500 mb-6">Cek status dan riwayat pembayaran</p>
            <a href="{{ route('pasien.pembayaran.index') }}" class="btn btn-pink px-6 py-3 text-lg">
                Lihat Pembayaran
            </a>
        </div>
    </div>

</div>
@endsection
