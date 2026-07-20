<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $learner = Auth::user()->learner;
        return view('learner.profile', compact('learner'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $learner = $user->learner;

        $validated = $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:30',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user->update(['email' => $validated['email'], 'phone' => $validated['phone'] ?? null]);

        if ($request->hasFile('photo')) {
            if ($learner->photo) {
                Storage::disk('public')->delete($learner->photo);
            }
            $learner->update(['photo' => $request->file('photo')->store('learners', 'public')]);
        }

        return back()->with('success', 'Profil mis à jour avec succès.');
    }
}
