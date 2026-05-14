<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Idemy</title>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/feather-icons"></script>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="bg-gray-50 flex min-h-screen flex-col m-0 p-0 overflow-y-auto">
    
    {{-- Banner Promo --}}
    <div class="w-full bg-[#addada] py-3 px-4 relative flex items-center justify-center border-b border-cyan-200 z-[9999]">
        <p class="text-center text-sm md:text-base text-gray-900">
            <span class="font-bold">{{ __('menu.promo_banner', ['days' => 1, 'price' => 'Rp129.000']) }}</span>
        </p>
    </div>

    {{-- FIX UTAMA: Paksa navbar menduduki z-[9999] agar dropdown keranjang & profil melayang di atas semua halaman --}}
    <header class="relative z-[9999] w-full">
        @include('components.navbar')
    </header>

    {{-- FIX PENDUKUNG: Set konten halaman di lapisan z-10 agar selalu mengalah di bawah navbar --}}
    <main class="flex-1 relative z-10">
        @yield('content')
    </main>

    {{-- Footer Aplikasi --}}
    <footer class="relative z-10">
        @include('components.footer')
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            feather.replace();
        });
    </script>
</body>
</html>