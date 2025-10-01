<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kliniku</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white/70 backdrop-blur-md shadow-md fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('img/logo/logoklinik.JPEG') }}" alt="Logo Kliniku" class="h-10 w-10 rounded-full shadow">
                <h1 class="text-2xl font-bold text-pink-600">Kliniku</h1>
            </div>

            <div class="space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="text-pink-700 font-semibold hover:text-pink-900">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="px-4 py-2 rounded-lg bg-pink-500 text-white font-semibold hover:bg-pink-600 shadow">
                            Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="px-4 py-2 rounded-lg bg-pink-100 text-pink-600 font-semibold hover:bg-pink-200 shadow">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <main class="flex-1 flex items-center justify-center text-center px-6 relative z-10">
        <div class="mt-28 bg-white/75 backdrop-blur-md p-12 rounded-3xl shadow-2xl max-w-4xl">
            <h2 class="text-5xl font-extrabold text-gray-800 mb-6">
                Selamat Datang di <span class="text-pink-600">Kliniku</span>
            </h2>
            <p class="text-lg text-gray-700 leading-relaxed max-w-3xl mx-auto">
                Kami berkomitmen untuk menjadi mitra kesehatan terbaik bagi Anda dan keluarga. 
                Dengan dukungan tenaga medis profesional, layanan modern, serta fasilitas yang nyaman, 
                <span class="font-semibold text-pink-600">Kliniku</span> hadir memberikan pengalaman pelayanan kesehatan 
                yang lebih hangat, aman, dan terpercaya.  
               
             Silakan masuk atau daftar untuk memulai perjalanan menuju hidup yang lebih sehat.
            </p>
        </div>
    </main>

    <style>
        body {
            background-image: url("{{ asset('storage/backgrounds/bgklinik.JPG') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>

</body>
</html>
