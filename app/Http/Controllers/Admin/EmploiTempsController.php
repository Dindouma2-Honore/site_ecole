<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmploiTemps;
use App\Models\Course;
use App\Models\Discipline;
use App\Models\Ambassador;
use Illuminate\Http\Request;

class EmploiTempsController extends Controller
{
    public function index(Request $request)
    {
        $courseId = $request->get('course_id');
        $courses = Course::orderBy('order')->get();

        $query = EmploiTemps::with(['course', 'discipline', 'enseignant'])
            ->orderByRaw("FIELD(jour,'Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi')")
            ->orderBy('heure_debut');

        if ($courseId) {
            $query->where('course_id', $courseId);
        }

        $creneaux = $query->get();

        return view('admin.emploi-temps.index', compact('creneaux', 'courses', 'courseId'));
    }

    public function create()
    {
        return $this->form(new EmploiTemps());
    }

    public function store(Request $request)
    {
        EmploiTemps::create($this->validateData($request));
        return redirect()->route('admin.emploi-temps.index')->with('success', 'Créneau ajouté avec succès.');
    }

    public function edit($id)
    {
        return $this->form(EmploiTemps::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        EmploiTemps::findOrFail($id)->update($this->validateData($request));
        return redirect()->route('admin.emploi-temps.index')->with('success', 'Créneau mis à jour avec succès.');
    }

    public function destroy($id)
    {
        EmploiTemps::findOrFail($id)->delete();
        return back()->with('success', 'Créneau supprimé.');
    }

    private function form($creneau)
    {
        $courses = Course::orderBy('order')->get();
        $disciplines = Discipline::orderBy('name')->get();
        $enseignants = Ambassador::where('active', true)->orderBy('name')->get();
        return view('admin.emploi-temps.form', compact('creneau', 'courses', 'disciplines', 'enseignants'));
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'course_id' => 'required|exists:courses,id',
            'discipline_id' => 'required|exists:disciplines,id',
            'enseignant_id' => 'nullable|exists:ambassadors,id',
            'jour' => 'required|in:Lundi,Mardi,Mercredi,Jeudi,Vendredi,Samedi',
            'heure_debut' => 'required',
            'heure_fin' => 'required|after:heure_debut',
            'salle' => 'nullable|string|max:50',
        ]);
    }
}
