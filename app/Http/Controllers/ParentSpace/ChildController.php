<?php

namespace App\Http\Controllers\ParentSpace;

use App\Http\Controllers\Controller;
use App\Models\Learner;
use App\Models\Grade;
use App\Models\Attendance;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Learner\DashboardController as LearnerDashboardController;

class ChildController extends Controller
{
    private function authorizeChild(Learner $learner): void
    {
        if (!Auth::user()->children()->where('learners.id', $learner->id)->exists()) {
            abort(403, "Vous n'avez pas accès à ce profil.");
        }
    }

    public function index()
    {
        $children = Auth::user()->children()->with('schoolClass')->get();
        return view('parent.children.index', compact('children'));
    }

    public function show($id)
    {
        $learner = Learner::with('schoolClass')->findOrFail($id);
        $this->authorizeChild($learner);

        $average = LearnerDashboardController::computeAverage($learner);
        $schedule = Schedule::with('course')
            ->where('class_id', $learner->class_id)
            ->orderByRaw("FIELD(day_of_week,'Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi')")
            ->orderBy('start_time')
            ->get()
            ->groupBy('day_of_week');

        return view('parent.children.show', compact('learner', 'average', 'schedule'));
    }

    public function academics($id)
    {
        $learner = Learner::with('schoolClass')->findOrFail($id);
        $this->authorizeChild($learner);

        $grades = Grade::with('course')->where('learner_id', $learner->id)->get()
            ->groupBy(fn($g) => $g->course->name ?? 'Autre');

        $attendances = Attendance::with('course')->where('learner_id', $learner->id)->orderBy('date', 'desc')->get();
        $average = LearnerDashboardController::computeAverage($learner);

        return view('parent.children.academics', compact('learner', 'grades', 'attendances', 'average'));
    }
}
