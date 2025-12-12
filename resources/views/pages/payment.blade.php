<x-layouts.app>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4">
        <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-xl text-center">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 text-blue-600 text-2xl">
                <i class="fa-solid fa-wallet"></i>
            </div>
            <h2 class="text-2xl font-bold text-slate-800 mb-2">Selesaikan Pembayaran</h2>
            <p class="text-slate-500 mb-6">Order ID: <span class="font-mono font-bold">{{ $booking->booking_code }}</span></p>
            
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 mb-6">
                <p class="text-sm text-slate-500">Total Tagihan</p>
                <h3 class="text-2xl font-bold text-blue-600">IDR {{ number_format($booking->total_price) }}</h3>
            </div>

            <button id="pay-button" class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition shadow-lg">
                Bayar Sekarang
            </button>
        </div>
    </div>

    <script type="text/javascript">
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        window.snap.pay('{{ $snapToken }}', {
          // KETIKA SUKSES
          onSuccess: function(result){
            // Redirect ke halaman sukses + bawa Order ID
            window.location.href = "{{ route('booking.success') }}?order_id=" + result.order_id;
          },
          // KETIKA PENDING
          onPending: function(result){
            window.location.href = "{{ route('booking.success') }}?order_id=" + result.order_id;
          },
          // KETIKA ERROR
          onError: function(result){
            alert("Pembayaran Gagal!");
            location.reload();
          },
          // KETIKA DITUTUP
          onClose: function(){
            alert('Kamu menutup popup tanpa menyelesaikan pembayaran');
          }
        });
      });
    </script>
</x-layouts.app>