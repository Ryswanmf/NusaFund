<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EventRegistrationController extends Controller
{
    public function create(Event $event)
    {
        // Cek kuota
        if ($event->quota && $event->registrations()->count() >= $event->quota) {
            return redirect()->route('event.show', $event->slug)->with('error', 'Maaf, kuota pendaftaran untuk event ini sudah penuh.');
        }

        if ($event->status !== 'active') {
            return redirect()->route('event.show', $event->slug)->with('error', 'Pendaftaran untuk event ini sudah ditutup.');
        }

        return view('landing_page.event.register', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $request->validate([
            'name' => Auth::check() ? 'nullable' : 'required|string|max:255',
            'email' => Auth::check() ? 'nullable' : 'required|email',
            'phone' => 'required|string',
        ]);

        // Cek kuota lagi sebelum simpan
        if ($event->quota && $event->registrations()->count() >= $event->quota) {
            return redirect()->route('event.show', $event->slug)->with('error', 'Maaf, kuota baru saja penuh.');
        }

        $registrationId = 'EVT-' . strtoupper(Str::random(8));

        EventRegistration::create([
            'event_id' => $event->id,
            'user_id' => Auth::id(),
            'registration_id' => $registrationId,
            'name' => Auth::check() ? Auth::user()->name : $request->name,
            'email' => Auth::check() ? Auth::user()->email : $request->email,
            'phone' => $request->phone,
            'notes' => $request->notes,
            'status' => 'registered'
        ]);

        return redirect()->route('event.success', $registrationId);
    }

    public function success($registration_id)
    {
        $registration = EventRegistration::with('event')->where('registration_id', $registration_id)->firstOrFail();
        return view('landing_page.event.success', compact('registration'));
    }
}
