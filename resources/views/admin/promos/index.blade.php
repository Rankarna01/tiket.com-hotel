<x-layouts.admin>
    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">List Promo</h1>
        <a href="{{ route('admin.promos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Promo</a>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-4 text-left">Promo</th>
                    <th class="p-4 text-left">Kode</th>
                    <th class="p-4 text-left">Diskon</th>
                    <th class="p-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($promos as $promo)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 flex items-center gap-3">
                        <img src="{{ $promo->image }}" class="w-16 h-10 object-cover rounded">
                        <span>{{ $promo->title }}</span>
                    </td>
                    <td class="p-4"><span class="bg-gray-100 px-2 py-1 rounded text-sm font-mono">{{ $promo->promo_code ?? '-' }}</span></td>
                    <td class="p-4 font-bold text-green-600">{{ $promo->discount_text }}</td>
                    <td class="p-4 text-right space-x-2">
                        <a href="{{ route('admin.promos.edit', $promo->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.promos.destroy', $promo->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.admin>