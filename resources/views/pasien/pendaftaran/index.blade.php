@extends('layouts.app')

@section('title', 'Pendaftaran Pasien')

@section('content')
<div class="container my-6">

    <!-- Container Putih Seluruh Halaman -->
    <div class="bg-white shadow-lg rounded-3xl p-6">

        <!-- Judul Halaman -->
        <div class="text-center mb-6">
            <h1 class="fw-bold d-flex justify-content-center align-items-center gap-2"
                style="font-family: 'Poppins', sans-serif; font-size: 2rem; color:#db2777;">
                <i class="fas fa-pencil-alt"></i> ISI PENDAFTARAN PASIEN
            </h1>
        </div>

        <!-- Tombol Tambah & Kembali -->
        <div class="d-flex justify-content-start gap-2 mb-4">
            <a href="{{ url()->previous() }}" 
               class="btn"
               style="background-color:#9ca3af; color:white;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>

            <a href="{{ route('pasien.pendaftaran.create') }}"
               class="btn"
               style="background-color:#ec4899; color:white;">
                <i class="fas fa-plus"></i> Tambah Pendaftaran Baru
            </a>
        </div>

        <!-- Tabel Pendaftaran -->
        <div class="table-responsive">
            @if($pendaftarans->isEmpty())
                <div class="text-center text-muted py-10" style="color:#9ca3af;">
                    <p class="fs-5">Belum ada pendaftaran.</p>
                </div>
            @else
                <table class="table table-bordered">
                    <thead style="background-color:#ec4899; color:white;">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>No. Telp</th>
                            <th>Alamat</th>
                            <th>Keluhan</th>
                            <th>Tanggal Berobat</th>
                            <th>Dokter</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendaftarans as $index => $p)
                            <tr class="align-middle">
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $p->no_telp }}</td>
                                <td>{{ $p->alamat }}</td>
                                <td>{{ $p->keluhan }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->tanggal_berobat)->format('d M Y') }}</td>
                                <td>{{ $p->dokter->nama ?? '-' }}</td>
                                <td class="text-center">
                                    <form action="{{ route('pasien.pendaftaran.destroy', $p->id) }}" method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn"
                                                style="background-color:#f9a8d4; color:white;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div> <!-- End container putih -->

</div>
@endsection
