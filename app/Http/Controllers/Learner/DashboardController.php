<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Assignment;
use App\Models\Grade;
use App\Models\Invoice;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $learner = Auth::user()->learner;

        $todaySchedule = Schedule::with('course')
            ->where('class_id', $learner->class_id)
            ->orderByRaw("FIELD(day_of_week,'Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi')")
            ->orderBy('start_time')
            ->take(4)
            ->get();

        $upcomingAssignments = Assignment::with('course')
            ->whereHas('course', fn($q) => $q->where('class_id', $learner->class_id))
            ->where('due_date', '>=', now()->toDateString())
            ->orderBy('due_date')
            ->take(3)
            ->get();

        $average = $this->computeAverage($learner);

        $totalDue = Invoice::where('learner_id', $learner->id)->sum('amount');
        $totalPaid = Invoice::where('learner_id', $learner->id)->get()->sum('paid_amount');

        $announcements = Announcement::whereIn('audience', ['tous', 'apprenants'])
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $coursesCount = $learner->schoolClass?->courses()->count() ?? 0;

        return view('site.espace-apprenant.dashboard', compact(
            'learner', 'todaySchedule', 'upcomingAssignments', 'average',
            'totalDue', 'totalPaid', 'announcements', 'coursesCount'
        ));
    }

    public static function computeAverage($learner): ?float
    {
        $grades = Grade::where('learner_id', $learner->id)->get();
        if ($grades->isEmpty()) return null;

        $totalWeighted = 0;
        $totalCoeff = 0;
        foreach ($grades as $grade) {
            $totalWeighted += $grade->score_sur20 * $grade->coefficient;
            $totalCoeff += $grade->coefficient;
        }

        return $totalCoeff > 0 ? round($totalWeighted / $totalCoeff, 1) : null;
    }
}
