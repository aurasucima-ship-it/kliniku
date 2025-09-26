@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
<div class="card border border-pink-400 shadow-sm">

    <!-- Header -->
    <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2" 
        style="font-family: 'Poppins', sans-serif; color:#db2777;">
        <i class="fas fa-users"></i> DATA PASIEN KLINIKU
    </h5>

    <div class="card-body">
        <!-- Tombol Tambah -->
        <a href="{{ route('admin.pasien.create') }}" class="btn btn-pink mb-3" 
           style="background-color:#db2777; color:#fff; font-weight:500;">
            + Tambah Pasien
        </a>

        <!-- Tabel Pasien -->
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead style="background-color:#fce7f3; color:#000;">
                    <tr>
                        <th style="width:5%;">NO</th>
                        <th style="width:20%;">NAMA</th>
                        <th style="width:30%;">ALAMAT</th>
                        <th style="width:15%;">JENIS KELAMIN</th>
                        <th style="width:20%;">DOKTER</th>
                        <th style="width:10%;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pasiens as $index => $pasien)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pasien->nama }}</td>
                        <td>{{ $pasien->alamat }}</td>
                        <td>{{ $pasien->jenis_kelamin }}</td>
                        <td>{{ $pasien->dokter->nama ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.pasien.show', $pasien->id) }}" class="btn btn-sm btn-outline-pink" title="Lihat">
                                <i class="fas fa-eye" style="color:#db2777;"></i>
                            </a>
                            <a href="{{ route('admin.pasien.edit', $pasien->id) }}" class="btn btn-sm btn-outline-pink" title="Edit">
                                <i class="fas fa-edit" style="color:#db2777;"></i>
                            </a>
                            <form action="{{ route('admin.pasien.destroy', $pasien->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus pasien ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-pink" title="Hapus">
                                    <i class="fas fa-trash" style="color:#db2777;"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-muted">Belum ada data pasien</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
