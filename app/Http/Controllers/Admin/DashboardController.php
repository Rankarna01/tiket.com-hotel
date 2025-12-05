<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Facility;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    // 1. Tampilkan Halaman Dashboard / List Hotel
    public function index() {
        // Load data hotel dengan relasi fasilitas & lokasi
        $hotels = Hotel::with(['facilities', 'location'])->latest()->get();
        
        // Data untuk modal (Dropdown & Checkbox)
        $facilities = Facility::all();
        $locations = Location::all(); 

        return view('admin.hotels.index', compact('hotels', 'facilities', 'locations'));
    }

    // 2. Simpan Hotel Baru
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'location_id' => 'required|exists:locations,id', // Wajib pilih Wilayah (Bali, Jkt, dll)
            'city' => 'required', // Wajib isi Area Spesifik (Ubud, Kuta, dll)
            'address' => 'required',
            'price' => 'required|numeric',
            'original_price' => 'required|numeric',
            'description' => 'required',
            'hotel_images' => 'required', // Wajib ada gambar saat create
            'hotel_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'facilities' => 'array',
        ]);

        // Proses Upload Gambar
        $imagePaths = [];
        if($request->hasFile('hotel_images')) {
            $files = array_slice($request->file('hotel_images'), 0, 5); // Max 5
            foreach($files as $file) {
                $path = $file->store('hotels', 'public');
                $imagePaths[] = '/storage/' . $path;
            }
        }

        // Simpan ke Database
        $hotel = Hotel::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
            'location_id' => $request->location_id, // ID Wilayah (Relasi)
            'city' => $request->city, // Nama Area Spesifik
            'address' => $request->address,
            'price' => $request->price,
            'original_price' => $request->original_price,
            'description' => $request->description,
            'rating' => 4.5, // Default rating awal
            'images' => $imagePaths, // Simpan array path gambar
        ]);

        // Simpan Relasi Fasilitas
        if($request->has('facilities')) {
            $hotel->facilities()->sync($request->facilities);
        }

        return back()->with('success', 'Hotel berhasil ditambahkan!');
    }

    // 3. Update Hotel (Untuk Fitur Edit)
    public function update(Request $request, Hotel $hotel) {
        $request->validate([
            'name' => 'required',
            'location_id' => 'required|exists:locations,id',
            'city' => 'required',
            'address' => 'required',
            'price' => 'required|numeric',
            'original_price' => 'required|numeric',
            'description' => 'required',
            'hotel_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'facilities' => 'array',
        ]);

        // Ambil gambar lama
        $currentImages = $hotel->images ?? [];

        // Jika ada upload gambar baru, tambahkan ke array lama
        if($request->hasFile('hotel_images')) {
            $files = $request->file('hotel_images');
            foreach($files as $file) {
                $path = $file->store('hotels', 'public');
                $currentImages[] = '/storage/' . $path;
            }
            // Opsional: Batasi total gambar jadi 5 jika mau
            $currentImages = array_slice($currentImages, 0, 5);
        }

        // Update Data Utama
        $hotel->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . $hotel->id, // Update slug biar sync
            'location_id' => $request->location_id,
            'city' => $request->city,
            'address' => $request->address,
            'price' => $request->price,
            'original_price' => $request->original_price,
            'description' => $request->description,
            'images' => $currentImages,
        ]);

        // Update Relasi Fasilitas (Sync akan menghapus yang tidak dicentang dan menambah yang dicentang)
        $hotel->facilities()->sync($request->facilities ?? []);

        return back()->with('success', 'Data hotel berhasil diperbarui!');
    }

    // 4. Hapus Hotel
    public function destroy(Hotel $hotel) {
        // Hapus file fisik gambar (Cleanup Storage)
        if($hotel->images) {
            foreach($hotel->images as $img) {
                $path = str_replace('/storage/', '', $img);
                if(Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }
        
        $hotel->delete();
        return back()->with('success', 'Hotel berhasil dihapus!');
    }
}