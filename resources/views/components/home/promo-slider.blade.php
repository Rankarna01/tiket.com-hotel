@props(['promos'])

<section class="mx-auto max-w-[120rem] px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col lg:flex-row gap-8">
        
        <div class="lg:w-1/4">
            <div class="sticky top-24">
                <div class="w-12 h-12 rounded-full bg-green-500 grid place-items-center text-white text-xl mb-4 shadow-lg shadow-green-500/30">
                    <i class="fa-solid fa-percent"></i>
                </div>
                <h2 class="text-3xl font-extrabold text-slate-800 leading-tight">
                    Penawaran menarik buatmu
                </h2>
                <p class="mt-4 text-slate-500">
                    Dapetin diskon dan cashback spesial untuk perjalananmu selanjutnya.
                </p>
            </div>
        </div>

        <div class="lg:w-3/4 overflow-hidden relative group">
            <div class="flex gap-4 overflow-x-auto pb-6 snap-x snap-mandatory scrollbar-hide" id="promoSlider">
                @foreach($promos as $promo)
                <a href="{{ route('promo.detail.slug', $promo->slug) }}" class="snap-start shrink-0 relative w-[280px] sm:w-[350px] h-[180px] sm:h-[200px] rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all hover:-translate-y-1 block">
                    <img src="{{ $promo->image }}" alt="{{ $promo->title }}" class="w-full h-full object-cover brightness-75 hover:brightness-90 transition">
                    
                    <div class="absolute inset-0 p-5 flex flex-col justify-end text-white bg-gradient-to-t from-black/80 via-transparent">
                        <p class="text-sm font-medium text-white/90 mb-1">{{ $promo->title }}</p>
                        <p class="text-2xl font-extrabold text-yellow-400 leading-none">
                            {{ $promo->discount_text }}
                        </p>
                        @if($promo->promo_code)
                            <div class="mt-2 inline-flex items-center gap-2 bg-white/20 backdrop-blur px-2 py-1 rounded text-xs w-fit border border-white/30">
                                <i class="fa-regular fa-copy"></i> {{ $promo->promo_code }}
                            </div>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>