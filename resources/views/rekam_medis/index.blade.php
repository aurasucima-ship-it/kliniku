@extends('layouts.app')

@section('title', 'Rekam Medis')

@section('content')
<div class="card">
  <h5 class="card-header">Daftar Rekam Medis</h5>

  <div class="p-3">
    <a href="{{ route('rekam_medis.create') }}" class="btn btn-primary mb-3">+ Tambah Rekam Medis</a>
  </div>

  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
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
          <td>
            <a href="{{ route('rekam_medis.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
            <a href="{{ route('rekam_medis.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('rekam_medis.destroy', $item->id) }}" method="POST" style="display:inline-block;">
              @csrf
              @method('DELETE')
              <button onclick="return confirm('Yakin hapus data ini?')" class="btn btn-danger btn-sm">
                Hapus
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-center">Belum ada data</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
