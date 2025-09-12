@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
<div class="card">
    <h5 class="card-header">Data Pasien</h5>

    <div class="p-3">
        <a href="{{ route('pasien.create') }}" class="btn btn-primary mb-3">+ Tambah Pasien</a>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
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
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pasien->nama }}</td>
                        <td>{{ $pasien->alamat }}</td>
                        <td>{{ $pasien->jenis_kelamin_text }}</td> {{-- L/P → Laki-laki/Perempuan --}}
                        <td>{{ $pasien->dokter->nama ?? '-' }}</td>
                        <td>
                            <a href="{{ route('pasien.show', $pasien->id) }}" class="btn btn-sm btn-info">Detail</a>
                            <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus pasien ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data pasien</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
