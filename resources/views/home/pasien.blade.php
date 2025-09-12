@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Logout -->
    <div class="d-flex justify-content-end mb-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Logout</button>
        </form>
    </div>

    <!-- Ucapan Selamat Datang -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center">
            <h2 class="fw-bold text-primary">
                Selamat Datang, {{ $pasien->nama ?? Auth::user()->name }} 👋
            </h2>
            <p class="mt-3 fs-5 text-muted">
                Gunakan menu di bawah untuk melakukan 
                <strong>pendaftaran</strong> atau melihat 
                <strong>rekam medis</strong> Anda.
            </p>
        </div>
    </div>

    <!-- Menu Aksi Cepat -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100 text-center p-3">
                <h5>Pendaftaran</h5>
                <p class="text-muted mb-3">Daftar berobat secara online</p>
                <a href="{{ route('pasien.pendaftaran.create') }}" class="btn btn-primary">Daftar Sekarang</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100 text-center p-3">
                <h5>Rekam Medis</h5>
                <p class="text-muted mb-3">Lihat riwayat pemeriksaan kamu</p>
                <a href="{{ route('pasien.rekam_medis') }}" class="btn btn-success">Lihat Rekam Medis</a>
            </div>
        </div>
    </div>

</div>
@endsection
