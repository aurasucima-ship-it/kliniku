@extends('layouts.app')

@section('title', 'Daftar Pembayaran')

@section('content')
<div class="max-w-6xl mx-auto py-6">
    <div class="card border border-pink-300 shadow-sm rounded-2xl">
        <h5 class="card-header text-center fs-4 fw-bold d-flex justify-content-center align-items-center gap-2"
            style="background: linear-gradient(90deg, #ffffff, #ffffff); color:#f73e88; letter-spacing:1px; border-top-left-radius:1rem; border-top-right-radius:1rem;">
            <i class="fas fa-credit-card"></i>
            DAFTAR PEMBAYARAN
        </h5>

        <div class="table-responsive p-3">
            @if($pembayaran->isEmpty())
                <div class="text-center text-pink-500 py-4">
                    <p class="fs-5">Belum ada pembayaran.</p>
                </div>
            @else
                <table class="table table-bordered text-center align-middle mb-0 rounded-2xl" 
                       style="border-color:#F9A8D4; border-radius:1rem; overflow:hidden;">
                    <thead style="background-color:#FBCFE8; color:#9d174d; font-weight:600; letter-spacing:0.5px;">
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Dokter</th>
                            <th>Jumlah</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Tanggal Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembayaran as $index => $p)
                            <tr style="transition:0.2s;" 
                                onmouseover="this.style.backgroundColor='#FFE4ED'" 
                                onmouseout="this.style.backgroundColor=''">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p->pasien->nama ?? '-' }}</td>
                                <td>{{ $p->pendaftaran->dokter->nama ?? '-' }}</td>
                                <td>Rp {{ number_format($p->jumlah,0,',','.') }}</td>
                                <td>{{ ucfirst($p->metode) }}</td>
                                <td>
                                    @if($p->status == 'belum')
                                        @if($p->pendaftaran)
                                            <a href="{{ route('pasien.pembayaran.form', $p->pendaftaran->id) }}" 
                                               class="badge bg-warning text-dark text-decoration-none">
                                                Belum
                                            </a>
                                        @else
                                            <span class="badge bg-danger text-white">Pendaftaran hilang</span>
                                        @endif
                                    @else
                                        <span class="badge bg-success text-white">Lunas</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($p->tanggal ?? $p->created_at)->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
