<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
{
    public function index()
    {
        // Hitung jumlah hotel di setiap lokasi
        $locations = Location::withCount('hotels')->latest()->get();
        return view('admin.locations.index', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:locations,name',
            'image' => 'nullable|image|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = '/storage/' . $request->file('image')->store('locations', 'public');
        }

        Location::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $imagePath
        ]);

        return back()->with('success', 'Lokasi berhasil ditambahkan!');
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|unique:locations,name,' . $location->id,
            'image' => 'nullable|image|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ];

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($location->image) {
                $oldPath = str_replace('/storage/', '', $location->image);
                Storage::disk('public')->delete($oldPath);
            }
            $data['image'] = '/storage/' . $request->file('image')->store('locations', 'public');
        }

        $location->update($data);

        return back()->with('success', 'Lokasi berhasil diperbarui!');
    }

    public function destroy(Location $location)
    {
        if ($location->image) {
            $oldPath = str_replace('/storage/', '', $location->image);
            Storage::disk('public')->delete($oldPath);
        }
        $location->delete();
        return back()->with('success', 'Lokasi berhasil dihapus!');
    }
}