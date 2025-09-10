@extends('layouts.app')

@section('title', 'Data Dokter')

@section('content')
<div class="card">
  <h5 class="card-header">Data Dokter</h5>

  <div class="p-3">
    <a href="{{ route('dokter.create') }}" class="btn btn-primary mb-3">+ Tambah Dokter</a>
  </div>

  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Spesialis</th>
          <th>Alamat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($dokters as $index => $dokter)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $dokter->nama }}</td>
          <td>{{ $dokter->spesialis }}</td>
          <td>{{ $dokter->alamat }}</td>
          <td>
            <a href="{{ route('dokter.edit', $dokter->id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST" style="display:inline-block;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus data dokter ini?')">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach

        @if($dokters->isEmpty())
        <tr>
          <td colspan="5" class="text-center">Belum ada data dokter</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>
@endsection
