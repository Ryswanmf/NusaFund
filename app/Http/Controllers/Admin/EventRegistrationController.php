<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventRegistration;
use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = EventRegistration::with('event', 'user')->latest();

        if ($request->has('search')) {
            $query->where('registration_id', 'like', '%' . $request->search . '%')
                  ->orWhere('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $registrations = $query->paginate(15);
        return view('admin.event_registrations.index', compact('registrations'));
    }

    public function destroy(EventRegistration $registration)
    {
        $registration->delete();
        return back()->with('success', 'Data pendaftaran peserta dihapus.');
    }
}
