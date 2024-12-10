<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Guia de futbol femení')</title>
    @vite(['resources/css/app.css'])
</head>
<body class="font-sans bg-gray-50 text-gray-800">
<header class="bg-blue-900 text-white shadow-lg">
    <div class="container mx-auto px-6 py-4">
        @include('partials.menu')
    </div>
</header>
<main class="container mx-auto px-6 py-8">
    @yield('content')
</main>
<footer class="bg-blue-900 text-white text-center py-6 mt-10">
    <p class="text-sm">&copy; 2024 Guia de Futbol Femení. Tots els drets reservats.</p>
</footer>
</body>
</html>
