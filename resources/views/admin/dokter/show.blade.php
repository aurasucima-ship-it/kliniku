@extends('layouts.app')

@section('title', 'Detail Dokter')

@section('content')
<div class="container mx-auto p-4">

    <!-- Header -->
    <div class="bg-pink-100 rounded-3xl shadow-lg p-6 mb-6 text-center">
        <h1 class="text-2xl font-bold text-pink-700 flex justify-center items-center gap-3">
            <i class="fas fa-user-doctor"></i> Detail Dokter
        </h1>
    </div>

    <!-- Card Info Dokter -->
    <div class="bg-white rounded-3xl shadow-xl p-6 max-w-3xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <h2 class="text-pink-600 font-semibold">Nama</h2>
                <p class="text-gray-700">{{ $dokter->nama }}</p>
            </div>
            <div>
                <h2 class="text-pink-600 font-semibold">Spesialis</h2>
                <p class="text-gray-700">{{ $dokter->spesialis }}</p>
            </div>
            <div class="md:col-span-2">
                <h2 class="text-pink-600 font-semibold">Alamat</h2>
                <p class="text-gray-700">{{ $dokter->alamat }}</p>
            </div>
            <div>
                <h2 class="text-pink-600 font-semibold">No. Telepon</h2>
                <p class="text-gray-700">{{ $dokter->no_telp ?? '-' }}</p>
            </div>
            <div>
                <h2 class="text-pink-600 font-semibold">Email</h2>
                <p class="text-gray-700">{{ $dokter->email ?? '-' }}</p>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-6 flex justify-end">
            <a href="{{ route('admin.dokter.index') }}"
               class="bg-pink-300 hover:bg-pink-400 text-white px-5 py-2 rounded-full font-semibold shadow transition duration-300">
               Kembali
            </a>
        </div>
    </div>

</div>
@endsection
