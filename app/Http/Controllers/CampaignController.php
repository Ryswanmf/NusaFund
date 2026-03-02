<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $query = Campaign::latest();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $campaigns = $query->paginate(10);
        return view('admin.donasi.index', compact('campaigns'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('admin.donasi.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required',
            'target_amount' => 'required|numeric|min:1000',
            'end_date' => 'required|date|after:today',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = $request->all();
        $data['is_urgent'] = $request->has('is_urgent');
        $data['status'] = $request->status ?? 'active';

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('campaigns', 'public');
        }

        Campaign::create($data);

        return redirect()->route('admin.donasi.index')->with('success', 'Kampanye berhasil dibuat!');
    }

    public function edit(Campaign $donasi)
    {
        $categories = \App\Models\Category::all();
        return view('admin.donasi.edit', [
            'campaign' => $donasi,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Campaign $donasi)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required',
            'target_amount' => 'required|numeric|min:1000',
            'end_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:active,inactive,completed'
        ]);

        $data = $request->all();
        $data['is_urgent'] = $request->has('is_urgent');

        if ($request->hasFile('image')) {
            if ($donasi->image) Storage::disk('public')->delete($donasi->image);
            $data['image'] = $request->file('image')->store('campaigns', 'public');
        }

        $donasi->update($data);

        return redirect()->route('admin.donasi.index')->with('success', 'Kampanye berhasil diperbarui!');
    }

    public function destroy(Campaign $donasi)
    {
        if ($donasi->image) Storage::disk('public')->delete($donasi->image);
        $donasi->delete();

        return redirect()->route('admin.donasi.index')->with('success', 'Kampanye berhasil dihapus!');
    }

    // Fungsi untuk Halaman Beranda
    public function publicHome()
    {
        // Ambil data hero utama
        $hero = \App\Models\HeroBanner::where('is_active', true)->orderBy('order')->first();

        // Ambil data profil/settings
        $about = \App\Models\About::first();

        // Ambil kategori unggulan
        $categories = \App\Models\Category::where('is_featured', true)->take(6)->get();

        // Ambil testimoni yang dipublish
        $testimonials = \App\Models\Testimonial::where('is_published', true)->latest()->take(2)->get();

        // Ambil kampanye: Prioritas Mendesak (is_urgent) lalu Terbaru (latest)
        $urgentCampaigns = Campaign::where('status', 'active')
            ->orderBy('is_urgent', 'desc')
            ->latest()
            ->take(3)
            ->get();

        return view('index', compact('urgentCampaigns', 'categories', 'testimonials', 'about', 'hero'));
    }

    // Fungsi untuk Landing Page
    public function publicIndex(Request $request)
    {
        // Prioritas: Mendesak (is_urgent) lalu Terbaru (latest)
        $query = Campaign::where('status', 'active')
            ->orderBy('is_urgent', 'desc')
            ->latest();

        if ($request->has('category') && $request->category != 'Semua') {
            $query->where('category', $request->category);
        }

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $campaigns = $query->get();
        $categories = \App\Models\Category::all();

        return view('landing_page.donasi.index', compact('campaigns', 'categories'));
    }

    public function publicShow($slug)
    {
        $campaign = Campaign::where('slug', $slug)->firstOrFail();
        
        // Data untuk SEO & Social Sharing
        $meta = [
            'title' => $campaign->title . ' - NusaFund',
            'description' => Str::limit(strip_tags($campaign->description), 160),
            'image' => $campaign->image ? (filter_var($campaign->image, FILTER_VALIDATE_URL) ? $campaign->image : asset('storage/' . $campaign->image)) : asset('images/nusafac.png')
        ];

        return view('landing_page.donasi.show', compact('campaign', 'meta'));
    }
}
