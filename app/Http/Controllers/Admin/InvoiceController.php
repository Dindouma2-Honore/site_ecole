<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Learner;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['learner', 'payments'])->orderBy('due_date', 'desc')->get();
        return view('admin.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $learners = Learner::orderBy('last_name')->get();
        $academicYears = AcademicYear::orderBy('label', 'desc')->get();
        return view('admin.invoices.form', ['invoice' => new Invoice(), 'learners' => $learners, 'academicYears' => $academicYears]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        $validated['reference'] = 'FAC-' . strtoupper(uniqid());
        Invoice::create($validated);
        return redirect()->route('admin.invoices.index')->with('success', 'Facture créée avec succès.');
    }

    public function show($id)
    {
        $invoice = Invoice::with(['learner', 'payments'])->findOrFail($id);
        return view('admin.invoices.show', compact('invoice'));
    }

    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $learners = Learner::orderBy('last_name')->get();
        $academicYears = AcademicYear::orderBy('label', 'desc')->get();
        return view('admin.invoices.form', compact('invoice', 'learners', 'academicYears'));
    }

    public function update(Request $request, $id)
    {
        Invoice::findOrFail($id)->update($this->validateData($request));
        return redirect()->route('admin.invoices.index')->with('success', 'Facture mise à jour avec succès.');
    }

    public function destroy($id)
    {
        Invoice::findOrFail($id)->delete();
        return back()->with('success', 'Facture supprimée.');
    }

    public function addPayment(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'paid_at' => 'required|date',
            'method' => 'required|in:especes,mobile_money,virement',
            'reference' => 'nullable|string|max:255',
        ]);

        $validated['invoice_id'] = $invoice->id;
        $validated['learner_id'] = $invoice->learner_id;
        Payment::create($validated);
        $invoice->refreshStatus();

        return back()->with('success', 'Paiement enregistré avec succès.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'learner_id' => 'required|exists:learners,id',
            'academic_year_id' => 'nullable|exists:academic_years,id',
            'label' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
        ]);
    }
}
