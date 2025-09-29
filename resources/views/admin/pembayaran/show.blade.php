@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="card border border-pink-400 shadow-sm">

    <!-- Header -->
    <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2 text-pink-600">
        <i class="fas fa-credit-card"></i>
        DETAIL PEMBAYARAN
    </h5>

    <div class="p-4">
        <table class="table table-bordered">
            <tr>
                <th>Pasien</th>
                <td>{{ $pembayaran->pasien->nama ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>Rp {{ number_format($pembayaran->jumlah,0,',','.') }}</td>
            </tr>
            <tr>
                <th>Metode</th>
                <td>{{ ucwords(str_replace('-', ' ', $pembayaran->metode)) }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ $pembayaran->tanggal->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td>{{ $pembayaran->keterangan ?? '-' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $pembayaran->lunas ? 'Lunas' : 'Belum Lunas' }}</td>
            </tr>
        </table>

        <div class="mt-4">
            <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary px-4 py-2 rounded-full shadow-sm">Kembali</a>
            <a href="{{ route('admin.pembayaran.edit', $pembayaran->id) }}" class="btn btn-pink px-4 py-2 rounded-full shadow-sm text-white hover:bg-pink-500">Edit</a>
        </div>
    </div>

</div>
@endsection
