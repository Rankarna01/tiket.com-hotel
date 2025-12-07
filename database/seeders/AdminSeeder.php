<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Facility;
use App\Models\Location; // Jangan lupa import
use App\Models\Section;
use Illuminate\Support\Facades\Hash;
use App\Models\Partner;


class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        User::updateOrCreate(
            ['email' => 'admin@tiket.com'],
            ['name' => 'Admin Tiket', 'password' => Hash::make('password'), 'role' => 'admin']
        );

        // 2. Master Locations (SEEDER ONLY)
        $locations = ['Bali', 'Jakarta', 'Bandung', 'Yogyakarta', 'Surabaya', 'Malang', 'Lombok'];
        foreach ($locations as $locName) {
            Location::firstOrCreate(
                ['name' => $locName],
                ['slug' => str()->slug($locName), 'image' => null]
            );
        }

        // 3. Master Facilities
        $facilitiesData = [
            ['name' => 'Kolam Renang', 'icon' => 'fa-solid fa-person-swimming'],
            ['name' => 'WiFi', 'icon' => 'fa-solid fa-wifi'],
            ['name' => 'AC', 'icon' => 'fa-solid fa-snowflake'],
            ['name' => 'Parkir Gratis', 'icon' => 'fa-solid fa-square-parking'],
            ['name' => 'Restoran', 'icon' => 'fa-solid fa-utensils'],
            ['name' => 'Resepsionis 24 Jam', 'icon' => 'fa-solid fa-bell-concierge'],
            ['name' => 'Lift', 'icon' => 'fa-solid fa-elevator'],
        ];
        foreach ($facilitiesData as $fac) {
            Facility::firstOrCreate(['name' => $fac['name']], $fac);
        }

        // 4. Hotel Dummy
        $bali = Location::where('name', 'Bali')->first();
        
        $hotel = Hotel::create([
            'name' => 'Labak River Hotel By EPS',
            'slug' => 'labak-river-hotel-by-eps',
            'location_id' => $bali->id, // Set Lokasi ke Bali
            'city' => 'Ubud, Gianyar',
            'address' => 'Jl. Raya Singakerta Nyuh Kuning, Ubud',
            'description' => 'Hotel nyaman dengan pemandangan sungai.',
            'stars' => 3,
            'price' => 352858,
            'original_price' => 2900000,
            'rating' => 4.6,
            'total_reviews' => 94,
            'images' => [
                'https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=800',
                'https://images.unsplash.com/photo-1582719508461-905c673771fd?q=80&w=800'
            ],
        ]);

        $accor = Partner::create([
    'name' => 'Accor Hotels',
    'slug' => 'accor-hotels',
    'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/Accor_Logo.svg/1200px-Accor_Logo.svg.png', // Ganti path lokal nanti
    'banner_image' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=2000'
]);
$hotel->update(['partner_id' => $accor->id]);
        // Hubungkan fasilitas ke hotel
        $hotel->facilities()->attach(Facility::limit(5)->pluck('id'));
        
        // Buat Section (Opsional)
        $sec = Section::create(['title' => 'Promoted Stay', 'subtitle' => 'Promo Spesial', 'theme_color' => 'orange']);
        $sec->hotels()->attach($hotel->id, ['tag' => 'Top Pick']);
    }
}