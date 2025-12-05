<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Facility; // Import ini
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index() {
        $hotels = Hotel::with('facilities')->latest()->get();
        $facilities = Facility::all(); // Kirim data fasilitas ke view untuk modal
        return view('admin.hotels.index', compact('hotels', 'facilities'));
    }

    public function store(Request $request) {
        // 1. Validasi
        $data = $request->validate([
            'name' => 'required',
            'city' => 'required',
            'address' => 'required',
            'price' => 'required|numeric',
            'original_price' => 'required|numeric',
            'description' => 'required',
            'hotel_images' => 'required', // Wajib upload minimal 1
            'hotel_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048', // Validasi file gambar
            'facilities' => 'array', // Array ID fasilitas
        ]);

        // 2. Proses Upload Gambar
        $imagePaths = [];
        if($request->hasFile('hotel_images')) {
            // Batasi maksimal 5 gambar
            $files = array_slice($request->file('hotel_images'), 0, 5); 
            
            foreach($files as $file) {
                // Simpan ke folder 'storage/app/public/hotels'
                $path = $file->store('hotels', 'public');
                // Simpan path akses publiknya: '/storage/hotels/namafile.jpg'
                $imagePaths[] = '/storage/' . $path;
            }
        }

        // 3. Simpan Data Hotel
        $hotel = Hotel::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
            'city' => $request->city,
            'address' => $request->address,
            'price' => $request->price,
            'original_price' => $request->original_price,
            'description' => $request->description,
            'rating' => 4.5, // Default rating
            'images' => $imagePaths, // Simpan array path gambar
        ]);

        // 4. Simpan Relasi Fasilitas
        if($request->has('facilities')) {
            $hotel->facilities()->sync($request->facilities);
        }

        return back()->with('success', 'Hotel berhasil ditambahkan dengan gambar!');
    }

    public function destroy(Hotel $hotel) {
        // Hapus file gambar dari storage (opsional, biar bersih)
        if($hotel->images) {
            foreach($hotel->images as $img) {
                $path = str_replace('/storage/', '', $img);
                Storage::disk('public')->delete($path);
            }
        }
        
        $hotel->delete();
        return back()->with('success', 'Hotel dihapus');
    }
}