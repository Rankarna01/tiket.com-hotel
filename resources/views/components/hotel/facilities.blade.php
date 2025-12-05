@props(['facilities'])

<div class="bg-white rounded-xl p-6 border border-slate-100 shadow-sm mb-6">
    <h3 class="text-lg font-bold text-slate-900 mb-4">Fasilitas Populer</h3>
    
    @if($facilities && count($facilities) > 0)
        <div class="grid grid-cols-2 md:grid-cols-4 gap-y-4 gap-x-6">
            @foreach($facilities as $facility)
                <div class="flex items-center gap-3 text-slate-600">
                    <div class="w-6 text-center">
                        <i class="{{ $facility->icon }} text-slate-400 text-lg"></i>
                    </div>
                    <span class="text-sm font-medium text-slate-700">{{ $facility->name }}</span>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-slate-400 text-sm italic">Belum ada info fasilitas.</p>
    @endif
</div>