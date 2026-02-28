<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // --- ADMIN FUNCTIONS ---
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('admin.event.index', compact('events'));
    }

    public function create()
    {
        return view('admin.event.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'required|string',
            'category' => 'required',
            'organizer' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($data);

        return redirect()->route('admin.event.index')->with('success', 'Event berhasil dibuat!');
    }

    public function edit(Event $event)
    {
        return view('admin.event.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'required|string',
            'category' => 'required',
            'organizer' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($event->image) Storage::disk('public')->delete($event->image);
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.event.index')->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy(Event $event)
    {
        if ($event->image) Storage::disk('public')->delete($event->image);
        $event->delete();

        return redirect()->route('admin.event.index')->with('success', 'Event berhasil dihapus!');
    }

    // --- PUBLIC FUNCTIONS ---
    public function publicIndex()
    {
        $events = Event::where('status', 'active')->latest()->get();
        return view('landing_page.event.index', compact('events'));
    }

    public function publicShow($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return view('landing_page.event.show', compact('event'));
    }
}
