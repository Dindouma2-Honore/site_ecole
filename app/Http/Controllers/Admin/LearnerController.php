<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Learner;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LearnerController extends Controller
{
    public function index(Request $request)
    {
        $classId = $request->get('class_id');
        $classes = SchoolClass::orderBy('order')->get();

        $query = Learner::with('schoolClass');
        if ($classId) {
            $query->where('class_id', $classId);
        }

        $learners = $query->orderBy('last_name')->get();

        return view('admin.learners.index', compact('learners', 'classes', 'classId'));
    }

    public function create()
    {
        $classes = SchoolClass::orderBy('order')->get();
        return view('admin.learners.form', ['learner' => new Learner(), 'classes' => $classes]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        $user = User::create([
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ?? Str::random(10),
            'role' => 'apprenant',
        ]);

        $validated['matricule'] = $this->generateMatricule();
        $validated['user_id'] = $user->id;
        unset($validated['email'], $validated['password'], $validated['photo']);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('learners', 'public');
        }

        Learner::create($validated);

        return redirect()->route('admin.learners.index')->with('success', 'Apprenant créé avec succès.');
    }

    public function show($id)
    {
        $learner = Learner::with(['schoolClass', 'user', 'parents'])->findOrFail($id);
        return view('admin.learners.show', compact('learner'));
    }

    public function edit($id)
    {
        $learner = Learner::findOrFail($id);
        $classes = SchoolClass::orderBy('order')->get();
        return view('admin.learners.form', compact('learner', 'classes'));
    }

    public function update(Request $request, $id)
    {
        $learner = Learner::findOrFail($id);
        $validated = $this->validateData($request, $learner);
        unset($validated['email'], $validated['password'], $validated['photo']);

        if ($request->hasFile('photo')) {
            if ($learner->photo) Storage::disk('public')->delete($learner->photo);
            $validated['photo'] = $request->file('photo')->store('learners', 'public');
        }

        $learner->update($validated);

        return redirect()->route('admin.learners.index')->with('success', 'Apprenant mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $learner = Learner::findOrFail($id);
        if ($learner->photo) Storage::disk('public')->delete($learner->photo);
        $learner->delete();
        return back()->with('success', 'Apprenant supprimé.');
    }

    public static function generateMatricule(): string
    {
        return 'AMB' . now()->format('Y') . '-' . str_pad((string) (Learner::count() + 1), 4, '0', STR_PAD_LEFT);
    }

    private function validateData(Request $request, ?Learner $learner = null): array
    {
        $emailRule = 'nullable|email';
        if (!$learner) {
            $emailRule = 'required|email|unique:users,email';
        }

        return $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:M,F',
            'class_id' => 'required|exists:school_classes,id',
            'status' => 'required|in:actif,inactif,diplome',
            'annee_scolaire' => 'nullable|string|max:20',
            'email' => $emailRule,
            'password' => 'nullable|string|min:8',
            'photo' => 'nullable|image|max:2048',
        ]);
    }
}
