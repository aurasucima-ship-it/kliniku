<x-guest-layout>
    <div class="max-w-md w-full mx-auto bg-white p-8 rounded-2xl shadow-lg border border-pink-200">
        <!-- Judul / Heading Form -->
        <div class="text-center mb-6">
            <!-- Icon di atas -->
            <div class="text-pink-600 text-5xl mb-3">
                🏥
            </div>

            <!-- Judul -->
            <h1 class="text-3xl font-extrabold text-pink-600">
                KLINIKU
            </h1>

            <!-- Subjudul / deskripsi -->
            <p class="text-pink-400 text-sm mt-2">
                Silakan masuk untuk melanjutkan
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="text-pink-600 font-semibold" />
                <x-text-input 
                    id="email"
                    class="block mt-1 w-full rounded-lg border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200"
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="username" 
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-pink-500" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="text-pink-600 font-semibold" />
                <x-text-input 
                    id="password"
                    class="block mt-1 w-full rounded-lg border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200"
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="current-password" 
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-pink-500" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-6">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input 
                        id="remember_me" 
                        type="checkbox"
                        class="rounded border-gray-300 text-pink-600 shadow-sm focus:ring-pink-400"
                        name="remember"
                    >
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Tombol dan Link -->
            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a 
                        class="underline text-sm text-pink-500 hover:text-pink-700"
                        href="{{ route('password.request') }}"
                    >
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button
                    class="bg-pink-500 hover:bg-pink-600 focus:ring-pink-400 px-6 py-2 rounded-full shadow-md"
                >
                    {{ __('Login') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
