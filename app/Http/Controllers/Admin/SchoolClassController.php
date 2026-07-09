<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    public function index()
    {
        $classes = Course::orderBy('order')->get();
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        return view('admin.classes.form', ['classe' => new Course()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        Course::create($data);

        return redirect()->route('admin.classes.index')->with('success', 'Classe ajoutée avec succès.');
    }

    public function edit($id)
    {
        $classe = Course::findOrFail($id);
        return view('admin.classes.form', compact('classe'));
    }

    public function update(Request $request, $id)
    {
        $classe = Course::findOrFail($id);
        $data = $this->validateData($request);
        $classe->update($data);

        return redirect()->route('admin.classes.index')->with('success', 'Classe mise à jour avec succès.');
    }

    public function destroy($id)
    {
        Course::findOrFail($id)->delete();
        return back()->with('success', 'Classe supprimée.');
    }

    private function validateData(Request $request): array
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pedagogical_content' => 'nullable|string',
            'admission_conditions' => 'nullable|string',
            'fee' => 'required|numeric|min:0',
            'order' => 'nullable|integer',
            'active' => 'nullable|boolean',
        ]);

        $validated['active'] = $request->boolean('active');
        $validated['order'] = $validated['order'] ?? 0;

        return $validated;
    }
}
