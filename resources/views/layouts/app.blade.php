<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Desa Bandar Rejo')</title>

    {{-- Google Fonts: Poppins --}}
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Tailwind via Vite --}}
    @vite('resources/css/app.css')

    <style>
        /* fallback bila Tailwind belum di-extend fontFamily */
        .font-poppins { font-family: "Poppins", ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans"; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 font-poppins">
    <x-navbar />

    <main class="min-h-screen">
        @yield('content')
    </main>

    <x-footer />

    @stack('scripts')
</body>
</html>
