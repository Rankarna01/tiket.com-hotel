<x-layouts.app>
    <div class="bg-gray-50 min-h-screen py-10 font-poppins">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <h1 class="text-2xl font-bold text-slate-800 mb-6">Riwayat Pesanan Anda</h1>

            <div class="space-y-4">
                @forelse($bookings as $book)
                <div class="bg-white border border-slate-200 rounded-2xl p-5 flex flex-col md:flex-row gap-6 hover:shadow-md transition">
                    <div class="w-full md:w-48 h-32 flex-shrink-0 rounded-xl overflow-hidden bg-gray-100">
                        <img src="{{ $book->hotel->images[0] ?? '' }}" class="w-full h-full object-cover">
                    </div>

                    <div class="flex-1">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="text-xs text-slate-400 mb-1">Order ID: {{ $book->booking_code }}</p>
                                <h3 class="text-lg font-bold text-slate-800">{{ $book->hotel->name }}</h3>
                            </div>
                            
                            @if($book->status == 'paid')
                                <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">Berhasil</span>
                            @elseif($book->status == 'unpaid')
                                <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-3 py-1 rounded-full">Menunggu Pembayaran</span>
                            @else
                                <span class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full">Dibatalkan</span>
                            @endif
                        </div>

                        <p class="text-sm text-slate-500 mb-4">
                            {{ \Carbon\Carbon::parse($book->check_in)->format('d M Y') }} 
                            <i class="fa-solid fa-arrow-right text-xs mx-1"></i>
                            {{ \Carbon\Carbon::parse($book->check_out)->format('d M Y') }}
                        </p>

                        <div class="flex justify-between items-end border-t border-slate-100 pt-4">
                            <div>
                                <p class="text-xs text-slate-400">Total Harga</p>
                                <p class="font-bold text-slate-800">IDR {{ number_format($book->total_price) }}</p>
                            </div>
                            
                            @if($book->status == 'paid')
                                <button onclick="window.location.href='{{ route('booking.success') }}?order_id={{ $book->booking_code }}'" 
                                   class="text-blue-600 font-bold text-sm hover:underline">
                                    Lihat E-Tiket
                                </button>
                            @elseif($book->status == 'unpaid')
                                <a href="{{ route('booking.checkout', $book->hotel->slug) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-xs font-bold">
                                    Bayar Sekarang
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-16 bg-white rounded-2xl border border-dashed border-slate-300">
                    <i class="fa-regular fa-folder-open text-4xl text-slate-300 mb-3"></i>
                    <p class="text-slate-500">Belum ada riwayat pesanan.</p>
                    <a href="{{ route('home') }}" class="text-blue-600 font-bold text-sm mt-2 block hover:underline">Cari Hotel Dulu Yuk</a>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</x-layouts.app>