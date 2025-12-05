<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::latest()->get();
        return view('admin.promos.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|url', // Kita pakai URL gambar dulu biar cepat (bisa ganti upload nanti)
        ]);

        Promo::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image' => $request->image,
            'promo_code' => $request->promo_code,
            'discount_text' => $request->discount_text,
            'description' => $request->description,
            'terms' => $request->terms,
        ]);

        return redirect()->route('admin.promos.index')->with('success', 'Promo berhasil dibuat!');
    }

    public function edit(Promo $promo)
    {
        return view('admin.promos.edit', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $promo->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image' => $request->image,
            'promo_code' => $request->promo_code,
            'discount_text' => $request->discount_text,
            'description' => $request->description,
            'terms' => $request->terms,
        ]);

        return redirect()->route('admin.promos.index')->with('success', 'Promo berhasil diupdate!');
    }

    public function destroy(Promo $promo)
    {
        $promo->delete();
        return redirect()->route('admin.promos.index')->with('success', 'Promo dihapus.');
    }
}