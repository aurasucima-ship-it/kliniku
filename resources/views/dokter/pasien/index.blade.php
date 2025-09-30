@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
<div class="card border border-pink-400 shadow-sm">

    <!-- Header -->
    <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2 text-pink-600">
        <i class="fas fa-user-injured"></i>
        DATA PASIEN
    </h5>

    <div class="p-3 flex justify-start">
        <a href="{{ route('dokter.pasien.create') }}" 
           class="btn btn-pink mb-3 px-4 py-2 rounded-full shadow-sm hover:bg-pink-500 text-white font-medium">
           + Tambah Pasien
        </a>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-pink">
                <tr>
                    <th style="width:50px;">No</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>No. Telepon</th>
                    <th>Tanggal Berobat</th>
                    <th style="width:120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pasiens as $index => $pasien)
                <tr class="row-hover-pink">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pasien->nama }}</td>
                    <td>{{ $pasien->jenis_kelamin_text }}</td>
                    <td>{{ $pasien->no_telp ?? '-' }}</td>
                    <td>{{ $pasien->tanggal_berobat->format('d/m/Y') }}</td>
                    <td class="d-flex justify-center gap-2">
                        <!-- Show -->
                        <a href="{{ route('dokter.pasien.show', $pasien->id) }}" class="btn-icon-pink" title="Lihat">
                            <i class="fas fa-eye"></i>
                        </a>

                        <!-- Edit -->
                        <a href="{{ route('dokter.pasien.edit', $pasien->id) }}" class="btn-icon-pink" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>

                        <!-- Hapus -->
                        <form action="{{ route('dokter.pasien.destroy', $pasien->id) }}" method="POST" class="inline-block">
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
                    <td colspan="6" class="text-center text-pink-500">Belum ada pasien</td>
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
                title: 'Yakin mau hapus pasien ini?',
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
