<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
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
            'message' => 'required',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:1024'
        ]);

        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
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
            'message' => 'required',
        ]);

        $data = $request->all();
        if ($request->hasFile('avatar')) {
            if ($testimoni->avatar) Storage::disk('public')->delete($testimoni->avatar);
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $testimoni->update($data);

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil diperbarui!');
    }

    public function destroy(Testimonial $testimoni)
    {
        if ($testimoni->avatar) Storage::disk('public')->delete($testimoni->avatar);
        $testimoni->delete();
        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni dihapus!');
    }
}
