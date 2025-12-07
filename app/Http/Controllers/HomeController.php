<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;
use App\Models\Location; // Import
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
        $locations = Location::all();
        $inspirations = \App\Models\Inspiration::latest()->take(4)->get();
        // 4. Promo Banner Slider (Banner Kecil)
        $promos = Promo::latest()->get();
        $partners = \App\Models\Partner::all();

        return view('pages.home', compact('heroSlides', 'searchHistory', 'promoSections', 'promos', 'inspirations','locations', 'partners'));
    }

    // Detail Hotel
    public function hotelDetail($slug) {
        $hotel = Hotel::where('slug', $slug)->firstOrFail();
        return view('pages.hotel-detail', compact('hotel'));
    }

    // Detail Banner Promo Statis
    public function promoDetail($id)
    {
        // Data Default
        $detail = [];

        switch ($id) {
            case 1: // Banner 1: Halo Tiket
                $detail = [
                    'id' => 1,
                    'title' => 'Ubah Jadwal Nginep? Kami Urus Seketika!',
                    'subtitle' => 'Fitur Smart Reschedule',
                    'image' => 'https://s-light.tiket.photos/t/01E25EBZS3W0FY9GTG6C42E1SE/rsfit720360gsm/mobile-modules/2025/11/24/061cae02-3e28-410a-82f2-b47a24b9c581-1763952569823-f3e556934cc7efce29330dddb5ddae5a.png',
                    'type' => 'reward', // Tampilan Biasa (Teks)
                    'description' => 'Rencana berubah dadakan? Jangan panik! Dengan fitur Halo Tiket, kamu bisa mengajukan reschedule atau refund dengan proses yang super cepat dan mudah.'
                ];
                break;

            case 2: // Banner 2: All Stars
                $detail = [
                    'id' => 2,
                    'title' => 'Hotel All-Stars: Pilihan Terbaik',
                    'subtitle' => 'Temukan hotel yang pas untuk setiap perjalananmu',
                    'image' => 'https://s-light.tiket.photos/t/01E25EBZS3W0FY9GTG6C42E1SE/rsfit720360gsm/mobile-modules/2025/11/24/72fd4f31-216c-4dc8-a6a5-c682644c8fb6-1763952580222-4d94df95847cc9e38f47b00f263a5862.png',
                    'type' => 'reward',
                    'description' => 'Nikmati pengalaman menginap tak terlupakan di koleksi Hotel All-Stars kami. Dipilih berdasarkan rating tertinggi dan pelayanan terbaik.'
                ];
                break;

            case 3: // Banner 3: STAY WITH BENEFITS (Tampilan Khusus)
                $detail = [
                    'id' => 3,
                    'title' => 'Stay With Benefits PLUS',
                    'subtitle' => 'Pesan hotel, raih 850rb!',
                    'image' => 'https://s-light.tiket.photos/t/01E25EBZS3W0FY9GTG6C42E1SE/rsfit720360gsm/mobile-modules/2025/10/06/8cded79d-bca8-4eeb-aefb-c341e491a5db-1759728614890-c7f4f67565d31de1d815bf900a599704.png',
                    'type' => 'reward', // Tipe Khusus
                    'description' => 'Program loyalitas khusus buat kamu yang hobi staycation.'
                ];
                break;
                
            default:
                abort(404);
        }

        return view('pages.promo-detail', compact('detail'));
    }


    public function locationDetail($slug)
{
    // 1. Ambil Data Lokasi
    $location = Location::where('slug', $slug)->firstOrFail();

    // 2. Ambil Hotel di Lokasi Tersebut
    $hotels = Hotel::where('location_id', $location->id)
                    ->with('facilities')
                    ->latest()
                    ->get();

    // 3. Ambil Promo untuk Slider (Reuse)
    $promos = Promo::latest()->get();

    return view('pages.location-detail', compact('location', 'hotels', 'promos'));
}


public function partnerDetail($slug)
{
    $partner = \App\Models\Partner::where('slug', $slug)->firstOrFail();
    
    // Ambil Hotel milik partner ini
    $hotels = Hotel::where('partner_id', $partner->id)->latest()->get();
    
    // Promo Slider (Reuse)
    $promos = \App\Models\Promo::latest()->get();

    return view('pages.partner-detail', compact('partner', 'hotels', 'promos'));
}
}


