<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Learner;
use App\Models\SchoolClass;
use App\Models\Invoice;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_registrations' => Registration::count(),
            'pending' => Registration::whereIn('status', ['nouvelle', 'en_examen'])->count(),
            'validated' => Registration::where('status', 'validee')->count(),
            'rejected' => Registration::where('status', 'rejetee')->count(),
            'learners' => Learner::where('status', 'actif')->count(),
            'classes' => SchoolClass::count(),
            'unpaid_invoices' => Invoice::where('status', '!=', 'payee')->count(),
        ];

        $recent = Registration::with('classeSouhaitee')->orderBy('created_at', 'desc')->take(10)->get();

        return view('admin.dashboard', compact('stats', 'recent'));
    }
}
