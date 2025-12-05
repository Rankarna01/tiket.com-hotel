<x-layouts.app>
    <div class="bg-gray-50 min-h-screen pb-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <a href="{{ route('home') }}" class="text-slate-500 hover:text-brand-blue mb-6 inline-block font-medium">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Penawaran
            </a>

            <div class="flex flex-col lg:flex-row gap-8 items-start">
                
                <div class="lg:w-2/3 w-full space-y-6">
                    <div class="rounded-3xl overflow-hidden shadow-lg border border-slate-100 bg-white">
                        <img src="{{ $promo->image }}" class="w-full h-64 md:h-[400px] object-cover">
                        <div class="p-6 md:p-8">
                            <h1 class="text-2xl md:text-3xl font-bold text-slate-900 mb-2">{{ $promo->title }}</h1>
                            <p class="text-slate-600 text-lg">{{ $promo->description }}</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-slate-100">
                        <h3 class="text-xl font-bold text-slate-800 mb-4 pb-2 border-b">Syarat dan Ketentuan</h3>
                        <ul class="list-disc pl-5 space-y-2 text-slate-600 leading-relaxed">
                            @if($promo->terms)
                                @foreach(explode("\n", $promo->terms) as $term)
                                    @if(trim($term))
                                        <li>{{ $term }}</li>
                                    @endif
                                @endforeach
                            @else
                                <li>Syarat dan ketentuan standar berlaku.</li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="lg:w-1/3 w-full sticky top-24">
                    <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-slate-900 mb-4">Kode Promo</h3>
                            
                            @if($promo->promo_code)
                                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-4">
                                    <p class="text-xs text-slate-500 mb-1">Salin kode ini:</p>
                                    <div class="flex justify-between items-center bg-white border border-slate-200 rounded-lg px-3 py-2">
                                        <span class="font-mono font-bold text-slate-800 text-lg tracking-wide">{{ $promo->promo_code }}</span>
                                        <button onclick="navigator.clipboard.writeText('{{ $promo->promo_code }}'); alert('Kode disalin!')" 
                                                class="text-brand-blue font-bold text-sm hover:underline">
                                            SALIN
                                        </button>
                                    </div>
                                </div>
                                <button class="w-full bg-brand-blue text-white font-bold py-3 rounded-xl shadow-md hover:brightness-110 transition">
                                    Salin & Pakai Promo
                                </button>
                            @else
                                <div class="bg-gray-50 rounded-xl p-4 text-center text-slate-500">
                                    <p>Promo ini tidak memerlukan kode khusus.</p>
                                </div>
                                <button class="w-full mt-4 bg-brand-blue text-white font-bold py-3 rounded-xl shadow-md hover:brightness-110 transition">
                                    Gunakan Promo Sekarang
                                </button>
                            @endif
                        </div>
                        
                        <div class="bg-gradient-to-r from-cyan-50 to-blue-50 p-6 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <p class="font-bold text-slate-800">Nikmati promonya</p>
                                <div class="bg-rose-500 text-white text-xs font-bold px-2 py-1 rounded inline-block mt-1 transform -rotate-2">
                                    cuma di aplikasi
                                </div>
                            </div>
                            <div class="bg-white p-2 rounded shadow-sm">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data={{ url()->current() }}" alt="QR Code" class="w-16 h-16">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 bg-white rounded-2xl p-4 shadow-sm border border-slate-100 flex items-center gap-4 text-sm font-medium text-slate-600">
                        <span>Bagikan</span>
                        <a href="#" class="hover:text-blue-600"><i class="fa-brands fa-facebook text-lg"></i></a>
                        <a href="#" class="hover:text-green-500"><i class="fa-brands fa-whatsapp text-lg"></i></a>
                        <a href="#" class="hover:text-sky-500"><i class="fa-brands fa-twitter text-lg"></i></a>
                        <button onclick="navigator.clipboard.writeText(window.location.href)" class="ml-auto hover:text-slate-900">
                            <i class="fa-solid fa-link"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>