<x-layouts.app>
    
    <div class="relative h-[300px] md:h-[500px]">
        <img src="{{ $inspiration->banner_image }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end justify-center pb-12">
            <div class="text-center px-4 max-w-4xl">
                <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full mb-3 inline-block uppercase tracking-wider shadow-md">
                    Inspirasi Liburan
                </span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-white drop-shadow-lg leading-tight">
                    {{ $inspiration->title }}
                </h1>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="max-w-4xl mx-auto prose prose-lg text-slate-600 mb-12 first-letter:text-5xl first-letter:font-bold first-letter:text-blue-600 first-letter:float-left first-letter:mr-3">
            <p>{{ $inspiration->description }}</p>
        </div>

        <div class="rounded-2xl overflow-hidden shadow-sm mt-8 border border-slate-100">
            @if($inspiration->bottom_image)
                <img src="{{ $inspiration->bottom_image }}" class="w-full h-auto object-cover">
            @else
                <img src="https://s-light.tiket.photos/t/01E25EBZS3W0FY9GTG6C42E1SE/rsfit19201280gsm/mobile-modules/2025/11/24/061cae02-3e28-410a-82f2-b47a24b9c581-1763952569823-f3e556934cc7efce29330dddb5ddae5a.png" 
                     class="w-full h-[200px] md:h-[300px] object-cover filter brightness-90">
            @endif
        </div>

        <div class="mb-12">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1 h-8 bg-blue-600 rounded-full"></div>
                <h3 class="text-2xl font-bold text-slate-900">Promo Spesial Untukmu</h3>
            </div>
            
            <x-home.promo-banners />
        </div>

        @if($inspiration->hotels->count() > 0)
            <div class="mb-16">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-1 h-8 bg-yellow-400 rounded-full"></div>
                        <h3 class="text-2xl font-bold text-slate-900">Rekomendasi Penginapan</h3>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($inspiration->hotels as $hotel)
                        <a href="{{ route('hotel.detail', $hotel->slug) }}" class="bg-white border border-slate-200 rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300 group hover:-translate-y-1">
                            <div class="h-48 overflow-hidden relative">
                                <img src="{{ $hotel->images[0] ?? '' }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                <div class="absolute top-3 right-3 bg-white/95 backdrop-blur px-2 py-1 rounded-lg text-xs font-bold text-blue-600 shadow-sm border border-slate-100">
                                    IDR {{ number_format($hotel->price) }}
                                </div>
                                <div class="absolute bottom-3 left-3 bg-black/60 backdrop-blur px-2 py-1 rounded-lg text-xs font-bold text-white flex items-center gap-1">
                                    <i class="fa-solid fa-star text-yellow-400"></i> {{ $hotel->rating }}
                                </div>
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold text-slate-800 truncate text-lg group-hover:text-blue-600 transition">{{ $hotel->name }}</h4>
                                <p class="text-sm text-slate-500 mb-3 flex items-center gap-1">
                                    <i class="fa-solid fa-location-dot text-slate-400"></i> {{ $hotel->city }}
                                </p>
                                <div class="flex flex-wrap gap-1">
                                    @foreach($hotel->facilities->take(2) as $fac)
                                        <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-1 rounded border border-slate-200">{{ $fac->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mb-12">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 text-center">Partner Promo Eksklusif</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="relative rounded-2xl overflow-hidden shadow-lg group cursor-pointer h-64 md:h-72">
                    <img src="https://s-light.tiket.photos/t/01E25EBZS3W0FY9GTG6C42E1SE/original/mobile-modules/2025/11/25/ae7694ff-ccc7-47e3-9eff-0989be9229ea-1764044817686-054411f74415691cc2c539be439d925f.png" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent flex items-end p-6">
                        <div>
                            <span class="bg-yellow-400 text-black text-xs font-bold px-2 py-1 rounded mb-2 inline-block">HOTEL DOMESTIK</span>
                            <h4 class="text-white font-bold text-2xl">Diskon s.d. 50% + Cashback</h4>
                            <p class="text-white/80 text-sm mt-1">Spesial Gajian! Serbu diskonnya sekarang.</p>
                        </div>
                    </div>
                </div>

                <div class="relative rounded-2xl overflow-hidden shadow-lg group cursor-pointer h-64 md:h-72">
                    <img src="https://s-light.tiket.photos/t/01E25EBZS3W0FY9GTG6C42E1SE/original/mobile-modules/2025/11/24/cc12637d-6256-4fc7-b7d2-978373f1e1a6-1763967105213-fa9ebad6c26e11c197e2b67f83a06674.png" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent flex items-end p-6">
                        <div>
                            <span class="bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded mb-2 inline-block">PAYLATER</span>
                            <h4 class="text-white font-bold text-2xl">Liburan Dulu Bayar Nanti</h4>
                            <p class="text-white/80 text-sm mt-1">Cicilan 0% hingga 12 bulan dengan kartu kredit pilihan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-home.special-offer />
        <x-shared.feature-icons />



    </div>
</x-layouts.app>