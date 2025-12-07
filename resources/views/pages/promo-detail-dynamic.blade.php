<x-layouts.app>
    <div class="bg-gray-50 min-h-screen pb-20 font-poppins">
        
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <a href="{{ route('home') }}" class="text-slate-500 hover:text-blue-600 mb-6 inline-block font-medium text-sm">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Promo
            </a>

            <div class="flex flex-col lg:flex-row gap-8 items-start">
                
                <div class="lg:w-2/3 w-full space-y-8">
                    <div class="rounded-2xl overflow-hidden shadow-lg border border-slate-100 bg-white">
                        <img src="{{ $promo->image }}" class="w-full h-auto object-cover">
                        <div class="p-6 md:p-8">
                            <h1 class="text-2xl md:text-3xl font-bold text-slate-900 mb-3">{{ $promo->title }}</h1>
                            <p class="text-slate-600 leading-relaxed">{{ $promo->description }}</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-slate-100">
                        <h3 class="text-lg font-bold text-slate-800 mb-4 pb-2 border-b">Syarat dan Ketentuan</h3>
                        <div class="prose prose-sm text-slate-600 leading-relaxed max-w-none">
                            {!! nl2br(e($promo->terms)) !!}
                        </div>
                    </div>

                    @if($promo->hotels->count() > 0)
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 mb-4">Rekomendasi Hotel untuk Kamu</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($promo->hotels as $hotel)
                                <a href="{{ route('hotel.detail', $hotel->slug) }}" class="group bg-white rounded-xl border border-slate-200 overflow-hidden hover:shadow-lg transition flex flex-col">
                                    <div class="h-40 overflow-hidden relative">
                                        <img src="{{ $hotel->images[0] ?? '' }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur px-2 py-1 rounded-lg text-xs font-bold text-blue-600 shadow-sm">
                                            IDR {{ number_format($hotel->price) }}
                                        </div>
                                    </div>
                                    <div class="p-4 flex-1 flex flex-col">
                                        <h4 class="font-bold text-slate-800 line-clamp-1 group-hover:text-blue-600 transition">{{ $hotel->name }}</h4>
                                        <p class="text-xs text-slate-500 mb-2">{{ $hotel->city }}</p>
                                        <div class="mt-auto pt-3 border-t border-slate-100 flex items-center justify-between">
                                            <div class="flex text-yellow-400 text-xs">
                                                @for($i=0; $i<$hotel->stars; $i++) <i class="fa-solid fa-star"></i> @endfor
                                            </div>
                                            <span class="text-xs font-bold text-blue-600">Lihat Kamar</span>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="lg:w-1/3 w-full sticky top-24">
                    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden p-6">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Kode Promo</h3>
                        
                        @if($promo->promo_code)
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-4 text-center">
                                <p class="text-xs text-slate-500 mb-2 uppercase tracking-wide font-bold">Salin Kode</p>
                                <div class="relative bg-white border-2 border-dashed border-blue-300 rounded-lg py-3 px-4 mb-2 cursor-pointer hover:bg-blue-50 transition group"
                                     onclick="navigator.clipboard.writeText('{{ $promo->promo_code }}'); alert('Kode disalin!')">
                                    <span class="font-mono font-bold text-xl text-blue-700 tracking-wider">{{ $promo->promo_code }}</span>
                                    <i class="fa-regular fa-copy absolute right-3 top-1/2 -translate-y-1/2 text-blue-300 group-hover:text-blue-600"></i>
                                </div>
                                <p class="text-xs text-slate-400">Klik kode untuk menyalin</p>
                            </div>
                        @else
                            <div class="bg-gray-50 rounded-xl p-4 text-center text-slate-500 border border-gray-200">
                                <p class="text-sm">Promo ini otomatis digunakan tanpa kode.</p>
                            </div>
                        @endif

                        <div class="mt-6 border-t pt-4">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Bagikan Promo</p>
                            <div class="flex gap-2">
                                <button class="flex-1 bg-[#1877F2] text-white py-2 rounded-lg hover:brightness-110 transition"><i class="fa-brands fa-facebook-f"></i></button>
                                <button class="flex-1 bg-[#25D366] text-white py-2 rounded-lg hover:brightness-110 transition"><i class="fa-brands fa-whatsapp"></i></button>
                                <button class="flex-1 bg-[#1DA1F2] text-white py-2 rounded-lg hover:brightness-110 transition"><i class="fa-brands fa-twitter"></i></button>
                                <button class="flex-1 bg-slate-200 text-slate-600 py-2 rounded-lg hover:bg-slate-300 transition" onclick="navigator.clipboard.writeText(window.location.href)"><i class="fa-solid fa-link"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>