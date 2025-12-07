<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Hotel App</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'sidebar-bg': '#0f172a', // Slate 900
                        'sidebar-hover': '#1e293b', // Slate 800
                        'brand-primary': '#2563eb', // Blue 600
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased text-slate-800">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-sidebar-bg text-white flex flex-col shadow-2xl z-20 transition-all duration-300">
            <div class="h-20 flex items-center px-8 border-b border-slate-800">
                <div class="flex items-center gap-3 text-brand-primary">
                    <i class="fa-solid fa-hotel text-2xl"></i>
                    <span class="text-xl font-bold tracking-wide text-white">TiketAdmin</span>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Main Menu</p>

                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-brand-primary text-white shadow-lg shadow-blue-900/50' : 'text-slate-400 hover:bg-sidebar-hover hover:text-white' }}">
                    <i class="fa-solid fa-bed w-5 text-center group-hover:scale-110 transition"></i>
                    <span class="font-medium">Hotel & Rooms</span>
                </a>

                <a href="{{ route('admin.promos.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.promos.*') ? 'bg-brand-primary text-white shadow-lg shadow-blue-900/50' : 'text-slate-400 hover:bg-sidebar-hover hover:text-white' }}">
                    <i class="fa-solid fa-ticket w-5 text-center group-hover:scale-110 transition"></i>
                    <span class="font-medium">Manajemen Promo</span>
                </a>
                <a href="{{ route('admin.sections.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.sections.*') ? 'bg-brand-primary text-white shadow-lg shadow-blue-900/50' : 'text-slate-400 hover:bg-sidebar-hover hover:text-white' }}">
                    <i class="fa-solid fa-layer-group w-5 text-center group-hover:scale-110 transition"></i>
                    <span class="font-medium">Section Home</span>
                </a>
                <a href="{{ route('admin.locations.index') }}" 
   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.locations.*') ? 'bg-brand-primary text-white shadow-lg shadow-blue-900/50' : 'text-slate-400 hover:bg-sidebar-hover hover:text-white' }}">
    <i class="fa-solid fa-map-location-dot w-5 text-center group-hover:scale-110 transition"></i>
    <span class="font-medium">Master Wilayah</span>
</a>
<a href="{{ route('admin.inspirations.index') }}" 
   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.inspirations.*') ? 'bg-brand-primary text-white shadow-lg shadow-blue-900/50' : 'text-slate-400 hover:bg-sidebar-hover hover:text-white' }}">
    <i class="fa-solid fa-lightbulb w-5 text-center group-hover:scale-110 transition"></i>
    <span class="font-medium">Inspirasi Liburan</span>
</a>
<a href="{{ route('admin.partners.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.partners.*') ? 'bg-brand-primary text-white shadow-lg shadow-blue-900/50' : 'text-slate-400 hover:bg-sidebar-hover hover:text-white' }}">
        <i class="fa-solid fa-handshake w-5 text-center group-hover:scale-110 transition"></i>
        <span class="font-medium">Partner Hotel</span>
    </a>

            </nav>

            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-800/50">
                    <div
                        class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold">
                        A
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">Admin</p>
                        <p class="text-xs text-slate-400 truncate">admin@tiket.com</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-slate-400 hover:text-red-400 transition" title="Logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden relative">

            <header
                class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-100 flex justify-between items-center px-8 z-10 sticky top-0">
                <h2 class="text-2xl font-bold text-slate-800">
                    @if (request()->routeIs('admin.dashboard'))
                        Dashboard Overview
                    @elseif(request()->routeIs('admin.promos.*'))
                        Promo Management
                    @else
                        Admin Panel
                    @endif
                </h2>

                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" target="_blank"
                        class="group flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 text-sm font-medium text-slate-600 hover:border-brand-primary hover:text-brand-primary transition bg-white">
                        <span>Lihat Website</span>
                        <i
                            class="fa-solid fa-arrow-up-right-from-square text-xs group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition"></i>
                    </a>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto bg-gray-50 p-6 md:p-8">
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                        class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg flex items-center gap-3 shadow-sm"
                        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0">
                        <i class="fa-solid fa-circle-check"></i>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                {{ $slot }}
            </main>

        </div>
    </div>
</body>

</html>
