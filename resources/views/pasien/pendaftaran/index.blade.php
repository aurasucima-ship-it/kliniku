@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white shadow-lg rounded-2xl p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Daftar Pendaftaran Pasien</h2>

    @if($pendaftarans->isEmpty())
        <div class="text-center text-gray-600 py-10">
            <p class="text-lg">Belum ada pendaftaran.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold">#</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Jenis Kelamin</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">No. Telp</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Alamat</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Keluhan</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Tanggal Berobat</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Dokter</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($pendaftarans as $index => $p)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $index+1 }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 font-medium">{{ $p->nama }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $p->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $p->no_telp }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $p->alamat }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $p->keluhan }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ \Carbon\Carbon::parse($p->tanggal_berobat)->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $p->dokter->nama ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
