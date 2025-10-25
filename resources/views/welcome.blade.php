<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Desa Bandar Rejo')</title>

    @vite('resources/css/app.css')

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Tambahan styling jika perlu --}}
    <style>
        .font-poppins { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="antialiased font-poppins bg-gray-50 text-gray-900">

    {{-- ✅ Tambah Navbar --}}
    <x-navbar />

    {{-- ✅ Bagian konten halaman --}}
    <main>
        @yield('content')
    </main>

    {{-- ✅ Tambah Footer --}}
    <x-footer />

</body>
</html>
