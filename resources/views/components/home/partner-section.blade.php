@props(['partners'])

<section class="mx-auto max-w-[120rem] px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-900">Partner hotel resmi dan terpercaya</h2>
        <p class="text-slate-500 mt-1">Siap memberimu pengalaman nginep yang seru.</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 sm:gap-6">
        
        @foreach($partners->take(6) as $p)
        <a href="{{ route('partner.detail', $p->slug) }}" 
           class="group flex items-center justify-center w-full aspect-[4/3] bg-white border border-slate-100 rounded-2xl shadow-sm hover:shadow-lg hover:-translate-y-1 hover:border-blue-100 transition-all duration-300 p-6">
            
            <img src="{{ $p->logo }}" 
                 alt="{{ $p->name }}" 
                 class="w-full h-full object-contain filter grayscale opacity-80 group-hover:grayscale-0 group-hover:opacity-100 transition duration-300">
        
        </a>
        @endforeach

    </div>
</section>