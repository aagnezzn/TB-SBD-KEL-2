<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Udemy Clone</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icon -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="bg-gray-100">

    @include('components.navbar')

    <main>
        @yield('content')
    </main>

    <script>
        feather.replace()
    </script>

</body>
</html>