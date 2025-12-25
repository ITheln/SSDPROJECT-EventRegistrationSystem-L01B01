<?php
namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class AuditLogController extends Controller
{
    public function index() {
        // Access Control: Admin only
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $logs = AuditLog::with('user')->latest()->get();
        return view('admin.audit_logs', compact('logs'));
    }
}