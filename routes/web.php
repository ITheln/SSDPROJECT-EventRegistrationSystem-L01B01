<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuditLogController;

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
    
    // FIX: This now calls the Controller to get the $events variable
    Route::get('/dashboard', [EventController::class, 'index'])->name('dashboard');

    // Secure CRUD: Event Registration
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

    // Admin-Only: Audit Log Page
    Route::get('/admin/logs', [AuditLogController::class, 'index'])->name('admin.logs');
});

require __DIR__.'/auth.php';