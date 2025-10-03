@extends('layouts.app')

@section('title', 'Pendaftaran Pasien')

@section('content')
<div class="max-w-6xl mx-auto py-6">

    <div class="card border border-pink-300 shadow-sm rounded-2xl">

        <!-- Header -->
        <h5 class="card-header text-center fs-4 fw-bold d-flex justify-content-center align-items-center gap-2"
            style="background: linear-gradient(90deg, #ffffff, #ffffff); color:#f73e88; letter-spacing:1px; border-top-left-radius:1rem; border-top-right-radius:1rem;">
            <i class="fas fa-pencil-alt"></i>
            PENDAFTARAN PASIEN
        </h5>

        <!-- Tombol Tambah -->
        <div class="p-3 text-start"> 
            <a href="{{ route('pasien.pendaftaran.create') }}" 
               class="btn px-4 py-2 rounded-full shadow-sm"
               style="background-color:#ef97be; color:#fff; font-weight:600; font-size:0.95rem;">
               + Tambah Pendaftaran Baru
            </a>
        </div>

        <!-- Table -->
        <div class="table-responsive p-3">
            @if($pendaftarans->isEmpty())
                <div class="text-center text-pink-500 py-4">
                    <p class="fs-5">Belum ada pendaftaran.</p>
                </div>
            @else
                <table class="table table-bordered text-center align-middle mb-0 rounded-2xl" 
                       style="border-color:#F9A8D4; border-radius:1rem; overflow:hidden;">
                    <thead style="background-color:#FBCFE8; color:#9d174d; font-weight:600; letter-spacing:0.5px;">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>No. Telp</th>
                            <th>Alamat</th>
                            <th>Keluhan</th>
                            <th>Tanggal Berobat</th>
                            <th>Dokter</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendaftarans as $index => $p)
                            <tr style="transition:0.2s;" 
                                onmouseover="this.style.backgroundColor='#FFE4ED'" 
                                onmouseout="this.style.backgroundColor=''">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $p->no_telp }}</td>
                                <td>{{ $p->alamat }}</td>
                                <td>{{ $p->keluhan }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->tanggal_berobat)->format('d/m/Y') }}</td>
                                <td>{{ $p->dokter->nama ?? '-' }}</td>
                                <td class="d-flex justify-center gap-2">
                                    <!-- Delete -->
                                    <form action="{{ route('pasien.pendaftaran.destroy', $p->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon-lightpink" title="Hapus">
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
    </div>
</div>
@endsection

<style>
.btn-icon-lightpink {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 36px;
    height: 36px;
    background-color: #fbcfe8;
    color: #9d174d;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
}
.btn-icon-lightpink:hover {
    background-color: #f9a8d4;
    transform: scale(1.05);
}
</style>
