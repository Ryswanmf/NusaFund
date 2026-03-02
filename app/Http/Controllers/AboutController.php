<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    // --- ADMIN ---
    public function edit()
    {
        $about = About::first();
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $about = About::first();
        
        $request->validate([
            'title' => 'required|string|max:255',
            'hero_description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'vision' => 'required|string',
            'mission_1' => 'required|string',
            'mission_2' => 'required|string',
            'mission_3' => 'required|string',
            'cta_title' => 'required|string',
            'cta_description' => 'required|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($about->image && Storage::disk('public')->exists($about->image)) {
                Storage::disk('public')->delete($about->image);
            }
            $data['image'] = $request->file('image')->store('about', 'public');
        }

        $about->update($data);

        return back()->with('success', 'Profil organisasi berhasil diperbarui!');
    }

    // --- PUBLIC ---
    public function publicIndex()
    {
        $about = About::first();
        return view('landing_page.tentang_kami.index', compact('about'));
    }
}
