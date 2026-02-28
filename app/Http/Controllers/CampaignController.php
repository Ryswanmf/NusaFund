<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::latest()->paginate(10);
        return view('admin.donasi.index', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.donasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required',
            'target_amount' => 'required|numeric',
            'end_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        $data['is_urgent'] = $request->has('is_urgent');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('campaigns', 'public');
        }

        Campaign::create($data);

        return redirect()->route('admin.donasi.index')->with('success', 'Kampanye berhasil dibuat!');
    }

    public function edit(Campaign $campaign)
    {
        return view('admin.donasi.edit', compact('campaign'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required',
            'target_amount' => 'required|numeric',
            'end_date' => 'required|date',
        ]);

        $data = $request->all();
        $data['is_urgent'] = $request->has('is_urgent');

        if ($request->hasFile('image')) {
            if ($campaign->image) Storage::disk('public')->delete($campaign->image);
            $data['image'] = $request->file('image')->store('campaigns', 'public');
        }

        $campaign->update($data);

        return redirect()->route('admin.donasi.index')->with('success', 'Kampanye berhasil diperbarui!');
    }

    public function destroy(Campaign $campaign)
    {
        if ($campaign->image) Storage::disk('public')->delete($campaign->image);
        $campaign->delete();

        return redirect()->route('admin.donasi.index')->with('success', 'Kampanye berhasil dihapus!');
    }

    // Fungsi untuk Landing Page
    public function publicIndex()
    {
        $campaigns = Campaign::where('status', 'active')->latest()->get();
        return view('landing_page.donasi.index', compact('campaigns'));
    }

    public function publicShow($slug)
    {
        $campaign = Campaign::where('slug', $slug)->firstOrFail();
        return view('landing_page.donasi.show', compact('campaign'));
    }
}
