<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Idemy</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

{{-- FAKTANYA: Hanya boleh ada SATU root node <body> dengan inisialisasi Alpine.js --}}
<body x-data="{ languageModal: false }" class="bg-gray-50 flex min-h-screen flex-col m-0 p-0 overflow-y-auto">
    
    {{-- Banner Promo --}}
    <div class="w-full bg-[#addada] py-3 px-4 relative flex items-center justify-center border-b border-cyan-200 z-[9999]">
        <p class="text-center text-sm md:text-base text-gray-900">
            <span class="font-bold">{{ __('menu.promo_banner', ['days' => 1, 'price' => 'Rp129.000']) }}</span>
        </p>
    </div>

    {{-- agar dropdown keranjang & profil melayang di atas semua halaman --}}
    <header class="relative z-[9999] w-full">
        @include('components.navbar')
    </header>

    {{-- agar selalu mengalah di bawah navbar --}}
    <main class="flex-1 relative z-10">
        @yield('content')
    </main>

    {{-- Footer Aplikasi --}}
    <footer class="relative z-10">
        @include('components.footer')
    </footer>

    {{-- PASANG STRUKTUR MODAL POPUP --}}
    <div 
        x-show="languageModal" 
        x-transition
        class="fixed inset-0 z-[99999] flex items-center justify-center bg-black bg-opacity-50"
        style="display: none;"
    >
        <div @click.away="languageModal = false" class="bg-white w-full max-w-lg mx-4 rounded-lg shadow-2xl relative p-6 md:p-8">
            {{-- Tombol Close (X) --}}
            <button @click="languageModal = false" class="absolute top-4 right-4 text-gray-500 hover:text-black transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <h2 class="text-[19px] font-bold text-[#2d2f31] mb-6">Pilih bahasa</h2>

            {{-- Grid Pilihan Bahasa --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-2">
                @php
                    $availableLangs = [
                        'en' => 'English',
                        'es' => 'Español',
                        'id' => 'Bahasa Indonesia'
                    ];
                @endphp

                @foreach($availableLangs as $code => $name)
                    <div class="flex">
                        <a href="{{ route('change.lang', $code) }}" 
                           class="inline-block text-[14px] px-3 py-1.5 transition-all duration-150 
                           {{ App::getLocale() == $code 
                                ? 'border border-[#2d2f31] font-bold text-[#2d2f31]' 
                                : 'text-[#2d2f31] hover:text-[#5624d0] hover:underline' }}">
                            {{ $name }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            feather.replace();
        });
    </script>
</body>
</html>