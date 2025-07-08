<x-layouts.frond.app title="Welcome">
    <x-slot:myStyle>
        <style>
            html {
                scroll-behavior: smooth;
            }
        </style>
    </x-slot:myStyle>

    {{-- ? navbar --}}
    <nav
        x-data="{ open: false, isSticky: false }"
        :class="{ 'backdrop-blur bg-white/70 shadow border-b border-gray-200': isSticky, 'bg-transparent': !isSticky }"
        class="transition-all duration-300 sticky top-0 z-50"
        x-init="window.addEventListener('scroll', () => { isSticky = window.scrollY > 10 })"
    >
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Brand -->
                <div class="flex-shrink-0 flex items-center">
                    <span class="font-bold text-xl text-blue-600">Arsip</span>
                </div>
                <!-- Desktop Menu -->
                <div class="hidden sm:flex sm:items-center sm:space-x-8 ml-auto">
                    <a href="#beranda" class="text-gray-600 px-3 py-2 rounded transition">Beranda</a>
                    <a href="#tentang" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded transition">Tentang</a>
                    <a href="#keunggulan" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded transition">Keunggulan</a>
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-400 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:from-blue-700 hover:to-blue-500 hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3m0 0l4-4m-4 4l4 4m13-4a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Login
                    </a>
                </div>
                <!-- Mobile Hamburger -->
                <div class="sm:hidden flex items-center ml-auto">
                    <button @click="open = !open" type="button" class="bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                        <svg class="h-6 w-6" x-show="!open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg class="h-6 w-6" x-show="open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div x-show="open" x-transition class="sm:hidden">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="#" class="block px-4 py-2 text-base font-semibold text-blue-600 rounded">Beranda</a>
                    <a href="#" class="block px-4 py-2 text-base font-medium text-gray-600 hover:text-blue-600 rounded transition">Tentang</a>
                    <a href="#" class="block px-4 py-2 text-base font-medium text-gray-600 hover:text-blue-600 rounded transition">Keunggulan</a>
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 w-full justify-center bg-gradient-to-r from-blue-600 to-blue-400 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:from-blue-700 hover:to-blue-500 hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300 text-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3m0 0l4-4m-4 4l4 4m13-4a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- ? Banner Section  --}}
    <section class="bg-blue-50 flex items-center py-16" style="height: 80vh;" id="beranda">
        <div class="container mx-auto px-4 flex flex-col items-center justify-center text-center">
            <div class="w-full md:w-4/5 lg:w-4/5 mx-auto">
                <h1 class="text-4xl font-extrabold text-blue-700 mb-4">Pengarsipan Dokumen KTP</h1>
                <p class="text-lg text-gray-700 mb-6">
                    Dinas Kependudukan dan Pencatatan Sipil Kota Kupang.
                </p>
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-400 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:from-blue-700 hover:to-blue-500 hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3m0 0l4-4m-4 4l4 4m13-4a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Login
                </a>
            </div>
        </div>
    </section>

    {{-- ? Tentang Section --}}
    <section id="tentang" class="py-20 bg-white mt-8" id="tentang">
        <div class="container mx-auto px-4 flex flex-col items-center text-center">
            <div class="w-full md:w-2/3 lg:w-1/2">
                <h2 class="text-3xl font-bold text-blue-700 mb-4">Tentang</h2>
                <p class="text-gray-700 text-lg mb-6">
                    Aplikasi Arsip KTP adalah solusi digital untuk pengelolaan dan pengarsipan dokumen KTP secara efisien dan aman. Dikembangkan oleh Dinas Kependudukan dan Pencatatan Sipil Kota Kupang, aplikasi ini memudahkan proses pencatatan, pencarian, dan pelaporan dokumen KTP masyarakat secara terintegrasi.
                </p>
            </div>
        </div>
    </section>

    {{-- ? keunggulan section --}}
    <section id="keunggulan" class="py-20 bg-blue-50" id="keunggulan">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-blue-700 mb-4">Keunggulan</h2>
                <p class="text-gray-700 text-lg">
                    Berikut adalah beberapa keunggulan utama dari aplikasi Arsip KTP.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Keunggulan 1 -->
                <div class="bg-white rounded-3xl shadow-2xl p-8 flex flex-col items-center text-center border-b-4 border-blue-500 hover:-translate-y-2 hover:shadow-blue-200 transition-all duration-300 group">
                    <div class="bg-gradient-to-tr from-blue-200 to-blue-400 rounded-full p-6 mb-6 shadow-lg group-hover:from-blue-300 group-hover:to-blue-500 transition">
                        <svg class="w-14 h-14 text-blue-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl mb-2 text-blue-700">Akses Cepat</h3>
                    <p class="text-gray-600">Dokumen KTP dapat diakses dengan mudah dan cepat kapan saja dibutuhkan.</p>
                </div>
                <!-- Keunggulan 2 -->
                <div class="bg-white rounded-3xl shadow-2xl p-8 flex flex-col items-center text-center border-b-4 border-blue-500 hover:-translate-y-2 hover:shadow-blue-200 transition-all duration-300 group">
                    <div class="bg-gradient-to-tr from-blue-200 to-blue-400 rounded-full p-6 mb-6 shadow-lg group-hover:from-blue-300 group-hover:to-blue-500 transition">
                        <svg class="w-14 h-14 text-blue-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl mb-2 text-blue-700">Integrasi Mudah</h3>
                    <p class="text-gray-600">Terintegrasi dengan sistem lain untuk kemudahan pengelolaan data.</p>
                </div>
                <!-- Keunggulan 3 (Keamanan Data) -->
                <div class="bg-white rounded-3xl shadow-2xl p-8 flex flex-col items-center text-center border-b-4 border-blue-500 hover:-translate-y-2 hover:shadow-blue-200 transition-all duration-300 group">
                    <div class="bg-gradient-to-tr from-blue-200 to-blue-400 rounded-full p-6 mb-6 shadow-lg group-hover:from-blue-300 group-hover:to-blue-500 transition">
                        <svg class="w-14 h-14 text-blue-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl mb-2 text-blue-700">Keamanan Data</h3>
                    <p class="text-gray-600">Data tersimpan dengan aman dan terjamin kerahasiaannya.</p>
                </div>
                <!-- Keunggulan 4 (Berbasis Digital) -->
                <div class="bg-white rounded-3xl shadow-2xl p-8 flex flex-col items-center text-center border-b-4 border-blue-500 hover:-translate-y-2 hover:shadow-blue-200 transition-all duration-300 group">
                    <div class="bg-gradient-to-tr from-blue-200 to-blue-400 rounded-full p-6 mb-6 shadow-lg group-hover:from-blue-300 group-hover:to-blue-500 transition">
                        <svg class="w-14 h-14 text-blue-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 014-4h4m0 0V7m0 4l-4-4m4 4l4-4"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl mb-2 text-blue-700">Berbasis Digital</h3>
                    <p class="text-gray-600">Pengelolaan dokumen dilakukan secara digital sehingga lebih efisien dan ramah lingkungan.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gradient-to-r from-blue-600 to-blue-400 text-white py-10 shadow-inner">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center space-x-3 mb-6 md:mb-0">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </span>
                <span class="font-extrabold text-xl tracking-wide">Arsip KTP</span>
            </div>
            <div class="flex space-x-6 mb-6 md:mb-0">
                <a href="#beranda" class="hover:underline hover:text-blue-100 transition font-semibold">Beranda</a>
                <a href="#tentang" class="hover:underline hover:text-blue-100 transition font-semibold">Tentang</a>
                <a href="#keunggulan" class="hover:underline hover:text-blue-100 transition font-semibold">Keunggulan</a>
            </div>
            <div class="text-sm text-blue-100 text-center md:text-right">
                &copy; {{ date('Y') }} Dinas Kependudukan dan Pencatatan Sipil Kota Kupang.<br>
                All rights reserved.
            </div>
        </div>
    </footer>

    <x-slot:myScript>

    </x-slot:myScript>
</x-layouts.frond.app>
