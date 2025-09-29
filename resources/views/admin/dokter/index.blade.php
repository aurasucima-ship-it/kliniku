@extends('layouts.app')

@section('title', 'Data Dokter')

@section('content')
<div class="card border border-pink-400 shadow-sm">

    <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2 custom-pink">
        <i class="fas fa-user-doctor"></i>
        DATA DOKTER KLINIKU
    </h5>

    <div class="p-3">
        <a href="{{ route('admin.dokter.create') }}" 
           class="btn btn-pink mb-3 px-4 py-2 rounded-full shadow-sm hover:bg-pink-500 text-white font-medium">
           + Tambah Dokter
        </a>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-pink">
                <tr>
                    <th style="width:50px;">No</th>
                    <th>Nama</th>
                    <th>Spesialis</th>
                    <th>Alamat</th>
                    <th style="width:150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dokters as $index => $dokter)
                <tr class="row-hover-pink">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $dokter->nama }}</td>
                    <td>{{ $dokter->spesialis }}</td>
                    <td>{{ $dokter->alamat }}</td>
<td class="d-flex justify-center gap-2">

    <!-- Lihat -->
    <a href="{{ route('admin.dokter.show', $dokter->id) }}" 
       class="btn-icon-pink" 
       title="Lihat">
        <i class="fas fa-eye"></i>
    </a>

    <!-- Edit -->
    <a href="{{ route('admin.dokter.edit', $dokter->id) }}" 
       class="btn-icon-pink" 
       title="Edit">
        <i class="fas fa-edit"></i>
    </a>

    <!-- Hapus -->
    <form action="{{ route('admin.dokter.destroy', $dokter->id) }}" method="POST" class="inline-block">
        @csrf
        @method('DELETE')
        <button type="button" class="btn-icon-pink btn-delete" title="Hapus">
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
<script>
document.addEventListener("DOMContentLoaded", function () {

    const deleteButtons = document.querySelectorAll(".btn-delete");
    deleteButtons.forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin mau hapus dokter ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-pink px-4 py-2 text-white rounded-full',
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
