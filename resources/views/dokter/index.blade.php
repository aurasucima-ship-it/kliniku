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
        <a href="{{ route('dokter.create') }}" class="btn btn-pink mb-3">+ Tambah Dokter</a>
    </div>

    <!-- Tabel data -->
    <div class="table-responsive text-nowrap">
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-pink">
                <tr>
                    <th style="width:50px;">No</th>
                    <th style="width:100px;">Foto</th>
                    <th>Nama</th>
                    <th>Spesialis</th>
                    <th>Alamat</th>
                    <th style="width:120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dokters as $index => $dokter)
                <tr class="row-hover-pink">
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div class="w-16 h-16 overflow-hidden rounded-lg mx-auto">
                            <img src="{{ $dokter->foto 
                                        ? asset('storage/uploads/dokter/' . $dokter->foto) 
                                        : asset('images/default-avatar.png') }}"
                                 alt="{{ $dokter->nama }}" 
                                 class="w-full h-full object-cover">
                        </div>
                    </td>
                    <td>{{ $dokter->nama }}</td>
                    <td>{{ $dokter->spesialis }}</td>
                    <td>{{ $dokter->alamat }}</td>
                    <td class="d-flex justify-center gap-3">
                        <!-- Edit -->
                        <a href="{{ route('dokter.edit', $dokter->id) }}" 
                           class="text-pink-500 hover:text-pink-700" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>

                        <!-- Hapus -->
                        <form action="{{ route('dokter.destroy', $dokter->id) }}" 
                              method="POST" class="delete-form" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon-pink btn-delete" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-pink-500">Belum ada data dokter</td>
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
    // SweetAlert konfirmasi hapus
    const deleteButtons = document.querySelectorAll(".btn-delete");
    deleteButtons.forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin mau hapus?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
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
