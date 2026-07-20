<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\SchoolClass;
use App\Models\Learner;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $classId = $request->get('class_id');
        $classes = SchoolClass::orderBy('order')->get();

        $query = Attendance::with(['learner', 'course']);
        if ($classId) {
            $query->whereHas('learner', fn($q) => $q->where('class_id', $classId));
        }

        $attendances = $query->orderBy('date', 'desc')->take(100)->get();

        return view('admin.attendances.index', compact('attendances', 'classes', 'classId'));
    }

    public function create()
    {
        $classes = SchoolClass::orderBy('order')->get();
        return view('admin.attendances.form', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:school_classes,id',
            'date' => 'required|date',
            'statuts' => 'array',
            'justified' => 'array',
        ]);

        $learners = Learner::where('class_id', $validated['class_id'])->get();

        foreach ($learners as $learner) {
            $statut = $request->input("statuts.$learner->id", 'present');
            if ($statut === 'present') continue;

            Attendance::create([
                'learner_id' => $learner->id,
                'date' => $validated['date'],
                'status' => $statut,
                'justified' => $request->boolean("justified.$learner->id"),
            ]);
        }

        return redirect()->route('admin.attendances.index')->with('success', 'Absences enregistrées avec succès.');
    }

    public function destroy($id)
    {
        Attendance::findOrFail($id)->delete();
        return back()->with('success', 'Enregistrement supprimé.');
    }
}
