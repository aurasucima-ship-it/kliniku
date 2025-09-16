@extends('layouts.app')

@section('title', 'Data Dokter')

@section('content')
<div class="card border border-pink-400 shadow-sm">
<h5 class="card-header text-pink-600 text-center fs-5 fw-semibold d-flex justify-content-center align-items-center gap-2" style="font-family: 'Poppins', sans-serif;">
    <i class="fas fa-user-doctor"></i>
    DATA DOKTER KLINIKU
</h5>




  <div class="p-3">
    <a href="{{ route('dokter.create') }}" class="btn bg-pink-500 hover:bg-pink-600 text-white mb-3">+ Tambah Dokter</a>
  </div>

  <div class="table-responsive text-nowrap">
    <table class="table table-bordered table-hover">
      <thead class="bg-pink-100 text-pink-600 font-bold">
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Spesialis</th>
          <th>Alamat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($dokters as $index => $dokter)
        <tr class="hover:bg-pink-50">
          <td>{{ $index + 1 }}</td>
          <td>{{ $dokter->nama }}</td>
          <td>{{ $dokter->spesialis }}</td>
          <td>{{ $dokter->alamat }}</td>
          <td class="d-flex gap-2">
            <!-- Edit icon -->
            <a href="{{ route('dokter.edit', $dokter->id) }}" class="text-pink-500 hover:text-pink-700" title="Edit">
              <i class="fas fa-edit"></i>
            </a>

            <!-- Hapus icon -->
            <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST" style="display:inline-block;">
              @csrf
              @method('DELETE')
              <button type="submit" class="bg-transparent border-0 p-0 text-pink-500 hover:text-pink-700" onclick="return confirm('Yakin mau hapus data dokter ini?')" title="Hapus">
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
