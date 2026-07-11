<?php

namespace App\Http\Controllers;

use App\Models\EmploiTemps;
use App\Models\Note;
use App\Models\Devoir;
use App\Models\SoumissionDevoir;
use App\Models\Facture;
use App\Models\NotificationApprenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EspaceApprenantController extends Controller
{
    private function apprenant()
    {
        return Auth::guard('apprenant')->user();
    }

    public function dashboard()
    {
        $apprenant = $this->apprenant();

        $emploiDuJour = EmploiTemps::with('discipline')
            ->where('course_id', $apprenant->course_id)
            ->orderByRaw("FIELD(jour,'Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi')")
            ->orderBy('heure_debut')
            ->take(4)
            ->get();

        $moyenneGenerale = $this->calculerMoyenneGenerale($apprenant);
        $performancesParMatiere = $this->calculerPerformancesParMatiere($apprenant);

        $devoirsAvenir = Devoir::with('discipline')
            ->where('course_id', $apprenant->course_id)
            ->where('date_limite', '>=', now()->toDateString())
            ->orderBy('date_limite')
            ->take(3)
            ->get();

        $totalDu = Facture::where('apprenant_id', $apprenant->id)->sum('montant_total');
        $totalPaye = Facture::where('apprenant_id', $apprenant->id)->get()->sum('montant_paye');

        $notifications = NotificationApprenant::where(function ($q) use ($apprenant) {
                $q->where('apprenant_id', $apprenant->id)
                  ->orWhere('course_id', $apprenant->course_id)
                  ->orWhereNull('apprenant_id')->whereNull('course_id');
            })
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $nbNotifNonLues = NotificationApprenant::where(function ($q) use ($apprenant) {
                $q->where('apprenant_id', $apprenant->id)
                  ->orWhere('course_id', $apprenant->course_id)
                  ->orWhere(function ($qq) { $qq->whereNull('apprenant_id')->whereNull('course_id'); });
            })->where('lu', false)->count();

        $coursCount = EmploiTemps::where('course_id', $apprenant->course_id)->distinct('discipline_id')->count('discipline_id');

        return view('site.espace-apprenant.dashboard', compact(
            'apprenant', 'emploiDuJour', 'moyenneGenerale', 'performancesParMatiere',
            'devoirsAvenir', 'totalDu', 'totalPaye', 'notifications', 'nbNotifNonLues', 'coursCount'
        ));
    }

    public function emploiTemps()
    {
        $apprenant = $this->apprenant();
        $creneaux = EmploiTemps::with(['discipline', 'enseignant'])
            ->where('course_id', $apprenant->course_id)
            ->orderByRaw("FIELD(jour,'Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi')")
            ->orderBy('heure_debut')
            ->get()
            ->groupBy('jour');

        return view('site.espace-apprenant.emploi-temps', compact('apprenant', 'creneaux'));
    }

    public function notes()
    {
        $apprenant = $this->apprenant();

        $notes = Note::with('evaluation.discipline')
            ->where('apprenant_id', $apprenant->id)
            ->get()
            ->groupBy(fn($note) => $note->evaluation->discipline->name ?? 'Autre');

        $moyenneGenerale = $this->calculerMoyenneGenerale($apprenant);
        $performancesParMatiere = $this->calculerPerformancesParMatiere($apprenant);

        return view('site.espace-apprenant.notes', compact('apprenant', 'notes', 'moyenneGenerale', 'performancesParMatiere'));
    }

    public function devoirs()
    {
        $apprenant = $this->apprenant();

        $devoirs = Devoir::with(['discipline', 'soumissions' => function ($q) use ($apprenant) {
                $q->where('apprenant_id', $apprenant->id);
            }])
            ->where('course_id', $apprenant->course_id)
            ->orderBy('date_limite', 'desc')
            ->get();

        return view('site.espace-apprenant.devoirs', compact('apprenant', 'devoirs'));
    }

    public function soumettreDevoir(Request $request, $id)
    {
        $apprenant = $this->apprenant();
        $devoir = Devoir::findOrFail($id);

        $request->validate([
            'fichier' => 'required|file|max:10240',
            'commentaire' => 'nullable|string',
        ]);

        $path = $request->file('fichier')->store('soumissions', 'public');

        SoumissionDevoir::updateOrCreate(
            ['devoir_id' => $devoir->id, 'apprenant_id' => $apprenant->id],
            [
                'fichier_joint' => $path,
                'commentaire' => $request->commentaire,
                'date_soumission' => now(),
                'statut' => now()->gt($devoir->date_limite) ? 'en_retard' : 'soumis',
            ]
        );

        return back()->with('success', 'Votre devoir a bien été soumis.');
    }

    public function finances()
    {
        $apprenant = $this->apprenant();
        $factures = Facture::with('paiements')->where('apprenant_id', $apprenant->id)->orderBy('date_emission', 'desc')->get();

        return view('site.espace-apprenant.finances', compact('apprenant', 'factures'));
    }

    public function notifications()
    {
        $apprenant = $this->apprenant();
        $notifications = NotificationApprenant::where(function ($q) use ($apprenant) {
                $q->where('apprenant_id', $apprenant->id)
                  ->orWhere('course_id', $apprenant->course_id)
                  ->orWhere(function ($qq) { $qq->whereNull('apprenant_id')->whereNull('course_id'); });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('site.espace-apprenant.notifications', compact('apprenant', 'notifications'));
    }

    public function markNotificationRead($id)
    {
        NotificationApprenant::findOrFail($id)->update(['lu' => true]);
        return back();
    }

    public function profil()
    {
        $apprenant = $this->apprenant();
        return view('site.espace-apprenant.profil', compact('apprenant'));
    }

    public function updateProfil(Request $request)
    {
        $apprenant = $this->apprenant();

        $validated = $request->validate([
            'email' => 'required|email|unique:apprenants,email,' . $apprenant->id,
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($apprenant->photo) {
                Storage::disk('public')->delete($apprenant->photo);
            }
            $validated['photo'] = $request->file('photo')->store('apprenants', 'public');
        }

        $apprenant->update($validated);

        return back()->with('success', 'Profil mis à jour avec succès.');
    }

    private function calculerMoyenneGenerale($apprenant): ?float
    {
        $notes = Note::with('evaluation')->where('apprenant_id', $apprenant->id)->get();
        if ($notes->isEmpty()) return null;

        $totalPondere = 0;
        $totalCoeff = 0;
        foreach ($notes as $note) {
            $sur20 = ($note->valeur / $note->evaluation->bareme) * 20;
            $coeff = $note->evaluation->coefficient;
            $totalPondere += $sur20 * $coeff;
            $totalCoeff += $coeff;
        }

        return $totalCoeff > 0 ? round($totalPondere / $totalCoeff, 1) : null;
    }

    private function calculerPerformancesParMatiere($apprenant): array
    {
        $notes = Note::with('evaluation.discipline')->where('apprenant_id', $apprenant->id)->get();
        $parMatiere = $notes->groupBy(fn($n) => $n->evaluation->discipline->name ?? 'Autre');

        $result = [];
        foreach ($parMatiere as $matiere => $group) {
            $totalPondere = 0;
            $totalCoeff = 0;
            foreach ($group as $note) {
                $sur20 = ($note->valeur / $note->evaluation->bareme) * 20;
                $coeff = $note->evaluation->coefficient;
                $totalPondere += $sur20 * $coeff;
                $totalCoeff += $coeff;
            }
            $result[$matiere] = $totalCoeff > 0 ? round(($totalPondere / $totalCoeff) / 20 * 100, 1) : 0;
        }

        return $result;
    }
}
