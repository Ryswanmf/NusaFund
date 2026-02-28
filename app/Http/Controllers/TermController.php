<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    // --- ADMIN ---
    public function index()
    {
        $terms = Term::orderBy('order')->get();
        return view('admin.syarat_ketentuan.index', compact('terms'));
    }

    public function create()
    {
        return view('admin.syarat_ketentuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'order' => 'required|integer',
        ]);

        Term::create($request->all());
        return redirect()->route('admin.syarat-ketentuan.index')->with('success', 'Poin syarat berhasil ditambahkan!');
    }

    public function edit(Term $syarat_ketentuan)
    {
        return view('admin.syarat_ketentuan.create', ['term' => $syarat_ketentuan]);
    }

    public function update(Request $request, Term $syarat_ketentuan)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'order' => 'required|integer',
        ]);

        $syarat_ketentuan->update($request->all());
        return redirect()->route('admin.syarat-ketentuan.index')->with('success', 'Poin syarat berhasil diperbarui!');
    }

    public function destroy(Term $syarat_ketentuan)
    {
        $syarat_ketentuan->delete();
        return redirect()->route('admin.syarat-ketentuan.index')->with('success', 'Poin syarat berhasil dihapus!');
    }

    // --- PUBLIC ---
    public function publicIndex()
    {
        $terms = Term::where('is_active', true)->orderBy('order')->get();
        return view('landing_page.syarat_ketentuan.index', compact('terms'));
    }
}
