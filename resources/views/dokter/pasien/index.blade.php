@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
<div class="max-w-6xl mx-auto py-6">

    <div class="card border border-pink-300 shadow-sm rounded-2xl">

        <!-- Header -->
        <h5 class="card-header text-center fs-4 fw-bold d-flex justify-content-center items-center gap-2"
            style="background: linear-gradient(90deg, #ffffff, #ffffff); color:#f73e88; letter-spacing:1px; border-top-left-radius:1rem; border-top-right-radius:1rem;">
            <i class="fas fa-user-injured"></i>
            DATA PASIEN
        </h5>

        <!-- Tombol Tambah -->
        <div class="p-3 text-start"> 
            <a href="{{ route('dokter.pasien.create') }}" 
               class="btn px-4 py-2 rounded-full shadow-sm"
               style="background-color:#ef97be; color:#fff; font-weight:600; font-size:0.95rem;">
               + Tambah Pasien
            </a>
        </div>

        <!-- Table -->
        <div class="table-responsive p-3">
            <table class="table table-bordered text-center align-middle mb-0 rounded-2xl" 
                   style="border-color:#F9A8D4; border-radius:1rem; overflow:hidden;">
                <thead style="background-color:#FBCFE8; color:#9d174d; font-weight:600; letter-spacing:0.5px;">
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>No. Telepon</th>
                        <th>Tanggal Berobat</th>
                        <th style="width:140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pasiens as $index => $pasien)
                        <tr style="transition:0.2s;" 
                            onmouseover="this.style.backgroundColor='#FFE4ED'" 
                            onmouseout="this.style.backgroundColor=''">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pasien->nama }}</td>
                            <td>{{ $pasien->jenis_kelamin_text }}</td>
                            <td>{{ $pasien->no_telp ?? '-' }}</td>
                            <td>{{ $pasien->tanggal_berobat->format('d/m/Y') }}</td>
                            <td class="d-flex justify-center gap-2">

                                <!-- Show -->
                                <a href="{{ route('dokter.pasien.show', $pasien->id) }}" 
                                   class="btn-icon-lightpink" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Edit -->
                                <a href="{{ route('dokter.pasien.edit', $pasien->id) }}" 
                                   class="btn-icon-lightpink" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('dokter.pasien.destroy', $pasien->id) }}" method="POST" class="inline-block form-delete">
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
                            <td colspan="6" class="text-center text-pink-500 py-2">Belum ada data pasien</td>
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

    // Notifikasi sukses
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

    // Tombol delete
    const deleteButtons = document.querySelectorAll(".btn-delete");
    deleteButtons.forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            const form = this.closest('form');
            const action = form.getAttribute('action');

            Swal.fire({
                title: 'Yakin mau hapus pasien ini?',
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
                    fetch(action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: new FormData(form)
                    })
                    .then(response => {
                        if(response.ok){
                            Swal.fire({
                                icon: 'success',
                                title: 'Data pasien berhasil dihapus',
                                timer: 1500,
                                showConfirmButton: false,
                                background: '#fbcfe8',
                                color: '#9d174d'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Gagal!', 'Tidak dapat menghapus data.', 'error');
                        }
                    });
                }
            });
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
