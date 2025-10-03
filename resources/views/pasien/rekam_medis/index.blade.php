@extends('layouts.app')

@section('title', 'Rekam Medis Saya')

@section('content')
<div class="max-w-6xl mx-auto py-6">

    <div class="card border border-pink-300 shadow-sm rounded-2xl">

        <!-- Header -->
        <h5 class="card-header text-center fs-4 fw-bold d-flex justify-content-center align-items-center gap-2"
            style="background: linear-gradient(90deg, #ffffff, #ffffff); color:#f73e88; letter-spacing:1px; border-top-left-radius:1rem; border-top-right-radius:1rem;">
            <i class="fas fa-notes-medical"></i>
            REKAM MEDIS SAYA
        </h5>

        <!-- Table -->
        <div class="table-responsive p-3">
            @if($rekamMedis->isEmpty())
                <div class="text-center text-pink-500 py-3">
                    Belum ada rekam medis. Data akan muncul jika dokter/admin sudah menginput.
                </div>
            @else
                <table class="table table-bordered text-center align-middle mb-0 rounded-2xl" 
                       style="border-color:#F9A8D4; border-radius:1rem; overflow:hidden;">
                    <thead style="background-color:#FBCFE8; color:#9d174d; font-weight:600; letter-spacing:0.5px;">
                        <tr>
                            <th style="width:50px;">No</th>
                            <th>Tanggal</th>
                            <th>Dokter</th>
                            <th>Keluhan</th>
                            <th>Diagnosa</th>
                            <th>Tindakan</th>
                            <th>Resep Obat</th>
                            <th>Catatan</th>
                            <th style="width:100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rekamMedis as $index => $rm)
                            <tr style="transition:0.2s;" 
                                onmouseover="this.style.backgroundColor='#FFE4ED'" 
                                onmouseout="this.style.backgroundColor=''">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($rm->tanggal_pemeriksaan)->format('d/m/Y') }}</td>
                                <td>{{ optional($rm->dokter)->nama ?? '-' }}</td>
                                <td>{{ $rm->keluhan }}</td>
                                <td>{{ $rm->diagnosa }}</td>
                                <td>{{ $rm->tindakan }}</td>
                                <td>{{ $rm->resep_obat }}</td>
                                <td>{{ $rm->catatan }}</td>
                                <td>
                                    <a href="{{ route('pasien.rekam_medis.show', $rm->id) }}" 
                                       class="btn btn-sm text-white" 
                                       style="background-color:#f73e88; border-radius:0.75rem;">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
