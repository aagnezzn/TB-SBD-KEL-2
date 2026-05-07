<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Idemy</title>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="bg-gray-50 flex min-h-screen flex-col m-0 p-0  overflow-y-auto">
    
    <div class="w-full bg-[#addada] py-3 px-4 relative flex items-center justify-center border-b border-cyaan-200">
        <p class="text-center text-sm md:text-base text-gray-900">
            <span class="font-bold">{{ __('menu.promo_banner', ['days' => 1, 'price' => 'Rp129.000']) }}</span>
        </p>
    </div>

    @include('components.navbar')

    <main class="flex-1">
        @yield('content')
    </main>

    @include('components.footer')

    <script>
        feather.replace()
    </script>
</body>
</html>