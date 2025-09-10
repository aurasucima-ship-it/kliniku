@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Ucapan Selamat Datang -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center">
            <h2 class="fw-bold text-primary">
                Selamat Datang, {{ Auth::user()->name }} 👋
            </h2>
            <p class="mt-3 fs-5 text-muted">
                Semoga sehat selalu.<br>
                Gunakan menu di sebelah kiri untuk melakukan 
                <strong>pendaftaran</strong> atau melihat 
                <strong>rekam medis</strong> Anda.
            </p>
        </div>
    </div>

    <!-- Menu Aksi Cepat -->
    <div class="row g-4">
        <!-- Pendaftaran -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-center text-center">
                    <h5 class="card-title fw-bold">Pendaftaran</h5>
                    <p class="text-muted mb-3">Daftar berobat secara online</p>
<a href="{{ route('pasien.pendaftaran.create') }}" class="btn btn-primary">
    Daftar Sekarang
</a>



                </div>
            </div>
        </div>
        
        <!-- Rekam Medis -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-center text-center">
                    <h5 class="card-title fw-bold">Rekam Medis</h5>
                    <p class="text-muted mb-3">Lihat riwayat pemeriksaan kamu</p>
                    <a href="{{ route('pasien.rekam_medis') }}" class="btn btn-success">
                        Lihat Rekam Medis
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
