@extends('layouts.app')

@section('title', 'Daftar Rekam Medis')

@section('content')
<div class="max-w-6xl mx-auto py-6">

    <div class="card border border-pink-300 shadow-sm rounded-2xl">

        <!-- Header -->
        <h5 class="card-header text-center fs-4 fw-bold d-flex justify-content-center align-items-center gap-2"
            style="background: linear-gradient(90deg, #ffffff, #ffffff); color:#f73e88; letter-spacing:1px; border-top-left-radius:1rem; border-top-right-radius:1rem;">
            <i class="fas fa-notes-medical"></i>
            DATA REKAM MEDIS ANDA
        </h5>

        <!-- Tombol Tambah -->
        <div class="p-3 text-start"> 
            <a href="{{ route('dokter.rekam_medis.create') }}" 
               class="btn px-4 py-2 rounded-full shadow-sm"
               style="background-color:#ef97be; color:#fff; font-weight:600; font-size:0.95rem;">
               + Tambah Rekam Medis
            </a>
        </div>

        <!-- Table -->
        <div class="table-responsive p-3">
            <table class="table table-bordered text-center align-middle mb-0 rounded-2xl" 
                   style="border-color:#F9A8D4; border-radius:1rem; overflow:hidden;">
                <thead style="background-color:#FBCFE8; color:#9d174d; font-weight:600; letter-spacing:0.5px;">
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>Pasien</th>
                        <th>Keluhan</th>
                        <th>Diagnosa</th>
                        <th>Tindakan</th>
                        <th style="width:140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rekamMedis as $index => $rm)
                        <tr style="transition:0.2s;" 
                            onmouseover="this.style.backgroundColor='#FFE4ED'" 
                            onmouseout="this.style.backgroundColor=''">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $rm->pasien->nama ?? '-' }}</td>
                            <td>{{ $rm->keluhan }}</td>
                            <td>{{ $rm->diagnosa }}</td>
                            <td>{{ $rm->tindakan }}</td>
                            <td class="d-flex justify-center gap-2">

                                <!-- Lihat -->
                                <a href="{{ route('dokter.rekam_medis.show', $rm->id) }}" 
                                   class="btn-icon-lightpink" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Hapus -->
                                <form action="{{ route('dokter.rekam_medis.destroy', $rm->id) }}" method="POST" class="inline-block">
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
                            <td colspan="6" class="text-center text-pink-500 py-2">Belum ada data rekam medis</td>
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
            didOpen: (toast) => {
                toast.classList.add('animate-bounce');
            }
        });
    @endif

    const deleteButtons = document.querySelectorAll(".btn-delete");
    deleteButtons.forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin mau hapus rekam medis ini?',
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
