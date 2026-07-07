<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Ambassador;
use App\Models\Course;
use App\Models\Document;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_registrations' => Registration::count(),
            'pending' => Registration::where('status', 'pending')->count(),
            'validated' => Registration::where('status', 'validated')->count(),
            'rejected' => Registration::where('status', 'rejected')->count(),
        ];
        $recent = Registration::orderBy('created_at', 'desc')->take(10)->get();
        return view('admin.dashboard', compact('stats', 'recent'));
    }

    public function registrations()
    {
        $registrations = Registration::with('course')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.registrations', compact('registrations'));
    }

    public function validateRegistration($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->status = 'validated';
        $registration->validated_at = now();
        $registration->save();

        return back()->with('success', 'Inscription validée avec succès !');
    }

    public function deleteRegistration($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();

        return back()->with('success', 'Inscription supprimée.');
    }

    public function resendApproval($id)
    {
        $registration = Registration::findOrFail($id);
        // Logique d'envoi d'email d'approbation
        // Mail::to($registration->email)->send(new ApprovalRenewed($registration));

        return back()->with('success', 'Approbation renvoyée avec succès !');
    }
}