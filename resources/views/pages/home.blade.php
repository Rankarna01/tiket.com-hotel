<x-layouts.app>
    
    <script src="//unpkg.com/alpinejs" defer></script>

    <x-home.hero :slides="$heroSlides" />

    <div class="h-8 md:h-6"></div>

<div class="hidden lg:block w-full lg:w-1/3 absolute right-0 top-1/2 -translate-y-1/2 px-8 z-20">
    
    <x-home.search-widget :popularHotels="$popularHotels ?? []" />

</div>
    
    <div class="h-8"></div>

    @if(isset($promoSections[0]))
        <x-home.promo-section :section="$promoSections[0]" />
    @endif

    <div class="py-4">
        <x-home.category-icons />
    </div>

    @if(isset($promoSections[1]))
        <x-home.promo-section :section="$promoSections[1]" />
    @endif

    @foreach($promoSections as $index => $section)
        @if($index > 1) <x-home.promo-section :section="$section" />
        @endif
    @endforeach

    <x-home.promo-banners />

    <x-home.promo-slider :promos="$promos" />

    <x-home.inspiration-section :inspirations="$inspirations" />

    <x-home.location-grid :locations="$locations" />

    <x-home.app-banner />

    <x-home.partner-section :partners="$partners" />
{{-- 
    <div id="special-offer">
        <x-home.special-offer />
    </div> --}}

    <x-home.app-banner2/>
    <div class="h-20"></div>



</x-layouts.app>