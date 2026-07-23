<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Learner;
use App\Models\User;
use App\Mail\AccountCredentialsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');

        $query = Registration::with(['classeSouhaitee', 'documents']);
        if ($status) {
            $query->where('status', $status);
        }

        $registrations = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        return view('admin.registrations.index', compact('registrations', 'status'));
    }

    public function show($id)
    {
        $registration = Registration::with(['classeSouhaitee', 'documents'])->findOrFail($id);
        return view('admin.registrations.show', compact('registration'));
    }


    
    public function updateStatus(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:nouvelle,en_examen,validee,liste_attente,rejetee',
            'admin_notes' => 'nullable|string',
        ]);

        $wasAlreadyValidated = $registration->status === 'validee';

        $registration->update($validated + [
            'processed_by' => Auth::id(),
            'processed_at' => now(),
        ]);

        $message = 'Statut mis à jour avec succès.';

        if ($validated['status'] === 'validee' && !$wasAlreadyValidated) {
            $message = $this->provisionAccounts($registration);
        }

        return back()->with('success', $message);
    }

    public function destroy($id)
    {
        Registration::findOrFail($id)->delete();
        return back()->with('success', 'Dossier supprimé.');
    }

    /**
     * Crée automatiquement le compte apprenant + le compte parent (ou réutilise
     * un compte parent existant avec le même email) et envoie les identifiants.
     */
    private function provisionAccounts(Registration $registration): string
    {
        // 1. Compte parent : réutiliser s'il existe déjà, sinon le créer
        $parentUser = User::where('email', $registration->parent_email)->first();
        $parentIsNew = false;
        $parentPassword = null;

        if (!$parentUser) {
            $parentPassword = Str::random(10);
            $parentUser = User::create([
                'name' => $registration->parent_name,
                'email' => $registration->parent_email,
                'phone' => $registration->parent_phone,
                'password' => $parentPassword,
                'role' => 'parent',
            ]);
            $parentIsNew = true;
        }

        // 2. Compte apprenant
        $learnerEmail = $this->generateLearnerEmail($registration);
        $learnerPassword = Str::random(10);

        $learnerUser = User::create([
            'name' => $registration->first_name . ' ' . $registration->last_name,
            'email' => $learnerEmail,
            'password' => $learnerPassword,
            'role' => 'apprenant',
        ]);

        $matricule = LearnerController::generateMatricule();

        $learner = Learner::create([
            'matricule' => $matricule,
            'user_id' => $learnerUser->id,
            'first_name' => $registration->first_name,
            'last_name' => $registration->last_name,
            'birth_date' => $registration->birth_date,
            'gender' => $registration->gender,
            'class_id' => $registration->class_souhaitee_id,
            'status' => 'actif',
            'annee_scolaire' => now()->format('Y') . '-' . (now()->year + 1),
        ]);

        // 3. Lien parent <-> apprenant
        $parentUser->children()->syncWithoutDetaching([$learner->id => ['relationship' => 'tuteur']]);

        // 4. Envoi des identifiants (utilise le driver de mail configuré ; log par défaut)
        try {
            Mail::to($learnerEmail)->send(new AccountCredentialsMail(
                $registration->first_name . ' ' . $registration->last_name,
                $learnerEmail,
                $learnerPassword,
                'apprenant',
                $matricule
            ));

            if ($parentIsNew) {
                Mail::to($registration->parent_email)->send(new AccountCredentialsMail(
                    $registration->parent_name,
                    $registration->parent_email,
                    $parentPassword,
                    'parent'
                ));
            }
        } catch (\Throwable $e) {
            // L'échec d'envoi d'email ne doit pas bloquer la validation de l'inscription
        }

        return "Inscription validée : compte apprenant ($learnerEmail) et compte parent créés avec succès. Identifiants envoyés par email.";
    }

    private function generateLearnerEmail(Registration $registration): string
    {
        $base = Str::slug($registration->first_name . '.' . $registration->last_name, '.');
        $email = $base . '@ambassadors.school';
        $i = 1;

        while (User::where('email', $email)->exists()) {
            $email = $base . $i . '@ambassadors.school';
            $i++;
        }

        return $email;
    }
}
