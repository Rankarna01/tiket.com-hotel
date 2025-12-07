<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inspiration;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class InspirationController extends Controller
{
    public function index()
    {
        $inspirations = Inspiration::latest()->get();
        $hotels = Hotel::all(); // Untuk modal create
        return view('admin.inspirations.index', compact('inspirations', 'hotels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image',
            'banner_image' => 'required|image',
            'description' => 'required',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'image' => '/storage/' . $request->file('image')->store('inspirations/thumb', 'public'),
            'banner_image' => '/storage/' . $request->file('banner_image')->store('inspirations/banner', 'public'),
        ];

        // Upload Bottom Image jika ada (atau bisa statis nanti di view)
        if($request->hasFile('bottom_image')) {
            $data['bottom_image'] = '/storage/' . $request->file('bottom_image')->store('inspirations/bottom', 'public');
        }

        $inspiration = Inspiration::create($data);

        if ($request->has('hotels')) {
            $inspiration->hotels()->sync($request->hotels);
        }

        return back()->with('success', 'Inspirasi berhasil dibuat!');
    }

    public function destroy(Inspiration $inspiration)
    {
        $inspiration->delete();
        return back()->with('success', 'Data dihapus!');
    }
}