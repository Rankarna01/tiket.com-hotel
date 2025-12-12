<x-layouts.app>
    <div class="bg-gray-50 min-h-screen pb-20 pt-6 font-poppins">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center gap-4 text-sm font-medium text-slate-400 mb-8 overflow-x-auto">
                <div class="flex items-center gap-2 text-blue-600 whitespace-nowrap">
                    <div class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold"><i class="fa-solid fa-check"></i></div>
                    <span>Detail Pesanan</span>
                </div>
                <div class="w-8 h-[1px] bg-blue-600"></div>
                <div class="flex items-center gap-2 text-blue-600 whitespace-nowrap">
                    <div class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold">2</div>
                    <span>Pelengkap Menginap</span>
                </div>
                <div class="w-8 h-[1px] bg-slate-300"></div>
                <div class="flex items-center gap-2 whitespace-nowrap">
                    <div class="w-6 h-6 rounded-full border border-slate-300 flex items-center justify-center text-xs font-bold">3</div>
                    <span>Pilih Metode Bayar</span>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                
                <div class="lg:w-2/3 space-y-8">
                    
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 mb-1">Fasilitas Ekstra</h2>
                        <p class="text-sm text-slate-500 mb-4">Supaya nginepnya lebih nyaman. Yuk, tambah fasilitas ekstra sesuai kebutuhanmu!</p>

                        <div class="flex gap-2 mb-4">
                            <button class="px-4 py-1.5 rounded-full border border-blue-600 text-blue-600 text-sm font-bold bg-blue-50">Makanan</button>
                            <button class="px-4 py-1.5 rounded-full border border-slate-300 text-slate-500 text-sm font-medium hover:bg-slate-50">Aktivitas</button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
                                <img src="https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?q=80&w=200&auto=format&fit=crop" class="w-16 h-16 rounded-lg object-cover">
                                <div class="flex-1">
                                    <h4 class="font-bold text-slate-800 text-sm">Paket Ayam Manalagi</h4>
                                    <p class="text-xs text-slate-500 font-bold mt-1">IDR 39.999<span class="font-normal text-gray-400">/item</span></p>
                                    <div class="flex justify-between items-end mt-2">
                                        <span class="text-[10px] text-slate-400">Maksimum 5 item</span>
                                        <button class="bg-blue-600 text-white text-xs font-bold px-4 py-1.5 rounded-lg hover:bg-blue-700 transition">+ Pilih</button>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
                                <div class="w-16 h-16 rounded-lg bg-gray-100 flex items-center justify-center text-slate-300">
                                    <i class="fa-solid fa-utensils text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-slate-800 text-sm">Additional Breakfast</h4>
                                    <p class="text-xs text-slate-500 font-bold mt-1">IDR 99.899<span class="font-normal text-gray-400">/item</span></p>
                                    <div class="flex justify-between items-end mt-2">
                                        <span class="text-[10px] text-slate-400">Maksimum 5 item</span>
                                        <button class="bg-blue-600 text-white text-xs font-bold px-4 py-1.5 rounded-lg hover:bg-blue-700 transition">+ Pilih</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-xl font-bold text-slate-800 mb-1">Perlindungan Ekstra</h2>
                        <p class="text-sm text-slate-500 mb-4">Lebih tenang selama di perjalanan dengan jaminan tambahan dari Perlindungan Ekstra!</p>

                        <div class="bg-slate-100 p-1 rounded-lg inline-flex w-full mb-6 border border-slate-200">
                            <button class="flex-1 py-2 text-sm font-bold text-slate-800 bg-white rounded shadow-sm">Standar</button>
                            <button class="flex-1 py-2 text-sm font-bold text-slate-500 hover:text-slate-700">Premium</button>
                        </div>

                        <div class="space-y-4">
                            
                            <div class="bg-white border border-blue-100 rounded-xl p-5 shadow-sm relative overflow-hidden">
                                <div class="absolute top-4 right-0 bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded-l shadow">Sering dipilih</div>
                                
                                <div class="flex items-start gap-3 mb-2">
                                    <div class="w-8 h-8 rounded-full bg-pink-100 flex items-center justify-center text-pink-500 text-sm">
                                        <i class="fa-solid fa-suitcase-medical"></i>
                                    </div>
                                    <h4 class="font-bold text-slate-800">Perlindungan Menginap</h4>
                                </div>

                                <div class="bg-blue-50 rounded-lg p-3 mb-4 text-xs text-slate-600 space-y-1 border border-blue-100">
                                    <p class="flex items-center gap-2"><i class="fa-solid fa-check text-blue-500"></i> Kompensasi pembatalan reservasi sampai <b>IDR 2.000.000</b> per kamar.</p>
                                    <p class="flex items-center gap-2"><i class="fa-solid fa-check text-blue-500"></i> Menanggung kehilangan barang sampai <b>IDR 2.500.000</b>.</p>
                                    <a href="#" class="text-blue-600 font-bold ml-5 hover:underline">Lihat 7 benefit lainnya</a>
                                </div>

                                <div class="flex items-center justify-between">
                                    <p class="font-bold text-slate-800 text-sm">IDR 10.416 <span class="text-gray-400 font-normal">/pax</span></p>
                                    <button class="bg-blue-600 text-white text-xs font-bold px-6 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-1">
                                        <i class="fa-solid fa-plus"></i> Tambahkan
                                    </button>
                                </div>
                            </div>

                            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm relative overflow-hidden">
                                <div class="absolute top-4 right-0 bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded-l shadow">Pilihan terbaik</div>
                                
                                <div class="flex items-start gap-3 mb-2">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 text-sm">
                                        <i class="fa-solid fa-shield-halved"></i>
                                    </div>
                                    <h4 class="font-bold text-slate-800">Hotel 100% Refund</h4>
                                </div>

                                <div class="bg-slate-50 rounded-lg p-3 mb-4 text-xs text-slate-600 space-y-1 border border-slate-100">
                                    <p class="flex items-center gap-2"><i class="fa-solid fa-check text-blue-500"></i> Menjamin refund pembatalan s.d. 100% hingga 4 jam sebelum check-in.</p>
                                    <p class="flex items-center gap-2"><i class="fa-solid fa-check text-blue-500"></i> Uang kembali hingga <b>100%</b> dengan alasan apapun.</p>
                                    <a href="#" class="text-blue-600 font-bold ml-5 hover:underline">Lihat 1 benefit lainnya</a>
                                </div>

                                <div class="flex items-center justify-between">
                                    <p class="font-bold text-slate-800 text-sm">IDR 56.241 <span class="text-gray-400 font-normal">/pax</span></p>
                                    <button class="bg-blue-600 text-white text-xs font-bold px-6 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-1">
                                        <i class="fa-solid fa-plus"></i> Tambahkan
                                    </button>
                                </div>
                            </div>

                            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm relative">
                                <div class="flex items-start gap-3 mb-2">
                                    <div class="w-8 h-8 rounded-full bg-pink-100 flex items-center justify-center text-pink-500 text-sm">
                                        <i class="fa-solid fa-suitcase"></i>
                                    </div>
                                    <h4 class="font-bold text-slate-800">Refund Setelah Check-in</h4>
                                </div>

                                <div class="bg-slate-50 rounded-lg p-3 mb-4 text-xs text-slate-600 space-y-1 border border-slate-100">
                                    <p class="flex items-center gap-2"><i class="fa-solid fa-check text-blue-500"></i> Batalkan dengan alasan apa pun setelah check in.</p>
                                    <p class="flex items-center gap-2"><i class="fa-solid fa-check text-blue-500"></i> Kompensasi hingga 50% dari harga hotel.</p>
                                    <a href="#" class="text-blue-600 font-bold ml-5 hover:underline">Lihat 1 benefit lainnya</a>
                                </div>

                                <div class="flex items-center justify-between">
                                    <p class="font-bold text-slate-800 text-sm">IDR 43.396 <span class="text-gray-400 font-normal">/pax</span></p>
                                    <button class="bg-blue-600 text-white text-xs font-bold px-6 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-1">
                                        <i class="fa-solid fa-plus"></i> Tambahkan
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="lg:w-1/3">
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm sticky top-24 overflow-hidden">
                        
                        <div class="p-4 border-b border-slate-100 flex gap-4">
                            <img src="{{ $hotel->images[0] ?? '' }}" class="w-20 h-20 rounded-lg object-cover flex-shrink-0">
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm line-clamp-2">{{ $hotel->name }}</h4>
                                <div class="border-t border-slate-100 mt-2 pt-2">
                                    <p class="text-xs text-slate-500">{{ $checkIn->isoFormat('ddd, D MMM YYYY') }} - {{ $checkOut->isoFormat('ddd, D MMM YYYY') }}</p>
                                    <p class="text-xs text-slate-500">{{ $duration }} Malam • 1 Kamar</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 space-y-3">
                            <div class="flex justify-between items-center text-sm text-slate-600">
                                <span>Total (setelah pajak)</span>
                                <span class="line-through text-xs text-slate-400">IDR {{ number_format($grandTotal * 1.1, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-rose-600 text-xl">IDR {{ number_format($grandTotal, 0, ',', '.') }}</span>
                                <i class="fa-solid fa-chevron-down text-slate-400 cursor-pointer"></i>
                            </div>
                        </div>

                        <div class="p-4 pt-0">
                            <button class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition shadow-lg shadow-blue-500/30">
                                Lanjutkan Pembayaran
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>