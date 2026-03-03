<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampaignUpdateController extends Controller
{
    public function index(Request $request)
    {
        $query = CampaignUpdate::with('campaign')->latest();
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        $updates = $query->paginate(10);
        return view('admin.updates.index', compact('updates'));
    }

    public function create()
    {
        // Izinkan tambah kabar untuk campaign yang aktif maupun yang sudah selesai
        $campaigns = Campaign::whereIn('status', ['active', 'completed'])->get();
        return view('admin.updates.create', compact('campaigns'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('updates', 'public');
        }

        CampaignUpdate::create($data);

        return redirect()->route('admin.updates.index')->with('success', 'Kabar terbaru berhasil dipublikasikan!');
    }

    public function edit(CampaignUpdate $update)
    {
        $campaigns = Campaign::all();
        return view('admin.updates.edit', compact('update', 'campaigns'));
    }

    public function update(Request $request, CampaignUpdate $update)
    {
        $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            if ($update->image) Storage::disk('public')->delete($update->image);
            $data['image'] = $request->file('image')->store('updates', 'public');
        }

        $update->update($data);

        return redirect()->route('admin.updates.index')->with('success', 'Kabar terbaru berhasil diperbarui!');
    }

    public function destroy(CampaignUpdate $update)
    {
        if ($update->image) Storage::disk('public')->delete($update->image);
        $update->delete();
        return redirect()->route('admin.updates.index')->with('success', 'Kabar terbaru berhasil dihapus!');
    }
}
