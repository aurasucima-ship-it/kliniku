@extends('layouts.app')

@section('title', 'Ubah Profil')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
    <h2 class="text-lg font-bold mb-4">Ubah Profil</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Nama -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Foto -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Foto Profil</label>
            <input type="file" name="foto" class="mt-1 block w-full">

            @if(auth()->user()->foto)
                <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                     alt="Foto Profil"
                     class="mt-2 w-20 h-20 rounded-full object-cover">
            @endif
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
