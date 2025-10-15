@extends('layouts.app')

@section('title', 'Daftar Pembayaran')

@section('content')
<div class="container py-4">

    {{-- Card Summary --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card shadow-lg rounded-3xl text-center p-4 text-white" style="background: linear-gradient(135deg, #FBCFE8, #F9A8D4);">
                <h6 class="fw-semibold">Total Pembayaran</h6>
                <p class="fs-3 fw-bold">{{ $pembayaran->count() }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-lg rounded-3xl text-center p-4 text-white" style="background: linear-gradient(135deg, #34D399, #10B981);">
                <h6 class="fw-semibold">Lunas</h6>
                <p class="fs-3 fw-bold">{{ $pembayaran->where('status', 'lunas')->count() }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-lg rounded-3xl text-center p-4 text-white" style="background: linear-gradient(135deg, #FBBF24, #F59E0B);">
                <h6 class="fw-semibold">Menunggu Konfirmasi</h6>
                <p class="fs-3 fw-bold">{{ $pembayaran->where('status', 'menunggu konfirmasi')->count() }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-lg rounded-3xl text-center p-4 text-white" style="background: linear-gradient(135deg, #F87171, #EF4444);">
                <h6 class="fw-semibold">Belum Lunas</h6>
                <p class="fs-3 fw-bold">{{ $pembayaran->where('status', 'belum lunas')->count() }}</p>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="d-flex justify-between flex-wrap gap-3 mb-3">
        <a href="{{ route('dokter.pembayaran.create') }}" 
           class="btn px-5 py-2 rounded-full shadow-sm text-white fw-semibold"
           style="background-color:#EF97BE; transition: 0.2s;">
           + Tambah Pembayaran
        </a>
        <input type="text" id="cariPembayaran" placeholder="Cari pembayaran..." 
               class="form-control rounded-full border-pink-300 focus:border-pink-400 focus:ring-0 w-auto" style="min-width: 250px;">
    </div>

    {{-- Tabel Pembayaran --}}
    <div class="card border border-pink-300 shadow-sm rounded-2xl p-3 overflow-x-auto">
        <table id="tabelPembayaran" class="table text-center align-middle mb-0 rounded-2xl" style="width:100%;">
            <thead style="background-color:#FBCFE8; color:#9d174d; font-weight:600;">
                <tr>
                    <th>No</th>
                    <th>Pasien</th>
                    <th>Jumlah</th>
                    <th>Metode</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Bukti Transfer</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pembayaran as $index => $p)
                <tr class="transition hover:bg-pink-100">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->pasien->nama ?? '-' }}</td>
                    <td>Rp {{ number_format($p->jumlah,0,',','.') }}</td>
                    <td>{{ ucfirst($p->metode ?? '-') }}</td>
                    <td>{{ $p->tanggal->format('d/m/Y') }}</td>
                    <td>{{ $p->keterangan ?? '-' }}</td>
                    <td>
                        @if($p->status === 'lunas')
                            <span class="badge bg-success">Lunas</span>
                        @elseif($p->status === 'menunggu konfirmasi')
                            <span class="badge bg-warning">Menunggu</span>
                        @else
                            <span class="badge bg-danger">Belum Lunas</span>
                        @endif
                    </td>
                    <td>
                        @if($p->bukti_transfer)
                            <a href="{{ asset('storage/' . $p->bukti_transfer) }}" target="_blank">
                                <img src="{{ asset('storage/' . $p->bukti_transfer) }}" style="width:60px; border-radius:6px;">
                            </a>
                        @else - @endif
                    </td>
                    <td class="d-flex justify-center gap-2">
                        <a href="{{ route('dokter.pembayaran.edit', $p->id) }}" class="btn-icon-lightpink"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('dokter.pembayaran.destroy', $p->id) }}" method="POST" class="inline-block">
                            @csrf @method('DELETE')
                            <button type="button" class="btn-icon-lightpink btn-delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-pink-500 py-2">Belum ada data pembayaran</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const inputCari = document.getElementById('cariPembayaran');
    inputCari.addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        document.querySelectorAll('#tabelPembayaran tbody tr').forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
        });
    });

    document.querySelectorAll(".btn-delete").forEach(btn => {
        btn.addEventListener("click", function() {
            const form = this.closest('form');
            Swal.fire({
                title: 'Yakin mau hapus pembayaran ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                background: '#fbcfe8',
                color: '#9d174d',
                customClass: {
                    confirmButton: 'btn btn-pink px-4 py-2 text-white rounded-full animate-bounce',
                    cancelButton: 'btn btn-secondary px-4 py-2 rounded-full'
                },
                buttonsStyling: false
            }).then((result) => { if(result.isConfirmed) form.submit(); });
        });
    });
});
</script>
@endpush

<style>
.btn-icon-lightpink {
    display:inline-flex; justify-content:center; align-items:center;
    width:36px; height:36px; background-color:#fbcfe8; color:#9d174d;
    border-radius:8px; border:none; cursor:pointer; transition:all 0.2s ease;
}
.btn-icon-lightpink:hover { background-color:#f9a8d4; transform:scale(1.05); }
.badge { font-size:0.8rem; font-weight:600; padding:0.2rem 0.5rem; border-radius:0.35rem; }
.bg-success {background-color: #22c55e; color:#fff;}
.bg-warning {background-color: #f59e0b; color:#fff;}
.bg-danger {background-color: #ef4444; color:#fff;}
</style>
