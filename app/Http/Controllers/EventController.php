<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // READ: Display only user's events
    public function index() {
        $events = Auth::user()->events()->latest()->get();
        return view('dashboard', compact('events'));
    }

    public function create() {
        return view('events.create');
    }

    // CREATE: Validate and Log
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date|after:today',
            'max_capacity' => 'required|integer|min:1',
        ]);

        $event = Auth::user()->events()->create($validated);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Event Created',
            'ip_address' => $request->ip(),
            'details' => "Created Event ID: {$event->id}"
        ]);

        return redirect()->route('dashboard')->with('success', 'Event created securely!');
    }

    // DELETE: Prevent IDOR
    public function destroy(Event $event) {
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Unauthorized IDOR attempt logged.');
        }

        $event->delete();
        return back()->with('success', 'Event deleted.');
    }
}
