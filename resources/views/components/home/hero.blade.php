@props(['slides'])

<section class="relative h-[85vh] md:h-[90vh] overflow-hidden" x-data="{ activeSlide: 0, total: {{ count($slides) }} }" x-init="setInterval(() => { activeSlide = (activeSlide + 1) % total }, 5000)">
    
    @foreach($slides as $index => $slide)
        <div class="absolute inset-0 -z-10 transition-opacity duration-1000 ease-in-out"
             x-show="activeSlide === {{ $index }}"
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0 transform scale-105"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-1000"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-105">
            
             <img src="{{ $slide['image'] }}" alt="Hero Background" class="h-full w-full object-cover" />
             <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-transparent to-black/60 md:to-transparent"></div>
        </div>
    @endforeach

    <div class="relative mx-auto max-w-[120rem] px-4 sm:px-6 lg:px-8 h-full flex flex-col justify-center md:block md:pt-20">
        
        <div class="flex justify-center md:justify-end">
            <x-home.search-form />
        </div>

        <div class="mt-8 md:mt-0 md:absolute md:bottom-20 md:left-8 max-w-4xl">
            @foreach($slides as $index => $slide)
                <h1 x-show="activeSlide === {{ $index }}"
                    x-transition:enter="transition ease-out duration-700 delay-300"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="text-4xl sm:text-5xl md:text-6xl leading-tight font-extrabold text-white drop-shadow-md">
                    {!! $slide['title'] !!}
                </h1>
            @endforeach
        </div>
        
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 md:left-8 md:translate-x-0 flex gap-2">
            @foreach($slides as $index => $slide)
                <button @click="activeSlide = {{ $index }}" 
                        :class="activeSlide === {{ $index }} ? 'w-8 bg-brand-yellow' : 'w-2 bg-white/50'"
                        class="h-2 rounded-full transition-all duration-300"></button>
            @endforeach
        </div>
    </div>
</section>