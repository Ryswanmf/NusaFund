<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimonial::latest();
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $testimonials = $query->paginate(10);
        return view('admin.testimoni.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimoni.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'message' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024'
        ]);

        $data = $request->all();
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil ditambahkan!');
    }

    public function edit(Testimonial $testimoni)
    {
        return view('admin.testimoni.edit', compact('testimoni'));
    }

    public function update(Request $request, Testimonial $testimoni)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'message' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024'
        ]);

        $data = $request->all();
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('avatar')) {
            if ($testimoni->avatar && Storage::disk('public')->exists($testimoni->avatar)) {
                Storage::disk('public')->delete($testimoni->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        $testimoni->update($data);

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil diperbarui!');
    }

    public function destroy(Testimonial $testimoni)
    {
        if ($testimoni->avatar && Storage::disk('public')->exists($testimoni->avatar)) {
            Storage::disk('public')->delete($testimoni->avatar);
        }
        $testimoni->delete();

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil dihapus!');
    }
}
