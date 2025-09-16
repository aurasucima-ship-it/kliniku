@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
<div class="card border border-pink-400 shadow-sm">
    <!-- Header tengah dengan ikon -->
    <h5 class="card-header text-pink-600 text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2" style="font-family: 'Poppins', sans-serif;">
        <i class="fas fa-user-injured"></i>
        DATA PASIEN KLINIKU
    </h5>

    <div class="p-3">
        <a href="{{ route('pasien.create') }}" class="btn bg-pink-500 hover:bg-pink-600 text-white mb-3">+ Tambah Pasien</a>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table table-bordered table-hover">
            <thead class="bg-pink-100 text-pink-600 font-bold">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Dokter</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pasiens as $index => $pasien)
                    <tr class="hover:bg-pink-50">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pasien->nama }}</td>
                        <td>{{ $pasien->alamat }}</td>
                        <td>{{ $pasien->jenis_kelamin_text }}</td>
                        <td>{{ $pasien->dokter->nama ?? '-' }}</td>
                        <td class="d-flex gap-2">
                            <!-- Detail icon -->
                            <a href="{{ route('pasien.show', $pasien->id) }}" class="text-pink-500 hover:text-pink-700" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>

                            <!-- Edit icon -->
                            <a href="{{ route('pasien.edit', $pasien->id) }}" class="text-pink-500 hover:text-pink-700" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Hapus icon -->
                            <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-transparent border-0 p-0 text-pink-500 hover:text-pink-700" onclick="return confirm('Yakin hapus pasien ini?')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-pink-500">Belum ada data pasien</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
