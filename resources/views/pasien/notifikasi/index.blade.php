@extends('layouts.app')

@section('title', 'Notifikasi Saya')

@section('content')
<div class="min-h-screen py-10 px-4" style="background-color: #fde6ef; font-family: 'Poppins', sans-serif;">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-center text-pink-700">Notifikasi Saya</h1>

        @foreach($notifications as $notif)
            <div class="p-5 mb-4 bg-pink-200 border border-pink-400 rounded-2xl shadow-md hover:bg-pink-300 transition duration-300">
                <h5 class="text-lg font-semibold text-pink-800 mb-2">{{ $notif->title }}</h5>
                
                <div class="bg-white border border-pink-300 rounded-xl p-3 mb-2 text-pink-800 shadow-sm">
                    {{ $notif->message }}
                </div>

                <small class="text-pink-600">{{ $notif->created_at->format('d M Y H:i') }}</small>
            </div>
        @endforeach

        @if($notifications->isEmpty())
            <div class="p-5 bg-pink-100 border border-pink-300 rounded-2xl text-center text-pink-700">
                Belum ada notifikasi.
            </div>
        @endif
    </div>
</div>
@endsection
