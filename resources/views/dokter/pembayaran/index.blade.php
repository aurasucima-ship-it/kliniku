@extends('layouts.app')

@section('title', 'Daftar Pembayaran')

@section('content')
    <div class="card border border-pink-300 shadow-sm rounded-2xl">
        <h5 class="card-header text-center fs-4 fw-bold d-flex justify-content-center items-center gap-2"
            style="background:#fff;color:#f73e88;letter-spacing:1px;border-top-left-radius:1rem;border-top-right-radius:1rem;">
            <i class="fas fa-credit-card"></i>
            DATA PEMBAYARAN
        </h5>
        <div class="p-3 flex justify-between items-center flex-wrap gap-2">
            <a href="{{ route('dokter.pembayaran.create') }}" 
               class="btn px-4 py-2 rounded-full shadow-sm text-white font-medium"
               style="background-color:#ef97be;">
               + Tambah Pembayaran
            </a>

            <div class="mt-2" style="width:230px;">
                <input type="text" id="cariPembayaran" placeholder="Cari pembayaran..." 
                       class="form-control rounded-full border-pink-300 focus:border-pink-400 focus:ring-0 text-sm">
            </div>
        </div>

        <div class="overflow-x-auto p-3">
            <table id="tabelPembayaran" class="table text-center align-middle mb-0 rounded-2xl" 
                   style="border-collapse:collapse;width:100%;">
                <thead style="background-color:#FBCFE8; color:#9d174d; font-weight:600; letter-spacing:0.5px;">
                    <tr>
                        <th style="width:50px; border:1px solid #F9A8D4;">No</th>
                        <th style="border:1px solid #F9A8D4;">Pasien</th>
                        <th style="border:1px solid #F9A8D4;">Jumlah</th>
                        <th style="border:1px solid #F9A8D4;">Metode</th>
                        <th style="border:1px solid #F9A8D4;">Tanggal</th>
                        <th style="border:1px solid #F9A8D4;">Keterangan</th>
                        <th style="border:1px solid #F9A8D4;">Status</th>
                        <th style="width:140px; border:1px solid #F9A8D4;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pembayaran as $index => $p)
                        <tr class="transition duration-200 hover:bg-pink-100">
                            <td style="border:1px solid #F9A8D4;">{{ $index + 1 }}</td>
                            <td style="border:1px solid #F9A8D4;">{{ $p->pasien->name ?? '-' }}</td>
                            <td style="border:1px solid #F9A8D4;">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                            <td style="border:1px solid #F9A8D4;">{{ ucfirst($p->metode ?? '-') }}</td>
                            <td style="border:1px solid #F9A8D4;">{{ $p->tanggal->format('d/m/Y') }}</td>
                            <td style="border:1px solid #F9A8D4;">{{ $p->keterangan ?? '-' }}</td>
                            <td style="border:1px solid #F9A8D4;">
                                @if($p->status === 'lunas')
                                    <span class="badge bg-success">Lunas</span>
                                @elseif($p->status === 'nunggu')
                                    <span class="badge bg-warning">Menunggu</span>
                                @else
                                    <span class="badge bg-danger">Belum Lunas</span>
                                @endif
                            </td>
                            <td style="border:1px solid #F9A8D4;" class="d-flex justify-center gap-2">
                                <a href="{{ route('dokter.pembayaran.edit', $p->id) }}" class="btn-icon-lightpink" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('dokter.pembayaran.destroy', $p->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-icon-lightpink btn-delete" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-pink-500 py-2">Belum ada data pembayaran</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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

    const deleteButtons = document.querySelectorAll(".btn-delete");
    deleteButtons.forEach(btn => {
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
            }).then((result) => {
                if(result.isConfirmed) form.submit();
            });
        });
    });

    @if(session('success'))
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000,
            background: '#fbcfe8',
            color: '#9d174d',
            toast: false,
            didOpen: (toast) => toast.classList.add('animate-bounce')
        });
    @endif
});
</script>
@endpush

<style>
.btn-icon-lightpink {
    display:inline-flex;
    justify-content:center;
    align-items:center;
    width:36px;
    height:36px;
    background-color:#fbcfe8;
    color:#9d174d;
    border-radius:8px;
    border:none;
    cursor:pointer;
    transition:all 0.2s ease;
}
.btn-icon-lightpink:hover {
    background-color:#f9a8d4;
    transform:scale(1.05);
}
@keyframes bounce {
    0%,20%,50%,80%,100% {transform: translateY(0);}
    40% {transform: translateY(-10px);}
    60% {transform: translateY(-5px);}
}
.animate-bounce { animation: bounce 0.6s; }

.badge { font-size:0.8rem; font-weight:600; padding:0.2rem 0.5rem; border-radius:0.35rem; }
.bg-success {background-color: #22c55e; color:#fff;}
.bg-warning {background-color: #f59e0b; color:#fff;}
.bg-danger {background-color: #ef4444; color:#fff;}
</style>
