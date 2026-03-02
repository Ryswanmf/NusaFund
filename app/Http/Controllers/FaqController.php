<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // --- ADMIN ---
    public function index(Request $request)
    {
        $query = Faq::orderBy('order');
        if ($request->has('search')) {
            $query->where('question', 'like', '%' . $request->search . '%');
        }
        $faqs = $query->paginate(10);
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        $nextOrder = Faq::max('order') + 1;
        return view('admin.faq.create', compact('nextOrder'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order' => 'required|integer',
        ]);

        $data = $request->all();
        $data['is_published'] = $request->has('is_published');

        Faq::create($data);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil ditambahkan!');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order' => 'required|integer',
        ]);

        $data = $request->all();
        $data['is_published'] = $request->has('is_published');

        $faq->update($data);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil diperbarui!');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil dihapus!');
    }

    // --- PUBLIC ---
    public function publicIndex()
    {
        $faqs = Faq::where('is_published', true)->orderBy('order')->get();
        return view('landing_page.faq.index', compact('faqs'));
    }
}
