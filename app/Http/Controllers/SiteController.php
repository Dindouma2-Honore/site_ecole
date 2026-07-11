<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Ambassador;
use App\Models\Course;
use App\Models\Document;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        $ambassadors = Ambassador::where('active', true)->take(3)->get();
        $courses = Course::where('active', true)->take(4)->get();
        $stats = [
            'students' => Registration::where('status', 'validated')->count(),
            'teachers' => Ambassador::where('role', 'teacher')->count(),
            'courses' => Course::count(),
        ];
        return view('site.home', compact('ambassadors', 'courses', 'stats'));
    }

    public function registrations(Request $request)
    {
        $courses = Course::where('active', true)->orderBy('order')->get();
        $selectedCourseId = $request->query('course_id');
        return view('site.registrations', compact('courses', 'selectedCourseId'));
    }

    public function submitRegistration(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:registrations',
            'phone' => 'required|string|max:20',
            'course_id' => 'required|exists:courses,id',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'parent_name' => 'required|string',
            'parent_phone' => 'required|string',
        ]);

        $registration = Registration::create($validated + ['status' => 'pending']);

        return redirect()->route('validation')->with('success', 'Inscription soumise avec succès !');
    }

    public function documents()
    {
        $requiredDocs = Document::where('required', true)->get();
        return view('site.documents', compact('requiredDocs'));
    }

    public function validation()
    {
        return view('site.validation');
    }

    public function checkValidation(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $registration = Registration::where('email', $request->email)->first();

        return view('site.validation-result', compact('registration'));
    }

    public function dashboard()
    {
        // Vue publique du tableau de bord (simplifié)
        return view('site.public-dashboard');
    }
}
