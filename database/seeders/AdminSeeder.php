<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Facility;
use App\Models\Section;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1. === BUAT AKUN ADMIN ===
        User::updateOrCreate(
            ['email' => 'admin@tiket.com'],
            [
                'name' => 'Admin Tiket',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // 2. === BUAT MASTER FASILITAS ===
        $facilitiesData = [
            ['name' => 'Kolam Renang', 'icon' => 'fa-solid fa-person-swimming'],
            ['name' => 'WiFi', 'icon' => 'fa-solid fa-wifi'],
            ['name' => 'AC', 'icon' => 'fa-solid fa-snowflake'],
            ['name' => 'Parkir Gratis', 'icon' => 'fa-solid fa-square-parking'],
            ['name' => 'Restoran', 'icon' => 'fa-solid fa-utensils'],
            ['name' => 'Resepsionis 24 Jam', 'icon' => 'fa-solid fa-bell-concierge'],
            ['name' => 'Antar Jemput Bandara', 'icon' => 'fa-solid fa-plane-arrival'],
            ['name' => 'Fasilitas Rapat', 'icon' => 'fa-solid fa-briefcase'],
            ['name' => 'Lift', 'icon' => 'fa-solid fa-elevator'],
            ['name' => 'Gym', 'icon' => 'fa-solid fa-dumbbell'],
        ];

        foreach ($facilitiesData as $fac) {
            Facility::firstOrCreate(['name' => $fac['name']], $fac);
        }

        // 3. === BUAT HOTEL DUMMY (Labak River) ===
        $hotel = Hotel::create([
            'name' => 'Labak River Hotel By EPS',
            'slug' => 'labak-river-hotel-by-eps',
            'city' => 'Ubud, Gianyar',
            'address' => 'Jl. Raya Singakerta Nyuh Kuning, Singakerta, Ubud, Bali',
            'description' => 'Terletak di Ubud, Labak River Hotel by EPS menawarkan akomodasi bintang 3 dengan kolam renang outdoor, taman, dan teras. Hotel ini menyediakan layanan resepsionis 24 jam, antar-jemput bandara, layanan kamar, dan WiFi gratis di seluruh areanya.',
            'stars' => 3,
            'price' => 352858,
            'original_price' => 2900000,
            'rating' => 4.6,
            'total_reviews' => 94,
            // JSON Images (Sesuai struktur baru)
            'images' => [
                'https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=800', 
                'https://images.unsplash.com/photo-1582719508461-905c673771fd?q=80&w=800', 
                'https://images.unsplash.com/photo-1571896349842-6e53ce41e887?q=80&w=800', 
                'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?q=80&w=800'
            ],
        ]);

        // 4. === HUBUNGKAN HOTEL KE FASILITAS ===
        $allFacilities = Facility::all();
        $hotel->facilities()->attach($allFacilities->pluck('id'));

        // 5. === BUAT SECTIONS PROMO (Orange & Putih) ===
        
        // Section 1: Promoted Stay (Orange)
        $section1 = Section::create([
            'title' => 'Promoted Stay',
            'subtitle' => null,
            'icon' => 'fa-solid fa-hotel',
            'theme_color' => 'orange',
            'end_time' => now()->addHours(12),
            'locations' => ['Bogor', 'Surabaya', 'Bali', 'Lombok', 'Labuan Bajo'],
        ]);

        // Section 2: Diskon (Putih)
        $section2 = Section::create([
            'title' => 'Diskon s.d. 40% + cashback 3%',
            'subtitle' => 'Bisa buat nginep di akomodasi populer di destinasi favorit.',
            'icon' => 'fa-solid fa-percent',
            'theme_color' => 'white',
            'end_time' => null,
            'locations' => ['Malang', 'Jakarta', 'Ubud', 'Bandung'],
        ]);

        // 6. === HUBUNGKAN HOTEL KE SECTION ===
        // Masukkan Hotel Labak ke kedua section dengan Tag berbeda
        $section1->hotels()->attach($hotel->id, ['tag' => 'Top Hotel 10']);
        $section2->hotels()->attach($hotel->id, ['tag' => 'Great Offer']);
    }
}