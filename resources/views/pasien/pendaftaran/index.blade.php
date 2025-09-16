@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white shadow-lg rounded-2xl p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">
        Daftar Pendaftaran Pasien
    </h2>

    
    <div class="flex justify-start mb-4">
        <a href="{{ route('pasien.pendaftaran.create') }}"
           class="inline-flex items-center gap-2 bg-pink-500 hover:bg-pink-600 
                  text-white px-5 py-2.5 rounded-lg shadow text-sm font-semibold 
                  transition-all duration-200 ease-in-out">
            <i class="fas fa-plus"></i> Tambah Pendaftaran Baru
        </a>
    </div>

    @if($pendaftarans->isEmpty())
        <div class="text-center text-gray-600 py-10">
            <p class="text-lg">Belum ada pendaftaran.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                <thead class="bg-pink-500 text-white">
                    <tr>
                        <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold">No</th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold">Nama</th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold">Jenis Kelamin</th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold">No. Telp</th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold">Alamat</th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold">Keluhan</th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold">Tanggal Berobat</th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold">Dokter</th>
                        <th class="border border-gray-300 px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendaftarans as $index => $p)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border border-gray-300 px-4 py-3 text-sm text-gray-700">{{ $index+1 }}</td>
                            <td class="border border-gray-300 px-4 py-3 text-sm text-gray-700 font-medium">{{ $p->nama }}</td>
                            <td class="border border-gray-300 px-4 py-3 text-sm text-gray-700">
                                {{ $p->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </td>
                            <td class="border border-gray-300 px-4 py-3 text-sm text-gray-700">{{ $p->no_telp }}</td>
                            <td class="border border-gray-300 px-4 py-3 text-sm text-gray-700">{{ $p->alamat }}</td>
                            <td class="border border-gray-300 px-4 py-3 text-sm text-gray-700">{{ $p->keluhan }}</td>
                            <td class="border border-gray-300 px-4 py-3 text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($p->tanggal_berobat)->format('d M Y') }}
                            </td>
                            <td class="border border-gray-300 px-4 py-3 text-sm text-gray-700">{{ $p->dokter->nama ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-3 text-sm text-center">
                                <form action="{{ route('pasien.pendaftaran.destroy', $p->id) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus pendaftaran ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="text-pink-500 hover:text-pink-600">
                                        <i class="fas fa-trash fa-lg"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
