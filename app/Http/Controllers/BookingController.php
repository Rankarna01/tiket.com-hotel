<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction; // Penting untuk Cek Status
use Midtrans\Notification; // Penting untuk Callback
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    // ==================================================================
    // 1. HALAMAN CHECKOUT (STEP 1 & 2)
    // ==================================================================
    
    public function checkout($slug)
    {
        $hotel = Hotel::where('slug', $slug)->firstOrFail();
        return view('pages.checkout', compact('hotel'));
    }

    public function checkoutAddons($slug)
    {
        $hotel = Hotel::where('slug', $slug)->firstOrFail();
        return view('pages.checkout-addons', compact('hotel'));
    }

    // ==================================================================
    // 2. PROSES PEMBAYARAN (STEP 3)
    // ==================================================================

    public function processPayment(Request $request)
    {
        // A. Validasi Input
        $request->validate([
            'hotel_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'total_room' => 'required|numeric|min:1',
        ]);

        // B. Hitung Ulang Harga di Backend (Supaya Aman)
        $hotel = Hotel::findOrFail($request->hotel_id);
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $nights = $checkIn->diffInDays($checkOut);
        
        // Harga Total = Harga Hotel * Jumlah Kamar * Jumlah Malam
        $grandTotal = ($hotel->price * $request->total_room) * $nights;

        // C. Simpan ke Database (Status Awal: UNPAID)
        // Pastikan Model Booking sudah ada $fillable
        $booking = Booking::create([
            'user_id' => Auth::id(), // Pastikan user sudah login
            'hotel_id' => $hotel->id,
            'booking_code' => 'TRX-' . mt_rand(1000,9999) . time(), // Kode Unik
            'customer_name' => $request->name,
            'customer_email' => $request->email,
            'customer_phone' => $request->phone,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'total_room' => $request->total_room,
            'total_night' => $nights,
            'total_price' => $grandTotal,
            'status' => 'unpaid',
        ]);

        // D. Konfigurasi Midtrans
        $this->configureMidtrans();

        // E. Buat Parameter untuk Snap Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $booking->booking_code,
                'gross_amount' => (int) $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ],
            'item_details' => [
                [
                    'id' => $hotel->id,
                    'price' => (int) $hotel->price,
                    'quantity' => $nights * $request->total_room,
                    'name' => substr($hotel->name, 0, 50), // Midtrans limit nama item max 50 char
                ]
            ]
        ];

        try {
            // F. Minta Snap Token ke Midtrans
            $snapToken = Snap::getSnapToken($params);
            
            // G. Update Token ke Database
            $booking->update(['snap_token' => $snapToken]);
            
            // H. Tampilkan Halaman Bayar
            return view('pages.payment', compact('booking', 'snapToken'));

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    // ==================================================================
    // 3. HALAMAN SUKSES (CEK STATUS OTOMATIS SETELAH BAYAR)
    // ==================================================================

    public function paymentSuccess(Request $request)
    {
        // Ambil Order ID dari parameter URL
        $orderId = $request->query('order_id'); 

        if (!$orderId) {
            return redirect()->route('home')->with('error', 'Order ID tidak ditemukan.');
        }

        $this->configureMidtrans();

        try {
            // A. Cek Status Transaksi Langsung ke API Midtrans
            $status = Transaction::status($orderId);
            $transaction = $status->transaction_status;
            $type = $status->payment_type;
            $fraud = $status->fraud_status;

            // B. Cari Data Booking
            $booking = Booking::where('booking_code', $orderId)->firstOrFail();

            // C. Logika Update Status
            if ($transaction == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $booking->update(['status' => 'unpaid']);
                    } else {
                        $booking->update(['status' => 'paid']);
                    }
                }
            } else if ($transaction == 'settlement') {
                $booking->update(['status' => 'paid']);
            } else if ($transaction == 'pending') {
                $booking->update(['status' => 'unpaid']);
            } else if ($transaction == 'deny' || $transaction == 'expire' || $transaction == 'cancel') {
                $booking->update(['status' => 'cancelled']);
            }

            // D. Tampilkan E-Ticket
            return view('pages.booking-success', compact('booking'));

        } catch (\Exception $e) {
            // Jika error koneksi, tetap coba tampilkan halaman (status mungkin belum update)
            return redirect()->route('history')->with('warning', 'Sedang memverifikasi pembayaran...');
        }
    }

    // ==================================================================
    // 4. WEBHOOK / CALLBACK HANDLER (UNTUK SERVER-TO-SERVER)
    // ==================================================================
    
    public function callback(Request $request)
    {
        $this->configureMidtrans();

        try {
            $notif = new Notification();

            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $order_id = $notif->order_id;
            $fraud = $notif->fraud_status;

            $booking = Booking::where('booking_code', $order_id)->first();

            if ($booking) {
                if ($transaction == 'capture') {
                    if ($type == 'credit_card') {
                        if ($fraud == 'challenge') {
                            $booking->update(['status' => 'unpaid']);
                        } else {
                            $booking->update(['status' => 'paid']);
                        }
                    }
                } else if ($transaction == 'settlement') {
                    $booking->update(['status' => 'paid']);
                } else if ($transaction == 'pending') {
                    $booking->update(['status' => 'unpaid']);
                } else if ($transaction == 'deny' || $transaction == 'expire' || $transaction == 'cancel') {
                    $booking->update(['status' => 'cancelled']);
                }
            }
            
            return response()->json(['message' => 'Notification processed']);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    // ==================================================================
    // 5. RIWAYAT PESANAN (HISTORY)
    // ==================================================================

    public function history()
    {
        $bookings = Booking::with('hotel')
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return view('pages.history', compact('bookings'));
    }

    // --- Helper Private untuk Config Midtrans ---
    private function configureMidtrans()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }
}