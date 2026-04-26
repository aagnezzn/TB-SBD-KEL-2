<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Idemy</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="bg-gray-50">

    <!-- NAVBAR -->
    @include('components.navbar')

    <!-- CONTENT -->
    @yield('content')

    <!-- INIT ICON -->
    <script>
        feather.replace()
    </script>

</body>
</html>