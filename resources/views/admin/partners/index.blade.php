<x-layouts.admin>
    <div x-data="{ isOpen: false }">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Partner Hotel</h1>
            <button @click="isOpen = true" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-700">
                + Tambah Partner
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach($partners as $p)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 flex flex-col items-center text-center">
                <img src="{{ $p->logo }}" class="h-16 object-contain mb-4">
                <h3 class="font-bold text-slate-800">{{ $p->name }}</h3>
                <p class="text-xs text-slate-500 mb-4">{{ $p->hotels_count }} Hotel Terkait</p>
                <form action="{{ route('admin.partners.destroy', $p->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="text-red-600 text-xs font-bold hover:underline">Hapus</button>
                </form>
            </div>
            @endforeach
        </div>

        <div x-show="isOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
            <div class="bg-white w-full max-w-md rounded-2xl p-6" @click.away="isOpen = false">
                <h3 class="text-xl font-bold mb-4">Tambah Partner</h3>
                <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="text" name="name" class="w-full border rounded p-2" placeholder="Nama Partner (e.g. Accor)" required>
                    <textarea name="description" class="w-full border rounded p-2" placeholder="Deskripsi singkat"></textarea>
                    
                    <div>
                        <label class="text-xs font-bold block mb-1">Logo (Kecil)</label>
                        <input type="file" name="logo" class="w-full border rounded p-2 text-sm" required>
                    </div>
                    <div>
                        <label class="text-xs font-bold block mb-1">Banner Header (Besar)</label>
                        <input type="file" name="banner_image" class="w-full border rounded p-2 text-sm" required>
                    </div>

                    <button class="w-full bg-blue-600 text-white font-bold py-2 rounded">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>