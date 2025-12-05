@props(['histories'])

<section class="mx-auto max-w-[120rem] px-4 sm:px-6 lg:px-8 -mt-8 relative z-20 md:mt-10">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-lg font-semibold text-slate-800">
        Riwayat Pencarianmu
      </h2>
      <button class="text-sm font-medium text-brand-blue hover:underline">
        Hapus semua
      </button>
    </div>

    <div class="flex flex-wrap gap-3">
        @foreach($histories as $history)
            <a href="#" class="group inline-flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-3 py-2 shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5">
                <div class="w-10 h-10 overflow-hidden rounded-xl bg-slate-200">
                    <img class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                        src="{{ $history['image'] }}"
                        alt="{{ $history['location'] }}" />
                </div>
                <div class="min-w-0 pr-2">
                    <p class="text-sm font-semibold text-slate-900 truncate">
                        {{ $history['location'] }}
                    </p>
                    <p class="text-[12px] text-slate-500 truncate">
                        @if($history['date'])
                            {{ $history['date'] }} • {{ $history['guests'] }}
                        @else
                            {{ $history['sub_location'] ?? 'Destinasi Populer' }}
                        @endif
                    </p>
                </div>
            </a>
        @endforeach
    </div>
</section>