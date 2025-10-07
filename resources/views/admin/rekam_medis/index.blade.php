@extends('layouts.app')

@section('title', 'Daftar Rekam Medis')

@section('content')
<div class="max-w-7xl mx-auto py-6">
    <div class="card border border-pink-300 shadow-sm rounded-2xl">

        <h5 class="card-header text-center fs-4 fw-bold d-flex justify-content-center align-items-center gap-2"
            style="background: #fff; color:#f73e88; letter-spacing:1px; border-top-left-radius:1rem; border-top-right-radius:1rem;">
            <i class="fas fa-notes-medical"></i>
            DATA REKAM MEDIS KLINIKU
        </h5>

        <div class="p-3 d-flex justify-between items-center gap-3 flex-wrap">
            <a href="{{ route('admin.rekam_medis.create') }}" 
               class="btn px-4 py-2 rounded-full shadow-sm"
               style="background-color:#ef97be; color:#fff; font-weight:600; font-size:0.95rem;">
               + Tambah Rekam Medis
            </a>

            <input type="text" id="searchInput" placeholder="Cari rekam medis pasien..." 
                   class="form-control rounded-full px-3 py-2 border border-pink-300 shadow-sm"
                   style="max-width:250px;">
        </div>

        <div class="p-3" style="overflow-x:auto; white-space:nowrap;">
            <table class="table table-bordered text-center align-middle mb-0" 
                   style="border-color:#F9A8D4; min-width:1200px; border-radius:1rem; overflow:hidden;">
                <thead style="background-color:#FBCFE8; color:#9d174d; font-weight:600; letter-spacing:0.5px;">
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Keluhan</th>
                        <th>Diagnosa</th>
                        <th>Tindakan</th>
                        <th>Resep Obat</th>
                        <th>Catatan</th>
                        <th>Tanggal</th>
                        <th style="width:160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="rekamMedisTable">
                    @forelse ($rekamMedis as $index => $rm)
                        <tr class="hover-row">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $rm->pasien->nama ?? '-' }}</td>
                            <td>{{ $rm->dokter->nama ?? '-' }}</td>
                            <td>{{ $rm->keluhan }}</td>
                            <td>{{ $rm->diagnosa }}</td>
                            <td>{{ $rm->tindakan ?? '-' }}</td>
                            <td>{{ $rm->resep_obat ?? '-' }}</td>
                            <td>{{ $rm->catatan ?? '-' }}</td>
                            <td>{{ $rm->tanggal_pemeriksaan ? \Carbon\Carbon::parse($rm->tanggal_pemeriksaan)->format('d-m-Y') : '-' }}</td>
                            <td class="d-flex justify-center gap-2 flex-wrap">
                                <a href="{{ route('admin.rekam_medis.show', $rm->id) }}" class="btn-icon-lightpink">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.rekam_medis.edit', $rm->id) }}" class="btn-icon-lightpink">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.rekam_medis.destroy', $rm->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-icon-lightpink btn-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-pink-500 py-2">Belum ada data rekam medis</td>
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
            iconHtml: '<i class="fas fa-check-circle fa-2x"></i>',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000,
            background: '#fbcfe8',
            color: '#9d174d',
        });
    @endif

    const deleteButtons = document.querySelectorAll(".btn-delete");
    deleteButtons.forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin mau hapus data ini?',
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
        document.querySelectorAll('#rekamMedisTable tr').forEach(row => {
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
.hover-row {
    transition: 0.2s;
}
.hover-row:hover {
    background-color: #FFE4ED;
    box-shadow: 0 4px 8px rgba(255, 192, 203, 0.2);
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
