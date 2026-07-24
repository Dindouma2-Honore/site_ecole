@extends('admin.layouts.app')

@section('title', $invoice->exists ? 'Modifier la facture' : 'Créer une facture')

@section('content')
<div class="admin-topbar"><div><h1>{{ $invoice->exists ? 'Modifier la facture' : 'Créer une facture' }}</h1></div></div>

<div class="admin-panel" style="max-width:650px;">
    <div style="padding:28px;">
        <form action="{{ $invoice->exists ? route('admin.invoices.update', $invoice->id) : route('admin.invoices.store') }}" method="POST">
            @csrf
            @if($invoice->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label class="admin-form-label">Élève</label>
                <select name="learner_id" class="admin-form-input" required>
                    <option value="">Choisir...</option>
                    @foreach($learners as $learner)
                    <option value="{{ $learner->id }}" {{ old('learner_id', $invoice->learner_id) == $learner->id ? 'selected' : '' }}>{{ $learner->first_name }} {{ $learner->last_name }} ({{ $learner->matricule }})</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Année scolaire</label>
                <select name="academic_year_id" class="admin-form-input">
                    <option value="">Non assignée</option>
                    @foreach($academicYears as $year)
                    <option value="{{ $year->id }}" {{ old('academic_year_id', $invoice->academic_year_id) == $year->id ? 'selected' : '' }}>{{ $year->label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Libellé</label>
                <input type="text" name="label" class="admin-form-input" value="{{ old('label', $invoice->label) }}" placeholder="Ex: Frais de scolarité - Trimestre 1" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Montant total (FCFA)</label>
                <input type="number" name="amount" class="admin-form-input" value="{{ old('amount', $invoice->amount) }}" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Échéance</label>
                <input type="date" name="due_date" class="admin-form-input" value="{{ old('due_date', optional($invoice->due_date)->format('Y-m-d')) }}" required>
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer</button>
                <a href="{{ route('admin.invoices.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
