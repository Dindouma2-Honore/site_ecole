<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $learner = Auth::user()->learner;

        $attendances = Attendance::with('course')
            ->where('learner_id', $learner->id)
            ->orderBy('date', 'desc')
            ->get();

        $stats = [
            'absences' => $attendances->where('status', 'absent')->count(),
            'retards' => $attendances->where('status', 'retard')->count(),
            'non_justifiees' => $attendances->where('justified', false)->whereIn('status', ['absent', 'retard'])->count(),
        ];

        return view('learner.attendance', compact('learner', 'attendances', 'stats'));
    }
}
