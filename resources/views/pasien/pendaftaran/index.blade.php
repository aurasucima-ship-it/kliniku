@extends('layouts.app')

@section('title', 'Pendaftaran Pasien')

@section('content')
@if(session('success'))
    <div id="success-notif" 
         style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                background-color:#ec4899; color:white; padding:15px 25px; border-radius:12px; z-index:1000; text-align:center;">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function(){
            var notif = document.getElementById('success-notif');
            if(notif){
                notif.style.transition = "opacity 0.5s";
                notif.style.opacity = 0;
                setTimeout(()=>notif.remove(), 500);
            }
        }, 3000);
    </script>
@endif

<div style="background-color:#fde6ef; min-height:100vh; padding:50px 0; font-family:'Poppins', sans-serif;">
    <div class="container max-w-6xl mx-auto px-4">
        <div class="bg-white rounded-4 shadow-lg p-5">
            <h1 class="text-center fw-bold mb-4" style="color:#db2777; font-size:2rem;">
                <i class="fas fa-heart"></i> DATA PENDAFTARAN PASIEN
            </h1>

            <div class="mb-4 text-center">
                <a href="{{ route('pasien.pendaftaran.create') }}" 
                   class="btn px-5 py-2"
                   style="background-color:#ec4899; color:white; border-radius:10px;">
                   + Tambah Pendaftaran Baru
                </a>
            </div>

            @if($pendaftarans->isEmpty())
                <div class="text-center text-pink-500 py-6">
                    <p class="fs-5">Belum ada pendaftaran.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle mb-0 rounded-3" 
                           style="border-color:#f472b6; background:#fff; box-shadow: 0 4px 12px rgba(249,114,182,0.2);">
                        <thead style="background-color:#f9a8d4; color:white; font-weight:600;">
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
                                <tr style="transition:0.3s; cursor:pointer;" 
                                    onmouseover="this.style.backgroundColor='#ffe0eb'" 
                                    onmouseout="this.style.backgroundColor=''">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $p->nama }}</td>
                                    <td>{{ $p->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $p->no_telp }}</td>
                                    <td>{{ $p->alamat }}</td>
                                    <td>{{ $p->keluhan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->tanggal_berobat)->format('d/m/Y') }}</td>
                                    <td>{{ $p->dokter->nama ?? '-' }}</td>
                                    <td class="flex justify-center items-center gap-2">
                                        <form action="{{ route('pasien.pendaftaran.destroy', $p->id) }}" method="POST" style="display:inline-flex;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn px-2 py-1" 
                                                    style="background-color:#f9a8d4; color:white; border-radius:8px;">
                                                <i class="fas fa-trash"></i>
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
    </div>
</div>
@endsection
