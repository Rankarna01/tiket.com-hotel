@props(['promos'])

<section class="mx-auto max-w-[120rem] px-4 sm:px-6 lg:px-8 py-12" x-data="{
    scrollLeft() {
        this.$refs.slider.scrollBy({ left: -320, behavior: 'smooth' });
    },
    scrollRight() {
        this.$refs.slider.scrollBy({ left: 320, behavior: 'smooth' });
    }
}">
    <div class="flex flex-col lg:flex-row items-center gap-8">
        
        <div class="lg:w-1/4">
            <div class="w-12 h-12 rounded-full bg-green-500 grid place-items-center text-white text-xl mb-4 shadow-lg shadow-green-500/30">
                <i class="fa-solid fa-percent"></i>
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-800 leading-tight mb-2">
                Penawaran menarik<br>buatmu
            </h2>
        </div>

        <div class="lg:w-3/4 w-full relative">
            
            <div class="hidden lg:flex gap-3 mb-4">
                <button @click="scrollLeft()" class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-slate-50 hover:shadow-md transition">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
                <button @click="scrollRight()" class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-slate-50 hover:shadow-md transition">
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
                
                <div class="flex-1 flex items-center pl-4">
                    <div class="w-full h-1 bg-slate-100 rounded-full overflow-hidden">
                        <div class="w-1/4 h-full bg-slate-300 rounded-full"></div>
                    </div>
                    <span class="text-xs text-slate-400 font-bold ml-3">1/{{ $promos->count() }}</span>
                </div>
            </div>

            <div x-ref="slider" class="flex gap-4 overflow-x-auto pb-4 snap-x snap-mandatory scrollbar-hide scroll-smooth">
                @foreach($promos as $promo)
                <a href="{{ route('promo.detail.slug', $promo->slug) }}" class="snap-start shrink-0 relative block w-[280px] sm:w-[350px] aspect-[16/7] rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all hover:-translate-y-1 group border border-slate-100">
                    
                    <img src="{{ $promo->image }}" 
                         alt="{{ $promo->title }}" 
                         class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                    
                    </a>
                @endforeach
            </div>

        </div>
    </div>
</section>