<?php

namespace App\Http\Controllers;

use App\Models\Zakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ZakatController extends Controller
{
    // --- ADMIN FUNCTIONS ---
    public function index()
    {
        $zakats = Zakat::latest()->paginate(10);
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
            'asnaf_category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('zakats', 'public');
        }

        Zakat::create($data);

        return redirect()->route('admin.zakat.index')->with('success', 'Program Zakat berhasil dibuat!');
    }

    public function edit(Zakat $zakat)
    {
        return view('admin.zakat.edit', compact('zakat'));
    }

    public function update(Request $request, Zakat $zakat)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'institution' => 'required',
            'asnaf_category' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($zakat->image) Storage::disk('public')->delete($zakat->image);
            $data['image'] = $request->file('image')->store('zakats', 'public');
        }

        $zakat->update($data);

        return redirect()->route('admin.zakat.index')->with('success', 'Program Zakat berhasil diperbarui!');
    }

    public function destroy(Zakat $zakat)
    {
        if ($zakat->image) Storage::disk('public')->delete($zakat->image);
        $zakat->delete();

        return redirect()->route('admin.zakat.index')->with('success', 'Program Zakat berhasil dihapus!');
    }

    // --- PUBLIC FUNCTIONS ---
    public function publicIndex()
    {
        $zakats = Zakat::where('status', 'active')->latest()->get();
        return view('landing_page.zakat.index', compact('zakats'));
    }
}
