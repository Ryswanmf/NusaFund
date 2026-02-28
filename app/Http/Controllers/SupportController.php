<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    // --- ADMIN ---
    public function index()
    {
        $supports = Support::orderBy('category')->orderBy('order')->get();
        return view('admin.bantuan.index', compact('supports'));
    }

    public function create()
    {
        return view('admin.bantuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required',
            'category' => 'required',
        ]);

        Support::create($request->all());
        return redirect()->route('admin.bantuan.index')->with('success', 'Bantuan berhasil ditambahkan!');
    }

    public function edit(Support $dukungan)
    {
        return view('admin.bantuan.create', compact('dukungan'));
    }

    public function update(Request $request, Support $dukungan)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required',
            'category' => 'required',
        ]);

        $dukungan->update($request->all());
        return redirect()->route('admin.bantuan.index')->with('success', 'Bantuan berhasil diperbarui!');
    }

    public function destroy(Support $dukungan)
    {
        $dukungan->delete();
        return redirect()->route('admin.bantuan.index')->with('success', 'Bantuan dihapus!');
    }

    // --- PUBLIC ---
    public function publicIndex()
    {
        $faqs = Support::where('is_active', true)->orderBy('order')->get()->groupBy('category');
        return view('landing_page.bantuan.index', compact('faqs'));
    }
}
