@extends('admin.layouts.app')

@section('title', 'Saisie des notes')

@section('content')
<div class="admin-topbar"><div><h1>Saisie des notes</h1></div></div>

<div class="admin-panel" style="margin-bottom:20px;">
    <div style="padding:20px;">
        <form method="GET" style="display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:14px;align-items:end;">
            <div class="admin-form-group" style="margin:0;grid-column:span 2;">
                <label class="admin-form-label">Matière (classe)</label>
                <select name="course_id" class="admin-form-input" onchange="this.form.submit()">
                    <option value="">Choisir...</option>
                    @foreach($courses as $c)
                    <option value="{{ $c->id }}" {{ (string) $courseId === (string) $c->id ? 'selected' : '' }}>{{ $c->name }} ({{ $c->schoolClass->name ?? '' }})</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>

@if($course)
<div class="admin-panel">
    <form action="{{ route('admin.grades.entry.store') }}" method="POST">
        @csrf
        <input type="hidden" name="course_id" value="{{ $course->id }}">

        <div style="padding:20px;display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:14px;">
            <div class="admin-form-group" style="margin:0;">
                <label class="admin-form-label">Trimestre</label>
                <input type="text" name="term" class="admin-form-input" placeholder="Trimestre 1" required>
            </div>
            <div class="admin-form-group" style="margin:0;">
                <label class="admin-form-label">Titre (optionnel)</label>
                <input type="text" name="title" class="admin-form-input" placeholder="Contrôle chapitre 3">
            </div>
            <div class="admin-form-group" style="margin:0;">
                <label class="admin-form-label">Barème</label>
                <input type="number" step="0.5" name="max_score" class="admin-form-input" value="20" required>
            </div>
            <div class="admin-form-group" style="margin:0;">
                <label class="admin-form-label">Coefficient</label>
                <input type="number" step="0.5" name="coefficient" class="admin-form-input" value="{{ $course->coefficient }}" required>
            </div>
        </div>

        @if($learners->count())
        <table class="admin-table">
            <thead><tr><th>Élève</th><th>Matricule</th><th>Note</th></tr></thead>
            <tbody>
                @foreach($learners as $learner)
                <tr>
                    <td><strong>{{ $learner->first_name }} {{ $learner->last_name }}</strong></td>
                    <td>{{ $learner->matricule }}</td>
                    <td><input type="number" step="0.25" min="0" name="scores[{{ $learner->id }}]" class="admin-form-input"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="padding:20px;">
            <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer les notes</button>
        </div>
        @else
        <div class="admin-empty-row">Aucun élève dans cette classe.</div>
        @endif
    </form>
</div>
@endif
@endsection
