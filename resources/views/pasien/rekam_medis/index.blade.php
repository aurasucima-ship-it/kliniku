@extends('layouts.app')

@section('title', 'Rekam Medis Pasien')

@section('content')
<div class="container mx-auto p-4">

    <!-- Header -->
    <div class="bg-pink-100 rounded-3xl shadow p-6 mb-6 text-center">
        <h1 class="text-3xl font-bold text-pink-700 flex justify-center items-center gap-2">
            <i class="fas fa-notes-medical"></i> Rekam Medis Pasien
        </h1>
    </div>

    <div class="overflow-x-auto bg-white shadow-lg rounded-3xl p-4">
        @if($rekamMedis->isEmpty())
            <div class="text-center text-gray-500 py-10">
                Belum ada rekam medis. Data akan muncul jika dokter/admin sudah mengirim.
            </div>
        @else
            <table class="min-w-full border border-pink-200 rounded-lg overflow-hidden">
                <thead class="bg-pink-200 text-pink-800">
                    <tr>
                        <th class="py-2 px-4 border-b">No</th>
                        <th class="py-2 px-4 border-b">Tanggal</th>
                        <th class="py-2 px-4 border-b">Dokter</th>
                        <th class="py-2 px-4 border-b">Keluhan</th>
                        <th class="py-2 px-4 border-b">Diagnosa</th>
                        <th class="py-2 px-4 border-b">Tindakan</th>
                        <th class="py-2 px-4 border-b">Resep Obat</th>
                        <th class="py-2 px-4 border-b">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rekamMedis as $index => $rm)
                        <tr class="hover:bg-pink-50">
                            <td class="py-2 px-4 text-center border-b">{{ $index + 1 }}</td>
                            <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($rm->tanggal_pemeriksaan)->format('d M Y') }}</td>
                            <td class="py-2 px-4 border-b">{{ optional($rm->dokter)->nama ?? '-' }}</td>
                            <td class="py-2 px-4 border-b">{{ $rm->keluhan }}</td>
                            <td class="py-2 px-4 border-b">{{ $rm->diagnosa }}</td>
                            <td class="py-2 px-4 border-b">{{ $rm->tindakan }}</td>
                            <td class="py-2 px-4 border-b">{{ $rm->resep_obat }}</td>
                            <td class="py-2 px-4 border-b">{{ $rm->catatan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="mt-6">
        <a href="{{ url()->previous() }}" 
           class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded font-medium inline-flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

</div>
@endsection
