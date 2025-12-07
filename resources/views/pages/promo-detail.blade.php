<x-layouts.app>
    <div class="bg-gray-50 min-h-screen pb-20 font-poppins">
        
        <div class="relative w-full h-[200px] md:h-[380px] bg-slate-200">
            <img src="{{ $detail['image'] }}" alt="{{ $detail['title'] }}" class="w-full h-full object-cover">
            
            <a href="{{ route('home') }}" class="absolute top-4 left-4 md:top-8 md:left-8 w-10 h-10 bg-black/30 backdrop-blur rounded-full flex items-center justify-center text-white hover:bg-black/50 transition z-20">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 relative -mt-4 md:-mt-10 z-10">
            
            @if($detail['type'] === 'reward')
                
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden mb-8 border border-blue-100">
                    
                    <div class="bg-gradient-to-r from-[#4A90E2] to-[#6DD5FA] p-6 pt-10 pb-8 text-white relative">
                        <div class="absolute -top-0 left-1/2 -translate-x-1/2 bg-[#A07E43] text-white text-[10px] md:text-xs font-bold px-4 py-1.5 rounded-b-xl shadow-md border-x border-b border-[#8a6a35]">
                            Pesan Hotel IDR 20jt
                        </div>

                        <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-4 border border-white/30 relative mt-4">
                            <div class="relative w-full h-2.5 bg-black/20 rounded-full mb-3">
                                <div class="absolute top-0 left-0 h-full bg-white w-[2%] rounded-full shadow-[0_0_10px_rgba(255,255,255,0.8)]"></div>
                                
                                <div class="absolute top-1/2 -translate-y-1/2 left-0 w-3 h-3 bg-[#A07E43] border-2 border-white rounded-full"></div>
                                
                                <div class="absolute top-1/2 -translate-y-1/2 right-0 w-6 h-6 bg-white text-[#A07E43] rounded-full flex items-center justify-center shadow-lg text-[10px] z-10">
                                    <i class="fa-solid fa-gift"></i>
                                </div>
                            </div>

                            <div class="flex justify-between text-[10px] md:text-xs font-medium text-white/90">
                                <span class="flex items-center gap-1"><div class="w-1.5 h-1.5 bg-[#A07E43] rounded-full"></div> IDR 0 sudah dibelanjakan</span>
                                <span class="flex items-center gap-1"><div class="w-1.5 h-1.5 bg-white/50 rounded-full"></div> IDR 20.0jt lagi <i class="fa-regular fa-circle-question opacity-70"></i></span>
                            </div>
                        </div>

                        <div class="absolute top-[85%] left-4 w-1 h-8 bg-[#A07E43] z-0"></div>
                        <div class="absolute top-[85%] right-4 w-1 h-8 bg-[#A07E43] z-0"></div>
                    </div>

                    <div class="p-6 relative bg-white z-10 rounded-t-3xl -mt-4">
                        <p class="text-sm text-slate-600 mb-4 font-medium">Ini reward yang menunggumu:</p>
                        
                        <div class="flex items-center gap-4 bg-slate-50 border border-slate-200 rounded-2xl p-4 mb-6 shadow-sm">
                            <div class="w-12 h-12 flex-shrink-0 bg-slate-200 rounded-full flex items-center justify-center text-slate-400 text-xl">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-0.5">
                                    <span class="w-4 h-4 rounded-full bg-blue-100 flex items-center justify-center text-[10px] text-blue-600"><i class="fa-solid fa-star"></i></span>
                                    <p class="text-xs text-slate-500 font-bold truncate">Blibli Tiket Points</p>
                                </div>
                                <h4 class="text-lg md:text-xl font-extrabold text-slate-900 leading-tight">850.000 Points</h4>
                                <p class="text-[10px] md:text-xs text-slate-500 mt-1 truncate">Poin dapat dipakai di Blibli, tiket, dan Ranch!</p>
                            </div>
                            <button class="text-brand-blue text-xs font-bold hover:underline">Info</button>
                        </div>

                        <div class="flex items-center justify-between border-t border-dashed border-slate-200 pt-4">
                            <p class="text-xs text-slate-400">Kumpulin stempel untuk klaim</p>
                            <button disabled class="bg-slate-200 text-slate-400 px-8 py-2.5 rounded-full font-bold text-sm cursor-not-allowed shadow-inner">
                                Klaim
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 md:p-8 mb-8">
                    <h3 class="text-xl font-bold text-slate-900 mb-6">Info selengkapnya</h3>
                    
                    <div class="flex gap-8 border-b border-slate-100 mb-8 text-sm font-semibold overflow-x-auto hide-scrollbar">
                        <button class="text-brand-blue border-b-2 border-brand-blue pb-3 px-1 whitespace-nowrap transition">Cara Ikut</button>
                        <button class="text-slate-400 hover:text-slate-600 border-b-2 border-transparent hover:border-slate-300 pb-3 px-1 whitespace-nowrap transition">Pertanyaan Umum</button>
                        <button class="text-slate-400 hover:text-slate-600 border-b-2 border-transparent hover:border-slate-300 pb-3 px-1 whitespace-nowrap transition">Syarat & Ketentuan</button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-[#F7F9FA] rounded-2xl p-6 flex flex-col items-center text-center relative group hover:bg-blue-50 transition">
                            <div class="w-6 h-6 rounded-full border border-blue-400 text-blue-600 flex items-center justify-center text-xs font-bold mb-4 bg-white">1</div>
                            <div class="h-12 mb-3">
                                <i class="fa-solid fa-mobile-screen-button text-4xl text-[#7B61FF]"></i>
                            </div>
                            <p class="text-xs text-slate-600 font-medium">Pesan produk sesuai misi</p>
                        </div>

                        <div class="bg-[#F7F9FA] rounded-2xl p-6 flex flex-col items-center text-center relative group hover:bg-blue-50 transition">
                            <div class="w-6 h-6 rounded-full border border-blue-400 text-blue-600 flex items-center justify-center text-xs font-bold mb-4 bg-white">2</div>
                            <div class="h-12 mb-3 relative">
                                <i class="fa-solid fa-user-group text-3xl text-slate-700"></i>
                                <div class="absolute -right-2 -bottom-1 bg-green-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-[10px] border-2 border-white">
                                    <i class="fa-solid fa-check"></i>
                                </div>
                            </div>
                            <p class="text-xs text-slate-600 font-medium">Selesaikan pesanan</p>
                        </div>

                        <div class="bg-[#F7F9FA] rounded-2xl p-6 flex flex-col items-center text-center relative group hover:bg-blue-50 transition">
                            <div class="w-6 h-6 rounded-full border border-blue-400 text-blue-600 flex items-center justify-center text-xs font-bold mb-4 bg-white">3</div>
                            <div class="h-12 mb-3">
                                <i class="fa-solid fa-route text-4xl text-[#FF5B5B]"></i>
                            </div>
                            <p class="text-xs text-slate-600 font-medium px-4">Misimu berlanjut setelah perjalanan selesai</p>
                        </div>

                        <div class="bg-[#F7F9FA] rounded-2xl p-6 flex flex-col items-center text-center relative group hover:bg-blue-50 transition">
                            <div class="w-6 h-6 rounded-full border border-blue-400 text-blue-600 flex items-center justify-center text-xs font-bold mb-4 bg-white">4</div>
                            <div class="h-12 mb-3">
                                <i class="fa-solid fa-shield-halved text-4xl text-[#FFC107]"></i>
                            </div>
                            <p class="text-xs text-slate-600 font-medium">Jangan batalin pesanan biar tetap ada progres</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">Dapetin ekstra IDR 150K</h3>
                    <div class="relative rounded-2xl overflow-hidden bg-gradient-to-r from-blue-700 to-blue-500 text-white shadow-lg h-48 md:h-56 flex items-center">
                        <div class="absolute inset-0 opacity-20">
                            <div class="absolute -left-10 -top-10 w-40 h-40 border-4 border-white rounded-full"></div>
                            <div class="absolute right-20 bottom-10 w-20 h-20 bg-white rounded-full blur-2xl"></div>
                        </div>

                        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between w-full px-8 md:px-12 gap-6">
                            
                            <div class="flex flex-col items-center md:items-start text-center md:text-left gap-2">
                                <div class="bg-white/20 backdrop-blur rounded-lg px-2 py-1 text-[10px] font-bold border border-white/30 uppercase tracking-widest inline-block">
                                    Stay With Benefits
                                </div>
                                <div class="w-20 h-20 bg-blue-400/30 rounded-full flex items-center justify-center border-4 border-blue-300/50 shadow-[0_0_20px_rgba(59,130,246,0.5)]">
                                    <i class="fa-solid fa-gift text-4xl text-blue-100 drop-shadow-md"></i>
                                </div>
                            </div>

                            <div class="text-center md:text-left flex-1">
                                <p class="text-lg md:text-xl font-medium opacity-90">Menangkan hadiah</p>
                                <h2 class="text-4xl md:text-6xl font-extrabold text-[#FFD700] drop-shadow-sm">
                                    IDR <span class="text-white">150rb</span>
                                </h2>
                            </div>

                            <div>
                                <button class="bg-white text-blue-700 px-8 py-3 rounded-xl font-bold hover:bg-blue-50 hover:shadow-lg transition transform hover:-translate-y-0.5">
                                    Lihat misi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 md:p-10">
                    <h1 class="text-2xl md:text-3xl font-bold text-slate-800 mb-2">{{ $detail['title'] }}</h1>
                    <p class="text-slate-500 font-medium mb-6 text-lg">{{ $detail['subtitle'] }}</p>
                    
                    <div class="prose text-slate-600 leading-relaxed mb-8 border-b border-slate-100 pb-8">
                        <p class="text-lg">{{ $detail['description'] }}</p>
                        <p>Nikmati kemudahan dan keuntungan lebih dengan berbagai fitur menarik dari tiket.com. Pesan sekarang dan rasakan pengalaman liburan yang tak terlupakan.</p>
                    </div>

                    <div class="bg-blue-50 rounded-2xl p-6 border border-blue-100">
                        <div class="flex items-center gap-3 mb-4">
                            <i class="fa-solid fa-circle-info text-blue-600 text-xl"></i>
                            <h3 class="font-bold text-blue-900 text-lg">Syarat & Ketentuan Umum</h3>
                        </div>
                        <ul class="list-disc pl-5 text-sm text-blue-800 space-y-2 font-medium">
                            <li>Promo berlaku untuk semua metode pembayaran yang tersedia di tiket.com.</li>
                            <li>Periode promo berlaku selama persediaan masih ada.</li>
                            <li>Tiket.com berhak mengubah syarat dan ketentuan tanpa pemberitahuan sebelumnya.</li>
                            <li>Promo tidak dapat digabungkan dengan promo lainnya.</li>
                        </ul>
                    </div>

                    <div class="mt-8 pt-4">
                        <a href="{{ route('home') }}" class="block w-full md:w-auto text-center bg-brand-blue text-white px-8 py-4 rounded-xl font-bold shadow-lg shadow-blue-500/30 hover:bg-blue-700 transition hover:-translate-y-1">
                            Cek Promo Lainnya
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-layouts.app>