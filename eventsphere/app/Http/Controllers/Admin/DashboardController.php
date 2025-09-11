<?php

// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Notification;
use App\Models\Ticket;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Top stats
        $totalEvents = Event::count();
        $totalUsers = User::count();
        $pendingEvents = Event::where('status', 'pending')->count();
        $ticketsSold = Ticket::sum('quantity');

        // Recent events (latest 5)
        $recentEvents = Event::with('organizer')
            ->latest()
            ->take(5)
            ->get();

        $notifications = collect(); // default empty

        // Event status stats
        $approved = Event::where('status', 'approved')->count();
        $rejected = Event::where('status', 'rejected')->count();
        $canceled = Event::where('status', 'canceled')->count();
        $total = $totalEvents > 0 ? $totalEvents : 1; // prevent divide by zero

        return view('admin.dashboard', compact(
            'totalEvents',
            'totalUsers',
            'pendingEvents',
            'ticketsSold',
            'recentEvents',
            'notifications',
            'approved',
            'rejected',
            'canceled',
            'total'
        ));

    }
}
