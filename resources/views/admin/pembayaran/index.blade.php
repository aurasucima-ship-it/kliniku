@extends('layouts.app')

@section('title', 'Data Pembayaran')

@section('content')
<div class="max-w-6xl mx-auto py-6">
    <div class="card border border-pink-300 shadow-sm rounded-2xl">

        <h5 class="card-header text-center fs-4 fw-bold d-flex justify-content-center align-items-center gap-2"
            style="color:#f73e88; letter-spacing:1px; border-top-left-radius:1rem; border-top-right-radius:1rem;">
            <i class="fas fa-credit-card"></i>
            DATA PEMBAYARAN KLINIKU
        </h5>

        <div class="p-3 d-flex justify-between items-center gap-3 flex-wrap">
            <a href="{{ route('admin.pembayaran.create') }}" 
               class="btn px-4 py-2 rounded-full shadow-sm"
               style="background-color:#ef97be; color:#fff; font-weight:600; font-size:0.95rem;">
               + Tambah Pembayaran
            </a>

            <input type="text" id="searchInput" placeholder="Cari pembayaran disini..." 
                   class="form-control rounded-full px-3 py-2 border border-pink-300 shadow-sm"
                   style="max-width:250px;">
        </div>

        <div class="table-responsive p-3">
            <table class="table table-bordered text-center align-middle mb-0 rounded-2xl" style="border-color:#F9A8D4;">
                <thead style="background-color:#FBCFE8; color:#9d174d; font-weight:600;">
                    <tr>
                        <th>No</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="pembayaranTable">
                    @forelse ($pembayaran as $index => $p)
                        <tr style="transition:0.2s;" 
                            onmouseover="this.style.backgroundColor='#FFE4ED'" 
                            onmouseout="this.style.backgroundColor=''">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $p->pasien->nama ?? '-' }}</td>
                            <td>{{ $p->dokter->nama ?? '-' }}</td>
                            <td>Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($p->metode) }}</td>
                            <td>{{ $p->tanggal->format('d-m-Y') }}</td>
                            <td>{{ $p->keterangan ?? '-' }}</td>
                            <td>
                                @if($p->status === 'lunas')
                                    <span class="badge px-3 py-2" style="background-color:#f9a8d4; color:#9d174d; border-radius:1rem;">Lunas</span>
                                @else
                                    <span class="badge px-3 py-2" style="background-color:#fde2e2; color:#b91c1c; border-radius:1rem;">Belum</span>
                                @endif
                            </td>
                            <td class="d-flex justify-center gap-2">
                                <a href="{{ route('admin.pembayaran.show', $p->id) }}" class="btn-icon-lightpink"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.pembayaran.edit', $p->id) }}" class="btn-icon-lightpink"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.pembayaran.destroy', $p->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
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
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
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
            didOpen: (toast) => { toast.classList.add('animate-bounce'); }
        });
    @endif

    const deleteButtons = document.querySelectorAll(".btn-delete");
    deleteButtons.forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin mau hapus pembayaran ini?',
                text: "Data yang dihapus tidak bisa dikembalikan.",
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
                if(result.isConfirmed) {
                    this.closest('form').submit();
                }
            });
        });
    });

    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        document.querySelectorAll('#pembayaranTable tr').forEach(row => {
            row.style.display = Array.from(row.cells)
                .some(td => td.textContent.toLowerCase().includes(filter)) ? '' : 'none';
        });
    });
});
</script>
@endpush

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
@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
    40% {transform: translateY(-10px);}
    60% {transform: translateY(-5px);}
}
.animate-bounce {
    animation: bounce 0.6s;
}
</style>
