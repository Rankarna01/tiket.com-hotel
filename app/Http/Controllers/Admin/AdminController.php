<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import Model
use App\Models\User;
use App\Models\Hotel;
use App\Models\Location;
use App\Models\Promo;
use App\Models\Partner;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Hitung total data untuk Info Box
        $totalUsers     = User::count();
        $totalHotels    = Hotel::count();
        $totalLocations = Location::count();
        $totalPromos    = Promo::count();
        $totalPartners  = Partner::count();

        // 2. Ambil 5 user terbaru untuk tabel mini
        $latestUsers = User::latest()->take(5)->get();

        // 3. Tampilkan ke view 'admin.dashboard'
        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalHotels', 
            'totalLocations', 
            'totalPromos', 
            'totalPartners',
            'latestUsers'
        ));
    }
}