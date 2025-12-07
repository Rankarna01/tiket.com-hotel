@props(['locations'])

<section class="mx-auto max-w-[120rem] px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Nginep asyik di destinasi favorit</h2>
        <p class="text-slate-500">Saatnya kasih reward ke diri sendiri dengan rileks di hotel berbagai destinasi domestik.</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        @foreach($locations->take(6) as $loc)
        <a href="{{ route('location.detail', $loc->slug) }}" class="group relative rounded-xl overflow-hidden aspect-[3/4] cursor-pointer">
            <img src="{{ $loc->image ?? 'https://via.placeholder.com/300x400?text='.$loc->name }}" 
                 alt="{{ $loc->name }}" 
                 class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
            
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
            
            <div class="absolute bottom-4 left-4">
                <h3 class="text-white font-bold text-lg group-hover:underline decoration-white underline-offset-4">
                    {{ $loc->name }}
                </h3>
            </div>
        </a>
        @endforeach
    </div>
</section>