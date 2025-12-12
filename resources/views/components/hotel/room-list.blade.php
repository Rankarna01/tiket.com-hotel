@props(['hotel'])

<div id="pilih-kamar" class="py-8 scroll-mt-24">
    <h3 class="text-xl font-bold text-slate-900 mb-6">Pilihan Kamar Tersedia</h3>

    <div class="space-y-6">
        
        {{-- LOGIKA DUMMY: Kita buat loop seolah-olah ada 3 tipe kamar berbeda --}}
        @php
            $rooms = [
                [
                    'name' => 'Deluxe Room King Bed',
                    'image' => $hotel->images[0] ?? 'https://via.placeholder.com/300',
                    'size' => '32m²',
                    'bed' => '1 King Bed',
                    'guest' => '2 Dewasa',
                    'breakfast' => false,
                    'price_multiplier' => 1, // Harga Normal
                ],
                [
                    'name' => 'Executive Suite with Balcony',
                    'image' => $hotel->images[1] ?? $hotel->images[0] ?? 'https://via.placeholder.com/300',
                    'size' => '45m²',
                    'bed' => '1 King Bed & Sofa',
                    'guest' => '2 Dewasa, 1 Anak',
                    'breakfast' => true,
                    'price_multiplier' => 1.5, // Lebih mahal 50%
                ],
                [
                    'name' => 'Presidential Villa with Private Pool',
                    'image' => $hotel->images[2] ?? $hotel->images[0] ?? 'https://via.placeholder.com/300',
                    'size' => '120m²',
                    'bed' => '2 King Bed',
                    'guest' => '4 Dewasa',
                    'breakfast' => true,
                    'price_multiplier' => 3.5, // Lebih mahal 3.5x
                ]
            ];
        @endphp

        @foreach($rooms as $room)
        <div class="bg-white border border-slate-200 rounded-xl p-4 md:p-6 shadow-sm hover:shadow-md transition">
            
            <h4 class="text-lg font-bold text-slate-900 mb-4">{{ $room['name'] }}</h4>

            <div class="flex flex-col md:flex-row gap-6">
                
                <div class="w-full md:w-1/4 flex-shrink-0">
                    <div class="relative rounded-lg overflow-hidden h-40 mb-3 group">
                        <img src="{{ $room['image'] }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute bottom-2 right-2 bg-black/60 text-white text-[10px] px-2 py-1 rounded">
                            1/6 Foto
                        </div>
                    </div>
                    
                    <div class="space-y-2 text-sm text-slate-600">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-bed text-slate-400 w-5"></i>
                            <span>{{ $room['bed'] }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-ban-smoking text-slate-400 w-5"></i>
                            <span>Bebas Asap Rokok</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-ruler-combined text-slate-400 w-5"></i>
                            <span>{{ $room['size'] }}</span>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-3/4 border border-slate-200 rounded-xl flex flex-col md:flex-row overflow-hidden">
                    
                    <div class="p-4 md:flex-1 border-b md:border-b-0 md:border-r border-slate-200 space-y-4">
                        @if($room['breakfast'])
                            <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded-md">
                                Termasuk Sarapan
                            </span>
                        @else
                            <span class="bg-slate-100 text-slate-500 text-xs font-bold px-2 py-1 rounded-md">
                                Tanpa Sarapan
                            </span>
                        @endif

                        <div class="text-sm text-slate-500 space-y-2">
                            <p class="text-green-600 font-medium"><i class="fa-solid fa-check mr-1"></i> WiFi Gratis</p>
                            <p class="text-slate-500"><i class="fa-solid fa-ban mr-1"></i> Tidak bisa refund & reschedule</p>
                        </div>

                        <div class="flex items-center gap-2 text-sm font-semibold text-slate-700 pt-2">
                            <i class="fa-solid fa-user-group text-slate-400"></i>
                            <span>{{ $room['guest'] }}</span>
                        </div>
                    </div>

                    <div class="p-4 md:w-64 flex flex-col justify-center items-end text-right bg-slate-50/50">
                        
                        @php
                            $roomPrice = $hotel->price * $room['price_multiplier'];
                            $roomOriginalPrice = $hotel->original_price * $room['price_multiplier'];
                        @endphp

                        <span class="bg-red-100 text-red-600 text-[10px] font-bold px-1 rounded mb-1">
                            Hemat {{ round((($roomOriginalPrice - $roomPrice)/$roomOriginalPrice)*100) }}%
                        </span>
                        <p class="text-xs text-slate-400 line-through decoration-slate-400">
                            IDR {{ number_format($roomOriginalPrice, 0, ',', '.') }}
                        </p>
                        <h3 class="text-xl font-bold text-red-600">
                            IDR {{ number_format($roomPrice, 0, ',', '.') }}
                        </h3>
                        <p class="text-[10px] text-slate-500 mb-2">/kamar/malam (Termasuk Pajak)</p>

                        <div class="flex items-center gap-1 text-[10px] text-orange-600 font-bold mb-4">
                            <i class="fa-solid fa-coins"></i>
                            Dapat {{ number_format($roomPrice / 100) }} poin
                        </div>

                        <p class="text-[10px] text-red-500 font-bold mb-2">Sisa 2 kamar!</p>

                        <a href="{{ route('booking.checkout', $hotel->slug) }}" 
   class="inline-block text-center bg-blue-600 text-white font-bold py-2 px-6 rounded-full hover:bg-blue-700 transition shadow-md">
   Pesan
</a>
                    </div>

                </div>
            </div>

        </div>
        @endforeach

    </div>
</div>