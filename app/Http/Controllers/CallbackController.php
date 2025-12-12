<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Midtrans\Config;
use Midtrans\Notification;

class CallbackController extends Controller
{
    public function handle(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        try {
            $notification = new Notification();
            
            $transactionStatus = $notification->transaction_status;
            $type = $notification->payment_type;
            $orderId = $notification->order_id;
            $fraud = $notification->fraud_status;

            $booking = Booking::where('booking_code', $orderId)->first();

            if ($booking) {
                if ($transactionStatus == 'capture') {
                    if ($type == 'credit_card') {
                        if ($fraud == 'challenge') {
                            $booking->update(['status' => 'unpaid']);
                        } else {
                            $booking->update(['status' => 'paid']);
                        }
                    }
                } else if ($transactionStatus == 'settlement') {
                    $booking->update(['status' => 'paid']);
                } else if ($transactionStatus == 'pending') {
                    $booking->update(['status' => 'unpaid']);
                } else if ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                    $booking->update(['status' => 'cancelled']);
                }
            }

            return response()->json(['message' => 'Notification processed']);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error processing notification'], 500);
        }
    }
}