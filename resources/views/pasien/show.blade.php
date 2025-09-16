@extends('layouts.app')

@section('title', 'Detail Pasien')

@section('content')
<div class="card border-pink-400 shadow-sm">
  <h5 class="card-header bg-pink-500 text-white font-bold">Detail Pasien</h5>
  <div class="card-body">
    <table class="table table-bordered table-striped">
      <tr>
        <th width="200" class="bg-pink-100 text-pink-600 font-bold">Nama</th>
        <td>{{ $pasien->nama }}</td>
      </tr>
      <tr>
        <th class="bg-pink-100 text-pink-600 font-bold">Alamat</th>
        <td>{{ $pasien->alamat }}</td>
      </tr>
      <tr>
        <th class="bg-pink-100 text-pink-600 font-bold">Jenis Kelamin</th>
        <td>{{ $pasien->jenis_kelamin }}</td>
      </tr>
      <tr>
        <th class="bg-pink-100 text-pink-600 font-bold">No. Telepon</th>
        <td>{{ $pasien->no_telp ?? '-' }}</td>
      </tr>
      <tr>
        <th class="bg-pink-100 text-pink-600 font-bold">Keluhan</th>
        <td>{{ $pasien->keluhan ?? '-' }}</td>
      </tr>
      <tr>
        <th class="bg-pink-100 text-pink-600 font-bold">Tanggal Berobat</th>
        <td>{{ \Carbon\Carbon::parse($pasien->tanggal_berobat)->format('d M Y') }}</td>
      </tr>
      <tr>
        <th class="bg-pink-100 text-pink-600 font-bold">Dokter</th>
        <td>{{ $pasien->dokter->nama ?? '-' }}</td>
      </tr>
    </table>

    <div class="mt-3 d-flex gap-2">
      <a href="{{ route('pasien.index') }}" class="btn bg-pink-300 hover:bg-pink-400 text-white">← Kembali</a>
      <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn bg-pink-500 hover:bg-pink-600 text-white">Edit</a>
    </div>
  </div>
</div>
@endsection
