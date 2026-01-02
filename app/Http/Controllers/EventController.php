<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // ==========================
    // USER FUNCTIONS
    // ==========================

    // READ: Display only user's events
    public function index() {
        $events = Auth::user()->events()->latest()->get();
        return view('dashboard', compact('events'));
    }

    // Show User Create Form
    public function create() {
        return view('events.create');
    }

    // CREATE: User Store Function
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\s]+$/'],
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

    // Show available events
    public function available() {
        $events = Event::latest()->get();
        return view('events.available', compact('events'));
    }

    // Register for an event
    public function register(Event $event) {
        // 1. Check if already registered
        if ($event->users()->where('user_id', Auth::id())->exists()) {
            return back()->with('error', 'You have already registered for this event.');
        }

        // 2. Register the user
        $event->users()->attach(Auth::id());

        // 3. Log to Audit Log
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Event Registration',
            'ip_address' => request()->ip(),
            'details' => "User " . Auth::user()->name . " registered for: " . $event->title
        ]);

        return back()->with('success', 'You successfully registered!');
    }


    // ==========================
    // ADMIN FUNCTIONS
    // ==========================

    // 1. Show the Admin "Create Event" Form
    public function adminCreate()
    {
        return view('admin.create_event');
    }

    // 2. Store the Admin event in the database
    public function adminStore(Request $request)
    {
        // A. Validate inputs
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'capacity' => 'nullable|integer',
        ]);

        // B. Combine Date and Time
        $combinedDateTime = $request->date . ' ' . $request->time;

        // C. Create Event (Fixed Logic)
        Event::create([
            'user_id' => Auth::id(),          // Added User ID
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $combinedDateTime,// Merged date & time
            'location' => $request->location,
            'max_capacity' => $request->capacity, // Correct column name
        ]);
        
        // Log this action
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Event Created',
            'details' => 'Created event: ' . $request->title,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Event created successfully!');
    }
    // 3. Delete an Audit Log Entry
    public function adminDeleteLog($id)
    {
        // Find the log by ID, or fail if it doesn't exist
        $log = \App\Models\AuditLog::findOrFail($id);
        
        // Delete it
        $log->delete();

        // Redirect back with a success message
        return back()->with('success', 'Log entry deleted successfully.');
    }
}
