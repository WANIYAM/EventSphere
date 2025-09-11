<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Notifications\EventPromotionNotification;

class StudentEventController extends Controller
{
    // ==================== Show all approved events ====================
    public function index(Request $request)
    {
        // Start query with approved filter
        $query = Event::where('status', 'approved');

        // Filters
        if ($request->filled('category')) {
            $query->where('category', 'like', '%'.$request->category.'%');
        }

        if ($request->filled('from')) {
            $query->whereDate('date', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('date', '<=', $request->to);
        }

        // Final events list
        $events = $query->orderBy('date', 'asc')->get();

        // Current user registrations
        $registrations = Registration::where('student_id', Auth::id())->get();

        return view('student.events.index', compact('events', 'registrations'));
    }


    // ==================== Register for Event ====================
    public function register($id)
    {
        $event = Event::findOrFail($id);

        // Check existing registration (any status)
        $existing = Registration::where('event_id', $event->id)
            ->where('student_id', Auth::id())
            ->first();

        if ($existing) {
            if ($existing->status === 'cancelled') {
                // Re-activate cancelled registration
                $existing->status = 'confirmed';
                $existing->save();
                return back()->with('success', 'You have re-registered for '.$event->title.'!');
            }

            // Already active registration
            return back()->with('info', 'You are already registered for this event.');
        }

        // Check capacity
        $currentCount = Registration::where('event_id', $event->id)
            ->where('status', 'confirmed')
            ->count();

        if ($currentCount >= $event->max_participants) {
            return back()->with('error', 'Registration full! No seats available.');
        }

        // Create new registration
        Registration::create([
            'event_id'   => $event->id,
            'student_id' => Auth::id(),
            'status'     => 'confirmed',
        ]);

        return back()->with('success', 'Successfully registered for '.$event->title.'!');
    }


    // ==================== Cancel Registration ====================
    public function cancel($id)
    {
        $registration = Registration::where('event_id', $id)
            ->where('student_id', Auth::id())
            ->first();

        if (!$registration) {
            return back()->with('error', 'You are not registered for this event.');
        }

        // Already cancelled check
        if ($registration->status === 'cancelled') {
            return back()->with('info', 'Your registration is already cancelled.');
        }

        // Update status
        $registration->status = 'cancelled';
        $registration->save();

        return back()->with('success', 'Your registration has been cancelled successfully.');
    }
    public function myRegistrations()
{
    $registrations = Registration::where('student_id', Auth::id())
        ->with('event')
        ->get();

    return view('student.events.my_registrations', compact('registrations'));
}

}
