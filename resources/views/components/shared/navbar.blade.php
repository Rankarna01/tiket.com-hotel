<header class="sticky top-0 z-50 w-full bg-white shadow-sm border-b border-gray-100 font-poppins">
    <div class="mx-auto max-w-[120rem] px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between gap-4 md:gap-8">
            
            <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-1 group">
                <span class="text-3xl font-bold text-blue-600 tracking-tighter group-hover:opacity-90 transition">tiket</span>
                <div class="w-3 h-3 rounded-full bg-yellow-400 mt-2"></div> <span class="text-3xl font-bold text-blue-600 tracking-tighter group-hover:opacity-90 transition">clone</span>
            </a>

            <div class="hidden lg:flex flex-1 max-w-2xl">
                <div class="relative w-full group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-gray-400 group-focus-within:text-blue-500 transition"></i>
                    </div>
                    <input type="text" 
                           class="block w-full rounded-full border-none bg-slate-100 py-3 pl-11 pr-4 text-sm text-slate-800 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-100 focus:bg-white transition" 
                           placeholder="Mau ke mana? Cth: Hotel di Bandung">
                </div>
            </div>

            <div class="flex items-center gap-4 sm:gap-6">
                
                <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600">
                    <a href="#" class="hover:text-blue-600 transition">Cek Order</a>
                    <a href="#" class="hover:text-blue-600 transition">Promo</a>
                </nav>

                <div class="flex items-center gap-2">
                    @auth
                        <div class="relative group" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 text-slate-700 hover:text-blue-600 font-semibold focus:outline-none">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="hidden sm:block truncate max-w-[100px]">{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </button>

                            <div x-show="open" @click.away="open = false" 
                                 x-transition 
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-slate-100 py-2" 
                                 style="display: none;">
                                
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-600">
                                        Dashboard Admin
                                    </a>
                                @endif
                                
                                <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-600">Profile Saya</a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Keluar</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-full transition">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 px-5 py-2.5 rounded-full shadow-md shadow-blue-200 transition">
                            Daftar
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </div>
</header>