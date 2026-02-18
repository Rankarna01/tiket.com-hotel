<header 
    class="sticky top-0 z-[60] w-full bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-100 font-poppins transition-all duration-300"
    x-data="{ atTop: true }"
    @scroll.window="atTop = (window.pageYOffset > 10 ? false : true)"
    :class="{ 'py-1 shadow-md': !atTop, 'py-0': atTop }"
>
    <div class="mx-auto max-w-[120rem] px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between gap-4 md:gap-8">
            
            <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-1 group">
                <div class="relative flex items-center">
                    <span class="text-3xl font-black text-blue-600 tracking-tighter transition-all duration-300 group-hover:text-blue-700">Tiket</span>
                    <span class="flex h-3 w-3 mt-3 mx-0.5">
                        <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-yellow-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-yellow-400"></span>
                    </span>
                    <span class="text-3xl font-black text-blue-600 tracking-tighter transition-all duration-300 group-hover:text-blue-700">Hotel</span>
                </div>
            </a>

            <div class="hidden lg:flex flex-1 max-w-xl group">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" 
                           class="block w-full rounded-2xl border-none bg-slate-100/80 py-3 pl-11 pr-4 text-sm text-slate-800 placeholder:text-slate-500 focus:ring-2 focus:ring-blue-500/20 focus:bg-white focus:shadow-inner transition-all duration-300" 
                           placeholder="Mau ke mana? Cth: Hotel di Bandung">
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                        <span class="text-[10px] font-bold text-slate-400 border border-slate-300 px-1.5 py-0.5 rounded shadow-sm bg-white">CTRL + K</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4 sm:gap-8">
                
                <nav class="hidden md:flex items-center gap-8 text-[13px] font-bold uppercase tracking-wider text-slate-600">
                    <a href="#" class="relative hover:text-blue-600 transition-colors group">
                        Cek Order
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#" class="relative hover:text-blue-600 transition-colors group">
                        Promo
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </nav>

                <div class="h-6 w-[1px] bg-slate-200 hidden md:block"></div>

                <div class="flex items-center gap-3">
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false" 
                                    class="flex items-center gap-2 p-1.5 rounded-full hover:bg-slate-100 transition-all focus:outline-none border border-transparent active:scale-95">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-bold shadow-md">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="hidden sm:block text-sm font-bold text-slate-700">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform duration-300" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                                 class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-[70]" 
                                 style="display: none;">
                                
                                <div class="px-4 py-2 border-b border-slate-50 mb-2">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Akun Saya</p>
                                </div>

                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                        <i class="fa-solid fa-chart-line w-4 text-center text-blue-500"></i>
                                        Dashboard Admin
                                    </a>
                                @endif
                                
                                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                    <i class="fa-solid fa-user w-4 text-center"></i>
                                    Profil Saya
                                </a>
                                
                                <div class="border-t border-slate-50 my-2"></div>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="flex items-center gap-3 w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition font-semibold">
                                        <i class="fa-solid fa-right-from-bracket w-4 text-center"></i>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-2">
                            <a href="{{ route('login') }}" class="text-sm font-bold text-blue-600 hover:text-blue-700 px-4 py-2 rounded-xl transition-all active:scale-95">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 px-6 py-2.5 rounded-xl shadow-[0_8px_20px_-6px_rgba(37,99,235,0.4)] hover:shadow-[0_8px_25px_-6px_rgba(37,99,235,0.6)] transition-all active:scale-95">
                                Daftar
                            </a>
                        </div>
                    @endauth
                </div>

            </div>
        </div>
    </div>
</header>