@extends('layouts.app')

@section('title', 'Data Dokter')

@section('content')
<div class="card border border-pink-400 shadow-sm">
    <!-- Header -->
    <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2 custom-pink">
        <i class="fas fa-user-doctor"></i>
        DATA DOKTER KLINIKU
    </h5>

    <!-- Tombol tambah -->
    <div class="p-3">
        <a href="{{ route('dokter.create') }}" class="btn btn-pink mb-3">
            + Tambah Dokter
        </a>
    </div>

    <!-- Tabel data -->
    <div class="table-responsive text-nowrap">
        <table class="table table-bordered table-hover">
            <thead class="table-pink">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Spesialis</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dokters as $index => $dokter)
                <tr class="row-hover-pink">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $dokter->nama }}</td>
                    <td>{{ $dokter->spesialis }}</td>
                    <td>{{ $dokter->alamat }}</td>
                    <td class="d-flex gap-2">
                        <!-- Edit -->
                        <a href="{{ route('dokter.edit', $dokter->id) }}" 
                           class="text-pink-500 hover:text-pink-700" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>

                        <!-- Hapus (SweetAlert yang handle, bukan confirm) -->
                        <form action="{{ route('dokter.destroy', $dokter->id) }}" 
                              method="POST" class="delete-form" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon-pink" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-pink-500">Belum ada data dokter</td>
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
    // konfirmasi hapus
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Yakin mau hapus?',
                text: 'Data ini akan hilang permanen!',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#ec4899', // pink
                cancelButtonColor: '#6b7280',  // abu-abu
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // notifikasi sukses (tambah / edit / hapus)
    @if (session('success'))
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000, // tampil 2 detik
                position: 'center',
                iconColor: '#ec4899', // centang pink
                customClass: {
                    popup: 'rounded-3 shadow',
                    title: 'fw-semibold text-dark',
                },
                showClass: { popup: '' }, // tanpa animasi masuk
                hideClass: { popup: '' }  // tanpa animasi keluar
            });
        });
    @endif
</script>
@endpush
