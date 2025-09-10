@extends('layouts.app')

@section('title', 'Detail Pasien')

@section('content')
<div class="card">
  <h5 class="card-header">Detail Pasien</h5>
  <div class="card-body">
    <table class="table table-striped table-bordered">
      <tr>
        <th width="200">Nama</th>
        <td>{{ $pasien->nama }}</td>
      </tr>
      <tr>
        <th>Alamat</th>
        <td>{{ $pasien->alamat }}</td>
      </tr>
      <tr>
        <th>Jenis Kelamin</th>
        <td>{{ $pasien->jenis_kelamin }}</td>
      </tr>
      <tr>
        <th>No. Telepon</th>
        <td>{{ $pasien->no_telp ?? '-' }}</td>
      </tr>
      <tr>
        <th>Keluhan</th>
        <td>{{ $pasien->keluhan ?? '-' }}</td>
      </tr>
      <tr>
        <th>Tanggal Berobat</th>
        <td>{{ \Carbon\Carbon::parse($pasien->tanggal_berobat)->format('d M Y') }}</td>
      </tr>
      <tr>
        <th>Dokter</th>
        <td>{{ $pasien->dokter->nama ?? '-' }}</td>
      </tr>
    </table>

    <div class="mt-3">
      <a href="{{ route('pasien.index') }}" class="btn btn-secondary">← Kembali</a>
      <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-warning">Edit</a>
    </div>
  </div>
</div>
@endsection
