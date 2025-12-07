<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::withCount('hotels')->latest()->get();
        return view('admin.partners.index', compact('partners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'required|image|max:2048',
            'banner_image' => 'required|image|max:2048',
        ]);

        Partner::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'logo' => '/storage/' . $request->file('logo')->store('partners/logo', 'public'),
            'banner_image' => '/storage/' . $request->file('banner_image')->store('partners/banner', 'public'),
        ]);

        return back()->with('success', 'Partner berhasil dibuat!');
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate(['name' => 'required']);
        
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ];

        if ($request->hasFile('logo')) {
            $data['logo'] = '/storage/' . $request->file('logo')->store('partners/logo', 'public');
        }
        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = '/storage/' . $request->file('banner_image')->store('partners/banner', 'public');
        }

        $partner->update($data);
        return back()->with('success', 'Partner berhasil diupdate!');
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();
        return back()->with('success', 'Partner dihapus!');
    }
}