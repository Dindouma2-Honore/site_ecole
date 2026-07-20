@extends('admin.layouts.app')

@section('title', $devoir->exists ? 'Modifier le devoir' : 'Publier un devoir')

@section('content')
<div class="admin-topbar"><div><h1>{{ $devoir->exists ? 'Modifier le devoir' : 'Publier un devoir' }}</h1></div></div>

<div class="admin-panel" style="max-width:700px;">
    <div style="padding:28px;">
        <form action="{{ $devoir->exists ? route('admin.devoirs.update', $devoir->id) : route('admin.devoirs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($devoir->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label class="admin-form-label">Titre</label>
                <input type="text" name="titre" class="admin-form-input" value="{{ old('titre', $devoir->titre) }}" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Classe</label>
                <select name="course_id" class="admin-form-input" required>
                    <option value="">Choisir...</option>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id', $devoir->course_id) == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Matière</label>
                <select name="discipline_id" class="admin-form-input" required>
                    <option value="">Choisir...</option>
                    @foreach($disciplines as $discipline)
                    <option value="{{ $discipline->id }}" {{ old('discipline_id', $devoir->discipline_id) == $discipline->id ? 'selected' : '' }}>{{ $discipline->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Description / consignes</label>
                <textarea name="description" class="admin-form-input" rows="4">{{ old('description', $devoir->description) }}</textarea>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Fichier joint (sujet, optionnel)</label>
                @if($devoir->fichier_joint)
                <p style="font-size:0.8rem;margin-bottom:8px;"><a href="{{ Storage::url($devoir->fichier_joint) }}" target="_blank">Fichier actuel</a></p>
                @endif
                <input type="file" name="fichier_joint">
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div class="admin-form-group">
                    <label class="admin-form-label">Date de publication</label>
                    <input type="date" name="date_publication" class="admin-form-input" value="{{ old('date_publication', optional($devoir->date_publication)->format('Y-m-d')) }}" required>
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">Date limite</label>
                    <input type="date" name="date_limite" class="admin-form-input" value="{{ old('date_limite', optional($devoir->date_limite)->format('Y-m-d')) }}" required>
                </div>
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer</button>
                <a href="{{ route('admin.devoirs.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
