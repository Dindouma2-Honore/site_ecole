<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Devoir;
use App\Models\Course;
use App\Models\Discipline;
use App\Models\SoumissionDevoir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DevoirController extends Controller
{
    public function index()
    {
        $devoirs = Devoir::with(['course', 'discipline', 'soumissions'])->orderBy('date_limite', 'desc')->get();
        return view('admin.devoirs.index', compact('devoirs'));
    }

    public function create()
    {
        return $this->form(new Devoir());
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('fichier_joint')) {
            $data['fichier_joint'] = $request->file('fichier_joint')->store('devoirs', 'public');
        }
        Devoir::create($data);
        return redirect()->route('admin.devoirs.index')->with('success', 'Devoir publié avec succès.');
    }

    public function edit($id)
    {
        return $this->form(Devoir::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $devoir = Devoir::findOrFail($id);
        $data = $this->validateData($request);
        if ($request->hasFile('fichier_joint')) {
            if ($devoir->fichier_joint) Storage::disk('public')->delete($devoir->fichier_joint);
            $data['fichier_joint'] = $request->file('fichier_joint')->store('devoirs', 'public');
        }
        $devoir->update($data);
        return redirect()->route('admin.devoirs.index')->with('success', 'Devoir mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $devoir = Devoir::findOrFail($id);
        if ($devoir->fichier_joint) Storage::disk('public')->delete($devoir->fichier_joint);
        $devoir->delete();
        return back()->with('success', 'Devoir supprimé.');
    }

    /**
     * Liste des soumissions reçues pour un devoir, avec possibilité de noter.
     */
    public function soumissions($id)
    {
        $devoir = Devoir::with(['course', 'discipline'])->findOrFail($id);
        $soumissions = SoumissionDevoir::with('apprenant')->where('devoir_id', $id)->orderBy('date_soumission')->get();
        return view('admin.devoirs.soumissions', compact('devoir', 'soumissions'));
    }

    public function noterSoumission(Request $request, $id)
    {
        $validated = $request->validate(['note' => 'required|numeric|min:0|max:20']);
        $soumission = SoumissionDevoir::findOrFail($id);
        $soumission->update(['note' => $validated['note'], 'statut' => 'note']);
        return back()->with('success', 'Soumission notée avec succès.');
    }

    private function form($devoir)
    {
        $courses = Course::orderBy('order')->get();
        $disciplines = Discipline::orderBy('name')->get();
        return view('admin.devoirs.form', compact('devoir', 'courses', 'disciplines'));
    }

    private function validateData(Request $request): array
    {
        $validated = $request->validate([
            'discipline_id' => 'required|exists:disciplines,id',
            'course_id' => 'required|exists:courses,id',
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_publication' => 'required|date',
            'date_limite' => 'required|date|after_or_equal:date_publication',
            'fichier_joint' => 'nullable|file|max:10240',
        ]);
        unset($validated['fichier_joint']);
        return $validated;
    }
}
