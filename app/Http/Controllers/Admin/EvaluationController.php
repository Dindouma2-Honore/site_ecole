<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\Note;
use App\Models\Course;
use App\Models\Discipline;
use App\Models\Apprenant;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index()
    {
        $evaluations = Evaluation::with(['course', 'discipline', 'notes'])->orderBy('date_evaluation', 'desc')->get();
        return view('admin.evaluations.index', compact('evaluations'));
    }

    public function create()
    {
        return $this->form(new Evaluation());
    }

    public function store(Request $request)
    {
        Evaluation::create($this->validateData($request));
        return redirect()->route('admin.evaluations.index')->with('success', 'Évaluation créée avec succès.');
    }

    public function edit($id)
    {
        return $this->form(Evaluation::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        Evaluation::findOrFail($id)->update($this->validateData($request));
        return redirect()->route('admin.evaluations.index')->with('success', 'Évaluation mise à jour avec succès.');
    }

    public function destroy($id)
    {
        Evaluation::findOrFail($id)->delete();
        return back()->with('success', 'Évaluation supprimée.');
    }

    /**
     * Saisie groupée des notes de tous les apprenants d'une classe pour cette évaluation.
     */
    public function notes($id)
    {
        $evaluation = Evaluation::with('course', 'discipline')->findOrFail($id);
        $apprenants = Apprenant::where('course_id', $evaluation->course_id)->orderBy('last_name')->get();
        $notes = Note::where('evaluation_id', $id)->get()->keyBy('apprenant_id');

        return view('admin.evaluations.notes', compact('evaluation', 'apprenants', 'notes'));
    }

    public function saveNotes(Request $request, $id)
    {
        $evaluation = Evaluation::findOrFail($id);

        $validated = $request->validate([
            'notes' => 'array',
            'notes.*' => 'nullable|numeric|min:0|max:' . $evaluation->bareme,
            'appreciations' => 'array',
        ]);

        foreach ($request->input('notes', []) as $apprenantId => $valeur) {
            if ($valeur === null || $valeur === '') {
                continue;
            }
            Note::updateOrCreate(
                ['evaluation_id' => $id, 'apprenant_id' => $apprenantId],
                ['valeur' => $valeur, 'appreciation' => $request->input("appreciations.$apprenantId")]
            );
        }

        return redirect()->route('admin.evaluations.index')->with('success', 'Notes enregistrées avec succès.');
    }

    private function form($evaluation)
    {
        $courses = Course::orderBy('order')->get();
        $disciplines = Discipline::orderBy('name')->get();
        return view('admin.evaluations.form', compact('evaluation', 'courses', 'disciplines'));
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'discipline_id' => 'required|exists:disciplines,id',
            'course_id' => 'required|exists:courses,id',
            'titre' => 'required|string|max:255',
            'type' => 'required|in:controle,devoir,examen',
            'date_evaluation' => 'required|date',
            'coefficient' => 'required|numeric|min:0.5|max:10',
            'bareme' => 'required|numeric|min:1|max:100',
        ]);
    }
}
