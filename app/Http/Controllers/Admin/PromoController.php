<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::latest()->get();
        // Kirim data hotel untuk modal create/edit
        $hotels = Hotel::all();
        return view('admin.promos.index', compact('promos', 'hotels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|max:2048',
            'discount_text' => 'required',
        ]);

        // Upload Gambar
        $imagePath = '/storage/' . $request->file('image')->store('promos', 'public');

        $promo = Promo::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(5),
            'image' => $imagePath,
            'promo_code' => $request->promo_code,
            'discount_text' => $request->discount_text,
            'description' => $request->description,
            'terms' => $request->terms,
        ]);

        // Simpan Rekomendasi Hotel
        if ($request->has('hotels')) {
            $promo->hotels()->sync($request->hotels);
        }

        return back()->with('success', 'Promo berhasil dibuat!');
    }

    public function update(Request $request, Promo $promo)
    {
        $request->validate([
            'title' => 'required',
            'discount_text' => 'required',
        ]);

        $data = [
            'title' => $request->title,
            'promo_code' => $request->promo_code,
            'discount_text' => $request->discount_text,
            'description' => $request->description,
            'terms' => $request->terms,
        ];

        // Cek Upload Gambar Baru
        if ($request->hasFile('image')) {
            // Hapus lama
            $oldPath = str_replace('/storage/', '', $promo->image);
            Storage::disk('public')->delete($oldPath);
            // Simpan baru
            $data['image'] = '/storage/' . $request->file('image')->store('promos', 'public');
        }

        $promo->update($data);

        // Update Rekomendasi Hotel
        if ($request->has('hotels')) {
            $promo->hotels()->sync($request->hotels);
        } else {
            $promo->hotels()->detach();
        }

        return back()->with('success', 'Promo berhasil diupdate!');
    }

    public function destroy(Promo $promo)
    {
        // Hapus file gambar
        $path = str_replace('/storage/', '', $promo->image);
        Storage::disk('public')->delete($path);
        
        $promo->delete();
        return back()->with('success', 'Promo dihapus!');
    }
}