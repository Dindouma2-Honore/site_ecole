@extends('admin.layouts.app')

@section('title', $classe->exists ? 'Modifier la classe' : 'Ajouter une classe')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>{{ $classe->exists ? 'Modifier la classe' : 'Ajouter une classe' }}</h1>
    </div>
</div>

<div class="admin-panel" style="max-width:750px;">
    <div style="padding:28px;">
        <form action="{{ $classe->exists ? route('admin.classes.update', $classe->id) : route('admin.classes.store') }}" method="POST">
            @csrf
            @if($classe->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label class="admin-form-label">Nom de la classe</label>
                <input type="text" name="name" class="admin-form-input" value="{{ old('name', $classe->name) }}" placeholder="Ex: 6ème, Terminale D" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Cycle</label>
                <select name="cycle" class="admin-form-input" required>
                    @foreach(['maternelle' => 'Maternelle', 'primaire' => 'Primaire', 'secondaire' => 'Secondaire', 'international' => 'International'] as $value => $label)
                    <option value="{{ $value }}" {{ old('cycle', $classe->cycle) == $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Niveau (libellé libre)</label>
                <input type="text" name="level" class="admin-form-input" value="{{ old('level', $classe->level) }}" placeholder="Ex: Collège, Lycée">
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div class="admin-form-group">
                    <label class="admin-form-label">Année scolaire</label>
                    <select name="academic_year_id" class="admin-form-input">
                        <option value="">Non assignée</option>
                        @foreach($academicYears as $year)
                        <option value="{{ $year->id }}" {{ old('academic_year_id', $classe->academic_year_id) == $year->id ? 'selected' : '' }}>{{ $year->label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">Capacité (nombre de places)</label>
                    <input type="number" name="capacity" min="1" class="admin-form-input" value="{{ old('capacity', $classe->capacity ?? 30) }}">
                </div>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Description courte</label>
                <textarea name="description" class="admin-form-input" rows="2">{{ old('description', $classe->description) }}</textarea>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Présentation pédagogique (page "Classes disponibles")</label>
                <textarea name="pedagogical_content" class="admin-form-input" rows="5">{{ old('pedagogical_content', $classe->pedagogical_content) }}</textarea>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Conditions d'admission (page "Conditions d'admission")</label>
                <textarea name="admission_conditions" class="admin-form-input" rows="5">{{ old('admission_conditions', $classe->admission_conditions) }}</textarea>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Frais de scolarité annuel (FCFA)</label>
                <input type="number" name="fee" step="1" min="0" class="admin-form-input" value="{{ old('fee', $classe->fee) }}" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Ordre d'affichage</label>
                <input type="number" name="order" class="admin-form-input" value="{{ old('order', $classe->order ?? 0) }}">
            </div>

            <div class="admin-form-group" style="display:flex;align-items:center;gap:8px;">
                <input type="checkbox" name="active" value="1" id="active" {{ old('active', $classe->active ?? true) ? 'checked' : '' }}>
                <label for="active" style="margin:0;">Classe active (visible sur le site)</label>
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer</button>
                <a href="{{ route('admin.classes.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
