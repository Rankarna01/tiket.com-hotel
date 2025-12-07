<x-layouts.app>
    
    <div class="relative h-[250px] md:h-[400px]">
        <img src="{{ $partner->banner_image }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50 flex items-center justify-center flex-col">
            <img src="{{ $partner->logo }}" class="h-16 md:h-24 object-contain bg-white/90 p-4 rounded-xl mb-4 backdrop-blur">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white">{{ $partner->name }}</h1>
        </div>
    </div>

    <div class="bg-white border-b border-gray-100">
        <x-home.promo-slider :promos="$promos" />
    </div>

    <div class="max-w-[120rem] mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="mb-16">
            <h2 class="text-2xl font-bold text-slate-900 mb-6">Rekomendasi Hotel {{ $partner->name }}</h2>
            
            @if($hotels->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($hotels as $hotel)
                        <a href="{{ route('hotel.detail', $hotel->slug) }}" class="bg-white border border-slate-200 rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300 group hover:-translate-y-1">
                            <div class="h-48 overflow-hidden relative">
                                <img src="{{ $hotel->images[0] ?? '' }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                <div class="absolute top-3 right-3 bg-white/95 backdrop-blur px-2 py-1 rounded-lg text-xs font-bold text-blue-600 shadow-sm">
                                    IDR {{ number_format($hotel->price) }}
                                </div>
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold text-slate-800 truncate text-lg group-hover:text-blue-600 transition">{{ $hotel->name }}</h4>
                                <p class="text-sm text-slate-500 mb-3 flex items-center gap-1">
                                    <i class="fa-solid fa-location-dot text-slate-400"></i> {{ $hotel->city }}
                                </p>
                                <div class="flex text-yellow-400 text-xs">
                                    @for($i=0; $i<$hotel->stars; $i++) <i class="fa-solid fa-star"></i> @endfor
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10 border-2 border-dashed border-gray-200 rounded-xl">
                    <p class="text-slate-500">Belum ada hotel yang terdaftar di partner ini.</p>
                </div>
            @endif
        </div>

        <x-shared.feature-icons />

    </div>
</x-layouts.app>