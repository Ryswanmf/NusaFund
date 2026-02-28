<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

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
            'title' => 'required|string',
            'hero_description' => 'required',
            'vision' => 'required',
            'mission_1' => 'required',
            'mission_2' => 'required',
            'mission_3' => 'required',
        ]);

        $about->update($request->all());

        return back()->with('success', 'Profil organisasi berhasil diperbarui!');
    }

    // --- PUBLIC ---
    public function publicIndex()
    {
        $about = About::first();
        return view('landing_page.tentang_kami.index', compact('about'));
    }
}
