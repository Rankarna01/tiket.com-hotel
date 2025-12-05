<x-layouts.app>
    <div class="max-w-4xl mx-auto px-4 py-10">
        <a href="{{ route('home') }}" class="text-brand-blue font-semibold hover:underline mb-4 inline-block">&larr; Kembali ke Home</a>
        
        <div class="rounded-2xl overflow-hidden shadow-lg h-64 md:h-80 w-full mb-8 relative">
            <img src="{{ $detail['image'] }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white">{{ $detail['title'] }}</h1>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100">
            <h2 class="text-2xl font-bold text-slate-800 mb-4">Tentang Promo Ini</h2>
            <p class="text-slate-600 leading-relaxed text-lg">
                {{ $detail['description'] }}
            </p>
            <p class="mt-4 text-slate-600">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
        </div>
    </div>
</x-layouts.app>