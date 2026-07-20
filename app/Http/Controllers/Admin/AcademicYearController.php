<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    public function index()
    {
        $academicYears = AcademicYear::orderBy('start_date', 'desc')->get();
        return view('admin.academic-years.index', compact('academicYears'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:20|unique:academic_years,label',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $validated['is_current'] = $request->boolean('is_current');

        if ($validated['is_current']) {
            AcademicYear::where('is_current', true)->update(['is_current' => false]);
        }

        AcademicYear::create($validated);

        return back()->with('success', 'Année scolaire ajoutée avec succès.');
    }

    public function setCurrent($id)
    {
        AcademicYear::where('is_current', true)->update(['is_current' => false]);
        AcademicYear::findOrFail($id)->update(['is_current' => true]);
        return back()->with('success', 'Année scolaire courante mise à jour.');
    }

    public function destroy($id)
    {
        AcademicYear::findOrFail($id)->delete();
        return back()->with('success', 'Année scolaire supprimée.');
    }
}
