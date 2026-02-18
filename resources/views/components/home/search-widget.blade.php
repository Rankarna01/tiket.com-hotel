<div class="w-full md:max-w-xl lg:max-w-lg relative z-20" x-data="searchWidget()">
    
    <div class="rounded-2xl bg-white/95 backdrop-blur border border-slate-200 shadow-md p-4 mb-3 flex items-start gap-3">
        <div class="w-8 h-8 grid place-items-center rounded-full bg-blue-50 text-blue-600">
            <i class="fa-solid fa-percent"></i>
        </div>
        <div class="text-sm">
            <p class="font-semibold text-slate-800">
                Nginep <span class="text-blue-600">mingguan atau bulanan</span> jadi lebih hemat
            </p>
            <p class="text-slate-500">dengan diskon hingga <span class="font-bold text-slate-700">20%</span></p>
        </div>
    </div>

    <div class="rounded-2xl bg-white/95 backdrop-blur border border-slate-200 shadow-xl p-4 space-y-3 relative">
        
        <div class="relative">
            <label @click="openSearchModal" class="flex items-center gap-3 rounded-xl border border-slate-200 px-4 py-3 cursor-pointer hover:border-blue-400 transition bg-white group">
                <i class="fa-solid fa-magnifying-glass text-slate-400 group-hover:text-blue-500 transition"></i>
                <div class="flex-1">
                    <p class="text-xs text-slate-400 font-bold mb-0.5">Tujuan / Nama Hotel</p>
                    <input type="text" x-model="searchQuery" 
                           class="w-full outline-none bg-transparent text-sm font-semibold text-slate-800 placeholder:text-slate-300 cursor-pointer" 
                           placeholder="Mau nginep di mana?" readonly>
                </div>
            </label>

            <div x-show="isSearchOpen" @click.away="isSearchOpen = false" x-transition.opacity
                 class="absolute top-full left-0 w-full md:w-[150%] bg-white rounded-2xl shadow-2xl mt-2 p-4 border border-slate-100 z-50 max-h-[400px] overflow-y-auto custom-scrollbar">
                
                <div class="flex justify-between items-center mb-4 pb-2 border-b border-slate-100">
                    <h3 class="font-bold text-slate-800 text-lg">Mau nginep di mana?</h3>
                    <button @click="isSearchOpen = false" class="text-slate-400 hover:text-red-500"><i class="fa-solid fa-xmark"></i></button>
                </div>

                <div class="relative mb-4">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-3.5 text-slate-400"></i>
                    <input type="text" x-model="realQuery" @input="filterResults"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-10 pr-4 py-3 outline-none focus:border-blue-500 transition" 
                           placeholder="Masukkan nama hotel, kota, atau daerah...">
                </div>

                <div class="mb-4 cursor-pointer hover:bg-blue-50 p-2 rounded-lg flex items-center gap-3 text-blue-600 transition">
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fa-solid fa-location-crosshairs"></i>
                    </div>
                    <span class="font-bold text-sm">Di dekat kamu</span>
                </div>

                <div x-show="!realQuery">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pencarian Terpopuler</h4>
                    </div>
                    <div class="space-y-2">
                        @foreach($popularHotels as $hotel)
                        <a href="{{ route('hotel.detail', $hotel->slug) }}" class="flex items-center gap-3 p-2 hover:bg-slate-50 rounded-xl transition group">
                            <img src="{{ $hotel->images[0] ?? 'https://via.placeholder.com/50' }}" class="w-12 h-12 rounded-lg object-cover bg-gray-200">
                            <div>
                                <h5 class="font-bold text-slate-800 text-sm group-hover:text-blue-600 transition">{{ $hotel->name }}</h5>
                                <p class="text-xs text-slate-500"><i class="fa-solid fa-location-dot mr-1"></i> {{ $hotel->city }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

                <div x-show="realQuery" class="space-y-2">
                    <template x-for="item in filteredItems" :key="item.id">
                        <a :href="'/hotel/' + item.slug" class="flex items-center gap-3 p-2 hover:bg-slate-50 rounded-xl transition group border border-transparent hover:border-slate-100">
                            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                <i class="fa-solid fa-hotel"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-slate-800 text-sm group-hover:text-blue-600" x-text="item.name"></h5>
                                <p class="text-xs text-slate-500" x-text="item.city"></p>
                            </div>
                        </a>
                    </template>
                    <div x-show="filteredItems.length === 0" class="text-center py-4 text-slate-400 text-sm">
                        Tidak ditemukan hasil.
                    </div>
                </div>

            </div>
        </div>

        <label class="flex items-center gap-3 rounded-xl border border-slate-200 px-4 py-3 cursor-pointer hover:border-blue-400 transition bg-white">
            <i class="fa-regular fa-calendar text-slate-400"></i>
            <div class="flex-1">
                <p class="text-xs text-slate-400 font-bold mb-0.5">Check-in - Check-out</p>
                <input type="text" class="w-full outline-none bg-transparent text-sm font-semibold text-slate-800 cursor-pointer" 
                       value="{{ now()->format('d M') }} - {{ now()->addDay()->format('d M Y') }}" readonly>
            </div>
        </label>

        <label class="flex items-center gap-3 rounded-xl border border-slate-200 px-4 py-3 cursor-pointer hover:border-blue-400 transition bg-white">
            <i class="fa-solid fa-user-group text-slate-400"></i>
            <div class="flex-1">
                <p class="text-xs text-slate-400 font-bold mb-0.5">Tamu & Kamar</p>
                <input type="text" class="w-full outline-none bg-transparent text-sm font-semibold text-slate-800 cursor-pointer" 
                       value="1 Kamar, 2 Tamu" readonly>
            </div>
        </label>

        <a href="{{ route('hotels.list') }}" class="block text-center w-full mt-2 rounded-xl bg-blue-600 text-white font-bold py-3.5 shadow-lg shadow-blue-500/30 hover:bg-blue-700 transition active:scale-[0.98]">
            Ayo Cari
        </a>

    </div>
</div>

<script>
    function searchWidget() {
        return {
            isSearchOpen: false,
            searchQuery: '',
            realQuery: '',
            // Ambil data hotel dari PHP ke JS
            allItems: @json($popularHotels),
            filteredItems: [],

            openSearchModal() {
                this.isSearchOpen = true;
                this.realQuery = '';
                this.filteredItems = [];
            },

            filterResults() {
                if (this.realQuery === '') {
                    this.filteredItems = [];
                    return;
                }
                const q = this.realQuery.toLowerCase();
                // Filter sederhana berdasarkan nama atau kota
                this.filteredItems = this.allItems.filter(item => 
                    item.name.toLowerCase().includes(q) || 
                    item.city.toLowerCase().includes(q)
                );
            }
        }
    }
</script>