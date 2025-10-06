@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
<div class="max-w-6xl mx-auto py-6">
    <div class="card border border-pink-300 shadow-sm rounded-2xl">
        <h5 class="card-header text-center fs-4 fw-bold d-flex justify-content-center items-center gap-2"
            style="background:#fff;color:#f73e88;letter-spacing:1px;border-top-left-radius:1rem;border-top-right-radius:1rem;">
            <i class="fas fa-user-injured"></i>
            DATA PASIEN
        </h5>

<div class="p-3 flex justify-between items-center flex-wrap gap-2">
    <a href="{{ route('dokter.pasien.create') }}" 
       class="btn px-4 py-2 rounded-full shadow-sm"
       style="background-color:#ef97be;color:#fff;font-weight:600;font-size:0.95rem;">
       + Tambah Pasien
    </a>

    <div class="mt-2" style="width:230px;">
        <input type="text" id="cariPasien" placeholder="Cari pasien disini..." 
               class="form-control rounded-full border-pink-300 focus:border-pink-400 focus:ring-0 text-sm">
    </div>
</div>


        <div class="table-responsive p-3">
            <table id="tabelPasien" class="table text-center align-middle mb-0 rounded-2xl" 
                   style="border-collapse:collapse;width:100%;">
                <thead style="background-color:#FBCFE8;color:#9d174d;font-weight:600;letter-spacing:0.5px;">
                    <tr>
                        <th style="width:50px;border:1px solid #F9A8D4;">No</th>
                        <th style="border:1px solid #F9A8D4;">Nama</th>
                        <th style="border:1px solid #F9A8D4;">Jenis Kelamin</th>
                        <th style="border:1px solid #F9A8D4;">No. Telepon</th>
                        <th style="border:1px solid #F9A8D4;">Tanggal Berobat</th>
                        <th style="width:140px;border:1px solid #F9A8D4;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pasiens as $index => $pasien)
                        <tr style="transition:0.2s;" 
                            onmouseover="this.style.backgroundColor='#FFE4ED'" 
                            onmouseout="this.style.backgroundColor=''">
                            <td style="border:1px solid #F9A8D4;">{{ $index + 1 }}</td>
                            <td style="border:1px solid #F9A8D4;">{{ $pasien->nama }}</td>
                            <td style="border:1px solid #F9A8D4;">{{ $pasien->jenis_kelamin_text }}</td>
                            <td style="border:1px solid #F9A8D4;">{{ $pasien->no_telp ?? '-' }}</td>
                            <td style="border:1px solid #F9A8D4;">{{ $pasien->tanggal_berobat->format('d/m/Y') }}</td>
                            <td style="border:1px solid #F9A8D4;" class="d-flex justify-center gap-2">
                                <a href="{{ route('dokter.pasien.show', $pasien->id) }}" class="btn-icon-lightpink">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('dokter.pasien.edit', $pasien->id) }}" class="btn-icon-lightpink">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('dokter.pasien.destroy', $pasien->id) }}" method="POST" class="inline-block form-delete">
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
    const inputCari = document.getElementById('cariPasien');
    inputCari.addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tabelPasien tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

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
                            }).then(() => location.reload());
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
</style>
