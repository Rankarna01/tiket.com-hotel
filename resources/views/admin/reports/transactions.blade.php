<x-layouts.admin>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Riwayat Transaksi</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 border-b border-slate-200 font-bold uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">Kode Booking</th>
                    <th class="px-6 py-4">Pelanggan</th>
                    <th class="px-6 py-4">Hotel</th>
                    <th class="px-6 py-4">Total Bayar</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($bookings as $book)
                <tr class="hover:bg-blue-50/50 transition">
                    <td class="px-6 py-4 font-mono font-bold text-slate-700">{{ $book->booking_code }}</td>
                    <td class="px-6 py-4">
                        <p class="font-bold">{{ $book->customer_name }}</p>
                        <p class="text-xs text-slate-400">{{ $book->customer_email }}</p>
                    </td>
                    <td class="px-6 py-4">{{ $book->hotel->name }}</td>
                    <td class="px-6 py-4 font-bold">IDR {{ number_format($book->total_price) }}</td>
                    <td class="px-6 py-4">
                        @if($book->status == 'paid')
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-bold">Sukses</span>
                        @elseif($book->status == 'unpaid')
                            <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-bold">Pending</span>
                        @else
                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-bold">Batal</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $book->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.admin>