<?php

namespace App\Http\Controllers;

use App\Models\Fundraising;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FundraisingController extends Controller
{
    // --- ADMIN FUNCTIONS ---
    public function adminIndex(Request $request)
    {
        $query = Fundraising::latest();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $fundraisings = $query->paginate(10);
        return view('admin.galang_dana.index', compact('fundraisings'));
    }

    public function edit(Fundraising $fundraising)
    {
        return view('admin.galang_dana.edit', compact('fundraising'));
    }

    public function update(Request $request, Fundraising $fundraising)
    {
        $request->validate([
            'status' => 'required|in:pending,active,rejected,completed',
            'target_amount' => 'required|numeric|min:1000',
            'admin_note' => 'nullable|string'
        ]);

        $fundraising->update($request->all());

        return redirect()->route('admin.galang_dana.index')->with('success', 'Status galang dana diperbarui!');
    }

    public function destroy(Fundraising $fundraising)
    {
        if ($fundraising->image && Storage::disk('public')->exists($fundraising->image)) {
            Storage::disk('public')->delete($fundraising->image);
        }
        $fundraising->delete();
        return redirect()->route('admin.galang_dana.index')->with('success', 'Galang dana dihapus!');
    }

    // --- PUBLIC FUNCTIONS ---
    public function publicIndex()
    {
        return view('landing_page.galang_dana.index');
    }

    public function publicCreate()
    {
        $categories = \App\Models\Category::all();
        return view('landing_page.galang_dana.create', compact('categories'));
    }

    public function publicStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'organization_name' => 'required|string|max:255',
            'category' => 'required',
            'target_amount' => 'required|numeric|min:1000000',
            'description' => 'required|min:100',
            'image' => 'required|image|max:2048',
            'end_date' => 'required|date|after:today',
            'phone' => 'required|string',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);
        $data['status'] = 'pending'; // Menunggu verifikasi admin
        $data['user_id'] = auth()->id() ?? null;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('fundraisings', 'public');
        }

        Fundraising::create($data);

        return redirect()->route('fundraising.index')->with('success', 'Pengajuan galang dana berhasil dikirim! Tim kami akan memverifikasi dalam 1x24 jam.');
    }

    public function publicShow($slug)
    {
        $fundraising = Fundraising::where('slug', $slug)->firstOrFail();
        return view('landing_page.galang_dana.show', compact('fundraising'));
    }

    public function publicGuide()
    {
        $steps = \App\Models\FundraisingStep::orderBy('step_number')->get();
        $faqs = \App\Models\FundraisingFaq::orderBy('order')->get();
        return view('landing_page.galang_dana.cara', compact('steps', 'faqs'));
    }
}
