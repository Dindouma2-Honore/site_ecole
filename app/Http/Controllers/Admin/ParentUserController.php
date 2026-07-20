<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Learner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ParentUserController extends Controller
{
    public function index()
    {
        $parents = User::where('role', 'parent')->with('children')->orderBy('name')->get();
        return view('admin.parents.index', compact('parents'));
    }

    public function create()
    {
        $learners = Learner::orderBy('last_name')->get();
        return view('admin.parents.form', ['parentUser' => new User(), 'learners' => $learners, 'linkedIds' => []]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:30',
            'password' => 'nullable|string|min:8',
            'children' => 'array',
            'children.*' => 'exists:learners,id',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => $validated['password'] ?? Str::random(10),
            'role' => 'parent',
        ]);

        foreach ($validated['children'] ?? [] as $learnerId) {
            $user->children()->attach($learnerId, ['relationship' => 'tuteur']);
        }

        return redirect()->route('admin.parents.index')->with('success', 'Parent créé avec succès.');
    }

    public function edit($id)
    {
        $parentUser = User::findOrFail($id);
        $learners = Learner::orderBy('last_name')->get();
        $linkedIds = $parentUser->children()->pluck('learners.id')->toArray();
        return view('admin.parents.form', compact('parentUser', 'learners', 'linkedIds'));
    }

    public function update(Request $request, $id)
    {
        $parentUser = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:30',
            'children' => 'array',
            'children.*' => 'exists:learners,id',
        ]);

        $parentUser->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ]);

        $syncData = [];
        foreach ($validated['children'] ?? [] as $learnerId) {
            $syncData[$learnerId] = ['relationship' => 'tuteur'];
        }
        $parentUser->children()->sync($syncData);

        return redirect()->route('admin.parents.index')->with('success', 'Parent mis à jour avec succès.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Parent supprimé.');
    }
}
