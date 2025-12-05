@props(['hotel'])

@php
    // Ambil array gambar, jika null pakai array kosong
    $images = $hotel->images ?? [];
    
    // Helper untuk mengambil gambar atau placeholder jika index tidak ada
    $img1 = $images[0] ?? 'https://via.placeholder.com/800x600?text=No+Image';
    $img2 = $images[1] ?? $images[0] ?? 'https://via.placeholder.com/400x300';
    $img3 = $images[2] ?? $images[0] ?? 'https://via.placeholder.com/400x300';
    $img4 = $images[3] ?? $images[0] ?? 'https://via.placeholder.com/400x300';
@endphp

<div class="mb-6">
    <p class="text-sm text-slate-500 mb-2">
        <a href="{{ route('home') }}" class="hover:underline">Home</a> > 
        {{ $hotel->city }} > 
        <span class="text-slate-900 font-semibold">{{ $hotel->name }}</span>
    </p>

    <div class="flex flex-col md:flex-row justify-between items-start mb-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-slate-900">{{ $hotel->name }}</h1>
            <div class="flex items-center gap-2 mt-2">
                <span class="bg-slate-100 text-slate-600 text-xs px-2 py-1 rounded font-medium">Hotel</span>
                <div class="flex text-yellow-400 text-xs">
                    @for($i=0; $i<$hotel->stars; $i++) <i class="fa-solid fa-star"></i> @endfor
                </div>
                <span class="text-slate-500 text-sm flex items-center gap-1">
                    <i class="fa-solid fa-location-dot"></i> {{ $hotel->city }}
                </span>
            </div>
        </div>
        <div class="mt-4 md:mt-0 flex flex-col md:items-end w-full md:w-auto">
             <div class="text-left md:text-right">
                <p class="text-sm text-slate-400 line-through">IDR {{ number_format($hotel->original_price, 0, ',', '.') }}</p>
                <p class="text-2xl font-bold text-rose-600">IDR {{ number_format($hotel->price, 0, ',', '.') }}</p>
                <p class="text-xs text-slate-500">/kamar/malam (Termasuk Pajak)</p>
            </div>
            <button class="mt-3 bg-brand-blue text-white px-6 py-3 rounded-xl font-bold shadow hover:bg-blue-700 w-full md:w-auto transition">
                Pilih Kamar
            </button>
        </div>
    </div>

    <div class="grid grid-cols-4 gap-2 h-[300px] md:h-[400px] rounded-2xl overflow-hidden">
        
        <div class="col-span-4 md:col-span-2 relative group">
            <img src="{{ $img1 }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
        </div>
        
        <div class="hidden md:flex col-span-1 flex-col gap-2">
            <div class="h-1/2 overflow-hidden">
                <img src="{{ $img2 }}" class="w-full h-full object-cover transition duration-500 hover:scale-110">
            </div>
            <div class="h-1/2 overflow-hidden">
                <img src="{{ $img3 }}" class="w-full h-full object-cover transition duration-500 hover:scale-110">
            </div>
        </div>

        <div class="hidden md:block col-span-1 relative overflow-hidden group cursor-pointer">
             <img src="{{ $img4 }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
             
             <div class="absolute inset-0 bg-black/30 group-hover:bg-black/40 transition flex items-center justify-center">
                 <button class="bg-white/20 backdrop-blur-md text-white px-4 py-2 rounded-lg font-semibold border border-white/50 text-sm hover:bg-white/30 transition">
                    Lihat Semua Foto
                 </button>
             </div>
        </div>
    </div>
</div>