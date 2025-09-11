<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrganizerEventManagementController;
use App\Http\Controllers\OrganizerRegistrationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/organizer/dashboard', function () {
        return view('organizer.dashboard');
    })->name('organizer.dashboard');

    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');
});

Route::get('/', function () {
    $head_title = 'Home || envens || envens PHP Template';

    return view('home', compact('head_title'));
});
Route::get('/', function () {
    return view('welcome');
})->name('home');

use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\OrganizerEventController;
use App\Http\Controllers\PublicEventController;

// Public
Route::get('/events', [PublicEventController::class, 'index']);

// Organizer
Route::get('/organizer/events/create', [OrganizerEventController::class, 'create']);
Route::post('/organizer/events', [OrganizerEventController::class, 'store']);
Route::get('/organizer/events/mine', [OrganizerEventController::class, 'myEvents']);
Route::get('/organizer/events/{id}/edit', [OrganizerEventController::class, 'edit']);
Route::post('/organizer/events/{id}/update', [OrganizerEventController::class, 'update']);
Route::post('/organizer/events/{id}/cancel', [OrganizerEventController::class, 'cancel']);
Route::get('/organizer/events', [OrganizerEventController::class, 'index']);
Route::get('/organizer/events/create', [OrganizerEventController::class, 'create']);
Route::post('/organizer/events/store', [OrganizerEventController::class, 'store']);
Route::get('/organizer/events/mine', [OrganizerEventController::class, 'index']); // all events
Route::get('/organizer/events/pending', [OrganizerEventController::class, 'pending']);
Route::get('/organizer/events/approved', [OrganizerEventController::class, 'approved']);
Route::get('/organizer/events/rejected', [OrganizerEventController::class, 'rejected']);
Route::get('/organizer/events/canceled', [OrganizerEventController::class, 'canceled']);
Route::get('/events/{id}/participants', [OrganizerRegistrationController::class, 'participants'])->name('organizer.registrations.participants');
Route::post('/registrations/{id}/approve', [OrganizerRegistrationController::class, 'approve'])->name('organizer.registrations.approve');
Route::post('/registrations/{id}/reject', [OrganizerRegistrationController::class, 'reject'])->name('organizer.registrations.reject');

// Admin
Route::get('/admin/events/pending', [AdminEventController::class, 'pendingEvents']);
Route::post('/admin/events/{id}/approve', [AdminEventController::class, 'approve']);
Route::post('/admin/events/{id}/reject', [AdminEventController::class, 'reject']);
Route::get('/admin/events/{id}/edit', [AdminEventController::class, 'edit']);
Route::post('/admin/events/{id}/update', [AdminEventController::class, 'update']);
Route::get('/admin/events', [AdminEventController::class, 'index']);
Route::get('/admin/events/pending', [AdminEventController::class, 'pending']);
Route::get('/admin/events/approved', [AdminEventController::class, 'approved']);
Route::get('/admin/events/rejected', [AdminEventController::class, 'rejected']);
Route::get('/admin/events/canceled', [AdminEventController::class, 'canceled']);
Route::get('/admin/events/{id}/feedbacks', [AdminEventController::class, 'feedbacks'])->name('admin.events.feedbacks');
Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
Route::post('/users/{id}/reset-password', [AdminUserController::class, 'resetPassword'])->name('admin.users.resetPassword');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('feedback', [App\Http\Controllers\Admin\FeedbackController::class, 'index'])->name('feedback.index');
});
Route::get('events/{id}/participants', [App\Http\Controllers\AdminEventController::class, 'participants'])
    ->name('admin.events.participants');

use App\Http\Controllers\Admin\DashboardController;

Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentEventController;

Route::prefix('student')->group(function () {
    Route::get('/events', [StudentEventController::class, 'index'])->name('student.events.index');
    Route::post('/events/{id}/register', [StudentEventController::class, 'register'])->name('student.events.register');
    Route::post('/events/{id}/cancel', [StudentEventController::class, 'cancel'])->name('student.events.cancel');

    // My Registrations page
    Route::get('/registrations', [StudentEventController::class, 'myRegistrations'])->name('student.my-registrations');
});

// Student Dashboard
Route::get('/student/dashboard', [StudentDashboardController::class, 'index']);
Route::get('/student/notifications', [StudentDashboardController::class, 'notifications']);
Route::prefix('student/feedback')->name('student.feedback.')->group(function () {
    Route::get('{event}/create', [FeedbackController::class, 'create'])->name('create');
    Route::post('{event}', [FeedbackController::class, 'store'])->name('store');
});

Route::get('student/feedback/{event}/peer', [FeedbackController::class, 'peerReviews'])
    ->name('student.feedback.peer');
// Route::prefix('organizer')->middleware('auth')->group(function () {

    // Event Management
    Route::get('/events', [OrganizerEventManagementController::class, 'index'])->name('organizer.events.index');
    Route::get('/events/create', [OrganizerEventManagementController::class, 'create'])->name('organizer.events.create');
    Route::post('/events', [OrganizerEventManagementController::class, 'store'])->name('organizer.events.store');
    Route::get('/events/{id}/edit', [OrganizerEventManagementController::class, 'edit'])->name('organizer.events.edit');
    Route::put('/events/{id}', [OrganizerEventManagementController::class, 'update'])->name('organizer.events.update');
    Route::delete('/events/{id}', [OrganizerEventManagementController::class, 'destroy'])->name('organizer.events.destroy');

    // Registration Management
    Route::get('/events/{id}/participants', [OrganizerRegistrationController::class, 'participants'])->name('organizer.registrations.participants');
    Route::post('/registrations/{id}/approve', [OrganizerRegistrationController::class, 'approve'])->name('organizer.registrations.approve');
    Route::post('/registrations/{id}/reject', [OrganizerRegistrationController::class, 'reject'])->name('organizer.registrations.reject');
// });

Route::middleware(['auth'])->prefix('admin')->group(function() {
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');

    // Admin events routes
    Route::get('/events/{id}/participants', [AdminEventController::class, 'participants'])->name('admin.events.participants');
});
// routes/web.php


Route::prefix('organizer')->name('organizer.')->middleware('auth')->group(function () {

    // Resource routes for CRUD
    Route::resource('events', OrganizerEventManagementController::class);

    // Status filter
    Route::get('events/status/{status?}', [OrganizerEventManagementController::class, 'status'])
        ->name('events.status');

    // Participants list
    Route::get('events/{event}/participants', [OrganizerEventManagementController::class, 'participants'])
        ->name('events.participants');
});
// Organizer Registration Management
Route::prefix('organizer/registrations')->middleware('auth')->group(function () {
    Route::get('/', [OrganizerEventController::class, 'registrations'])->name('organizer.registrations');

    // Approve or reject a registration
    Route::get('/approve/{id}', [OrganizerEventController::class, 'approveRegistration'])->name('organizer.registration.approve');
    Route::get('/reject/{id}', [OrganizerEventController::class, 'rejectRegistration'])->name('organizer.registration.reject');
});
// Organizer event routes
Route::prefix('organizer/events')->middleware('auth')->name('organizer.events.')->group(function () {
    Route::get('/pending', [OrganizerEventController::class, 'pending'])->name('pending');
    Route::get('/approved', [OrganizerEventController::class, 'approved'])->name('approved');
    Route::get('/rejected', [OrganizerEventController::class, 'rejected'])->name('rejected');
    Route::get('/canceled', [OrganizerEventController::class, 'canceled'])->name('canceled');
});

Route::prefix('organizer/registrations')->middleware('auth')->name('organizer.registrations.')->group(function () {
    Route::get('/', [OrganizerRegistrationController::class, 'index'])->name('index');
    Route::get('/approve/{id}', [OrganizerRegistrationController::class, 'approve'])->name('approve');
    Route::get('/reject/{id}', [OrganizerRegistrationController::class, 'reject'])->name('reject');
});

// Organizer routes
Route::prefix('organizer')->name('organizer.')->middleware('auth')->group(function () {

    // My events
    Route::get('events', [OrganizerEventController::class, 'myEvents'])->name('events.index');
    Route::get('events/status/{status}', [OrganizerEventController::class, 'status'])->name('events.status');
    Route::get('events/{event}/participants', [OrganizerEventController::class, 'participants'])->name('events.participants');

    // Approve / Reject registration
    Route::get('registrations/{registration}/approve', [OrganizerEventController::class, 'approveRegistration'])->name('registration.approve');
    Route::get('registrations/{registration}/reject', [OrganizerEventController::class, 'rejectRegistration'])->name('registration.reject');

    // **All registrations index**
    Route::get('registrations', [OrganizerEventController::class, 'allRegistrations'])->name('registrations.index');
});

require __DIR__.'/auth.php';
