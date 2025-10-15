@extends('layouts.app')

@section('title', 'Notifikasi Saya')

@section('content')
<div class="min-h-screen py-10 px-4" style="background-color: #fde6ef; font-family: 'Poppins', sans-serif;">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-center text-pink-700">Notifikasi Saya</h1>

        @if($pendaftaran->isEmpty() && $pembayaran->isEmpty())
            <div class="p-5 bg-pink-100 border border-pink-300 rounded-2xl text-center text-pink-700">
                Belum ada notifikasi.
            </div>
        @endif
        @foreach($pendaftaran as $item)
            <div class="p-5 mb-4 bg-pink-200 border border-pink-400 rounded-2xl shadow-md hover:bg-pink-300 transition duration-300">
                <h5 class="text-lg font-semibold text-pink-800 mb-2">Pendaftaran Baru</h5>
                <div class="bg-white border border-pink-300 rounded-xl p-3 mb-2 text-pink-800 shadow-sm">
                    Pasien: {{ $item->pasien->nama ?? 'Tidak ada' }}<br>
                    Tanggal: {{ $item->created_at->format('d M Y H:i') }}<br>
                    Catatan: {{ $item->catatan ?? '-' }}
                </div>
            </div>
        @endforeach
        @foreach($pembayaran as $item)
            <div class="p-5 mb-4 bg-pink-200 border border-pink-400 rounded-2xl shadow-md hover:bg-pink-300 transition duration-300">
                <h5 class="text-lg font-semibold text-pink-800 mb-2">Pembayaran Menunggu</h5>
                <div class="bg-white border border-pink-300 rounded-xl p-3 mb-2 text-pink-800 shadow-sm">
                    Pasien: {{ $item->pasien->nama ?? 'Tidak ada' }}<br>
                    Total: Rp {{ number_format($item->total,0,',','.') }}<br>
                    Tanggal: {{ $item->created_at->format('d M Y H:i') }}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
