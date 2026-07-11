<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evenement;
use Illuminate\Http\Request;

class EvenementController extends Controller
{
    public function index()
    {
        $evenements = Evenement::orderBy('event_date')->get();
        return view('admin.evenements.index', compact('evenements'));
    }

    public function create()
    {
        return view('admin.evenements.form', ['evenement' => new Evenement()]);
    }

    public function store(Request $request)
    {
        Evenement::create($this->validateData($request));
        return redirect()->route('admin.evenements.index')->with('success', 'Événement ajouté avec succès.');
    }

    public function edit($id)
    {
        $evenement = Evenement::findOrFail($id);
        return view('admin.evenements.form', compact('evenement'));
    }

    public function update(Request $request, $id)
    {
        Evenement::findOrFail($id)->update($this->validateData($request));
        return redirect()->route('admin.evenements.index')->with('success', 'Événement mis à jour avec succès.');
    }

    public function destroy($id)
    {
        Evenement::findOrFail($id)->delete();
        return back()->with('success', 'Événement supprimé.');
    }

    private function validateData(Request $request): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_time' => 'nullable',
            'icon' => 'nullable|string|max:10',
            'location' => 'nullable|string|max:255',
            'active' => 'nullable|boolean',
        ]);

        $validated['active'] = $request->boolean('active');

        return $validated;
    }
}
