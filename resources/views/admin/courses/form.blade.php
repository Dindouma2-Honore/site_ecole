@extends('admin.layouts.app')

@section('title', $course->exists ? 'Modifier la matière' : 'Ajouter une matière')

@section('content')
<div class="admin-topbar"><div><h1>{{ $course->exists ? 'Modifier la matière' : 'Ajouter une matière' }}</h1></div></div>

<div class="admin-panel" style="max-width:650px;">
    <div style="padding:28px;">
        <form action="{{ $course->exists ? route('admin.courses.update', $course->id) : route('admin.courses.store') }}" method="POST">
            @csrf
            @if($course->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label class="admin-form-label">Classe</label>
                <select name="class_id" class="admin-form-input" required>
                    <option value="">Choisir...</option>
                    @foreach($classes as $classe)
                    <option value="{{ $classe->id }}" {{ old('class_id', $course->class_id) == $classe->id ? 'selected' : '' }}>{{ $classe->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Nom de la matière</label>
                <input type="text" name="name" class="admin-form-input" value="{{ old('name', $course->name) }}" placeholder="Ex: Mathématiques" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Enseignant (optionnel)</label>
                <select name="teacher_id" class="admin-form-input">
                    <option value="">Non assigné</option>
                    @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ old('teacher_id', $course->teacher_id) == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Description</label>
                <textarea name="description" class="admin-form-input" rows="3">{{ old('description', $course->description) }}</textarea>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div class="admin-form-group">
                    <label class="admin-form-label">Couleur (code hex, optionnel)</label>
                    <input type="text" name="color" class="admin-form-input" value="{{ old('color', $course->color) }}" placeholder="#0a2463">
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">Coefficient</label>
                    <input type="number" step="0.5" name="coefficient" class="admin-form-input" value="{{ old('coefficient', $course->coefficient ?? 1) }}" required>
                </div>
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer</button>
                <a href="{{ route('admin.courses.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
