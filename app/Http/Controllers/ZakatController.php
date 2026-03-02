<?php

namespace App\Http\Controllers;

use App\Models\Zakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ZakatController extends Controller
{
    // --- ADMIN FUNCTIONS ---
    public function index(Request $request)
    {
        $query = Zakat::latest();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $zakats = $query->paginate(10);
        return view('admin.zakat.index', compact('zakats'));
    }

    public function create()
    {
        return view('admin.zakat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'institution' => 'required|string',
            'asnaf_category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = $request->all();
        $data['status'] = $request->status ?? 'active';

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('zakats', 'public');
        }

        Zakat::create($data);

        return redirect()->route('admin.zakat.index')->with('success', 'Program Zakat berhasil dibuat!');
    }

    public function edit(Zakat $zakat)
    {
        return view('admin.zakat.edit', [
            'zakat' => $zakat
        ]);
    }

    public function update(Request $request, Zakat $zakat)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'institution' => 'required|string',
            'asnaf_category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($zakat->image && Storage::disk('public')->exists($zakat->image)) {
                Storage::disk('public')->delete($zakat->image);
            }
            $data['image'] = $request->file('image')->store('zakats', 'public');
        }

        $zakat->update($data);

        return redirect()->route('admin.zakat.index')->with('success', 'Program Zakat berhasil diperbarui!');
    }

    public function destroy(Zakat $zakat)
    {
        if ($zakat->image && Storage::disk('public')->exists($zakat->image)) {
            Storage::disk('public')->delete($zakat->image);
        }
        $zakat->delete();

        return redirect()->route('admin.zakat.index')->with('success', 'Program Zakat berhasil dihapus!');
    }

    // --- PUBLIC FUNCTIONS ---
    public function publicIndex(Request $request)
    {
        $query = Zakat::where('status', 'active')->latest();

        if ($request->has('category') && $request->category != 'Semua') {
            $query->where('asnaf_category', $request->category);
        }

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $zakats = $query->get();
        
        return view('landing_page.zakat.index', compact('zakats'));
    }
}
