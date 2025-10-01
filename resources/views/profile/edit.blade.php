@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Notifikasi sukses -->
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Notifikasi error -->
    @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mb-4">
        <h5 class="card-header">Edit Profil</h5>
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- Foto Profil -->
                <div class="mb-4 text-center">
                    <img id="preview-photo" 
                         src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('/img/default-avatar.png') }}" 
                         alt="Foto Profil" class="rounded-circle" width="120" height="120">
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Ganti Foto Profil</label>
                    <input type="file" class="form-control" name="photo" id="photo" accept="image/*" onchange="previewPhoto(event)">
                </div>

                <!-- Nama -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" id="name"
                           value="{{ old('name', $user->name) }}" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email"
                           value="{{ old('email', $user->email) }}" required>
                </div>

                <!-- Password (readonly / optional) -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" value="••••••" readonly>
                    <small class="text-muted">Untuk mengganti password, gunakan halaman Update Profil</small>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-pink">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script preview foto -->
@push('scripts')
<script>
function previewPhoto(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('preview-photo');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endpush

@endsection
