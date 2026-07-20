<?php

namespace App\Http\Controllers\ParentSpace;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Announcement;
use App\Http\Controllers\Learner\DashboardController as LearnerDashboardController;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $children = Auth::user()->children()->with('schoolClass')->get();

        $childrenData = $children->map(function ($child) {
            return [
                'learner' => $child,
                'average' => LearnerDashboardController::computeAverage($child),
                'due' => Invoice::where('learner_id', $child->id)->sum('amount'),
                'paid' => Invoice::where('learner_id', $child->id)->get()->sum('paid_amount'),
            ];
        });

        $announcements = Announcement::whereIn('audience', ['tous', 'parents'])
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('parent.dashboard', compact('children', 'childrenData', 'announcements'));
    }
}
