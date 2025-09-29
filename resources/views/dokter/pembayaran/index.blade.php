@extends('layouts.app')

@section('title', 'Daftar Pembayaran')

@section('content')
<div class="card border border-pink-400 shadow-sm">

    <!-- Header -->
    <h5 class="card-header bg-pink-500 text-white text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2">
        <i class="fas fa-credit-card"></i>
        DATA PEMBAYARAN KLINIKU
    </h5>

    <div class="p-3 flex justify-start">
        <a href="{{ route('dokter.pembayaran.create') }}" 
           class="btn btn-pink bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-full shadow-sm font-medium mb-3">
           + Tambah Pembayaran
        </a>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-pink bg-pink-100 text-pink-700">
                <tr>
                    <th style="width:50px;">No</th>
                    <th>Pasien</th>
                    <th>Jumlah</th>
                    <th>Metode</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th style="width:120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pembayaran as $index => $p)
                <tr class="hover:bg-pink-50">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->pasien->nama ?? '-' }}</td>
                    <td>Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($p->metode) }}</td>
                    <td>{{ $p->tanggal->format('d-m-Y') }}</td>
                    <td>{{ $p->keterangan ?? '-' }}</td>
                    <td class="d-flex justify-center gap-2">
                        <!-- Lihat -->
                        <a href="{{ route('dokter.pembayaran.show', $p->id) }}" 
                           class="btn-icon-pink text-pink-600 hover:text-pink-800" 
                           title="Lihat">
                            <i class="fas fa-eye"></i>
                        </a>

                        <!-- Edit -->
                        <a href="{{ route('dokter.pembayaran.edit', $p->id) }}" 
                           class="btn-icon-pink text-pink-600 hover:text-pink-800" 
                           title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>

                        <!-- Hapus -->
                        <form action="{{ route('dokter.pembayaran.destroy', $p->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-icon-pink btn-delete text-pink-600 hover:text-pink-800" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-pink-500">Belum ada data pembayaran</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {

    const deleteButtons = document.querySelectorAll(".btn-delete");
    deleteButtons.forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin mau hapus pembayaran ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-pink bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-full',
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

});
</script>
@endpush
