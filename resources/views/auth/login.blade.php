{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


<x-layouts.frond.app title="login">
    <x-slot:myStyle>
        <style>
            html {
                scroll-behavior: smooth;
            }
        </style>
    </x-slot:myStyle>

    <section class="flex justify-center items-center min-h-screen bg-gradient-to-br from-indigo-100 via-white to-indigo-200">
        <div class="w-full max-w-4xl bg-white rounded-3xl shadow-2xl flex overflow-hidden">
            <!-- Left: Login Form -->
            <div class="w-full md:w-1/2 p-10 flex flex-col justify-center">
                <div class="flex justify-center mb-6">
                    <svg width="48" height="48" fill="none" viewBox="0 0 48 48">
                        <circle cx="24" cy="24" r="24" fill="#6366F1"/>
                        <path d="M24 14a7 7 0 1 1 0 14 7 7 0 0 1 0-14zm0 16c5.33 0 16 2.67 16 8v2H8v-2c0-5.33 10.67-8 16-8z" fill="#fff"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold mb-2 text-center text-indigo-700">Login</h2>
                <p class="text-center text-gray-500 mb-8">Masuk ke akun Anda</p>
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label for="username" class="block text-gray-700 text-sm font-semibold mb-1">Username</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M16 12H8m8 0a4 4 0 1 0-8 0 4 4 0 0 0 8 0z" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus autocomplete="username"
                                class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition outline-none text-gray-700 bg-gray-50 shadow-sm">
                        </div>
                        @error('username')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="block text-gray-700 text-sm font-semibold mb-1">NIK</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 17a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm6-6V9a6 6 0 1 0-12 0v2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2z" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition outline-none text-gray-700 bg-gray-50 shadow-sm">
                        </div>
                        @error('password')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex items-center justify-between">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="remember" class="form-checkbox text-indigo-600 rounded focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-indigo-500 to-indigo-700 text-white font-bold py-2.5 px-4 rounded-lg shadow-lg hover:from-indigo-600 hover:to-indigo-800 transition focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            Log in
                        </button>
                    </div>
                </form>
            </div>
            <!-- Right: SVG Illustration -->
            <div class="hidden md:flex md:w-1/2 bg-indigo-50 items-center justify-center">
                <svg width="320" height="320" viewBox="0 0 320 320" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-72 h-72">
                    <circle cx="160" cy="160" r="160" fill="#6366F1" fill-opacity="0.1"/>
                    <rect x="70" y="110" width="180" height="100" rx="20" fill="#6366F1" fill-opacity="0.2"/>
                    <rect x="90" y="130" width="140" height="60" rx="12" fill="#fff"/>
                    <rect x="110" y="150" width="100" height="12" rx="6" fill="#6366F1" fill-opacity="0.5"/>
                    <rect x="110" y="170" width="60" height="8" rx="4" fill="#6366F1" fill-opacity="0.3"/>
                    <circle cx="220" cy="190" r="8" fill="#6366F1"/>
                    <circle cx="100" cy="190" r="8" fill="#6366F1"/>
                </svg>
            </div>
        </div>
    </section>

    <x-slot:myScript>

    </x-slot:myScript>
</x-layouts.frond.app>
