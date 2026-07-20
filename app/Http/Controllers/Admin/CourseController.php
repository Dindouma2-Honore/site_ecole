<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\SchoolClass;
use App\Models\Ambassador;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $classId = $request->get('class_id');
        $classes = SchoolClass::orderBy('order')->get();

        $query = Course::with(['schoolClass', 'teacher']);
        if ($classId) {
            $query->where('class_id', $classId);
        }

        $courses = $query->orderBy('name')->get();

        return view('admin.courses.index', compact('courses', 'classes', 'classId'));
    }

    public function create()
    {
        return $this->form(new Course());
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['slug'] = Str::slug($data['name']) . '-' . Str::random(4);
        Course::create($data);
        return redirect()->route('admin.courses.index')->with('success', 'Matière ajoutée avec succès.');
    }

    public function edit($id)
    {
        return $this->form(Course::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        Course::findOrFail($id)->update($this->validateData($request));
        return redirect()->route('admin.courses.index')->with('success', 'Matière mise à jour avec succès.');
    }

    public function destroy($id)
    {
        Course::findOrFail($id)->delete();
        return back()->with('success', 'Matière supprimée.');
    }

    private function form($course)
    {
        $classes = SchoolClass::orderBy('order')->get();
        $teachers = Ambassador::where('active', true)->orderBy('name')->get();
        return view('admin.courses.form', compact('course', 'classes', 'teachers'));
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'class_id' => 'required|exists:school_classes,id',
            'name' => 'required|string|max:255',
            'teacher_id' => 'nullable|exists:ambassadors,id',
            'teacher_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:20',
            'coefficient' => 'required|numeric|min:0.5|max:10',
        ]);
    }
}
