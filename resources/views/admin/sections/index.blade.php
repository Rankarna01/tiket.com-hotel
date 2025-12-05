<x-layouts.admin>
    <div x-data="sectionManager()">
        
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Manajemen Section Home</h1>
                <p class="text-gray-500 text-sm">Atur section promo dan pilih hotelnya.</p>
            </div>
            <button @click="openCreateModal()" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-700 shadow flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Buat Section Baru
            </button>
        </div>

        <div class="grid grid-cols-1 gap-6 mb-10">
            @foreach($sections as $section)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition group">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg flex items-center justify-center text-xl shadow-sm border
                                {{ $section->theme_color == 'white' ? 'bg-gray-50 text-slate-600 border-gray-200' : 'bg-orange-100 text-orange-600 border-orange-200' }}">
                                <i class="{{ $section->icon }}"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-slate-800">{{ $section->title }}</h3>
                                <p class="text-sm text-gray-500">
                                    <span class="capitalize font-semibold text-blue-600">{{ $section->theme_color }}</span> • 
                                    {{ $section->hotels->count() }} Hotel
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-2 opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity">
                            <button @click='openEditModal(@json($section))' class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-sm font-semibold hover:bg-blue-100 transition">
                                Edit
                            </button>
                            
                            <form action="{{ route('admin.sections.destroy', $section->id) }}" method="POST" onsubmit="return confirm('Hapus section ini?')">
                                @csrf @method('DELETE')
                                <button class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-sm font-semibold hover:bg-red-100 transition">Hapus</button>
                            </form>
                        </div>
                    </div>
                    
                    @if($section->locations)
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach($section->locations as $loc)
                            <span class="px-2 py-1 bg-gray-50 border border-gray-100 rounded text-xs text-gray-500">{{ $loc }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @endforeach

            @if($sections->isEmpty())
                <div class="text-center py-10 text-gray-400 bg-white rounded-xl border border-dashed border-gray-300">
                    <i class="fa-regular fa-folder-open text-4xl mb-2"></i>
                    <p>Belum ada section promo dibuat.</p>
                </div>
            @endif
        </div>

        <div x-show="isOpen" x-cloak 
             class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <div class="bg-white w-full max-w-4xl rounded-2xl shadow-2xl overflow-hidden max-h-[90vh] flex flex-col"
                 @click.away="isOpen = false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0">

                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                    <div>
                        <h3 class="text-xl font-bold text-slate-800" x-text="isEdit ? 'Edit Section' : 'Buat Section Baru'"></h3>
                    </div>
                    <button @click="isOpen = false" class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-500 hover:text-red-500 transition">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto p-6 custom-scrollbar">
                    <form :action="formAction" method="POST" id="sectionForm">
                        @csrf
                        <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            
                            <div class="space-y-5">
                                <h4 class="font-bold text-gray-700 border-b pb-2 mb-4">1. Tampilan Section</h4>
                                
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Judul Section</label>
                                    <input type="text" name="title" x-model="form.title" class="w-full border rounded-lg px-3 py-2 outline-none focus:border-blue-500" required placeholder="Contoh: Promoted Stay">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Subtitle (Opsional)</label>
                                    <input type="text" name="subtitle" x-model="form.subtitle" class="w-full border rounded-lg px-3 py-2 outline-none focus:border-blue-500" placeholder="Deskripsi pendek...">
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold mb-1">Tema Warna</label>
                                        <select name="theme_color" x-model="form.theme_color" class="w-full border rounded-lg px-3 py-2 bg-white outline-none">
                                            <option value="orange">Orange (Promo)</option>
                                            <option value="white">Putih (Clean)</option>
                                            <option value="blue">Biru (Info)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-1">Icon (FontAwesome)</label>
                                        <div class="relative">
                                            <input type="text" name="icon" x-model="form.icon" class="w-full border rounded-lg pl-10 pr-3 py-2 outline-none" placeholder="fa-solid fa-hotel">
                                            <div class="absolute left-3 top-2.5 text-gray-400">
                                                <i :class="form.icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Waktu Berakhir (Countdown)</label>
                                    <input type="datetime-local" name="end_time" x-model="form.end_time" class="w-full border rounded-lg px-3 py-2 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Chips Lokasi (Pisahkan koma)</label>
                                    <input type="text" name="locations" x-model="form.locations" class="w-full border rounded-lg px-3 py-2 outline-none" placeholder="Bali, Bandung, Jakarta">
                                </div>
                            </div>

                            <div class="flex flex-col h-full">
                                <h4 class="font-bold text-gray-700 border-b pb-2 mb-4">2. Pilih Hotel</h4>
                                
                                <div class="flex-1 overflow-y-auto border rounded-xl p-1 bg-gray-50 max-h-[400px]">
                                    @foreach($hotels as $hotel)
                                    <div class="flex items-center justify-between p-3 mb-1 bg-white border border-gray-100 rounded-lg hover:border-blue-300 transition group">
                                        <div class="flex items-center gap-3">
                                            <input type="checkbox" 
                                                   name="hotels[{{ $hotel->id }}][selected]" 
                                                   value="1" 
                                                   id="hotel_{{ $hotel->id }}"
                                                   class="hotel-checkbox w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500 cursor-pointer">
                                            
                                            <label for="hotel_{{ $hotel->id }}" class="cursor-pointer select-none">
                                                <p class="font-bold text-slate-800 text-sm">{{ $hotel->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $hotel->city }}</p>
                                            </label>
                                        </div>
                                        
                                        <div>
                                            <input type="text" 
                                                   name="hotels[{{ $hotel->id }}][tag]" 
                                                   id="tag_{{ $hotel->id }}"
                                                   class="hotel-tag text-xs border border-gray-200 rounded px-2 py-1 w-28 outline-none focus:border-blue-400 focus:bg-blue-50 transition" 
                                                   placeholder="Tag (opsional)">
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                    @if($hotels->isEmpty())
                                        <p class="text-center text-sm text-gray-400 py-4">Belum ada data hotel.</p>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="p-6 border-t border-gray-100 bg-gray-50 flex justify-end gap-3">
                    <button type="button" @click="isOpen = false" class="px-5 py-2.5 text-slate-600 font-medium hover:bg-gray-200 rounded-xl transition">Batal</button>
                    <button type="submit" form="sectionForm" class="px-5 py-2.5 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition">
                        <span x-text="isEdit ? 'Update Section' : 'Simpan Section'"></span>
                    </button>
                </div>

            </div>
        </div>

    </div>

    <script>
        function sectionManager() {
            return {
                isOpen: false,
                isEdit: false,
                formAction: '',
                form: {
                    title: '',
                    subtitle: '',
                    theme_color: 'orange',
                    icon: 'fa-solid fa-hotel',
                    end_time: '',
                    locations: ''
                },
                
                resetForm() {
                    this.form = {
                        title: '',
                        subtitle: '',
                        theme_color: 'orange',
                        icon: 'fa-solid fa-hotel',
                        end_time: '',
                        locations: ''
                    };
                    document.querySelectorAll('.hotel-checkbox').forEach(el => el.checked = false);
                    document.querySelectorAll('.hotel-tag').forEach(el => el.value = '');
                },

                openCreateModal() {
                    this.isEdit = false;
                    this.formAction = "{{ route('admin.sections.store') }}";
                    this.resetForm();
                    this.isOpen = true;
                },

                openEditModal(section) {
                    this.isEdit = true;
                    this.formAction = "{{ route('admin.sections.index') }}/" + section.id;
                    
                    this.form.title = section.title;
                    this.form.subtitle = section.subtitle;
                    this.form.theme_color = section.theme_color;
                    this.form.icon = section.icon;
                    this.form.end_time = section.end_time ? section.end_time.replace(' ', 'T') : ''; 
                    this.form.locations = section.locations ? section.locations.join(', ') : '';

                    document.querySelectorAll('.hotel-checkbox').forEach(el => el.checked = false);
                    document.querySelectorAll('.hotel-tag').forEach(el => el.value = '');

                    if(section.hotels) {
                        section.hotels.forEach(hotel => {
                            let checkbox = document.getElementById('hotel_' + hotel.id);
                            let tagInput = document.getElementById('tag_' + hotel.id);
                            
                            if(checkbox) checkbox.checked = true;
                            if(tagInput && hotel.pivot && hotel.pivot.tag) tagInput.value = hotel.pivot.tag;
                        });
                    }
                    this.isOpen = true;
                }
            }
        }
    </script>
</x-layouts.admin>