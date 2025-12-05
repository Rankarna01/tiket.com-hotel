<x-layouts.admin>
    <div x-data="{ openModal: false }">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:-translate-y-1 transition duration-300">
                <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 text-2xl">
                    <i class="fa-solid fa-hotel"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Hotel</p>
                    <h4 class="text-2xl font-bold text-gray-800">{{ $hotels->count() }}</h4>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:-translate-y-1 transition duration-300">
                <div class="w-14 h-14 rounded-full bg-orange-50 flex items-center justify-center text-orange-600 text-2xl">
                    <i class="fa-solid fa-star"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Rata-rata Rating</p>
                    <h4 class="text-2xl font-bold text-gray-800">4.8</h4>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:-translate-y-1 transition duration-300">
                <div class="w-14 h-14 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600 text-2xl">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Pengunjung Bulan Ini</p>
                    <h4 class="text-2xl font-bold text-gray-800">1.2K</h4>
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div>
                <h3 class="text-xl font-bold text-slate-800">Daftar Hotel & Akomodasi</h3>
                <p class="text-sm text-gray-500">Kelola data hotel yang tampil di halaman depan.</p>
            </div>
            <button @click="openModal = true" class="bg-blue-600 text-white px-5 py-2.5 rounded-xl font-semibold hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Hotel
            </button>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 text-gray-600 text-xs uppercase font-bold tracking-wider border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4">Nama Properti</th>
                            <th class="px-6 py-4">Lokasi</th>
                            <th class="px-6 py-4">Harga /Malam</th>
                            <th class="px-6 py-4">Fasilitas</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm">
                        @forelse($hotels as $hotel)
                        <tr class="hover:bg-blue-50/50 transition duration-150 group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if(isset($hotel->images) && count($hotel->images) > 0)
                                        <img src="{{ $hotel->images[0] }}" class="w-12 h-12 rounded-lg object-cover shadow-sm border border-gray-200">
                                    @else
                                        <div class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center text-gray-400">
                                            <i class="fa-solid fa-image"></i>
                                        </div>
                                    @endif
                                    
                                    <div>
                                        <span class="font-bold text-slate-800 block">{{ $hotel->name }}</span>
                                        <span class="text-xs text-orange-500 flex items-center gap-1">
                                            @for($i=0; $i<$hotel->stars; $i++) <i class="fa-solid fa-star"></i> @endfor
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                <i class="fa-solid fa-location-dot text-gray-400 mr-1"></i> {{ $hotel->city }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800">Rp {{ number_format($hotel->price) }}</div>
                                <div class="text-xs text-gray-400 line-through">Rp {{ number_format($hotel->original_price) }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($hotel->facilities->take(2) as $fac)
                                        <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md border border-gray-200">
                                            {{ $fac->name }}
                                        </span>
                                    @endforeach
                                    
                                    @if($hotel->facilities->count() > 2)
                                        <span class="px-2 py-1 bg-gray-100 text-gray-500 text-xs rounded-md border border-gray-200">
                                            +{{ $hotel->facilities->count() - 2 }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('hotel.detail', $hotel->slug) }}" target="_blank" class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Lihat">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.hotels.destroy', $hotel->id) }}" method="POST" onsubmit="return confirm('Yakin hapus hotel ini?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center gap-2">
                                    <i class="fa-regular fa-folder-open text-4xl mb-2"></i>
                                    <p>Belum ada data hotel.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="openModal" x-cloak 
             class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden max-h-[90vh] flex flex-col"
                 @click.away="openModal = false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">Tambah Hotel Baru</h3>
                        <p class="text-sm text-gray-500">Lengkapi data properti di bawah ini</p>
                    </div>
                    <button @click="openModal = false" class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-500 hover:text-red-500 hover:border-red-200 transition shadow-sm">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                
                <div class="p-6 overflow-y-auto custom-scrollbar">
                    <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5" id="hotelForm">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Hotel</label>
                            <input type="text" name="name" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 outline-none focus:border-blue-500 transition" required placeholder="Contoh: Labak River Hotel">
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Kota / Area</label>
                                <input type="text" name="city" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 outline-none focus:border-blue-500 transition" required placeholder="Ubud, Bali">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Lengkap</label>
                                <input type="text" name="address" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 outline-none focus:border-blue-500 transition" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Harga Asli (Coret)</label>
                                <input type="number" name="original_price" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 outline-none focus:border-blue-500 transition" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Harga Diskon (Tampil)</label>
                                <input type="number" name="price" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 outline-none focus:border-blue-500 transition" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi</label>
                            <textarea name="description" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 outline-none focus:border-blue-500 transition h-24 resize-none" required></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Fasilitas Hotel</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 p-4 bg-gray-50 rounded-xl border border-gray-200 h-32 overflow-y-auto">
                                @foreach($facilities as $fac)
                                <label class="flex items-center gap-2 cursor-pointer hover:bg-gray-100 p-1 rounded">
                                    <input type="checkbox" name="facilities[]" value="{{ $fac->id }}" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                                    <span class="text-sm text-slate-700"><i class="{{ $fac->icon }} text-gray-400 mr-1"></i> {{ $fac->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Upload Foto Hotel (Max 5)</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:bg-gray-50 transition cursor-pointer relative bg-gray-50">
                                <input type="file" name="hotel_images[]" multiple accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>
                                <div class="space-y-2">
                                    <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-400"></i>
                                    <p class="text-sm text-gray-500 font-medium">Klik untuk upload atau drag & drop</p>
                                    <p class="text-xs text-gray-400">PNG, JPG, WEBP (Max 5 Foto)</p>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="p-6 border-t border-gray-100 bg-gray-50 flex justify-end gap-3">
                    <button type="button" @click="openModal = false" class="px-5 py-2.5 text-slate-600 font-medium hover:bg-gray-200 rounded-xl transition">Batal</button>
                    <button type="submit" form="hotelForm" class="px-5 py-2.5 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition">Simpan Data</button>
                </div>
            </div>
        </div>

    </div>
</x-layouts.admin>