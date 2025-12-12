<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // 1. DATA TRANSAKSI / DETAIL CHECKOUT
    public function transactions()
    {
        // Ambil semua booking, urutkan terbaru
        $bookings = Booking::with(['user', 'hotel'])->latest()->get();
        return view('admin.reports.transactions', compact('bookings'));
    }

    // 2. DATA USER
    public function users()
    {
        $users = User::latest()->get();
       return view('admin.users.index', compact('users'));
    }

    // 3. LAPORAN PENDAPATAN
    public function income()
    {
        // Total Pendapatan (Hanya yang statusnya PAID)
        $totalRevenue = Booking::where('status', 'paid')->sum('total_price');
        
        // Transaksi Sukses
        $successCount = Booking::where('status', 'paid')->count();

        // Pendapatan Per Bulan (Untuk Grafik/Tabel)
        $monthlyRevenue = Booking::where('status', 'paid')
            ->select(
                DB::raw('sum(total_price) as sums'), 
                DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
            )
            ->groupBy('months')
            ->get();

        return view('admin.reports.income', compact('totalRevenue', 'successCount', 'monthlyRevenue'));
    }
}