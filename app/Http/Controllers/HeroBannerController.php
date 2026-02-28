<?php

namespace App\Http\Controllers;

use App\Models\HeroBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroBannerController extends Controller
{
    public function index()
    {
        $banners = HeroBanner::orderBy('order')->get();
        return view('admin.hero.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tag' => 'required|string',
            'title' => 'required|string',
            'description' => 'required',
            'cta_text' => 'required',
            'cta_link' => 'required',
            'image' => 'nullable|string|or:image|max:2048' // Mendukung URL atau Upload
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('hero', 'public');
        }

        HeroBanner::create($data);
        return redirect()->route('admin.hero.index')->with('success', 'Slide banner berhasil ditambahkan!');
    }

    public function edit(HeroBanner $hero)
    {
        return view('admin.hero.create', ['banner' => $hero]);
    }

    public function update(Request $request, HeroBanner $hero)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            if ($hero->image && !filter_var($hero->image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($hero->image);
            }
            $data['image'] = $request->file('image')->store('hero', 'public');
        }

        $hero->update($data);
        return redirect()->route('admin.hero.index')->with('success', 'Slide banner berhasil diperbarui!');
    }

    public function destroy(HeroBanner $hero)
    {
        if ($hero->image && !filter_var($hero->image, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($hero->image);
        }
        $hero->delete();
        return redirect()->route('admin.hero.index')->with('success', 'Slide banner dihapus!');
    }
}
