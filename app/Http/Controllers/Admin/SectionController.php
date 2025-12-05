<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Hotel;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        // Kita butuh load relasi 'hotels' agar saat Edit data pivot-nya (tag) terbaca
        $sections = Section::with('hotels')->latest()->get();
        
        // Kita butuh list semua hotel untuk pilihan di Modal
        $hotels = Hotel::all(); 
        
        return view('admin.sections.index', compact('sections', 'hotels'));
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'title' => 'required',
            'theme_color' => 'required',
        ]);

        // 1. Simpan Section
        $section = Section::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'icon' => $request->icon ?? 'fa-solid fa-hotel',
            'theme_color' => $request->theme_color,
            'end_time' => $request->end_time,
            'locations' => $request->locations ? array_map('trim', explode(',', $request->locations)) : [],
        ]);

        // 2. Sync Hotel (Relasi Many to Many)
        if ($request->has('hotels')) {
            $syncData = [];
            foreach ($request->hotels as $hotelId => $data) {
                // Hanya masukkan jika checkbox dicentang (isset selected)
                if (isset($data['selected'])) {
                    $syncData[$hotelId] = ['tag' => $data['tag'] ?? null];
                }
            }
            $section->hotels()->sync($syncData);
        }

        return back()->with('success', 'Section berhasil dibuat!');
    }

    public function update(Request $request, Section $section)
    {
        $request->validate([
            'title' => 'required',
            'theme_color' => 'required',
        ]);

        // 1. Update Section
        $section->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'icon' => $request->icon,
            'theme_color' => $request->theme_color,
            'end_time' => $request->end_time,
            'locations' => $request->locations ? array_map('trim', explode(',', $request->locations)) : [],
        ]);

        // 2. Update Relasi Hotel
        if ($request->has('hotels')) {
            $syncData = [];
            foreach ($request->hotels as $hotelId => $data) {
                if (isset($data['selected'])) {
                    $syncData[$hotelId] = ['tag' => $data['tag'] ?? null];
                }
            }
            $section->hotels()->sync($syncData);
        } else {
            $section->hotels()->detach();
        }

        return back()->with('success', 'Section berhasil diupdate!');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return back()->with('success', 'Section dihapus!');
    }
}