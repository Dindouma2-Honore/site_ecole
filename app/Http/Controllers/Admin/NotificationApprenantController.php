<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationApprenant;
use App\Models\Course;
use App\Models\Apprenant;
use Illuminate\Http\Request;

class NotificationApprenantController extends Controller
{
    public function index()
    {
        $notifications = NotificationApprenant::with(['apprenant', 'course'])->orderBy('created_at', 'desc')->get();
        return view('admin.notifications.index', compact('notifications'));
    }

    public function create()
    {
        $courses = Course::orderBy('order')->get();
        $apprenants = Apprenant::orderBy('last_name')->get();
        return view('admin.notifications.form', compact('courses', 'apprenants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'scope' => 'required|in:tous,classe,individuel',
            'course_id' => 'nullable|exists:courses,id',
            'apprenant_id' => 'nullable|exists:apprenants,id',
            'titre' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:info,alerte,annonce',
        ]);

        if ($validated['scope'] === 'tous') {
            NotificationApprenant::create([
                'titre' => $validated['titre'], 'message' => $validated['message'], 'type' => $validated['type'],
            ]);
        } elseif ($validated['scope'] === 'classe' && $validated['course_id']) {
            NotificationApprenant::create([
                'course_id' => $validated['course_id'], 'titre' => $validated['titre'],
                'message' => $validated['message'], 'type' => $validated['type'],
            ]);
        } elseif ($validated['scope'] === 'individuel' && $validated['apprenant_id']) {
            NotificationApprenant::create([
                'apprenant_id' => $validated['apprenant_id'], 'titre' => $validated['titre'],
                'message' => $validated['message'], 'type' => $validated['type'],
            ]);
        }

        return redirect()->route('admin.notifications.index')->with('success', 'Notification envoyée avec succès.');
    }

    public function destroy($id)
    {
        NotificationApprenant::findOrFail($id)->delete();
        return back()->with('success', 'Notification supprimée.');
    }
}
