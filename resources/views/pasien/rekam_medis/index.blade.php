@extends('layouts.app')

@section('title', 'Rekam Medis Pasien')

@section('content')
<div class="container my-6">

    <!-- Judul Halaman + Tombol Kembali -->
    <div class="bg-white shadow-lg rounded-3xl p-6 mb-4 d-flex justify-content-between align-items-center">
        <h2 class="fw-bold d-flex justify-content-center align-items-center gap-2 flex-grow-1"
            style="font-family: 'Poppins', sans-serif; font-size: 2.5rem; color:#db2777;">
            <i class="fas fa-notes-medical"></i> Rekam Medis Pasien
        </h2>

    </div>

    <!-- Tabel Rekam Medis -->
    <div class="bg-white shadow-lg rounded-3xl p-4">
        @if($rekamMedis->isEmpty())
            <div class="text-center text-gray-600 py-10" style="color:#9ca3af;">
                <p class="fs-5">
                    Belum ada rekam medis. Data akan muncul jika dokter/admin sudah mengirim.
                </p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead style="background-color:#ec4899; color:white;">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Tanggal</th>
                            <th>Dokter</th>
                            <th>Keluhan</th>
                            <th>Diagnosa</th>
                            <th>Tindakan</th>
                            <th>Resep Obat</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rekamMedis as $index => $rm)
                            <tr class="align-middle">
                                <td class="text-center">{{ $index+1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($rm->tanggal_pemeriksaan)->format('d M Y') }}</td>
                                <td>{{ $rm->dokter->nama ?? '-' }}</td>
                                <td>{{ $rm->keluhan }}</td>
                                <td>{{ $rm->diagnosa }}</td>
                                <td>{{ $rm->tindakan }}</td>
                                <td>{{ $rm->resep_obat }}</td>
                                <td>{{ $rm->catatan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>
            <a href="{{ url()->previous() }}" 
               class="btn"
               style="background-color:#9ca3af; color:white;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
@endsection
