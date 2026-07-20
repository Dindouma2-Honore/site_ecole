<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $learner = Auth::user()->learner;

        $schedule = Schedule::with(['course.teacher'])
            ->where('class_id', $learner->class_id)
            ->orderByRaw("FIELD(day_of_week,'Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi')")
            ->orderBy('start_time')
            ->get()
            ->groupBy('day_of_week');

        return view('learner.schedule', compact('learner', 'schedule'));
    }
}
