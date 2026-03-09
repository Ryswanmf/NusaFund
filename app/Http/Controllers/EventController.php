<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // --- ADMIN FUNCTIONS ---
    public function index(Request $request)
    {
        $query = Event::latest();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $events = $query->paginate(10);
        return view('admin.event.index', compact('events'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        $campaigns = \App\Models\Campaign::where('status', 'active')->get();
        return view('admin.event.create', compact('categories', 'campaigns'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'campaign_id' => 'nullable|exists:campaigns,id',
            'title' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date|after:today',
            'location' => 'required|string',
            'category' => 'required',
            'organizer' => 'required|string',
            'quota' => 'nullable|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = $request->all();
        $data['status'] = $request->status ?? 'active';

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($data);

        return redirect()->route('admin.event.index')->with('success', 'Event berhasil dibuat!');
    }

    public function edit(Event $event)
    {
        $categories = \App\Models\Category::all();
        $campaigns = \App\Models\Campaign::where('status', 'active')->get();
        return view('admin.event.edit', [
            'event' => $event,
            'categories' => $categories,
            'campaigns' => $campaigns
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'campaign_id' => 'nullable|exists:campaigns,id',
            'title' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'required|string',
            'category' => 'required',
            'organizer' => 'required|string',
            'quota' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:active,inactive,completed'
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
    public function publicIndex(Request $request)
    {
        $query = Event::where('status', 'active')->latest();

        if ($request->has('category') && $request->category != 'Semua') {
            $query->where('category', $request->category);
        }

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $events = $query->paginate(9)->withQueryString();
        $categories = \App\Models\Category::all();

        return view('landing_page.event.index', compact('events', 'categories'));
    }

    public function publicShow($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        // Data untuk SEO & Social Sharing
        $meta = [
            'title' => $event->title . ' - NusaFund',
            'description' => \Illuminate\Support\Str::limit(strip_tags($event->description), 160),
            'image' => $event->image ? (filter_var($event->image, FILTER_VALIDATE_URL) ? $event->image : asset('storage/' . $event->image)) : asset('images/nusafac.png')
        ];

        return view('landing_page.event.show', compact('event', 'meta'));
    }
}
