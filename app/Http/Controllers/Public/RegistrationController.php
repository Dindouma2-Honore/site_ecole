<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\RegistrationDocument;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    public function create(Request $request)
    {
        $classes = SchoolClass::where('active', true)->orderBy('order')->get();
        $selectedClassId = $request->query('class_id');

        return view('site.registrations', compact('classes', 'selectedClassId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'nullable|in:M,F',
            'cycle_souhaite' => 'nullable|in:maternelle,primaire,secondaire,international',
            'class_souhaitee_id' => 'required|exists:school_classes,id',
            'parent_name' => 'required|string|max:255',
            'parent_email' => 'required|email',
            'parent_phone' => 'required|string|max:30',
            'address' => 'nullable|string',
            'previous_school' => 'nullable|string|max:255',
            'documents' => 'nullable|array',
            'documents.acte_naissance' => 'nullable|file|max:5120',
            'documents.bulletin' => 'nullable|file|max:5120',
            'documents.photo' => 'nullable|image|max:2048',
            'documents.certificat_medical' => 'nullable|file|max:5120',
        ]);

        $classe = SchoolClass::find($validated['class_souhaitee_id']);
        if (empty($validated['cycle_souhaite']) && $classe) {
            $validated['cycle_souhaite'] = $classe->cycle;
        }

        $documents = $validated['documents'] ?? [];
        unset($validated['documents']);

        $registration = Registration::create($validated + ['status' => 'nouvelle']);

        foreach ($documents as $type => $file) {
            if ($file) {
                $path = $file->store('registrations', 'public');
                RegistrationDocument::create([
                    'registration_id' => $registration->id,
                    'type' => $type,
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->route('public.registration.status')->with('success', "Votre demande d'inscription a bien été envoyée. Vous pouvez suivre son statut avec l'email du parent/tuteur.");
    }

    public function status()
    {
        return view('site.validation');
    }

    public function checkStatus(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $registration = Registration::where('parent_email', $request->email)
            ->orderBy('created_at', 'desc')
            ->first();

        return view('site.validation-result', compact('registration'));
    }

    public function documents()
    {
        return view('site.documents');
    }
}
