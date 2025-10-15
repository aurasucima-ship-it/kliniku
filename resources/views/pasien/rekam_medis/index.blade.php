@extends('layouts.app')

@section('title', 'Rekam Medis Saya')

@section('content')
<div class="min-h-screen py-10" style="background-color:#fde6ef; font-family:'Poppins', sans-serif;">

    <div class="max-w-6xl mx-auto px-4">

        <div class="bg-white rounded-4 shadow-lg overflow-hidden p-5">

            <h5 class="text-center fs-4 fw-bold d-flex justify-center items-center gap-2 mb-6"
                style="background: #fff; color:#f73e88; letter-spacing:1px; border-radius:1rem; padding:1rem 0;">
                <i class="fas fa-notes-medical"></i>
                REKAM MEDIS SAYA
            </h5>

            @if($rekamMedis->isEmpty())
                <div class="text-center text-pink-500 py-6">
                    Belum ada rekam medis. Data akan muncul jika dokter/admin sudah menginput.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-[900px] table table-bordered text-center align-middle mb-0 rounded-xl"
                           style="border-color:#F9A8D4; background:#fff; box-shadow:0 4px 12px rgba(249,114,182,0.2);">
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
                                <tr class="transition cursor-pointer hover:bg-[#FFE4ED]">
                                    <td class="py-2 px-3">{{ $index + 1 }}</td>
                                    <td class="py-2 px-3">{{ \Carbon\Carbon::parse($rm->tanggal_pemeriksaan)->format('d/m/Y') }}</td>
                                    <td class="py-2 px-3">{{ optional($rm->dokter)->nama ?? '-' }}</td>
                                    <td class="py-2 px-3">{{ $rm->keluhan }}</td>
                                    <td class="py-2 px-3">{{ $rm->diagnosa }}</td>
                                    <td class="py-2 px-3">{{ $rm->tindakan }}</td>
                                    <td class="py-2 px-3">{{ $rm->resep_obat }}</td>
                                    <td class="py-2 px-3">{{ $rm->catatan }}</td>
                                    <td class="py-2 px-3">
                                        <a href="{{ route('pasien.rekam_medis.show', $rm->id) }}" 
                                           class="btn px-3 py-1 text-white"
                                           style="background-color:#f73e88; border-radius:0.75rem;">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>

    </div>
</div>
@endsection
