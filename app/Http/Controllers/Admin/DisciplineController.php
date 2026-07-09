<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discipline;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    public function index()
    {
        $disciplines = Discipline::orderBy('order')->get();
        return view('admin.disciplines.index', compact('disciplines'));
    }

    public function create()
    {
        return view('admin.disciplines.form', ['discipline' => new Discipline()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        Discipline::create($data);

        return redirect()->route('admin.disciplines.index')->with('success', 'Discipline ajoutée avec succès.');
    }

    public function edit($id)
    {
        $discipline = Discipline::findOrFail($id);
        return view('admin.disciplines.form', compact('discipline'));
    }

    public function update(Request $request, $id)
    {
        $discipline = Discipline::findOrFail($id);
        $data = $this->validateData($request);
        $discipline->update($data);

        return redirect()->route('admin.disciplines.index')->with('success', 'Discipline mise à jour avec succès.');
    }

    public function destroy($id)
    {
        Discipline::findOrFail($id)->delete();
        return back()->with('success', 'Discipline supprimée.');
    }

    private function validateData(Request $request): array
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:10',
            'order' => 'nullable|integer',
            'active' => 'nullable|boolean',
        ]);

        $validated['active'] = $request->boolean('active');
        $validated['order'] = $validated['order'] ?? 0;

        return $validated;
    }
}
