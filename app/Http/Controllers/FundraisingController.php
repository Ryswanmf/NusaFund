<?php

namespace App\Http\Controllers;

use App\Models\Fundraising;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FundraisingController extends Controller
{
    // --- ADMIN FUNCTIONS ---
    public function adminIndex()
    {
        $fundraisings = Fundraising::latest()->paginate(10);
        return view('admin.galang_dana.index', compact('fundraisings'));
    }

    public function edit(Fundraising $fundraising)
    {
        return view('admin.galang_dana.edit', compact('fundraising'));
    }

    public function update(Request $request, Fundraising $fundraising)
    {
        $request->validate([
            'status' => 'required',
            'target_amount' => 'required|numeric'
        ]);

        $fundraising->update($request->all());

        return redirect()->route('admin.galang_dana.index')->with('success', 'Status galang dana diperbarui!');
    }

    public function destroy(Fundraising $fundraising)
    {
        if ($fundraising->image) Storage::disk('public')->delete($fundraising->image);
        $fundraising->delete();
        return redirect()->route('admin.galang_dana.index')->with('success', 'Galang dana dihapus!');
    }

    // --- PUBLIC FUNCTIONS ---
    public function publicIndex()
    {
        $fundraisings = Fundraising::where('status', 'active')->latest()->get();
        return view('landing_page.galang_dana.index', compact('fundraisings'));
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
