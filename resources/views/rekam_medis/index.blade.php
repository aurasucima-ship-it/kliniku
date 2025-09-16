@extends('layouts.app')

@section('title', 'Rekam Medis')

@section('content')
<div class="card border border-pink-400 shadow-sm">
  <!-- Header Card -->
  <h5 class="card-header text-pink-600 text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2" style="font-family: 'Poppins', sans-serif;">
      <i class="fas fa-notes-medical"></i>
      DAFTAR REKAM MEDIS
  </h5>

  <!-- Tombol Tambah -->
  <div class="p-3">
    <a href="{{ route('rekam_medis.create') }}" class="btn bg-pink-500 hover:bg-pink-600 text-white mb-3">+ Tambah Rekam Medis</a>
  </div>

  <!-- Tabel -->
  <div class="table-responsive text-nowrap">
    <table class="table table-bordered table-hover">
      <thead class="bg-pink-100 text-pink-600 font-bold">
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
        <tr class="hover:bg-pink-50">
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->pasien->nama }}</td>
          <td>{{ $item->dokter->nama }}</td>
          <td>{{ $item->keluhan }}</td>
          <td>{{ $item->diagnosa }}</td>
          <td>{{ $item->tanggal_pemeriksaan }}</td>
          <td class="d-flex gap-2">
            <!-- Detail icon -->
            <a href="{{ route('rekam_medis.show', $item->id) }}" class="text-pink-500 hover:text-pink-700" title="Detail">
              <i class="fas fa-eye"></i>
            </a>

            <!-- Edit icon -->
            <a href="{{ route('rekam_medis.edit', $item->id) }}" class="text-pink-500 hover:text-pink-700" title="Edit">
              <i class="fas fa-edit"></i>
            </a>

            <!-- Hapus icon -->
            <form action="{{ route('rekam_medis.destroy', $item->id) }}" method="POST" style="display:inline-block;">
              @csrf
              @method('DELETE')
              <button type="submit" class="bg-transparent border-0 p-0 text-pink-500 hover:text-pink-700" onclick="return confirm('Yakin hapus data ini?')" title="Hapus">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-center text-pink-500">Belum ada data</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
