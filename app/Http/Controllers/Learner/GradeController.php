<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function index()
    {
        $learner = Auth::user()->learner;

        $grades = Grade::with('course')->where('learner_id', $learner->id)->get()
            ->groupBy(fn($g) => $g->course->name ?? 'Autre');

        $average = DashboardController::computeAverage($learner);
        $performanceByCourse = $this->performanceByCourse($learner);

        return view('learner.grades', compact('learner', 'grades', 'average', 'performanceByCourse'));
    }

    public function performance()
    {
        $learner = Auth::user()->learner;
        $average = DashboardController::computeAverage($learner);
        $performanceByCourse = $this->performanceByCourse($learner);

        return view('learner.performance', compact('learner', 'average', 'performanceByCourse'));
    }

    private function performanceByCourse($learner): array
    {
        $grades = Grade::with('course')->where('learner_id', $learner->id)->get();
        $grouped = $grades->groupBy(fn($g) => $g->course->name ?? 'Autre');

        $result = [];
        foreach ($grouped as $name => $group) {
            $totalWeighted = 0;
            $totalCoeff = 0;
            foreach ($group as $grade) {
                $totalWeighted += $grade->score_sur20 * $grade->coefficient;
                $totalCoeff += $grade->coefficient;
            }
            $result[$name] = $totalCoeff > 0 ? round(($totalWeighted / $totalCoeff) / 20 * 100, 1) : 0;
        }

        return $result;
    }
}
