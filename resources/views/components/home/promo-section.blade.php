@props(['section'])

@php
    // 1. Logika Warna Background
    $bgClass = match($section->theme_color) {
        'white' => 'bg-white border border-slate-100', // Putih polos + border tipis
        'blue' => 'bg-gradient-to-b from-blue-100 to-blue-50',
        default => 'bg-gradient-to-b from-orange-200 to-orange-100',
    };
    
    // 2. Logika Warna Tombol "Lihat Semua"
    $btnClass = match($section->theme_color) {
        'white' => 'text-brand-blue bg-blue-50 hover:bg-blue-100',
        default => 'text-brand-blue bg-white/80 hover:bg-white', 
    };

    // 3. Logika Style Chip Lokasi (Agar kontras di background putih/warna)
    $chipBaseClass = $section->theme_color === 'white' 
        ? 'border border-slate-200 bg-white hover:border-brand-blue text-slate-600' 
        : 'bg-white/60 hover:bg-white text-slate-700';
        
    $chipActiveClass = $section->theme_color === 'white'
        ? 'bg-blue-50 border-brand-blue text-brand-blue'
        : 'bg-white text-brand-blue ring-1 ring-blue-100';
@endphp

<section class="mx-auto max-w-[120rem] px-4 sm:px-6 lg:px-8 pb-12">
    <div class="rounded-3xl {{ $bgClass }} p-5 sm:p-6 lg:p-8 shadow-[0_10px_40px_rgba(0,0,0,0.03)]">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1">
                <div class="flex items-center gap-3">
                    @if($section->theme_color !== 'white')
                        <span class="grid place-items-center w-10 h-10 rounded-xl bg-white/70 shadow-sm text-slate-800">
                            <i class="{{ $section->icon }} text-xl"></i>
                        </span>
                    @endif
                    <h3 class="text-2xl font-extrabold text-slate-900 leading-tight">
                        {{ $section->title }}
                    </h3>
                </div>
                
                @if(isset($section->subtitle) && $section->subtitle)
                    <p class="text-slate-500 text-sm md:text-base font-medium">
                        {{ $section->subtitle }}
                    </p>
                @endif
            </div>

            @if($section->end_time)
                <div class="flex items-center gap-2 text-slate-800"
                     x-data="timer('{{ $section->end_time }}')"
                     x-init="init()">
                    <span class="text-sm font-medium">Berakhir dalam</span>
                    <div class="flex items-center gap-1">
                        <span class="inline-flex w-10 justify-center rounded-lg bg-yellow-300 px-2 py-1 text-sm font-bold shadow-sm" x-text="hours">00</span>
                        <span class="font-bold">:</span>
                        <span class="inline-flex w-10 justify-center rounded-lg bg-yellow-300 px-2 py-1 text-sm font-bold shadow-sm" x-text="minutes">00</span>
                        <span class="font-bold">:</span>
                        <span class="inline-flex w-10 justify-center rounded-lg bg-yellow-300 px-2 py-1 text-sm font-bold shadow-sm" x-text="seconds">00</span>
                    </div>
                </div>
            @endif
        </div>

        <div class="mt-6 flex flex-wrap gap-3">
            @if($section->locations)
                @foreach($section->locations as $index => $loc)
                    <button class="px-5 py-2 rounded-full text-sm font-semibold shadow-sm transition-all hover:scale-105 {{ $index === 0 ? $chipActiveClass : $chipBaseClass }}">
                        {{ $loc }}
                    </button>
                @endforeach
            @endif
        </div>

        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($section->hotels as $hotel)
                <article class="group rounded-2xl bg-white overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="relative h-48 overflow-hidden">
                        <img class="h-full w-full object-cover group-hover:scale-110 transition duration-700"
                             src="{{ $hotel->images[0] ?? 'https://via.placeholder.com/400x300' }}"
                             alt="{{ $hotel->name }}" />
                        
                        @if($hotel->pivot->tag)
                            <div class="absolute top-3 left-3 flex gap-2">
                                <div class="text-[10px] uppercase tracking-wider font-bold bg-white/95 px-2 py-1 rounded shadow-sm text-slate-800">
                                    {{ $hotel->pivot->tag }}
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="p-4">
                        <a href="{{ route('hotel.detail', $hotel->slug) }}" class="block text-slate-900 font-bold leading-snug hover:text-brand-blue transition line-clamp-2 min-h-[3rem]">
                            {{ $hotel->name }}
                        </a>
                        
                        <div class="mt-2 flex items-center gap-1">
                            <div class="flex text-yellow-400 text-xs">
                                @for($i=0; $i<5; $i++)
                                    <i class="fa-solid fa-star {{ $i < floor($hotel->stars) ? '' : 'text-slate-200' }}"></i>
                                @endfor
                            </div>
                            <span class="text-xs font-medium text-slate-500">
                                {{ $hotel->rating }}/5 ({{ number_format($hotel->total_reviews, 0, ',', '.') }})
                            </span>
                        </div>

                        <p class="mt-1 text-sm text-slate-600 flex items-center gap-1">
                             <i class="fa-solid fa-location-dot text-slate-400 text-xs"></i> {{ $hotel->city }}
                        </p>

                        <div class="mt-4 pt-3 border-t border-slate-50">
                            <p class="text-xs text-slate-400 line-through">
                                IDR {{ number_format($hotel->original_price, 0, ',', '.') }}
                            </p>
                            <div class="flex items-end justify-between">
                                <p class="text-lg text-rose-600 font-extrabold leading-none">
                                    IDR {{ number_format($hotel->price, 0, ',', '.') }}
                                </p>
                                <p class="text-[10px] text-slate-400">/malam</p>
                            </div>
                            <p class="text-[10px] text-slate-400 mt-0.5">Termasuk pajak</p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-10 flex justify-center">
           <a href="{{ route('hotels.list') }}" 
   class="inline-flex items-center justify-center rounded-xl backdrop-blur px-8 py-3 {{ $btnClass ?? 'bg-blue-600 text-white hover:bg-blue-700' }} font-bold shadow-sm transition-all">
    Lihat semua
</a>
        </div>
    </div>
</section>