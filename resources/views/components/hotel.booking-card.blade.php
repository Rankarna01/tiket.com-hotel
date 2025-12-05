@props(['hotel'])

<div class="bg-white border border-slate-200 rounded-2xl shadow-lg p-6 sticky top-24">
    <div class="flex items-center justify-between mb-4">
        <div>
            <p class="text-sm text-slate-500 line-through">IDR {{ number_format($hotel->original_price, 0, ',', '.') }}</p>
            <div class="flex items-end gap-1">
                <h3 class="text-2xl font-bold text-rose-600">IDR {{ number_format($hotel->price, 0, ',', '.') }}</h3>
                <span class="text-xs text-slate-500 mb-1">/malam</span>
            </div>
            <p class="text-[10px] text-emerald-600 font-bold mt-1">Termasuk pajak & biaya</p>
        </div>
        <div class="bg-rose-50 text-rose-600 text-xs font-bold px-2 py-1 rounded">
            Diskon 80%
        </div>
    </div>

    <div class="border border-slate-200 rounded-xl mb-4 divide-y divide-slate-200">
        <div class="p-3 hover:bg-slate-50 cursor-pointer transition">
            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wider mb-1">Check-in - Check-out</p>
            <div class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                <i class="fa-regular fa-calendar"></i>
                <span>{{ now()->format('d M') }} - {{ now()->addDay()->format('d M Y') }}</span>
            </div>
        </div>
        <div class="p-3 hover:bg-slate-50 cursor-pointer transition">
            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wider mb-1">Tamu & Kamar</p>
            <div class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                <i class="fa-solid fa-user-group"></i>
                <span>1 Kamar, 2 Tamu</span>
            </div>
        </div>
    </div>

    <div class="space-y-2 mb-6">
        <div class="flex items-center gap-2 text-xs text-slate-600">
            <i class="fa-solid fa-check text-green-500"></i>
            <span>Bisa refund s.d 24 jam sebelum inap</span>
        </div>
        <div class="flex items-center gap-2 text-xs text-slate-600">
            <i class="fa-solid fa-check text-green-500"></i>
            <span>Reschedule tersedia</span>
        </div>
        <div class="flex items-center gap-2 text-xs text-slate-600">
            <i class="fa-solid fa-check text-green-500"></i>
            <span>WiFi kencang gratis</span>
        </div>
    </div>

    <button class="w-full bg-brand-blue text-white font-bold py-3.5 rounded-xl hover:brightness-110 shadow-lg shadow-blue-500/30 transition transform active:scale-[0.98] mb-3">
        Pesan Kamar Ini
    </button>
    
    <button class="w-full bg-white border border-slate-200 text-slate-700 font-bold py-3 rounded-xl hover:bg-slate-50 transition">
        Lihat Kamar Lain
    </button>
</div>