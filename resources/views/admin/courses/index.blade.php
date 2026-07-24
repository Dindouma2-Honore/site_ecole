@extends('admin.layouts.app')

@section('title', 'Matières')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Matières</h1>
        <p>{{ $courses->count() }} matière(s)</p>
    </div>
    <a href="{{ route('admin.courses.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Ajouter une matière</a>
</div>

@if(session('success'))
<div class="admin-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="admin-panel" style="margin-bottom:20px;">
    <div style="padding:16px 20px;">
        <form method="GET" style="display:flex;gap:10px;align-items:center;">
            <label class="admin-form-label" style="margin:0;">Filtrer par classe :</label>
            <select name="class_id" class="admin-form-input" style="width:auto;" onchange="this.form.submit()">
                <option value="">Toutes les classes</option>
                @foreach($classes as $classe)
                <option value="{{ $classe->id }}" {{ (string) $classId === (string) $classe->id ? 'selected' : '' }}>{{ $classe->name }}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>

<div class="admin-panel">
    @if($courses->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Matière</th>
                <th>Classe</th>
                <th>Enseignant</th>
                <th>Coefficient</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td><strong style="color:{{ $course->color }};">● </strong>{{ $course->name }}</td>
                <td>{{ $course->schoolClass->name ?? '—' }}</td>
                <td>{{ $course->teacher->name ?? $course->teacher_name ?? '—' }}</td>
                <td>{{ $course->coefficient }}</td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.courses.edit', $course->id) }}" class="admin-row-btn admin-row-btn-green">Modifier</a>
                        <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Supprimer cette matière ?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="admin-row-btn admin-row-btn-red">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="admin-empty-row">Aucune matière enregistrée.</div>
    @endif
</div>
@endsection
