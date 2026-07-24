@extends('admin.layouts.app')

@section('title', $assignment->exists ? 'Modifier le devoir' : 'Publier un devoir')

@section('content')
<div class="admin-topbar"><div><h1>{{ $assignment->exists ? 'Modifier le devoir' : 'Publier un devoir' }}</h1></div></div>

<div class="admin-panel" style="max-width:700px;">
    <div style="padding:28px;">
        <form action="{{ $assignment->exists ? route('admin.assignments.update', $assignment->id) : route('admin.assignments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($assignment->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label class="admin-form-label">Matière (classe)</label>
                <select name="course_id" class="admin-form-input" required>
                    <option value="">Choisir...</option>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id', $assignment->course_id) == $course->id ? 'selected' : '' }}>{{ $course->name }} ({{ $course->schoolClass->name ?? '' }})</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Titre</label>
                <input type="text" name="title" class="admin-form-input" value="{{ old('title', $assignment->title) }}" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Description / consignes</label>
                <textarea name="description" class="admin-form-input" rows="4">{{ old('description', $assignment->description) }}</textarea>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Fichier joint (sujet, optionnel)</label>
                @if($assignment->attachment_path)
                <p style="font-size:0.8rem;margin-bottom:8px;"><a href="{{ Storage::url($assignment->attachment_path) }}" target="_blank">Fichier actuel</a></p>
                @endif
                <input type="file" name="attachment_path">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Date limite</label>
                <input type="date" name="due_date" class="admin-form-input" value="{{ old('due_date', optional($assignment->due_date)->format('Y-m-d')) }}" required>
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer</button>
                <a href="{{ route('admin.assignments.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
