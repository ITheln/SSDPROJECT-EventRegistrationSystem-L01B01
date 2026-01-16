<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Protected Group: Authenticated users only
Route::middleware(['auth'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [EventController::class, 'index'])->name('dashboard');

    // USER PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// ==========================================
    // SYSTEM ADMIN (Logs Only)
    // ==========================================
    
    // 1. Show Audit Logs
    Route::get('/admin/audit-logs', function () {
        // Only System Admin can enter
        if (auth()->user()->role !== 'system_admin') { abort(403, 'Unauthorized.'); }
        
        $logs = App\Models\AuditLog::latest()->get();
        return view('admin.audit_logs', compact('logs'));
    })->name('audit.logs');

    // 4. Delete Audit Log Route
    Route::delete('/admin/audit-logs/{id}', function ($id) {
        // Only System Admin can delete
        if (auth()->user()->role !== 'system_admin') { abort(403, 'Unauthorized.'); }
        return app(EventController::class)->adminDeleteLog($id);
    })->name('admin.logs.delete');


    // ==========================================
    // EVENT ADMIN (Create Events Only)
    // ==========================================
    
    // 2. Show Create Event Form
    Route::get('/admin/events/create', function () {
        // Only Event Admin can enter
        if (auth()->user()->role !== 'event_admin') { abort(403, 'Unauthorized.'); }
        return app(EventController::class)->adminCreate();
    })->name('admin.events.create');

    // 3. Process Create Event
    Route::post('/admin/events/store', function (Illuminate\Http\Request $request) {
        // Only Event Admin can store
        if (auth()->user()->role !== 'event_admin') { abort(403, 'Unauthorized.'); }
        return app(EventController::class)->adminStore($request);
    })->name('admin.events.store');

    // ==========================================
    // REGULAR USER ROUTES
    // ==========================================

    // Show Available Events
    Route::get('/events/available', [EventController::class, 'available'])->name('events.available');
    
    // Register for Event
    Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register');

    // Other User Actions
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

}); 

require __DIR__.'/auth.php';