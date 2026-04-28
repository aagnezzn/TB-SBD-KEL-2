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

<body class="bg-gray-50">

    <!-- NAVBAR -->
     <body class="bg-gray-50">
        <div class="w-full bg-[#CEFEFF] py-3 px-4 relative flex items-center justify-center border-b border-cyaan-200">
            <p class="text-center text-sm md:text-base text-gray-900">
                <span class="font-bold">1 hari tersisa! Add cross-team skills from Rp.129.000 by tomorrow.</span>
            </p>

            <button class="absolute right-4 text-gray-600 hover:text-black">
                <i data-feather="x" class="w-4 h-4"></i>
            </button>
        </div>

    @include('components.navbar')

    <!-- CONTENT -->
    @yield('content')

    <!-- INIT ICON -->
    <script>
        feather.replace()
    </script>

</body>
</html>