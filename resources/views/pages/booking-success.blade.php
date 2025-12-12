<x-layouts.app>
    <div class="bg-gray-50 min-h-screen py-10 font-poppins">
        <div class="max-w-3xl mx-auto px-4">
            
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 text-green-600 text-3xl">
                    <i class="fa-solid fa-check"></i>
                </div>
                <h1 class="text-2xl font-bold text-slate-800">Pembayaran Berhasil!</h1>
                <p class="text-slate-500">E-Voucher telah terbit. Tunjukkan saat check-in.</p>
            </div>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-200">
                <div class="bg-blue-600 p-6 flex justify-between items-center text-white">
                    <div>
                        <p class="text-xs font-medium opacity-80 uppercase tracking-widest">Kode Booking</p>
                        <h2 class="text-2xl font-mono font-bold tracking-wider">{{ $booking->booking_code }}</h2>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-medium opacity-80">Status</p>
                        <span class="bg-white/20 px-3 py-1 rounded-full text-xs font-bold border border-white/30">
                            LUNAS (PAID)
                        </span>
                    </div>
                </div>

                <div class="p-6 md:p-8">
                    <div class="flex gap-4 mb-8 border-b border-dashed border-slate-200 pb-8">
                        <img src="{{ $booking->hotel->images[0] ?? '' }}" class="w-24 h-24 rounded-xl object-cover bg-gray-200">
                        <div>
                            <h3 class="text-xl font-bold text-slate-800 mb-1">{{ $booking->hotel->name }}</h3>
                            <p class="text-sm text-slate-500 mb-2"><i class="fa-solid fa-location-dot mr-1"></i> {{ $booking->hotel->city }}</p>
                            <div class="flex text-yellow-400 text-xs">
                                @for($i=0; $i<$booking->hotel->stars; $i++) <i class="fa-solid fa-star"></i> @endfor
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                        <div>
                            <p class="text-xs text-slate-400 mb-1">Check-in</p>
                            <p class="font-bold text-slate-800">{{ \Carbon\Carbon::parse($booking->check_in)->format('d M Y') }}</p>
                            <p class="text-xs text-slate-500">14:00 WIB</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 mb-1">Check-out</p>
                            <p class="font-bold text-slate-800">{{ \Carbon\Carbon::parse($booking->check_out)->format('d M Y') }}</p>
                            <p class="text-xs text-slate-500">12:00 WIB</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 mb-1">Durasi</p>
                            <p class="font-bold text-slate-800">{{ $booking->total_night }} Malam</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 mb-1">Tamu</p>
                            <p class="font-bold text-slate-800">{{ $booking->customer_name }}</p>
                        </div>
                    </div>

                    <div class="bg-slate-50 rounded-xl p-4 flex flex-col md:flex-row items-center justify-between gap-4 border border-slate-100">
                        <div class="flex items-center gap-4">
                            <div class="bg-white p-2 rounded-lg border border-slate-200">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $booking->booking_code }}" class="w-16 h-16">
                            </div>
                            <div class="text-xs text-slate-500">
                                <p>Tunjukkan QR Code ini kepada</p>
                                <p>resepsionis saat check-in.</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-slate-400">Total Pembayaran</p>
                            <p class="text-xl font-bold text-blue-600">IDR {{ number_format($booking->total_price) }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-50 p-6 flex justify-center gap-4">
                    <a href="{{ route('home') }}" class="px-6 py-3 rounded-xl border border-slate-300 text-slate-600 font-bold hover:bg-slate-100 transition">
                        Kembali ke Home
                    </a>
                    <button onclick="window.print()" class="px-6 py-3 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-500/30 flex items-center gap-2">
                        <i class="fa-solid fa-print"></i> Cetak Tiket
                    </button>
                </div>
            </div>

        </div>
    </div>
</x-layouts.app>