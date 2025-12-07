@props(['partners'])

<section class="mx-auto max-w-[120rem] px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Partner hotel resmi dan terpercaya</h2>
        <p class="text-slate-500">Siap memberimu pengalaman nginep yang seru.</p>
    </div>

    <div class="flex gap-4 overflow-x-auto pb-4 hide-scrollbar">
        @foreach($partners as $p)
        <a href="{{ route('partner.detail', $p->slug) }}" class="min-w-[160px] h-24 bg-white border border-slate-200 rounded-xl flex items-center justify-center p-4 hover:shadow-md hover:border-blue-200 transition">
            <img src="{{ $p->logo }}" alt="{{ $p->name }}" class="max-h-12 max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
        </a>
        @endforeach
    </div>
</section>