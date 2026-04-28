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

<body class="bg-gray-50 flex min-h-screen flex-col m-0 p-0 overflow-x-hidden overflow-y-auto">
    
    <div class="w-full bg-[#addada] py-3 px-4 relative flex items-center justify-center border-b border-cyaan-200">
        <p class="text-center text-sm md:text-base text-gray-900">
            <span class="font-bold">1 hari tersisa! Add cross-team skills from Rp.129.000 by tomorrow.</span>
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