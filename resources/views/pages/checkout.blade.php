<x-layouts.app>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.3/cdn.min.js" defer></script>

    <div class="bg-gray-50 min-h-screen pb-20 pt-6 font-poppins" 
         x-data="checkoutLogic({ price: {{ $hotel->price }} })">
        
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold text-slate-800 mb-6">Konfirmasi Pesanan</h1>

            <form action="{{ route('booking.process') }}" method="POST" class="flex flex-col lg:flex-row gap-8">
                @csrf
                <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">

                <div class="lg:w-2/3 space-y-6">
                    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                        <h2 class="text-xl font-bold text-slate-800 mb-4">Detail Pemesan</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm text-slate-500 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" class="w-full border rounded-lg px-4 py-3" value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm text-slate-500 mb-1">Email</label>
                                    <input type="email" name="email" class="w-full border rounded-lg px-4 py-3" value="{{ Auth::user()->email }}" required>
                                </div>
                                <div>
                                    <label class="block text-sm text-slate-500 mb-1">No. Handphone</label>
                                    <input type="number" name="phone" class="w-full border rounded-lg px-4 py-3" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                        <h2 class="text-xl font-bold text-slate-800 mb-4">Detail Menginap</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm text-slate-500 mb-1">Check-In</label>
                                <input type="date" name="check_in" x-model="checkIn" @change="calculateTotal()" class="w-full border rounded-lg px-3 py-2" required>
                            </div>
                            <div>
                                <label class="block text-sm text-slate-500 mb-1">Check-Out</label>
                                <input type="date" name="check_out" x-model="checkOut" @change="calculateTotal()" class="w-full border rounded-lg px-3 py-2" required>
                            </div>
                            <div>
                                <label class="block text-sm text-slate-500 mb-1">Jumlah Kamar</label>
                                <input type="number" name="total_room" x-model="rooms" @change="calculateTotal()" min="1" class="w-full border rounded-lg px-3 py-2" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/3">
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm sticky top-24 p-6">
                        <div class="flex gap-4 mb-4 border-b pb-4">
                            <img src="{{ $hotel->images[0] }}" class="w-20 h-20 rounded-lg object-cover">
                            <div>
                                <h4 class="font-bold text-slate-800 line-clamp-2">{{ $hotel->name }}</h4>
                                <p class="text-xs text-slate-500 mt-1">{{ $hotel->city }}</p>
                            </div>
                        </div>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Harga per malam</span>
                                <span class="font-semibold">IDR {{ number_format($hotel->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Durasi</span>
                                <span class="font-semibold"><span x-text="nights"></span> Malam</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Jumlah Kamar</span>
                                <span class="font-semibold"><span x-text="rooms"></span> Kamar</span>
                            </div>
                            <div class="border-t pt-3 flex justify-between items-center">
                                <span class="font-bold text-lg text-slate-800">Total Bayar</span>
                                <span class="font-bold text-xl text-blue-600">IDR <span x-text="formattedTotal"></span></span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 shadow-lg transition">
                            Lanjut Pembayaran
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function checkoutLogic(config) {
            return {
                price: config.price,
                checkIn: new Date().toISOString().split('T')[0], // Hari ini
                checkOut: new Date(new Date().getTime() + 24 * 60 * 60 * 1000).toISOString().split('T')[0], // Besok
                rooms: 1,
                nights: 1,
                total: config.price,
                formattedTotal: new Intl.NumberFormat('id-ID').format(config.price),

                calculateTotal() {
                    const start = new Date(this.checkIn);
                    const end = new Date(this.checkOut);
                    
                    // Hitung selisih hari
                    const diffTime = Math.abs(end - start);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
                    
                    this.nights = diffDays > 0 ? diffDays : 1;
                    this.total = this.price * this.nights * this.rooms;
                    this.formattedTotal = new Intl.NumberFormat('id-ID').format(this.total);
                }
            }
        }
    </script>
</x-layouts.app>