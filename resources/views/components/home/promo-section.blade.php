@props(['section'])

@php
    // 1. Logika Warna Background (Lebih Soft & Modern)
    $bgClass = match($section->theme_color) {
        'white' => 'bg-white border border-slate-100',
        'blue' => 'bg-gradient-to-br from-blue-50 via-white to-blue-50/30',
        default => 'bg-gradient-to-br from-orange-50 via-white to-orange-50/30',
    };
    
    // 2. Logika Warna Tombol "Lihat Semua"
    $btnClass = match($section->theme_color) {
        'white' => 'text-blue-600 bg-blue-50 hover:bg-blue-600 hover:text-white',
        default => 'text-blue-600 bg-white shadow-sm hover:bg-blue-600 hover:text-white', 
    };

    // 3. Logika Style Chip Lokasi
    $chipBaseClass = $section->theme_color === 'white' 
        ? 'bg-slate-50 border border-slate-200 text-slate-600 hover:border-blue-400 hover:text-blue-600' 
        : 'bg-white/80 backdrop-blur-sm text-slate-700 hover:bg-white hover:text-blue-600';
        
    $chipActiveClass = 'bg-blue-600 text-white shadow-md shadow-blue-200 ring-2 ring-blue-100';
@endphp

<section class="mx-auto max-w-[120rem] px-4 sm:px-6 lg:px-8 pb-16">
    <div class="rounded-[2.5rem] {{ $bgClass }} p-6 sm:p-8 lg:p-12 shadow-[0_20px_50px_rgba(0,0,0,0.04)]">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-3">
                <div class="flex items-center gap-4">
                    @if($section->theme_color !== 'white')
                        <span class="flex items-center justify-center w-12 h-12 rounded-2xl bg-white shadow-sm border border-slate-100 text-blue-600">
                            <i class="{{ $section->icon }} text-2xl"></i>
                        </span>
                    @endif
                    <div>
                        <h3 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                            {{ $section->title }}
                        </h3>
                        @if(isset($section->subtitle) && $section->subtitle)
                            <p class="text-slate-500 text-base md:text-lg font-medium mt-1">
                                {{ $section->subtitle }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            @if($section->end_time)
                <div class="flex flex-col items-end gap-2" x-data="timer('{{ $section->end_time }}')" x-init="init()">
                    <span class="text-xs font-bold uppercase tracking-widest text-slate-400">🔥 Berakhir dalam</span>
                    <div class="flex items-center gap-2">
                        <div class="flex flex-col items-center">
                            <span class="flex w-11 h-11 items-center justify-center rounded-xl bg-slate-900 text-white text-lg font-black shadow-lg" x-text="hours">00</span>
                        </div>
                        <span class="font-black text-slate-900">:</span>
                        <div class="flex flex-col items-center">
                            <span class="flex w-11 h-11 items-center justify-center rounded-xl bg-slate-900 text-white text-lg font-black shadow-lg" x-text="minutes">00</span>
                        </div>
                        <span class="font-black text-slate-900">:</span>
                        <div class="flex flex-col items-center">
                            <span class="flex w-11 h-11 items-center justify-center rounded-xl bg-rose-600 text-white text-lg font-black shadow-lg animate-pulse" x-text="seconds">00</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="mt-10 flex flex-wrap gap-3">
            @if($section->locations)
                @foreach($section->locations as $index => $loc)
                    <button class="px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300 active:scale-95 {{ $index === 0 ? $chipActiveClass : $chipBaseClass }}">
                        {{ $loc }}
                    </button>
                @endforeach
            @endif
        </div>

        <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($section->hotels as $hotel)
                <article class="group relative bg-white rounded-[2rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] transition-all duration-500 hover:-translate-y-2">
                    
                    <div class="relative h-56 overflow-hidden">
                        <img class="h-full w-full object-cover transform group-hover:scale-110 transition duration-1000"
                             src="{{ $hotel->images[0] ?? 'https://via.placeholder.com/400x300' }}"
                             alt="{{ $hotel->name }}" />
                        
                        <div class="absolute top-4 left-4 flex flex-col gap-2">
                            @if($hotel->pivot->tag)
                                <div class="bg-blue-600/90 backdrop-blur-md text-white text-[10px] font-black uppercase tracking-widest px-3 py-1.5 rounded-lg shadow-lg">
                                    {{ $hotel->pivot->tag }}
                                </div>
                            @endif
                        </div>

                        <button class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white/20 backdrop-blur-md border border-white/30 text-white flex items-center justify-center hover:bg-white hover:text-rose-500 transition-all duration-300">
                            <i class="fa-regular fa-heart text-sm"></i>
                        </button>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="flex text-yellow-400 text-[10px]">
                                @for($i=0; $i<5; $i++)
                                    <i class="fa-solid fa-star {{ $i < floor($hotel->stars) ? '' : 'text-slate-200' }}"></i>
                                @endfor
                            </div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-tighter">
                                • {{ $hotel->rating }} ({{ number_format($hotel->total_reviews, 0, ',', '.') }} Review)
                            </span>
                        </div>

                        <a href="{{ route('hotel.detail', $hotel->slug) }}" class="block text-slate-900 font-extrabold text-lg leading-snug hover:text-blue-600 transition-colors line-clamp-2 min-h-[3.5rem]">
                            {{ $hotel->name }}
                        </a>
                        
                        <p class="mt-2 text-sm text-slate-500 flex items-center gap-1.5 font-medium">
                             <i class="fa-solid fa-location-dot text-blue-500"></i> {{ $hotel->city }}
                        </p>

                        <div class="mt-6 pt-5 border-t border-slate-50 flex items-end justify-between">
                            <div>
                                <p class="text-xs text-slate-400 line-through font-medium mb-1">
                                    IDR {{ number_format($hotel->original_price, 0, ',', '.') }}
                                </p>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-2xl font-black text-rose-600">IDR {{ number_format($hotel->price, 0, ',', '.') }}</span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase">/malam</span>
                                </div>
                            </div>
                            
                            <div class="w-10 h-10 rounded-xl bg-slate-50 group-hover:bg-blue-600 group-hover:text-white flex items-center justify-center transition-all duration-300">
                                <i class="fa-solid fa-arrow-right text-sm"></i>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-14 flex justify-center">
            <a href="{{ route('hotels.list') }}" 
               class="inline-flex items-center gap-3 justify-center rounded-2xl px-10 py-4 {{ $btnClass }} font-black text-sm uppercase tracking-widest transition-all duration-300 transform active:scale-95 border border-transparent shadow-xl">
                Lihat Semua Hotel
                <i class="fa-solid fa-chevron-right text-xs"></i>
            </a>
        </div>
    </div>
</section>