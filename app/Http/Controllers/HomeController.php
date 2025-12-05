<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;
use App\Models\Hotel;
use App\Models\Section; // Pastikan Model Section di-import

class HomeController extends Controller
{
    public function index()
    {
        // 1. Data Dummy Slider Hero (Tetap array dulu sesuai request)
        $heroSlides = [
            [
                'image' => 'https://images.pexels.com/photos/3201921/pexels-photo-3201921.jpeg',
                'title' => 'Booking hotel murah online<br class="hidden sm:block" />dengan harga promo',
            ],
            [
                'image' => 'https://images.pexels.com/photos/261102/pexels-photo-261102.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'title' => 'Liburan nyaman<br class="hidden sm:block" />tanpa bikin kantong bolong',
            ],
            [
                'image' => 'https://images.pexels.com/photos/189296/pexels-photo-189296.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                'title' => 'Staycation seru<br class="hidden sm:block" />bersama keluarga tercinta',
            ],
        ];

        // 2. Data Dummy Riwayat Pencarian
        $searchHistory = [
            [
                'location' => 'Bogor, Jawa Barat',
                'date' => '12 Des 25 - 13 Des 25',
                'guests' => '1 Kamar, 1 Dewasa',
                'image' => 'https://images.unsplash.com/photo-1600431521340-491eca880813?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'location' => 'Kartika One Hotel Jakarta',
                'sub_location' => 'Jagakarsa, Jakarta Selatan',
                'date' => '',
                'guests' => '',
                'image' => 'https://images.unsplash.com/photo-1501117716987-c8e0bdde665a?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'location' => 'Bali, Indonesia',
                'date' => '20 Jan 26 - 25 Jan 26',
                'guests' => '1 Kamar, 2 Dewasa',
                'image' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?q=80&w=400&auto=format&fit=crop',
            ],
        ];

        // 3. Data Dinamis Section (AMBIL DARI DATABASE)
        // Kita ambil semua section beserta hotel-hotel yang sudah direlasikan
        $promoSections = Section::with('hotels')->get();

        // 4. Promo Banner Slider (Banner Kecil)
        $promos = Promo::latest()->get();

        return view('pages.home', compact('heroSlides', 'searchHistory', 'promoSections', 'promos'));
    }

    // Detail Hotel
    public function hotelDetail($slug) {
        $hotel = Hotel::where('slug', $slug)->firstOrFail();
        return view('pages.hotel-detail', compact('hotel'));
    }

    // Detail Banner Promo Statis
    public function promoDetail($id)
    {
        $detail = [
            'id' => $id,
            'title' => 'Detail Promo Banner ' . $id,
            'description' => 'Ini adalah halaman detail untuk banner nomor ' . $id . '. Di sini nanti berisi syarat & ketentuan promo lengkap.',
            'image' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=1200'
        ];
        return view('pages.promo-detail', compact('detail'));
    }
}