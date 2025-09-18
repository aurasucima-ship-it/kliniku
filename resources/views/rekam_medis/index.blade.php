@extends('layouts.app')

@section('title', 'Rekam Medis')

@section('content')
<div class="card border border-pink-400 shadow-sm">
  <!-- Header Card -->
  <h5 class="card-header text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2" 
      style="font-family: 'Poppins', sans-serif; color:#db2777;">
      <i class="fas fa-notes-medical"></i>
      DAFTAR REKAM MEDIS
  </h5>

  <!-- Tombol Tambah -->
  <div class="p-3">
    <a href="{{ route('rekam_medis.create') }}" 
       class="btn mb-3"
       style="background-color:#ec4899; color:white;">
       + Tambah Rekam Medis
    </a>
  </div>

  <!-- Tabel -->
  <div class="table-responsive text-nowrap">
    <table class="table table-bordered table-hover">
      <thead style="background-color:#fce7f3; color:#db2777;">
        <tr>
          <th>No</th>
          <th>Pasien</th>
          <th>Dokter</th>
          <th>Keluhan</th>
          <th>Diagnosa</th>
          <th>Tanggal Pemeriksaan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($rekamMedis as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->pasien->nama }}</td>
          <td>{{ $item->dokter->nama }}</td>
          <td>{{ $item->keluhan }}</td>
          <td>{{ $item->diagnosa }}</td>
          <td>{{ $item->tanggal_pemeriksaan }}</td>
          <td class="d-flex gap-2">
            <!-- Detail -->
            <a href="{{ route('rekam_medis.show', $item->id) }}" 
               class="text-decoration-none"
               style="color:#ec4899;" 
               title="Detail">
              <i class="fas fa-eye"></i>
            </a>

            <!-- Edit -->
            <a href="{{ route('rekam_medis.edit', $item->id) }}" 
               class="text-decoration-none"
               style="color:#ec4899;" 
               title="Edit">
              <i class="fas fa-edit"></i>
            </a>

            <!-- Hapus -->
            <form action="{{ route('rekam_medis.destroy', $item->id) }}" 
                  method="POST" 
                  class="d-inline delete-form">
              @csrf
              @method('DELETE')
              <button type="button" 
                      class="border-0 bg-transparent p-0 delete-btn" 
                      style="color:#ec4899;" 
                      title="Hapus">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-center" style="color:#db2777;">Belum ada data</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

@push('scripts')
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        const form = this.closest('form');
        Swal.fire({
            title: 'Yakin hapus data ini?',
            text: "Data yang dihapus tidak bisa dikembalikan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ec4899',  // tombol konfirmasi pink
            cancelButtonColor: '#f9a8d4',   // tombol batal pink muda
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endpush
