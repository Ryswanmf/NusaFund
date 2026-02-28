<?php

namespace App\Http\Controllers;

use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    // --- ADMIN ---
    public function index()
    {
        $policies = PrivacyPolicy::orderBy('order')->get();
        return view('admin.kebijakan_privasi.index', compact('policies'));
    }

    public function create()
    {
        return view('admin.kebijakan_privasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'order' => 'required|integer',
        ]);

        PrivacyPolicy::create($request->all());
        return redirect()->route('admin.kebijakan-privasi.index')->with('success', 'Poin kebijakan berhasil ditambahkan!');
    }

    public function edit(PrivacyPolicy $kebijakan_privasi)
    {
        return view('admin.kebijakan_privasi.create', ['policy' => $kebijakan_privasi]);
    }

    public function update(Request $request, PrivacyPolicy $kebijakan_privasi)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'order' => 'required|integer',
        ]);

        $kebijakan_privasi->update($request->all());
        return redirect()->route('admin.kebijakan-privasi.index')->with('success', 'Poin kebijakan berhasil diperbarui!');
    }

    public function destroy(PrivacyPolicy $kebijakan_privasi)
    {
        $kebijakan_privasi->delete();
        return redirect()->route('admin.kebijakan-privasi.index')->with('success', 'Poin kebijakan berhasil dihapus!');
    }

    // --- PUBLIC ---
    public function publicIndex()
    {
        $policies = PrivacyPolicy::where('is_active', true)->orderBy('order')->get();
        return view('landing_page.kebijakan_privasi.index', compact('policies'));
    }
}
