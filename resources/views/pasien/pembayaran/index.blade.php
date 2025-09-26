@extends('layouts.app')

@section('title', 'Daftar Pembayaran')

@section('content')
<div class="card border border-pink-400 shadow-sm">
    <h5 class="card-header text-center fs-5 fw-semibold text-pink-600">
        <i class="ti ti-credit-card"></i> DAFTAR PEMBAYARAN
    </h5>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead class="table-pink">
                <tr>
                    <th>Tanggal</th>
                    <th>Layanan</th>
                    <th>Biaya</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pembayaran as $item)
                <tr>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->layanan }}</td>
                    <td>Rp {{ number_format($item->biaya, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                    <td>
                        @if($item->status === 'belum_lunas')
                            <a href="{{ route('pasien.pembayaran.form', $item->id) }}" 
                               class="btn btn-sm btn-pink">
                                Bayar Sekarang
                            </a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada pembayaran</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
