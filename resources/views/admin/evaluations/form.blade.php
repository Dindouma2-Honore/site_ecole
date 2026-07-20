@extends('admin.layouts.app')

@section('title', $evaluation->exists ? "Modifier l'évaluation" : 'Créer une évaluation')

@section('content')
<div class="admin-topbar"><div><h1>{{ $evaluation->exists ? "Modifier l'évaluation" : 'Créer une évaluation' }}</h1></div></div>

<div class="admin-panel" style="max-width:650px;">
    <div style="padding:28px;">
        <form action="{{ $evaluation->exists ? route('admin.evaluations.update', $evaluation->id) : route('admin.evaluations.store') }}" method="POST">
            @csrf
            @if($evaluation->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label class="admin-form-label">Titre</label>
                <input type="text" name="titre" class="admin-form-input" value="{{ old('titre', $evaluation->titre) }}" placeholder="Ex: Contrôle chapitre 3" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Classe</label>
                <select name="course_id" class="admin-form-input" required>
                    <option value="">Choisir...</option>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id', $evaluation->course_id) == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Matière</label>
                <select name="discipline_id" class="admin-form-input" required>
                    <option value="">Choisir...</option>
                    @foreach($disciplines as $discipline)
                    <option value="{{ $discipline->id }}" {{ old('discipline_id', $evaluation->discipline_id) == $discipline->id ? 'selected' : '' }}>{{ $discipline->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Type</label>
                <select name="type" class="admin-form-input">
                    <option value="controle" {{ old('type', $evaluation->type) == 'controle' ? 'selected' : '' }}>Contrôle</option>
                    <option value="devoir" {{ old('type', $evaluation->type) == 'devoir' ? 'selected' : '' }}>Devoir</option>
                    <option value="examen" {{ old('type', $evaluation->type) == 'examen' ? 'selected' : '' }}>Examen</option>
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Date</label>
                <input type="date" name="date_evaluation" class="admin-form-input" value="{{ old('date_evaluation', optional($evaluation->date_evaluation)->format('Y-m-d')) }}" required>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div class="admin-form-group">
                    <label class="admin-form-label">Coefficient</label>
                    <input type="number" step="0.5" name="coefficient" class="admin-form-input" value="{{ old('coefficient', $evaluation->coefficient ?? 1) }}" required>
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">Barème (sur combien)</label>
                    <input type="number" step="0.5" name="bareme" class="admin-form-input" value="{{ old('bareme', $evaluation->bareme ?? 20) }}" required>
                </div>
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer</button>
                <a href="{{ route('admin.evaluations.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
