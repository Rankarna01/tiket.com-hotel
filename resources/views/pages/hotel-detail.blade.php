<x-layouts.app>
    <div class="max-w-[120rem] mx-auto px-4 sm:px-6 lg:px-8 py-6">
        
        <nav class="flex text-sm text-slate-500 mb-6 overflow-x-auto whitespace-nowrap pb-2 hide-scrollbar" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fa-solid fa-chevron-right text-slate-300 text-[10px] mx-2"></i>
                        <a href="#" class="hover:text-blue-600 transition">Hotel</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fa-solid fa-chevron-right text-slate-300 text-[10px] mx-2"></i>
                        <span class="text-slate-800 font-medium">{{ $hotel->city }}</span>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fa-solid fa-chevron-right text-slate-300 text-[10px] mx-2"></i>
                        <span class="text-slate-500 truncate max-w-[150px] md:max-w-xs">{{ $hotel->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 relative">
            
            <div class="lg:col-span-2 space-y-8">
                
                <div>
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <span class="px-2 py-1 bg-slate-100 text-slate-600 text-[10px] font-bold uppercase tracking-wider rounded-md">Hotel</span>
                        
                        <div class="flex items-center text-yellow-400 text-xs">
                            @for($i=0; $i<$hotel->stars; $i++) <i class="fa-solid fa-star"></i> @endfor
                        </div>

                        @if($hotel->rating >= 4.5)
                        <span class="px-2 py-1 bg-purple-50 text-purple-700 text-xs font-bold rounded-full flex items-center gap-1 border border-purple-100">
                            <i class="fa-solid fa-medal"></i> Preferred Partner
                        </span>
                        @endif
                    </div>

                    <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 mb-2 leading-tight">{{ $hotel->name }}</h1>
                    
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-slate-500">
                        <div class="flex items-center gap-1">
                            <span class="bg-blue-50 text-blue-700 font-bold px-1.5 py-0.5 rounded text-sm">{{ $hotel->rating }}</span>
                            <span class="text-slate-400 text-xs">/ 5 ({{ $hotel->total_reviews }} review)</span>
                        </div>
                        <span class="hidden sm:inline">•</span>
                        <div class="flex items-center gap-1 hover:text-blue-600 cursor-pointer transition">
                            <i class="fa-solid fa-location-dot text-slate-400"></i>
                            <span class="underline decoration-slate-300 hover:decoration-blue-600 underline-offset-2">{{ $hotel->city }}, {{ $hotel->address }}</span>
                        </div>
                    </div>
                </div>

                <x-hotel.gallery :hotel="$hotel" />

                <x-hotel.highlights />

                <div class="border-b border-slate-200 sticky top-[80px] bg-white/95 backdrop-blur z-20 overflow-x-auto hide-scrollbar -mx-4 px-4 md:mx-0 md:px-0">
                    <nav class="flex space-x-8 text-sm font-medium">
                        <a href="#info" class="border-b-2 border-blue-600 text-blue-600 py-3 whitespace-nowrap transition">Info Umum</a>
                        <a href="#reviews" class="border-b-2 border-transparent text-slate-500 hover:text-slate-800 hover:border-slate-300 py-3 whitespace-nowrap transition">Review</a>
                        <a href="#facilities" class="border-b-2 border-transparent text-slate-500 hover:text-slate-800 hover:border-slate-300 py-3 whitespace-nowrap transition">Fasilitas</a>
                        <a href="#location" class="border-b-2 border-transparent text-slate-500 hover:text-slate-800 hover:border-slate-300 py-3 whitespace-nowrap transition">Lokasi</a>
                    </nav>
                </div>
                
                <div id="info" class="scroll-mt-32">
                    <x-hotel.info :hotel="$hotel" />
                </div>

                <div id="facilities" class="scroll-mt-32">
                     <x-hotel.facilities :facilities="$hotel->facilities" />
                </div>

                 <div id="reviews" class="scroll-mt-32">
                    <x-hotel.reviews />
                 </div>
            </div>

            <div class="hidden lg:block lg:col-span-1">
                <div class="sticky top-28"> <x-hotel.booking-card :hotel="$hotel" />
                </div>
            </div>

            <div class="lg:hidden fixed bottom-0 inset-x-0 bg-white border-t border-gray-200 p-4 z-50 flex justify-between items-center shadow-[0_-4px_20px_rgba(0,0,0,0.1)]">
                <div>
                    <div class="flex items-center gap-2">
                        <p class="text-xs text-slate-400 line-through">IDR {{ number_format($hotel->original_price, 0, ',', '.') }}</p>
                        <span class="bg-red-100 text-red-600 text-[10px] font-bold px-1 rounded">-{{ round((($hotel->original_price - $hotel->price)/$hotel->original_price)*100) }}%</span>
                    </div>
                    <div class="flex items-baseline gap-1">
                        <p class="text-xl font-bold text-rose-600">IDR {{ number_format($hotel->price, 0, ',', '.') }}</p>
                        <span class="text-[10px] text-slate-500">/malam</span>
                    </div>
                </div>
                <button class="bg-brand-blue text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-500/30 active:scale-95">
                    Lihat Kamar
                </button>
            </div>

        </div>
    </div>
</x-layouts.app>