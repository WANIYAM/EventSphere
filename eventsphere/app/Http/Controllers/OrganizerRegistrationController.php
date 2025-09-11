<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Registration;
use Auth;

class OrganizerRegistrationController extends Controller
{
    // Show participants of a specific event
    public function participants($event_id)
    {
        $event = Event::with('registrations.student')
                      ->where('organizer_id', Auth::id())
                      ->findOrFail($event_id);

        return view('organizer.registrations.participants', compact('event'));
    }

  
    // Show all registrations for organizer's events
    public function index()
    {
        $registrations = Registration::whereHas('event', function($q){
            $q->where('organizer_id', auth()->id());
        })->get();

        return view('organizer.registrations.index', compact('registrations'));
    }

    // Approve registration
    public function approve($id)
    {
        $registration = Registration::whereHas('event', function($q){
            $q->where('organizer_id', auth()->id());
        })->findOrFail($id);

        $registration->status = 'confirmed';
        $registration->save();

        return back()->with('success', 'Registration approved.');
    }

    // Reject registration
    public function reject($id)
    {
        $registration = Registration::whereHas('event', function($q){
            $q->where('organizer_id', auth()->id());
        })->findOrFail($id);

        $registration->status = 'cancelled';
        $registration->save();

        return back()->with('success', 'Registration rejected.');
    }
}
