@extends('admin.layouts.app')

@section('title', $creneau->exists ? 'Modifier le créneau' : 'Ajouter un créneau')

@section('content')
<div class="admin-topbar"><div><h1>{{ $creneau->exists ? 'Modifier le créneau' : 'Ajouter un créneau' }}</h1></div></div>

<div class="admin-panel" style="max-width:650px;">
    <div style="padding:28px;">
        <form action="{{ $creneau->exists ? route('admin.emploi-temps.update', $creneau->id) : route('admin.emploi-temps.store') }}" method="POST">
            @csrf
            @if($creneau->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label class="admin-form-label">Classe</label>
                <select name="course_id" class="admin-form-input" required>
                    <option value="">Choisir...</option>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id', $creneau->course_id) == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Matière</label>
                <select name="discipline_id" class="admin-form-input" required>
                    <option value="">Choisir...</option>
                    @foreach($disciplines as $discipline)
                    <option value="{{ $discipline->id }}" {{ old('discipline_id', $creneau->discipline_id) == $discipline->id ? 'selected' : '' }}>{{ $discipline->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Enseignant (optionnel)</label>
                <select name="enseignant_id" class="admin-form-input">
                    <option value="">Non assigné</option>
                    @foreach($enseignants as $enseignant)
                    <option value="{{ $enseignant->id }}" {{ old('enseignant_id', $creneau->enseignant_id) == $enseignant->id ? 'selected' : '' }}>{{ $enseignant->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Jour</label>
                <select name="jour" class="admin-form-input" required>
                    @foreach(['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'] as $jour)
                    <option value="{{ $jour }}" {{ old('jour', $creneau->jour) == $jour ? 'selected' : '' }}>{{ $jour }}</option>
                    @endforeach
                </select>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div class="admin-form-group">
                    <label class="admin-form-label">Heure de début</label>
                    <input type="time" name="heure_debut" class="admin-form-input" value="{{ old('heure_debut', $creneau->heure_debut) }}" required>
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">Heure de fin</label>
                    <input type="time" name="heure_fin" class="admin-form-input" value="{{ old('heure_fin', $creneau->heure_fin) }}" required>
                </div>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Salle</label>
                <input type="text" name="salle" class="admin-form-input" value="{{ old('salle', $creneau->salle) }}" placeholder="Ex: Salle 12">
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer</button>
                <a href="{{ route('admin.emploi-temps.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
