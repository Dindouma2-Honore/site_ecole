@extends('admin.layouts.app')

@section('title', 'Notes')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Notes</h1>
        <p>{{ $grades->count() }} note(s) récente(s)</p>
    </div>
    <a href="{{ route('admin.grades.entry') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Saisir des notes</a>
</div>

@if(session('success'))
<div class="admin-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="admin-panel" style="margin-bottom:20px;">
    <div style="padding:16px 20px;">
        <form method="GET" style="display:flex;gap:10px;align-items:center;">
            <label class="admin-form-label" style="margin:0;">Filtrer par matière :</label>
            <select name="course_id" class="admin-form-input" style="width:auto;" onchange="this.form.submit()">
                <option value="">Toutes les matières</option>
                @foreach($courses as $course)
                <option value="{{ $course->id }}" {{ (string) $courseId === (string) $course->id ? 'selected' : '' }}>{{ $course->name }} ({{ $course->schoolClass->name ?? '' }})</option>
                @endforeach
            </select>
        </form>
    </div>
</div>

<div class="admin-panel">
    @if($grades->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Élève</th>
                <th>Matière</th>
                <th>Évaluation</th>
                <th>Trimestre</th>
                <th>Note</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($grades as $grade)
            <tr>
                <td><strong>{{ $grade->learner->first_name ?? '' }} {{ $grade->learner->last_name ?? '' }}</strong></td>
                <td>{{ $grade->course->name ?? '—' }}</td>
                <td>{{ $grade->title ?? '—' }}</td>
                <td>{{ $grade->term }}</td>
                <td><strong>{{ $grade->score }} / {{ $grade->max_score }}</strong></td>
                <td>
                    <form action="{{ route('admin.grades.destroy', $grade->id) }}" method="POST" onsubmit="return confirm('Supprimer cette note ?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="admin-row-btn admin-row-btn-red">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="admin-empty-row">Aucune note enregistrée.</div>
    @endif
</div>
@endsection
