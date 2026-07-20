<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Course;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with(['course.schoolClass', 'submissions'])->orderBy('due_date', 'desc')->get();
        return view('admin.assignments.index', compact('assignments'));
    }

    public function create()
    {
        return $this->form(new Assignment());
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['slug'] = Str::slug($data['title']) . '-' . Str::random(4);

        if ($request->hasFile('attachment_path')) {
            $data['attachment_path'] = $request->file('attachment_path')->store('assignments', 'public');
        }

        Assignment::create($data);
        return redirect()->route('admin.assignments.index')->with('success', 'Devoir publié avec succès.');
    }

    public function edit($id)
    {
        return $this->form(Assignment::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $assignment = Assignment::findOrFail($id);
        $data = $this->validateData($request);

        if ($request->hasFile('attachment_path')) {
            if ($assignment->attachment_path) Storage::disk('public')->delete($assignment->attachment_path);
            $data['attachment_path'] = $request->file('attachment_path')->store('assignments', 'public');
        }

        $assignment->update($data);
        return redirect()->route('admin.assignments.index')->with('success', 'Devoir mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);
        if ($assignment->attachment_path) Storage::disk('public')->delete($assignment->attachment_path);
        $assignment->delete();
        return back()->with('success', 'Devoir supprimé.');
    }

    public function submissions($id)
    {
        $assignment = Assignment::with('course.schoolClass')->findOrFail($id);
        $submissions = AssignmentSubmission::with('learner')->where('assignment_id', $id)->orderBy('submitted_at')->get();
        return view('admin.assignments.submissions', compact('assignment', 'submissions'));
    }

    public function gradeSubmission(Request $request, $id)
    {
        $validated = $request->validate(['grade' => 'required|numeric|min:0|max:20']);
        $submission = AssignmentSubmission::findOrFail($id);
        $submission->update(['grade' => $validated['grade'], 'status' => 'note']);
        return back()->with('success', 'Soumission notée avec succès.');
    }

    private function form($assignment)
    {
        $courses = Course::with('schoolClass')->orderBy('name')->get();
        return view('admin.assignments.form', compact('assignment', 'courses'));
    }

    private function validateData(Request $request): array
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'attachment_path' => 'nullable|file|max:10240',
        ]);
        unset($validated['attachment_path']);
        return $validated;
    }
}
