<x-layouts.admin>
    <div x-data="promoManager()">
        
        <div class="flex justify-between items-center mb-6">
            <div>
                
            </div>
            <button @click="openCreateModal()" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-700 shadow flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Buat Promo Baru
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            @foreach($promos as $promo)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden group hover:shadow-md transition">
                <div class="h-40 bg-gray-100 relative overflow-hidden">
                    <img src="{{ $promo->image }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
                        <button @click='openEditModal(@json($promo), @json($promo->hotels->pluck("id")))' class="bg-white text-blue-600 px-3 py-1 rounded text-sm font-bold hover:bg-blue-50">Edit</button>
                        <form action="{{ route('admin.promos.destroy', $promo->id) }}" method="POST" onsubmit="return confirm('Hapus promo ini?')">
                            @csrf @method('DELETE')
                            <button class="bg-red-600 text-white px-3 py-1 rounded text-sm font-bold hover:bg-red-700">Hapus</button>
                        </form>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded uppercase tracking-wider">
                            {{ $promo->promo_code ?? 'Tanpa Kode' }}
                        </span>
                        <span class="text-xs text-slate-500">{{ $promo->created_at->format('d M Y') }}</span>
                    </div>
                    <h3 class="font-bold text-slate-800 line-clamp-1">{{ $promo->title }}</h3>
                    <p class="text-sm text-slate-500 line-clamp-1">{{ $promo->discount_text }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div x-show="isOpen" x-cloak 
             class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4"
             x-transition.opacity>
            
            <div class="bg-white w-full max-w-4xl rounded-2xl shadow-2xl overflow-hidden max-h-[90vh] flex flex-col"
                 @click.away="isOpen = false">

                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                    <h3 class="text-xl font-bold text-slate-800" x-text="isEdit ? 'Edit Promo' : 'Buat Promo Baru'"></h3>
                    <button @click="isOpen = false" class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-xmark text-xl"></i></button>
                </div>

                <div class="flex-1 overflow-y-auto p-6 custom-scrollbar">
                    <form :action="formAction" method="POST" enctype="multipart/form-data" id="promoForm">
                        @csrf
                        <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Judul Promo</label>
                                    <input type="text" name="title" x-model="form.title" class="w-full border rounded-lg px-3 py-2 outline-none focus:border-blue-500" required>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold mb-1">Teks Diskon</label>
                                        <input type="text" name="discount_text" x-model="form.discount_text" class="w-full border rounded-lg px-3 py-2 outline-none focus:border-blue-500" placeholder="Diskon 40%">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-1">Kode Promo</label>
                                        <input type="text" name="promo_code" x-model="form.promo_code" class="w-full border rounded-lg px-3 py-2 outline-none focus:border-blue-500 font-mono uppercase" placeholder="TIKETNEW">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Deskripsi Singkat</label>
                                    <textarea name="description" x-model="form.description" class="w-full border rounded-lg px-3 py-2 outline-none focus:border-blue-500 h-20"></textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Syarat & Ketentuan (HTML Support)</label>
                                    <textarea name="terms" x-model="form.terms" class="w-full border rounded-lg px-3 py-2 outline-none focus:border-blue-500 h-32" placeholder="<li>Promo berlaku...</li>"></textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Banner Gambar</label>
                                    <input type="file" name="image" class="w-full border rounded-lg p-2 text-sm">
                                    <p class="text-xs text-gray-400 mt-1">Format JPG/PNG, Max 2MB.</p>
                                </div>
                            </div>

                            <div class="flex flex-col h-full">
                                <h4 class="font-bold text-gray-700 border-b pb-2 mb-4">Rekomendasi Hotel (Opsional)</h4>
                                <div class="flex-1 overflow-y-auto border rounded-xl p-2 bg-gray-50 max-h-[400px]">
                                    @foreach($hotels as $hotel)
                                    <label class="flex items-center gap-3 p-3 mb-1 bg-white border border-gray-100 rounded-lg hover:border-blue-300 transition cursor-pointer">
                                        <input type="checkbox" name="hotels[]" value="{{ $hotel->id }}" class="hotel-checkbox w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm">{{ $hotel->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $hotel->city }}</p>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="p-6 border-t border-gray-100 bg-gray-50 flex justify-end gap-3">
                    <button type="button" @click="isOpen = false" class="px-5 py-2.5 text-slate-600 font-medium hover:bg-gray-200 rounded-xl transition">Batal</button>
                    <button type="submit" form="promoForm" class="px-5 py-2.5 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow transition">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function promoManager() {
            return {
                isOpen: false,
                isEdit: false,
                formAction: '',
                form: { title: '', discount_text: '', promo_code: '', description: '', terms: '' },
                
                resetForm() {
                    this.form = { title: '', discount_text: '', promo_code: '', description: '', terms: '' };
                    document.querySelectorAll('.hotel-checkbox').forEach(el => el.checked = false);
                },

                openCreateModal() {
                    this.isEdit = false;
                    this.formAction = "{{ route('admin.promos.store') }}";
                    this.resetForm();
                    this.isOpen = true;
                },

                openEditModal(promo, selectedHotels) {
                    this.isEdit = true;
                    this.formAction = "{{ route('admin.promos.index') }}/" + promo.id;
                    this.form = { ...promo }; // Spread existing data
                    
                    // Centang hotel yang sudah terpilih
                    document.querySelectorAll('.hotel-checkbox').forEach(el => el.checked = false);
                    selectedHotels.forEach(id => {
                        let checkbox = document.querySelector(`.hotel-checkbox[value="${id}"]`);
                        if(checkbox) checkbox.checked = true;
                    });

                    this.isOpen = true;
                }
            }
        }
    </script>
</x-layouts.admin>