@props(['inspirations'])

<section class="mx-auto max-w-[120rem] px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Inspirasi untuk liburanmu selanjutnya</h2>
        <p class="text-slate-500">Cek inspirasi liburan di Indonesia maupun luar negeri, yuk!</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($inspirations as $item)
        <a href="{{ route('inspiration.detail', $item->slug) }}" class="group relative rounded-2xl overflow-hidden aspect-square block">
            <img src="{{ $item->image }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-6">
                <h3 class="text-xl font-bold text-white leading-tight group-hover:underline">
                    {{ $item->title }}
                </h3>
            </div>
        </a>
        @endforeach
    </div>
</section>