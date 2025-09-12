@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
    <h2 class="text-lg font-bold mb-4">Ubah Profil</h2>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Nama -->
        <div class="mb-4">
            <label class="block text-gray-700">Nama</label>
            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                   class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200" required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                   class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200" required>
        </div>

        <!-- Foto Profil -->
        <div class="mb-4">
            <label class="block text-gray-700">Foto Profil</label>
            <input type="file" name="foto" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
            @if(auth()->user()->foto)
                <img src="{{ asset('storage/' . auth()->user()->foto) }}" class="mt-2 w-24 h-24 rounded-full" alt="Foto Profil">
            @endif
        </div>

        <!-- Password Baru -->
        <div class="mb-4">
            <label class="block text-gray-700">Password Baru (opsional)</label>
            <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Simpan Perubahan
            </button>
        </div>

        @if(session('status') === 'profile-updated')
            <p class="text-green-500 mt-2">Profil berhasil diperbarui!</p>
        @endif
    </form>
</div>
@endsection
