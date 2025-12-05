<x-layouts.app>
    {{-- Container Utama --}}
    <div class="max-w-[120rem] mx-auto px-4 sm:px-6 lg:px-8 py-6">

        {{-- BREADCRUMB NAVIGATION (Dirapikan) --}}
        {{-- Struktur: Home > Hotel > Kota (Link) > Nama Hotel (Teks Aktif) --}}


        {{-- CONTENT GRID --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 relative">

            {{-- KOLOM KIRI (Gallery, Info, Review) --}}
            <div class="lg:col-span-2 space-y-2">

                {{-- HEADER JUDUL HOTEL --}}
                <div>
                </div>

                {{-- GALLERY --}}
                <x-hotel.gallery :hotel="$hotel" />

                {{-- HIGHLIGHTS --}}
                <x-hotel.highlights />

                {{-- STICKY NAVIGASI DALAM HALAMAN --}}
                <div
                    class="border-b border-slate-200 sticky top-[80px] bg-white/95 backdrop-blur z-20 overflow-x-auto hide-scrollbar -mx-4 px-4 md:mx-0 md:px-0">
                    <nav class="flex space-x-8 text-sm font-medium">
                        <a href="#info"
                            class="border-b-2 border-blue-600 text-blue-600 py-3 whitespace-nowrap transition">Info
                            Umum</a>
                        <a href="#reviews"
                            class="border-b-2 border-transparent text-slate-500 hover:text-slate-800 hover:border-slate-300 py-3 whitespace-nowrap transition">Review</a>
                        <a href="#facilities"
                            class="border-b-2 border-transparent text-slate-500 hover:text-slate-800 hover:border-slate-300 py-3 whitespace-nowrap transition">Fasilitas</a>
                        <a href="#location"
                            class="border-b-2 border-transparent text-slate-500 hover:text-slate-800 hover:border-slate-300 py-3 whitespace-nowrap transition">Lokasi</a>
                    </nav>
                </div>

                {{-- SECTIONS --}}
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

            {{-- KOLOM KANAN (Booking Card Desktop) --}}
            <div class="hidden lg:block lg:col-span-1">
                <div class="sticky top-28">
                    <x-hotel.booking-card :hotel="$hotel" />
                </div>
            </div>

            {{-- FLOATING BOOKING BAR (Mobile Only) --}}
            <div
                class="lg:hidden fixed bottom-0 inset-x-0 bg-white border-t border-gray-200 p-4 z-50 flex justify-between items-center shadow-[0_-4px_20px_rgba(0,0,0,0.1)]">
                <div>
                    <div class="flex items-center gap-2">
                        <p class="text-xs text-slate-400 line-through">IDR
                            {{ number_format($hotel->original_price, 0, ',', '.') }}</p>
                        @if ($hotel->original_price > 0)
                            <span class="bg-red-100 text-red-600 text-[10px] font-bold px-1 rounded">
                                -{{ round((($hotel->original_price - $hotel->price) / $hotel->original_price) * 100) }}%
                            </span>
                        @endif
                    </div>
                    <div class="flex items-baseline gap-1">
                        <p class="text-xl font-bold text-rose-600">IDR {{ number_format($hotel->price, 0, ',', '.') }}
                        </p>
                        <span class="text-[10px] text-slate-500">/malam</span>
                    </div>
                </div>
                <button
                    class="bg-brand-blue text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-500/30 active:scale-95">
                    Lihat Kamar
                </button>
            </div>

        </div>
    </div>
</x-layouts.app>
