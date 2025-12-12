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
                        'brand-primary': '#3b82f6', // Blue 500 modified
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        /* Custom scrollbar for sidebar */
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: #334155; border-radius: 20px; }
        .sidebar-scroll:hover::-webkit-scrollbar-thumb { background: #475569; }
    </style>
</head>

<body class="bg-slate-50 font-sans antialiased text-slate-800">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-72 bg-sidebar-bg text-white flex flex-col shadow-2xl z-20 transition-all duration-300 border-r border-slate-800/50">
            
            <div class="h-24 flex items-center px-8 border-b border-slate-800/50 bg-slate-900/50">
                <div class="flex items-center gap-4 text-brand-primary group cursor-pointer">
                    <div class="w-10 h-10 rounded-xl bg-blue-600/10 flex items-center justify-center group-hover:bg-blue-600/20 transition duration-300">
                        <i class="fa-solid fa-hotel text-2xl text-blue-500"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-bold tracking-wide text-white leading-tight">TiketAdmin</span>
                        <span class="text-[10px] text-slate-500 uppercase tracking-widest font-medium">Hotel Dashboard</span>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-4 py-8 space-y-1 overflow-y-auto sidebar-scroll">
                
                <p class="px-4 text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-4">Main Menu</p>

                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-300 group mb-1 relative overflow-hidden {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-blue-400' }}">
                    <i class="fa-solid fa-bed w-6 text-center text-lg {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-500 group-hover:text-blue-400' }} transition-colors"></i>
                    <span class="font-medium tracking-wide">Hotel & Rooms</span>
                    @if(request()->routeIs('admin.dashboard'))
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-white/20 rounded-l-full"></div>
                    @endif
                </a>

                <a href="{{ route('admin.promos.index') }}"
                   class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-300 group mb-1 relative overflow-hidden {{ request()->routeIs('admin.promos.*') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-blue-400' }}">
                    <i class="fa-solid fa-ticket w-6 text-center text-lg {{ request()->routeIs('admin.promos.*') ? 'text-white' : 'text-slate-500 group-hover:text-blue-400' }} transition-colors"></i>
                    <span class="font-medium tracking-wide">Manajemen Promo</span>
                </a>

                <a href="{{ route('admin.sections.index') }}"
                   class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-300 group mb-1 relative overflow-hidden {{ request()->routeIs('admin.sections.*') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-blue-400' }}">
                    <i class="fa-solid fa-layer-group w-6 text-center text-lg {{ request()->routeIs('admin.sections.*') ? 'text-white' : 'text-slate-500 group-hover:text-blue-400' }} transition-colors"></i>
                    <span class="font-medium tracking-wide">Section Home</span>
                </a>

                <a href="{{ route('admin.locations.index') }}" 
                   class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-300 group mb-1 relative overflow-hidden {{ request()->routeIs('admin.locations.*') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-blue-400' }}">
                    <i class="fa-solid fa-map-location-dot w-6 text-center text-lg {{ request()->routeIs('admin.locations.*') ? 'text-white' : 'text-slate-500 group-hover:text-blue-400' }} transition-colors"></i>
                    <span class="font-medium tracking-wide">Master Wilayah</span>
                </a>

                <a href="{{ route('admin.inspirations.index') }}" 
                   class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-300 group mb-1 relative overflow-hidden {{ request()->routeIs('admin.inspirations.*') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-blue-400' }}">
                    <i class="fa-solid fa-lightbulb w-6 text-center text-lg {{ request()->routeIs('admin.inspirations.*') ? 'text-white' : 'text-slate-500 group-hover:text-blue-400' }} transition-colors"></i>
                    <span class="font-medium tracking-wide">Inspirasi Liburan</span>
                </a>

                <a href="{{ route('admin.partners.index') }}" 
                   class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-300 group mb-1 relative overflow-hidden {{ request()->routeIs('admin.partners.*') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-blue-400' }}">
                    <i class="fa-solid fa-handshake w-6 text-center text-lg {{ request()->routeIs('admin.partners.*') ? 'text-white' : 'text-slate-500 group-hover:text-blue-400' }} transition-colors"></i>
                    <span class="font-medium tracking-wide">Partner Hotel</span>
                </a>

                <div class="my-6 border-t border-slate-800 mx-4"></div>

                <p class="px-4 text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-4">Laporan & User</p>

                <a href="{{ route('admin.transactions') }}" 
                   class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-300 group mb-1 {{ request()->routeIs('admin.transactions') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-blue-400' }}">
                    <i class="fa-solid fa-money-bill-transfer w-6 text-center text-lg"></i> 
                    <span class="font-medium tracking-wide">Transaksi</span>
                </a>

                <a href="{{ route('admin.income') }}" 
                   class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-300 group mb-1 {{ request()->routeIs('admin.income') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-blue-400' }}">
                    <i class="fa-solid fa-chart-line w-6 text-center text-lg"></i> 
                    <span class="font-medium tracking-wide">Pendapatan</span>
                </a>

                <a href="{{ route('admin.users') }}" 
                   class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-300 group mb-1 {{ request()->routeIs('admin.users') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-blue-400' }}">
                    <i class="fa-solid fa-users w-6 text-center text-lg"></i> 
                    <span class="font-medium tracking-wide">Data User</span>
                </a>

            </nav>

            <div class="p-4 border-t border-slate-800/50 bg-slate-900">
                <div class="flex items-center gap-3 px-4 py-3.5 rounded-2xl bg-slate-800/40 hover:bg-slate-800 transition border border-slate-700/30">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold shadow-lg shadow-blue-500/20">
                        A
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-white truncate">Admin</p>
                        <p class="text-[10px] text-slate-400 truncate">admin@tiket.com</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-red-400 hover:bg-red-400/10 transition duration-200" title="Logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden relative bg-slate-50">

            <header class="h-24 bg-white/80 backdrop-blur-md border-b border-gray-100 flex justify-between items-center px-8 z-10 sticky top-0">
                <div class="flex flex-col">
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">
                        @if (request()->routeIs('admin.dashboard'))
                            Dashboard Overview
                        @elseif(request()->routeIs('admin.promos.*'))
                            Promo Management
                        @else
                            Admin Panel
                        @endif
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">Selamat datang kembali, Admin!</p>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" target="_blank"
                        class="group flex items-center gap-2 px-5 py-2.5 rounded-full border border-gray-200 text-sm font-semibold text-slate-600 hover:border-brand-primary hover:text-white hover:bg-brand-primary transition-all duration-300 bg-white shadow-sm">
                        <span>Lihat Website</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-xs group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition"></i>
                    </a>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6 md:p-8 custom-scrollbar">
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