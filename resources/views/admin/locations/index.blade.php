<x-layouts.admin>
    <div x-data="{ 
        isOpen: false, 
        isEdit: false, 
        actionUrl: '', 
        form: { name: '', image_preview: '' } 
    }">
        
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Master Data Wilayah</h1>
                <p class="text-gray-500 text-sm">Kelola daftar kota atau area populer.</p>
            </div>
            <button @click="
                isOpen = true; 
                isEdit = false; 
                actionUrl = '{{ route('admin.locations.store') }}'; 
                form = { name: '', image_preview: '' };
                document.getElementById('locationForm').reset();
            " class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-700 shadow flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Wilayah
            </button>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($locations as $loc)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden group hover:shadow-md transition">
                <div class="h-32 bg-gray-100 relative overflow-hidden">
                    @if($loc->image)
                        <img src="{{ $loc->image }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    @else
                        <div class="flex items-center justify-center h-full text-gray-300">
                            <i class="fa-solid fa-map-location-dot text-4xl"></i>
                        </div>
                    @endif
                    
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition duration-300">
                        <button @click="
                            isOpen = true; 
                            isEdit = true; 
                            actionUrl = '{{ route('admin.locations.update', $loc->id) }}';
                            form.name = '{{ $loc->name }}';
                            form.image_preview = '{{ $loc->image }}';
                        " class="w-8 h-8 rounded-full bg-white text-blue-600 flex items-center justify-center hover:bg-blue-50">
                            <i class="fa-solid fa-pen text-xs"></i>
                        </button>
                        
                        <form action="{{ route('admin.locations.destroy', $loc->id) }}" method="POST" onsubmit="return confirm('Hapus wilayah ini?')">
                            @csrf @method('DELETE')
                            <button class="w-8 h-8 rounded-full bg-white text-red-600 flex items-center justify-center hover:bg-red-50">
                                <i class="fa-solid fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="p-4 text-center">
                    <h3 class="font-bold text-slate-800">{{ $loc->name }}</h3>
                    <p class="text-xs text-slate-500 mt-1">{{ $loc->hotels_count }} Hotel Terdaftar</p>
                </div>
            </div>
            @endforeach
        </div>

        <div x-show="isOpen" x-cloak 
             class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4"
             x-transition.opacity>
            
            <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden"
                 @click.away="isOpen = false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                    <h3 class="text-lg font-bold text-slate-800" x-text="isEdit ? 'Edit Wilayah' : 'Tambah Wilayah Baru'"></h3>
                    <button @click="isOpen = false" class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-xmark text-xl"></i></button>
                </div>

                <div class="p-6">
                    <form :action="actionUrl" method="POST" enctype="multipart/form-data" id="locationForm" class="space-y-4">
                        @csrf
                        <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Wilayah / Kota</label>
                            <input type="text" name="name" x-model="form.name" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Contoh: Yogyakarta" required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Foto Thumbnail (Opsional)</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:bg-gray-50 cursor-pointer relative">
                                <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                                <div class="space-y-1">
                                    <i class="fa-regular fa-image text-gray-400 text-2xl"></i>
                                    <p class="text-xs text-gray-500">Klik untuk upload gambar</p>
                                </div>
                            </div>
                            <template x-if="form.image_preview">
                                <div class="mt-2 text-xs text-green-600 flex items-center gap-1">
                                    <i class="fa-solid fa-check-circle"></i>
                                    <span>Gambar saat ini tersedia</span>
                                </div>
                            </template>
                        </div>

                        <div class="pt-4">
                            <button class="w-full bg-blue-600 text-white font-bold py-2.5 rounded-lg hover:bg-blue-700 shadow transition">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>