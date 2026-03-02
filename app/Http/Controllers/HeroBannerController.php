<?php

namespace App\Http\Controllers;

use App\Models\HeroBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroBannerController extends Controller
{
    public function index()
    {
        // Langsung arahkan ke fungsi edit untuk data pertama
        $hero = HeroBanner::firstOrCreate(['id' => 1], [
            'tag' => '#NusaFund',
            'title' => 'Kebaikan <span class="text-amber-400">Tanpa Batas</span>',
            'description' => 'Salurkan bantuan Anda untuk mereka yang membutuhkan dengan cepat, aman, dan transparan.',
            'cta_text' => 'Mulai Berdonasi',
            'cta_link' => '/donasi',
            'order' => 1,
            'is_active' => true
        ]);

        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request)
    {
        $hero = HeroBanner::firstOrCreate(['id' => 1]);

        $request->validate([
            'tag' => 'required|string|max:255',
            'title' => 'required|string',
            'description' => 'required|string',
            'cta_text' => 'required|string|max:255',
            'cta_link' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($hero->image && Storage::disk('public')->exists($hero->image)) {
                Storage::disk('public')->delete($hero->image);
            }
            $data['image'] = $request->file('image')->store('hero', 'public');
        }

        $hero->update($data);

        return redirect()->back()->with('success', 'Hero Section berhasil diperbarui!');
    }
}
