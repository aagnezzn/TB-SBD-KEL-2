<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Idemy - Platform Pembelajaran Kelas Dunia</title>

    {{-- Manajemen Aset Ikon dan Pustaka Skrip --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    
    {{-- Mencegah Glitch Kedipan Elemen Alpine.js Saat Pertama Kali Load --}}
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

{{-- FAKTANYA: Sesi root Alpine ditaruh di body untuk mengendalikan modal bahasa global di navbar/footer --}}
<body x-data="{ languageModal: false }" class="bg-[#f7f9fa] flex min-h-screen flex-col m-0 p-0 overflow-y-auto font-sans text-[#1c1d1f]">
    
    {{-- 1. Banner Promo Komersial Atas --}}
    <div class="w-full bg-[#addada] py-3 px-4 relative flex items-center justify-center border-b border-cyan-200 z-[9999] shrink-0">
        <p class="text-center text-xs md:text-sm text-gray-900 font-medium">
            <span class="font-bold">{{ __('menu.promo_banner', ['days' => 1, 'price' => 'Rp129.000']) }}</span>
        </p>
    </div>

    {{-- 2. Komponen Pengarah Navigasi Atas (Navbar Melayang Luar) --}}
    <header class="relative z-[9999] w-full shrink-0">
        @include('components.navbar')
    </header>

    {{-- 3. Area Wadah Konten Dinamis Halaman (Diisi oleh View Anak) --}}
    <main class="flex-1 relative z-10 w-full">
        @yield('content')
    </main>

    {{-- 4. Komponen Keterangan Informasi Bawah (Footer Aplikasi) --}}
    <footer class="relative z-10 w-full shrink-0">
        @include('components.footer')
    </footer>

    {{-- FAKTA PERBAIKAN SCRIPT: Eksekusi rendering Feather Icons dipastikan berjalan responsif dan instan --}}
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
    </script>
</body>
</html>