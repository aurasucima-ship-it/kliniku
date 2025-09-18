@extends('layouts.app')

@section('title', 'Ubah Profil')

@section('content')
<div class="bg-white shadow rounded-2xl p-4 p-md-5 mx-auto border border-pink-300" style="max-width: 600px;">
    <h2 class="text-center mb-4" style="color:#db2777; font-family:'Poppins', sans-serif;">
        <i class="fas fa-user-edit me-2"></i> Ubah Profil
    </h2>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success mb-4 text-center">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Nama -->
        <div class="mb-3">
            <label class="form-label fw-semibold" style="color:#db2777;">Nama</label>
            <input type="text" name="name" 
                   value="{{ old('name', auth()->user()->name) }}"
                   class="form-control" style="border-color:#f9a8d4;">
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label fw-semibold" style="color:#db2777;">Email</label>
            <input type="email" name="email" 
                   value="{{ old('email', auth()->user()->email) }}"
                   class="form-control" style="border-color:#f9a8d4;">
        </div>

        <!-- Foto -->
        <div class="mb-3">
            <label class="form-label fw-semibold" style="color:#db2777;">Foto Profil</label>
            <input type="file" name="foto" class="form-control" style="border-color:#f9a8d4;">
            @if(auth()->user()->foto)
                <div class="mt-3 text-center">
                    <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                        alt="Foto Profil"
                        class="rounded-circle border"
                        style="width:100px; height:100px; object-fit:cover; border-color:#f9a8d4;">
                </div>
            @endif
        </div>

        <!-- Password Baru -->
        <div class="mb-3">
            <label class="form-label fw-semibold" style="color:#db2777;">Password Baru (opsional)</label>
            <input type="password" name="password" class="form-control" style="border-color:#f9a8d4;">
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-4">
            <label class="form-label fw-semibold" style="color:#db2777;">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" style="border-color:#f9a8d4;">
        </div>

        <!-- Tombol Simpan -->
        <div class="text-end">
            <button type="submit" 
                    class="btn px-4" 
                    style="background-color:#ec4899; color:white; font-weight:600;">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
