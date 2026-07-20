<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::orderBy('order')->get();
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        $academicYears = AcademicYear::orderBy('label', 'desc')->get();
        return view('admin.classes.form', ['classe' => new SchoolClass(), 'academicYears' => $academicYears]);
    }

    public function store(Request $request)
    {
        SchoolClass::create($this->validateData($request));
        return redirect()->route('admin.classes.index')->with('success', 'Classe ajoutée avec succès.');
    }

    public function edit($id)
    {
        $classe = SchoolClass::findOrFail($id);
        $academicYears = AcademicYear::orderBy('label', 'desc')->get();
        return view('admin.classes.form', compact('classe', 'academicYears'));
    }

    public function update(Request $request, $id)
    {
        SchoolClass::findOrFail($id)->update($this->validateData($request));
        return redirect()->route('admin.classes.index')->with('success', 'Classe mise à jour avec succès.');
    }

    public function destroy($id)
    {
        SchoolClass::findOrFail($id)->delete();
        return back()->with('success', 'Classe supprimée.');
    }

    private function validateData(Request $request): array
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cycle' => 'required|in:maternelle,primaire,secondaire,international',
            'level' => 'nullable|string|max:255',
            'academic_year_id' => 'nullable|exists:academic_years,id',
            'capacity' => 'nullable|integer|min:1',
            'description' => 'nullable|string',
            'pedagogical_content' => 'nullable|string',
            'admission_conditions' => 'nullable|string',
            'fee' => 'required|numeric|min:0',
            'order' => 'nullable|integer',
            'active' => 'nullable|boolean',
        ]);

        $validated['active'] = $request->boolean('active');
        $validated['order'] = $validated['order'] ?? 0;
        $validated['capacity'] = $validated['capacity'] ?? 30;

        return $validated;
    }
}
