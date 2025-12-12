<x-layouts.app>
    
    <div class="bg-white border-b border-slate-200 sticky top-[70px] z-30 py-4 shadow-sm">
        <div class="max-w-[120rem] mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('hotels.list') }}" method="GET" class="flex gap-4">
                <div class="flex-1 relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-3.5 text-slate-400"></i>
                    <input type="text" name="location" value="{{ request('location') }}" 
                           class="w-full border border-slate-300 rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:border-blue-500 font-medium" 
                           placeholder="Mau nginep ke mana? (Bali, Bandung, dll)">
                </div>
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-700 transition">
                    Cari Hotel
                </button>
            </form>
        </div>
    </div>

    <div class="bg-slate-50 min-h-screen py-8">
        <div class="max-w-[120rem] mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col lg:flex-row gap-8">
                
                <div class="lg:w-1/4 space-y-6">
                    
                    <div class="bg-white p-2 rounded-xl shadow-sm border border-slate-200 cursor-pointer hover:shadow-md transition relative group overflow-hidden">
                        <img src="https://via.placeholder.com/400x150?text=Map+View" class="w-full h-24 object-cover rounded-lg">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <button class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg group-hover:scale-105 transition">
                                <i class="fa-solid fa-map-location-dot mr-1"></i> Lihat di Peta
                            </button>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200">
                        <h3 class="font-bold text-slate-900 mb-4">Urutkan Harga</h3>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="sort" class="text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-slate-600">Harga Terendah</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="sort" class="text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-slate-600">Harga Tertinggi</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="sort" class="text-blue-600 focus:ring-blue-500" checked>
                                <span class="text-sm text-slate-600">Rekomendasi</span>
                            </label>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200">
                        <h3 class="font-bold text-slate-900 mb-4">Fasilitas Populer</h3>
                        <div class="space-y-3">
                            @foreach($facilities->take(5) as $fac)
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 border-gray-300">
                                <span class="text-sm text-slate-600 group-hover:text-blue-600 transition">{{ $fac->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="lg:w-3/4">
                    
                    <div class="mb-4 flex justify-between items-center">
                        <h2 class="font-bold text-slate-800 text-lg">Menampilkan {{ $hotels->count() }} akomodasi terbaik</h2>
                    </div>

                    <div class="space-y-4">
                        @forelse($hotels as $hotel)
                        <div class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col md:flex-row gap-4 hover:shadow-lg transition duration-300 group">
                            
                            <div class="w-full md:w-72 h-48 md:h-auto flex-shrink-0 relative rounded-xl overflow-hidden">
                                <img src="{{ $hotel->images[0] ?? '' }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @if($hotel->rating >= 4.5)
                                    <span class="absolute top-2 left-2 bg-purple-100 text-purple-700 text-[10px] font-bold px-2 py-1 rounded shadow-sm">
                                        Preferred Partner
                                    </span>
                                @endif
                            </div>

                            <div class="flex-1 flex flex-col justify-between py-1">
                                <div>
                                    <h3 class="text-xl font-bold text-slate-900 mb-1 group-hover:text-blue-600 transition">
                                        <a href="{{ route('hotel.detail', $hotel->slug) }}">{{ $hotel->name }}</a>
                                    </h3>
                                    
                                    <div class="flex items-center gap-2 text-sm mb-2">
                                        <div class="flex text-yellow-400 text-xs">
                                            @for($i=0; $i<$hotel->stars; $i++) <i class="fa-solid fa-star"></i> @endfor
                                        </div>
                                        <span class="text-slate-300">•</span>
                                        <p class="text-slate-500 text-xs flex items-center gap-1">
                                            <i class="fa-solid fa-location-dot"></i> {{ $hotel->city }}
                                        </p>
                                    </div>

                                    <div class="flex items-center gap-2 mb-3">
                                        <span class="bg-blue-100 text-blue-700 font-bold px-1.5 py-0.5 rounded text-xs">{{ $hotel->rating }}</span>
                                        <span class="text-xs text-slate-500">Luar biasa ({{ $hotel->total_reviews }} review)</span>
                                    </div>

                                    <div class="flex flex-wrap gap-1">
                                        @foreach($hotel->facilities->take(3) as $fac)
                                            <span class="text-[10px] bg-slate-50 text-slate-500 px-2 py-1 rounded border border-slate-100">
                                                {{ $fac->name }}
                                            </span>
                                        @endforeach
                                        @if($hotel->facilities->count() > 3)
                                            <span class="text-[10px] text-slate-400 px-1">+{{ $hotel->facilities->count() - 3 }} lainnya</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="w-full md:w-48 border-t md:border-t-0 md:border-l border-slate-100 md:pl-4 pt-4 md:pt-0 flex flex-col justify-end items-end text-right">
                                
                                @if($hotel->original_price > $hotel->price)
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="bg-red-100 text-red-600 text-[10px] font-bold px-1 rounded">
                                            {{ round((($hotel->original_price - $hotel->price)/$hotel->original_price)*100) }}%
                                        </span>
                                        <span class="text-xs text-slate-400 line-through">IDR {{ number_format($hotel->original_price, 0, ',', '.') }}</span>
                                    </div>
                                @endif

                                <h4 class="text-2xl font-bold text-rose-600 leading-none mb-1">
                                    IDR {{ number_format($hotel->price, 0, ',', '.') }}
                                </h4>
                                <p class="text-[10px] text-slate-400 mb-4">per kamar / malam</p>

                                <a href="{{ route('hotel.detail', $hotel->slug) }}" class="bg-blue-600 text-white font-bold py-2 px-6 rounded-full hover:bg-blue-700 transition shadow-md w-full text-center text-sm">
                                    Pilih Kamar
                                </a>
                            </div>

                        </div>
                        @empty
                        <div class="bg-white rounded-xl p-10 text-center border border-slate-200">
                            <img src="https://via.placeholder.com/150" class="mx-auto mb-4 opacity-50 w-32">
                            <h3 class="text-lg font-bold text-slate-700">Tidak ada hotel ditemukan</h3>
                            <p class="text-slate-500">Coba cari lokasi lain atau ubah filter pencarian.</p>
                        </div>
                        @endforelse

                        <div class="mt-8">
                            {{ $hotels->links() }}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-layouts.app>