<x-layouts.app>
    {{-- Tambahan CSS Inline untuk memastikan smooth scroll aktif di halaman ini --}}
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

    {{-- Container Utama --}}
    <div class="max-w-[120rem] mx-auto px-4 sm:px-6 lg:px-8 py-6">

        {{-- BREADCRUMB NAVIGATION (Dirapikan) --}}
        {{-- ... (Kode breadcrumb Anda) ... --}}

        {{-- CONTENT GRID --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 relative">

            {{-- KOLOM KIRI (Gallery, Info, Review) --}}
            <div class="lg:col-span-2 space-y-2">

                {{-- HEADER JUDUL HOTEL --}}
                <div>
                    {{-- ... --}}
                </div>

                {{-- GALLERY --}}
                <x-hotel.gallery :hotel="$hotel" />

                {{-- HIGHLIGHTS --}}
                <x-hotel.highlights />

                {{-- STICKY NAVIGASI DALAM HALAMAN --}}
                {{-- Top 80px disesuaikan dengan tinggi navbar utama app Anda --}}
                <div class="border-b border-slate-200 sticky top-[80px] bg-white/95 backdrop-blur-md z-30 overflow-x-auto hide-scrollbar -mx-4 px-4 md:mx-0 md:px-0 transition-all duration-300">
                    <nav class="flex space-x-8 text-sm font-medium">
                        <a href="#info" class="border-b-2 border-transparent hover:text-blue-600 focus:text-blue-600 focus:border-blue-600 py-3 whitespace-nowrap transition text-slate-600">
                            Info Umum
                        </a>
                        <a href="#reviews" class="border-b-2 border-transparent hover:text-blue-600 focus:text-blue-600 focus:border-blue-600 py-3 whitespace-nowrap transition text-slate-600">
                            Review
                        </a>
                        <a href="#facilities" class="border-b-2 border-transparent hover:text-blue-600 focus:text-blue-600 focus:border-blue-600 py-3 whitespace-nowrap transition text-slate-600">
                            Fasilitas
                        </a>
                        <a href="#location" class="border-b-2 border-transparent hover:text-blue-600 focus:text-blue-600 focus:border-blue-600 py-3 whitespace-nowrap transition text-slate-600">
                            Lokasi
                        </a>
                    </nav>
                </div>

                {{-- SECTIONS (Diberi jarak padding top/margin agar smooth scroll pas) --}}
                
                {{-- 1. Info Umum --}}
                <div id="info" class="scroll-mt-40 pt-6">
                    <x-hotel.info :hotel="$hotel" />
                </div>

                {{-- 2. Reviews --}}
                <div id="reviews" class="scroll-mt-40 pt-6 border-t border-slate-100 mt-6">
                    <x-hotel.reviews />
                </div>

                {{-- 3. Facilities --}}
                <div id="facilities" class="scroll-mt-40 pt-6 border-t border-slate-100 mt-6">
                    <x-hotel.facilities :facilities="$hotel->facilities" />
                </div>

                {{-- 4. Lokasi (BARU - Statis) --}}
                <div id="location" class="scroll-mt-40 pt-6 border-t border-slate-100 mt-6">
                    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                        <div class="p-5 border-b border-slate-100">
                            <h3 class="text-lg font-bold text-slate-900">Lokasi Akomodasi</h3>
                            <p class="text-slate-500 text-sm mt-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-red-500">
                                    <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 18.226c0-.202-.13-.568-.13-.568l-.003-.002-.007-.005a66.248 66.248 0 01-2.454-1.743 45.42 45.42 0 01-5.186-4.96C1.196 9.873 1 8.242 1 6c0-3.336 4.029-6 9-6s9 2.664 9 6c0 2.242-.196 3.873-1.22 4.95a45.42 45.42 0 01-5.186 4.96 66.19 66.19 0 01-2.46 1.748l-.008.005h-.001zM10 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                </svg>
                                {{ $hotel->address ?? 'Jalan Raya Utama No. 123, Pusat Kota, Indonesia' }}
                            </p>
                        </div>
                        
                        {{-- Gambar Peta Statis --}}
                        <div class="relative w-full h-64 bg-slate-100 group">
                            {{-- Placeholder image peta --}}
                            <img src="https://via.placeholder.com/800x400.png?text=Map+Preview+Location" 
                                 alt="Map Location" 
                                 class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition">
                            
                            {{-- Overlay Button (Agar terlihat interaktif walau statis) --}}
                            <div class="absolute inset-0 flex items-center justify-center">
                                <button class="bg-white text-slate-800 px-4 py-2 rounded-full shadow-lg text-sm font-bold flex items-center gap-2 hover:scale-105 transition transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                    Lihat di Peta
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- KOLOM KANAN (Booking Card Desktop) --}}
            <div class="hidden lg:block lg:col-span-1">
                <div class="sticky top-28">
                    <x-hotel.booking-card :hotel="$hotel" />
                </div>
            </div>

            {{-- FLOATING BOOKING BAR (Mobile Only) --}}
            <div class="lg:hidden fixed bottom-0 inset-x-0 bg-white border-t border-gray-200 p-4 z-50 flex justify-between items-center shadow-[0_-4px_20px_rgba(0,0,0,0.1)]">
                <div>
                    <div class="flex items-center gap-2">
                        <p class="text-xs text-slate-400 line-through">IDR {{ number_format($hotel->original_price, 0, ',', '.') }}</p>
                        @if ($hotel->original_price > 0)
                            <span class="bg-red-100 text-red-600 text-[10px] font-bold px-1 rounded">
                                -{{ round((($hotel->original_price - $hotel->price) / $hotel->original_price) * 100) }}%
                            </span>
                        @endif
                    </div>
                    <div class="flex items-baseline gap-1">
                        <p class="text-xl font-bold text-rose-600">IDR {{ number_format($hotel->price, 0, ',', '.') }}</p>
                        <span class="text-[10px] text-slate-500">/malam</span>
                    </div>
                </div>
                <button class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-500/30 active:scale-95">
                    Lihat Kamar
                </button>
            </div>

        </div>
    </div>
</x-layouts.app>