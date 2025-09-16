@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-pink-50 shadow-lg rounded-2xl p-8">
    <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Form Pendaftaran Pasien</h2>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="bg-pink-100 text-pink-700 p-3 rounded-lg mb-6 border border-pink-300 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan error --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-6 border border-red-300 text-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pasien.pendaftaran.store') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Keluhan --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Keluhan</label>
            <textarea name="keluhan" rows="2"
                class="w-full border border-gray-300 rounded-md px-2 py-1 text-sm focus:ring focus:ring-pink-300"
                required>{{ old('keluhan') }}</textarea>
        </div>

        {{-- Nomor Telepon --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">No. Telepon</label>
            <input type="text" name="no_telp" value="{{ old('no_telp') }}"
                class="w-full border border-gray-300 rounded-md px-2 py-1 text-sm focus:ring focus:ring-pink-300"
                required>
        </div>

        {{-- Tanggal Berobat --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Tanggal Berobat</label>
            <input type="date" name="tanggal_berobat" value="{{ old('tanggal_berobat') }}"
                class="w-full border border-gray-300 rounded-md px-2 py-1 text-sm focus:ring focus:ring-pink-300"
                required>
        </div>

        {{-- Jenis Kelamin --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Jenis Kelamin</label>
            <select name="jenis_kelamin"
                class="w-full border border-gray-300 rounded-md px-2 py-1 text-sm focus:ring focus:ring-pink-300"
                required>
                <option value="">-- Pilih --</option>
                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        {{-- Alamat --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Alamat</label>
            <textarea name="alamat" rows="2"
                class="w-full border border-gray-300 rounded-md px-2 py-1 text-sm focus:ring focus:ring-pink-300"
                required>{{ old('alamat') }}</textarea>
        </div>

        {{-- Pilih Dokter --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Pilih Dokter</label>
            <select name="dokter_id"
                class="w-full border border-gray-300 rounded-md px-2 py-1 text-sm focus:ring focus:ring-pink-300"
                required>
                <option value="">-- Pilih Dokter --</option>
                @foreach($dokters as $dokter)
                    <option value="{{ $dokter->id }}" {{ old('dokter_id') == $dokter->id ? 'selected' : '' }}>
                        {{ $dokter->nama }} ({{ $dokter->spesialis }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tombol Submit --}}
        <div class="flex justify-start pt-4">
            <button type="submit"
                class="flex items-center gap-2 bg-pink-500 hover:bg-pink-600 
                       text-white font-semibold px-6 py-2 rounded-md shadow-md 
                       transition duration-200">
                <i class="fas fa-user-plus"></i> Daftar
            </button>
        </div>
    </form>
</div>
@endsection
