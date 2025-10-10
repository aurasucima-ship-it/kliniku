@extends('layouts.app')

@section('title', 'Daftar Pembayaran')

@section('content')
<div class="max-w-6xl mx-auto py-6">
    <div class="card border border-pink-300 shadow-sm rounded-2xl overflow-hidden">
        <h5 class="card-header text-center fs-4 fw-bold d-flex justify-content-center align-items-center gap-2"
            style="background: #fff; color:#f73e88; letter-spacing:1px;">
            <i class="fas fa-credit-card"></i>
            DAFTAR PEMBAYARAN
        </h5>

        @if(session('success'))
            <div class="alert text-center m-3 rounded-2xl px-4 py-3 fw-semibold" 
                 style="background-color:#fce7f3; color:#9d174d; border:1px solid #f9a8d4;">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive p-3">
            @if($pembayaran->isEmpty())
                <div class="text-center text-pink-500 py-4 fs-5">
                    Belum ada pembayaran.
                </div>
            @else
                <table class="table table-bordered text-center align-middle mb-0"
                       style="border-color:#f9a8d4; border-radius:1rem; overflow:hidden;">
                    <thead style="background-color:#fbcfe8; color:#9d174d; font-weight:600; letter-spacing:0.5px;">
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Nama Dokter</th>
                            <th>Jumlah</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Tanggal Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembayaran as $index => $p)
                            <tr onmouseover="this.style.backgroundColor='#ffe4ed'" onmouseout="this.style.backgroundColor=''">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p->pasien?->nama ?? '-' }}</td>
                                <td>{{ $p->dokter?->nama ?? '-' }}</td>
                                <td>Rp {{ number_format($p->jumlah ?? 0, 0, ',', '.') }}</td>
                                <td>{{ $p->metode ?? '-' }}</td>
                                <td>
                                    @if($p->status === 'lunas')
                                        <span class="badge bg-success text-white px-3 py-2">Lunas</span>
                                    @else
                                        <a href="{{ route('pasien.pembayaran.form', $p->id) }}"
                                           class="badge bg-warning text-dark text-decoration-none px-3 py-2">
                                           Belum
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $p->tanggal?->format('d/m/Y') ?? $p->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
