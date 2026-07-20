<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Course;
use App\Models\Learner;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        $courseId = $request->get('course_id');
        $courses = Course::with('schoolClass')->orderBy('name')->get();

        $query = Grade::with(['learner', 'course.schoolClass']);
        if ($courseId) {
            $query->where('course_id', $courseId);
        }

        $grades = $query->orderBy('created_at', 'desc')->take(100)->get();

        return view('admin.grades.index', compact('grades', 'courses', 'courseId'));
    }

    /**
     * Saisie groupée des notes pour tous les apprenants d'un cours donné.
     */
    public function entry(Request $request)
    {
        $courseId = $request->get('course_id');
        $courses = Course::with('schoolClass')->orderBy('name')->get();
        $learners = collect();
        $course = null;

        if ($courseId) {
            $course = Course::with('schoolClass')->findOrFail($courseId);
            $learners = Learner::where('class_id', $course->class_id)->orderBy('last_name')->get();
        }

        return view('admin.grades.entry', compact('courses', 'courseId', 'learners', 'course'));
    }

    public function storeEntry(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'term' => 'required|string|max:50',
            'title' => 'nullable|string|max:255',
            'max_score' => 'required|numeric|min:1',
            'coefficient' => 'required|numeric|min:0.5',
            'scores' => 'array',
        ]);

        foreach ($request->input('scores', []) as $learnerId => $score) {
            if ($score === null || $score === '') continue;

            Grade::create([
                'learner_id' => $learnerId,
                'course_id' => $validated['course_id'],
                'term' => $validated['term'],
                'title' => $validated['title'],
                'score' => $score,
                'max_score' => $validated['max_score'],
                'coefficient' => $validated['coefficient'],
            ]);
        }

        return redirect()->route('admin.grades.index')->with('success', 'Notes enregistrées avec succès.');
    }

    public function destroy($id)
    {
        Grade::findOrFail($id)->delete();
        return back()->with('success', 'Note supprimée.');
    }
}
