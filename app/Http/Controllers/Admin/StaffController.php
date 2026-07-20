<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ambassador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        $membres = Ambassador::orderBy('order')->get();
        return view('admin.staff.index', compact('membres'));
    }

    public function create()
    {
        return view('admin.staff.form', ['membre' => new Ambassador()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('staff', 'public');
        }

        Ambassador::create($data);

        return redirect()->route('admin.equipe.index')->with('success', 'Membre ajouté avec succès.');
    }

    public function edit($id)
    {
        $membre = Ambassador::findOrFail($id);
        return view('admin.staff.form', compact('membre'));
    }

    public function update(Request $request, $id)
    {
        $membre = Ambassador::findOrFail($id);
        $data = $this->validateData($request);

        if ($request->hasFile('photo')) {
            if ($membre->photo) {
                Storage::disk('public')->delete($membre->photo);
            }
            $data['photo'] = $request->file('photo')->store('staff', 'public');
        }

        $membre->update($data);

        return redirect()->route('admin.equipe.index')->with('success', 'Membre mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $membre = Ambassador::findOrFail($id);
        if ($membre->photo) {
            Storage::disk('public')->delete($membre->photo);
        }
        $membre->delete();

        return back()->with('success', 'Membre supprimé.');
    }

    private function validateData(Request $request): array
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:30',
            'bio' => 'nullable|string',
            'order' => 'nullable|integer',
            'active' => 'nullable|boolean',
            'photo' => 'nullable|image|max:2048',
        ]);

        $validated['active'] = $request->boolean('active');
        $validated['order'] = $validated['order'] ?? 0;

        unset($validated['photo']);

        return $validated;
    }
}
