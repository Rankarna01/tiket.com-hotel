@props(['slides', 'popularHotels'])

<section 
    class="relative h-[85vh] md:h-[95vh] overflow-hidden bg-[#0f172a]" 
    x-data="{ 
        activeSlide: 0, 
        total: {{ count($slides) }},
        paused: false,
        next() { if(!this.paused) { this.activeSlide = (this.activeSlide + 1) % this.total } },
        prev() { this.activeSlide = (this.activeSlide - 1 + this.total) % this.total }
    }" 
    x-init="setInterval(() => { next() }, 6000)"
    @mouseenter="paused = true"
    @mouseleave="paused = false"
>
    <div class="absolute inset-0 z-0">
        @foreach($slides as $index => $slide)
            <div 
                class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
                x-show="activeSlide === {{ $index }}"
                x-transition:enter="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="opacity-100"
                x-transition:leave-end="opacity-0"
            >
                <div class="absolute inset-0 bg-gradient-to-r from-[#0f172a]/95 via-[#0f172a]/60 to-transparent z-10"></div>
                
                <img 
                    src="{{ $slide['image'] }}" 
                    alt="Background Slide" 
                    class="h-full w-full object-cover transform"
                    :class="activeSlide === {{ $index }} ? 'animate-slow-zoom' : ''" 
                />
            </div>
        @endforeach
    </div>

    <div class="relative z-20 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 h-full flex items-center">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center w-full">
            
            <div class="lg:col-span-7 space-y-6">
                @foreach($slides as $index => $slide)
                    <div 
                        x-show="activeSlide === {{ $index }}"
                        x-transition:enter="transition ease-out duration-700"
                        x-transition:enter-start="opacity-0 translate-x-10"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        class="max-w-xl"
                    >
                        <div class="inline-block px-3 py-1 mb-4 rounded-full border border-brand-yellow/30 bg-brand-yellow/10">
                            <span class="text-[10px] md:text-xs font-bold tracking-widest text-brand-yellow uppercase flex items-center">
                                <span class="w-1.5 h-1.5 rounded-full bg-brand-yellow mr-2 animate-pulse"></span>
                                FEATURED DESTINATION
                            </span>
                        </div>
                        
                        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white leading-tight drop-shadow-xl">
                            {!! $slide['title'] !!}
                        </h1>
                        
                        <p class="mt-4 text-sm md:text-lg text-gray-200 leading-relaxed drop-shadow-md">
                            Temukan kenyamanan eksklusif dan penawaran terbaik untuk perjalanan Anda berikutnya hanya di platform kami.
                        </p>

                        <div class="mt-8">
                            <button class="px-8 py-3 bg-[#ffcc00] hover:bg-[#e6b800] text-black font-bold rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                                Booking Sekarang
                            </button>
                        </div>
                    </div>
                @endforeach

                <div class="flex items-center space-x-3 mt-12">
                    @foreach($slides as $index => $slide)
                        <button 
                            @click="activeSlide = {{ $index }}" 
                            class="relative h-1.5 rounded-full bg-white/20 transition-all duration-500 overflow-hidden"
                            :class="activeSlide === {{ $index }} ? 'w-16' : 'w-8 hover:bg-white/40'"
                        >
                            <div 
                                class="absolute top-0 left-0 h-full bg-[#ffcc00] transition-all"
                                :style="activeSlide === {{ $index }} ? 'width: 100%' : 'width: 0%'"
                                :class="activeSlide === {{ $index }} && !paused ? 'duration-[6000ms] ease-linear' : 'duration-300'"
                            ></div>
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-5 hidden lg:flex justify-end z-30">
                <div class="w-full max-w-[420px]">
                    <x-home.search-widget :popularHotels="$popularHotels ?? []" />
                </div>
            </div>

        </div>
    </div>

    <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 z-30 p-2 rounded-full bg-black/20 hover:bg-white/20 text-white transition-all">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 z-30 p-2 rounded-full bg-black/20 hover:bg-white/20 text-white transition-all">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>
</section>

<style>
    @keyframes slow-zoom {
        from { transform: scale(1); }
        to { transform: scale(1.1); }
    }
    .animate-slow-zoom {
        animation: slow-zoom 8s ease-out forwards;
    }
</style>