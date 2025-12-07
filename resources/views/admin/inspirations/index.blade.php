<x-layouts.admin>
    <div x-data="{ isOpen: false }">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Inspirasi Liburan</h1>
            <button @click="isOpen = true" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-700">
                + Tambah Inspirasi
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($inspirations as $item)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <img src="{{ $item->image }}" class="w-full h-40 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-slate-800 line-clamp-1">{{ $item->title }}</h3>
                    <p class="text-xs text-slate-500 mt-1">{{ $item->hotels->count() }} Hotel Terkait</p>
                    <form action="{{ route('admin.inspirations.destroy', $item->id) }}" method="POST" class="mt-3">
                        @csrf @method('DELETE')
                        <button class="text-red-600 text-sm font-bold hover:underline">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <div x-show="isOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
            <div class="bg-white w-full max-w-2xl rounded-2xl p-6 max-h-[90vh] overflow-y-auto" @click.away="isOpen = false">
                <h3 class="text-xl font-bold mb-4">Tambah Inspirasi</h3>
                <form action="{{ route('admin.inspirations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold mb-1">Judul</label>
                        <input type="text" name="title" class="w-full border rounded p-2" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold mb-1">Thumbnail (Home)</label>
                            <input type="file" name="image" class="w-full border rounded p-2 text-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-1">Banner (Detail)</label>
                            <input type="file" name="banner_image" class="w-full border rounded p-2 text-sm" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Deskripsi Artikel</label>
                        <textarea name="description" class="w-full border rounded p-2 h-24" required></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Pilih Hotel Rekomendasi</label>
                        <div class="h-32 overflow-y-auto border rounded p-2 grid grid-cols-2 gap-2">
                            @foreach($hotels as $hotel)
                            <label class="flex items-center gap-2 text-sm">
                                <input type="checkbox" name="hotels[]" value="{{ $hotel->id }}"> {{ $hotel->name }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Gambar Bawah (Opsional)</label>
                        <input type="file" name="bottom_image" class="w-full border rounded p-2 text-sm">
                    </div>
                    <button class="w-full bg-blue-600 text-white font-bold py-2 rounded">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>