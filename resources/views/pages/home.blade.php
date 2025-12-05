<x-layouts.app>
    
    <script src="//unpkg.com/alpinejs" defer></script>

    <x-home.hero :slides="$heroSlides" />

    <div class="h-8 md:h-6"></div>

    <x-home.search-history :histories="$searchHistory" />
    
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
    <div class="h-20"></div>

</x-layouts.app>