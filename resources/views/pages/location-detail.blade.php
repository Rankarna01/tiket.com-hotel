<x-layouts.app>
    
    <div class="relative h-[250px] md:h-[400px]">
        <img src="{{ $location->image ?? 'https://images.unsplash.com/photo-1596422846543-75c6fc197f07?q=80&w=2000' }}" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
            <div class="text-center text-white">
                <p class="text-sm md:text-lg font-medium tracking-widest uppercase mb-2">Jelajahi Indonesia</p>
                <h1 class="text-4xl md:text-6xl font-extrabold drop-shadow-lg">{{ $location->name }}</h1>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 min-h-screen">
        
        <div class="bg-white border-b border-gray-200">
            <x-home.promo-slider :promos="$promos" />
        </div>

        <div class="max-w-[120rem] mx-auto px-4 sm:px-6 lg:px-8 py-10">
            
            <div class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-slate-900">
                        Hotel Terfavorit di {{ $location->name }}
                    </h2>
                    <div class="flex gap-2">
                        <button class="w-8 h-8 rounded-full border border-slate-300 flex items-center justify-center text-slate-500 hover:bg-slate-100"><i class="fa-solid fa-arrow-left"></i></button>
                        <button class="w-8 h-8 rounded-full border border-slate-300 flex items-center justify-center text-slate-500 hover:bg-slate-100"><i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>

                @if($hotels->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($hotels as $hotel)
                            <a href="{{ route('hotel.detail', $hotel->slug) }}" class="bg-white border border-slate-200 rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300 group hover:-translate-y-1">
                                <div class="h-52 overflow-hidden relative">
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
                                    
                                    <div class="flex flex-wrap gap-1 mb-3">
                                        @foreach($hotel->facilities->take(2) as $fac)
                                            <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-1 rounded border border-slate-200">{{ $fac->name }}</span>
                                        @endforeach
                                        @if($hotel->facilities->count() > 2)
                                            <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-1 rounded border border-slate-200">+{{ $hotel->facilities->count() - 2 }}</span>
                                        @endif
                                    </div>

                                    <button class="w-full text-center text-sm font-bold text-blue-600 mt-2 hover:underline">Lihat Detail</button>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
                        <i class="fa-solid fa-hotel text-4xl text-gray-300 mb-2"></i>
                        <p class="text-gray-500">Belum ada hotel terdaftar di {{ $location->name }}</p>
                    </div>
                @endif
            </div>

            <x-shared.feature-icons />

        </div>
    </div>
</x-layouts.app>