@extends('layouts.admin')

@section('title', 'Daftar Rekam Medis')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Daftar Rekam Medis</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.rekam_medis.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Rekam Medis</a>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Pasien</th>
                    <th class="px-4 py-2 border">Dokter</th>
                    <th class="px-4 py-2 border">Keluhan</th>
                    <th class="px-4 py-2 border">Diagnosa</th>
                    <th class="px-4 py-2 border">Tindakan</th>
                    <th class="px-4 py-2 border">Resep Obat</th>
                    <th class="px-4 py-2 border">Catatan Tambahan</th>
                    <th class="px-4 py-2 border">Tanggal Pemeriksaan</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekamMedis as $rm)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $rm->pasien->nama }}</td>
                    <td class="px-4 py-2 border">{{ $rm->dokter->nama }}</td>
                    <td class="px-4 py-2 border">{{ $rm->keluhan }}</td>
                    <td class="px-4 py-2 border">{{ $rm->diagnosa }}</td>
                    <td class="px-4 py-2 border">{{ $rm->tindakan ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $rm->resep_obat ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $rm->catatan_tambahan ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $rm->tanggal_pemeriksaan_formatted }}</td>
                    <td class="px-4 py-2 border flex gap-2">
                        <a href="{{ route('admin.rekam_medis.edit', $rm->id) }}" class="bg-yellow-400 text-white px-3 py-1 rounded">Edit</a>
                        <form action="{{ route('admin.rekam_medis.destroy', $rm->id) }}" method="POST" onsubmit="return confirm('Yakin ingin dihapus?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($rekamMedis->isEmpty())
                <tr>
                    <td colspan="9" class="px-4 py-2 text-center border">Belum ada rekam medis</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
