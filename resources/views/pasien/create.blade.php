@extends('layouts.app')

@section('title', 'Tambah Pasien')

@section('content')
<div class="card">
  <h5 class="card-header">Tambah Pasien</h5>
  <div class="card-body">
    <form action="{{ route('pasien.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="nama" class="form-label">Nama Pasien</label>
        <input type="text" name="nama" id="nama" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea name="alamat" id="alamat" class="form-control" rows="2" required></textarea>
      </div>

      <div class="mb-3">
        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
          <option value="">-- Pilih --</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="no_telp" class="form-label">No. Telepon</label>
        <input type="text" name="no_telp" id="no_telp" class="form-control">
      </div>

      <div class="mb-3">
        <label for="keluhan" class="form-label">Keluhan</label>
        <textarea name="keluhan" id="keluhan" class="form-control" rows="2"></textarea>
      </div>

      <div class="mb-3">
        <label for="tanggal_berobat" class="form-label">Tanggal Berobat</label>
        <input type="date" name="tanggal_berobat" id="tanggal_berobat" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="dokter_id" class="form-label">Dokter</label>
        <select name="dokter_id" id="dokter_id" class="form-control">
          <option value="">-- Pilih Dokter --</option>
          @foreach($dokters as $dokter)
            <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
          @endforeach
        </select>
      </div>

      <button type="submit" class="btn btn-success">Simpan</button>
      <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>
@endsection
