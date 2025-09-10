@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white shadow-lg rounded-2xl overflow-hidden">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center pt-6">Rekam Medis Pasien</h2>

    @if($rekamMedis->isEmpty())
        <div class="text-center text-gray-600 py-10">
            <p class="text-lg">Belum ada rekam medis. Data akan muncul jika dokter/admin sudah mengirim.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full border-t border-gray-200">
                <thead class="bg-green-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold border">#</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold border">Tanggal</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold border">Dokter</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold border">Keluhan</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold border">Diagnosa</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold border">Tindakan</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold border">Resep Obat</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold border">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rekamMedis as $index => $rm)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm text-gray-700 border">{{ $index+1 }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 border">
                                {{ \Carbon\Carbon::parse($rm->tanggal_pemeriksaan)->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700 border">{{ $rm->dokter->nama ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 border">{{ $rm->keluhan }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 border">{{ $rm->diagnosa }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 border">{{ $rm->tindakan }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 border">{{ $rm->resep_obat }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 border">{{ $rm->catatan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
