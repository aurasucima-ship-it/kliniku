@extends('layouts.app')

@section('title', 'Daftar Pembayaran')

@section('content')
<div class="min-h-screen py-10" style="background-color:#fde6ef; font-family:'Poppins', sans-serif;">
    <div class="max-w-6xl mx-auto px-4">

        @if(session('success'))
            <div id="notif-success"
                class="fixed top-20 left-1/2 transform -translate-x-1/2 z-50 bg-pink-100 text-pink-700 border border-pink-300 rounded-2xl px-6 py-3 text-center shadow-lg font-semibold transition-opacity duration-700 opacity-0">
                {{ session('success') }}
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const notif = document.getElementById('notif-success');
                    notif.classList.remove('opacity-0');
                    setTimeout(() => {
                        notif.classList.add('opacity-0');
                    }, 4000);
                });
            </script>
        @endif

        <div class="bg-white rounded-4 shadow-lg overflow-hidden p-5">
            <h5 class="text-center fs-4 fw-bold d-flex justify-center items-center gap-2 mb-6"
                style="background: #fff; color:#f73e88; letter-spacing:1px; padding:1rem 0;">
                <i class="fas fa-credit-card"></i>
                DAFTAR PEMBAYARAN
            </h5>

            @if($pembayaran->isEmpty())
                <div class="text-center text-pink-500 py-6 text-lg">
                    Belum ada pembayaran.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-[900px] table table-bordered text-center align-middle mb-0 rounded-xl"
                           style="border-color:#f9a8d4; background:#fff; box-shadow:0 4px 12px rgba(249,114,182,0.2);">
                        <thead style="background-color:#fbcfe8; color:#9d174d; font-weight:600; letter-spacing:0.5px;">
                            <tr>
                                <th class="py-2 px-3">No</th>
                                <th class="py-2 px-3">Nama Pasien</th>
                                <th class="py-2 px-3">Nama Dokter</th>
                                <th class="py-2 px-3">Jumlah</th>
                                <th class="py-2 px-3">Metode</th>
                                <th class="py-2 px-3">Bukti Transfer</th>
                                <th class="py-2 px-3">Status</th>
                                <th class="py-2 px-3">Tanggal Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembayaran as $index => $p)
                                <tr class="transition cursor-pointer hover:bg-[#FFE4ED]">
                                    <td class="py-2 px-3">{{ $index + 1 }}</td>
                                    <td class="py-2 px-3">{{ $p->pasien?->nama ?? '-' }}</td>
                                    <td class="py-2 px-3">{{ $p->dokter?->nama ?? '-' }}</td>
                                    <td class="py-2 px-3">Rp {{ number_format($p->jumlah ?? 0, 0, ',', '.') }}</td>
                                    <td class="py-2 px-3 text-capitalize">{{ $p->metode ?? '-' }}</td>
<td class="py-2 px-3">
    @php
        $bukti = trim($p->bukti_transfer ?? '');
    @endphp

    @if($bukti)
        <a href="{{ asset('storage/' . $bukti) }}" target="_blank"
           class="badge bg-primary px-3 py-2 rounded-pill text-decoration-none">
           Lihat
        </a>
    @else
        <span class="text-gray-400">-</span>
    @endif
</td>



                                    <td class="py-2 px-3">
                                        @if($p->status === 'lunas')
                                            <span class="badge bg-success px-3 py-2 rounded-pill">Lunas</span>
                                        @else
                                            <a href="{{ route('pasien.pembayaran.form', $p->id) }}"
                                               class="badge bg-danger px-3 py-2 rounded-pill text-decoration-none">
                                               Belum
                                            </a>
                                        @endif
                                    </td>
                                    <td class="py-2 px-3">
                                        {{ $p->tanggal?->format('d/m/Y') ?? $p->created_at->format('d/m/Y') }}
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
