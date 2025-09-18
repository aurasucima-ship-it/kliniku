@extends('layouts.app')

@section('title', 'Tambah Dokter')

@section('content')
<div class="card">
  <h5 class="card-header">Tambah Dokter</h5>
  <div class="card-body">
    <form action="{{ route('dokter.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="nama" class="form-label">Nama Dokter</label>
        <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
      </div>

      <div class="mb-3">
        <label for="spesialis" class="form-label">Spesialis</label>
        <input type="text" name="spesialis" id="spesialis" class="form-control" value="{{ old('spesialis') }}" required>
      </div>

      <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea name="alamat" id="alamat" class="form-control" rows="3">{{ old('alamat') }}</textarea>
      </div>

<button type="submit" class="btn btn-pink">Simpan</button>
<a href="{{ route('dokter.index') }}" class="btn btn-secondary">Batal</a>

  </div>
</div>
@endsection
