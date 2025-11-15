<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dasbor Admin Desa')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb { background: #888; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #555; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex">

    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white shadow-sm p-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold text-gray-800">@yield('title')</h1>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">Halo, Admin!</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Logout</button>
                </form>
            </div>
        </header>
        <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Cari semua tombol trigger dropdown di sidebar
            const triggers = document.querySelectorAll('[data-dropdown-trigger]');
    
            triggers.forEach(trigger => {
                const contentName = trigger.dataset.dropdownTrigger;
                const content = document.querySelector(`[data-dropdown-content="${contentName}"]`);
                const icon = trigger.querySelector(`[data-dropdown-icon="${contentName}"]`);
    
                trigger.addEventListener('click', function () {
                    // Toggle (buka/tutup) menu
                    content.classList.toggle('hidden');
                    
                    // Putar ikon panah
                    icon.classList.toggle('rotate-180');
                });
            });
        });
    </script>
</body>
</html>
