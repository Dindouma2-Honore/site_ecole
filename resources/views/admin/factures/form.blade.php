@extends('admin.layouts.app')

@section('title', $facture->exists ? 'Modifier la facture' : 'Créer une facture')

@section('content')
<div class="admin-topbar"><div><h1>{{ $facture->exists ? 'Modifier la facture' : 'Créer une facture' }}</h1></div></div>

<div class="admin-panel" style="max-width:650px;">
    <div style="padding:28px;">
        <form action="{{ $facture->exists ? route('admin.factures.update', $facture->id) : route('admin.factures.store') }}" method="POST">
            @csrf
            @if($facture->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label class="admin-form-label">Élève</label>
                <select name="apprenant_id" class="admin-form-input" required>
                    <option value="">Choisir...</option>
                    @foreach($apprenants as $apprenant)
                    <option value="{{ $apprenant->id }}" {{ old('apprenant_id', $facture->apprenant_id) == $apprenant->id ? 'selected' : '' }}>{{ $apprenant->first_name }} {{ $apprenant->last_name }} ({{ $apprenant->matricule }})</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Libellé</label>
                <input type="text" name="libelle" class="admin-form-input" value="{{ old('libelle', $facture->libelle) }}" placeholder="Ex: Frais de scolarité - Trimestre 1" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Montant total (FCFA)</label>
                <input type="number" name="montant_total" class="admin-form-input" value="{{ old('montant_total', $facture->montant_total) }}" required>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div class="admin-form-group">
                    <label class="admin-form-label">Date d'émission</label>
                    <input type="date" name="date_emission" class="admin-form-input" value="{{ old('date_emission', optional($facture->date_emission)->format('Y-m-d')) }}" required>
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">Échéance</label>
                    <input type="date" name="echeance" class="admin-form-input" value="{{ old('echeance', optional($facture->echeance)->format('Y-m-d')) }}" required>
                </div>
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer</button>
                <a href="{{ route('admin.factures.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
