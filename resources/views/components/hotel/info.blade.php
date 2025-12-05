@props(['hotel'])

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="md:col-span-2 bg-white rounded-xl p-6 border border-slate-100 shadow-sm">
        <h3 class="text-lg font-bold text-slate-900 mb-3">Tentang Akomodasi</h3>
        <div class="prose prose-sm text-slate-600 leading-relaxed">
            <p>{{ $hotel->description }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm h-fit">
        <h3 class="text-lg font-bold text-slate-900 mb-3">Lokasi</h3>
        
        <div class="rounded-lg overflow-hidden h-40 bg-slate-100 relative mb-3 group cursor-pointer">
             <img src="https://via.placeholder.com/400x200.png?text=Map+View" 
                  class="w-full h-full object-cover group-hover:opacity-80 transition">
             <div class="absolute inset-0 flex items-center justify-center">
                <span class="bg-white px-3 py-1 rounded-full shadow text-xs font-bold text-slate-800">Lihat Peta</span>
             </div>
        </div>
        
        <div class="flex gap-2 items-start text-xs text-slate-500 mb-3">
            <i class="fa-solid fa-location-dot mt-0.5 text-rose-500"></i>
            <p>{{ $hotel->address }}</p>
        </div>
    </div>
</div>