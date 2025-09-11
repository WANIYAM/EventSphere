<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    // Dashboard home
    public function index()
    {
        return view('student.dashboard');
    }

    // Show notifications
    public function notifications()
    {
        $notifications = auth()->user()->notifications()->latest()->get();
        return view('student.notifications', compact('notifications'));
    }
}
