<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facture;
use App\Models\Paiement;
use App\Models\Apprenant;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    public function index()
    {
        $factures = Facture::with(['apprenant', 'paiements'])->orderBy('date_emission', 'desc')->get();
        return view('admin.factures.index', compact('factures'));
    }

    public function create()
    {
        $apprenants = Apprenant::orderBy('last_name')->get();
        return view('admin.factures.form', ['facture' => new Facture(), 'apprenants' => $apprenants]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        $validated['reference'] = 'FAC-' . strtoupper(uniqid());
        Facture::create($validated);
        return redirect()->route('admin.factures.index')->with('success', 'Facture créée avec succès.');
    }

    public function edit($id)
    {
        $facture = Facture::findOrFail($id);
        $apprenants = Apprenant::orderBy('last_name')->get();
        return view('admin.factures.form', compact('facture', 'apprenants'));
    }

    public function update(Request $request, $id)
    {
        Facture::findOrFail($id)->update($this->validateData($request));
        return redirect()->route('admin.factures.index')->with('success', 'Facture mise à jour avec succès.');
    }

    public function destroy($id)
    {
        Facture::findOrFail($id)->delete();
        return back()->with('success', 'Facture supprimée.');
    }

    public function show($id)
    {
        $facture = Facture::with(['apprenant', 'paiements'])->findOrFail($id);
        return view('admin.factures.show', compact('facture'));
    }

    public function addPaiement(Request $request, $id)
    {
        $facture = Facture::findOrFail($id);

        $validated = $request->validate([
            'montant' => 'required|numeric|min:1',
            'date_paiement' => 'required|date',
            'mode_paiement' => 'required|in:especes,mobile_money,virement,cheque',
            'reference_transaction' => 'nullable|string|max:255',
        ]);

        $validated['facture_id'] = $facture->id;
        Paiement::create($validated);
        $facture->refreshStatut();

        return back()->with('success', 'Paiement enregistré avec succès.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'apprenant_id' => 'required|exists:apprenants,id',
            'libelle' => 'required|string|max:255',
            'montant_total' => 'required|numeric|min:0',
            'date_emission' => 'required|date',
            'echeance' => 'required|date',
        ]);
    }
}
