<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
    {
        $learner = Auth::user()->learner;

        $assignments = Assignment::with(['course', 'submissions' => function ($q) use ($learner) {
                $q->where('learner_id', $learner->id);
            }])
            ->whereHas('course', fn($q) => $q->where('class_id', $learner->class_id))
            ->orderBy('due_date', 'desc')
            ->get();

        return view('learner.assignments', compact('learner', 'assignments'));
    }

    public function submit(Request $request, $id)
    {
        $learner = Auth::user()->learner;
        $assignment = Assignment::findOrFail($id);

        $request->validate([
            'file' => 'required|file|max:10240',
            'comment' => 'nullable|string',
        ]);

        $path = $request->file('file')->store('submissions', 'public');

        AssignmentSubmission::updateOrCreate(
            ['assignment_id' => $assignment->id, 'learner_id' => $learner->id],
            [
                'file_path' => $path,
                'comment' => $request->comment,
                'submitted_at' => now(),
                'status' => now()->gt($assignment->due_date) ? 'en_retard' : 'soumis',
            ]
        );

        return back()->with('success', 'Votre devoir a bien été soumis.');
    }
}
