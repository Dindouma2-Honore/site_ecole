@extends('admin.layouts.app')

@section('title', 'Devoirs')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Devoirs</h1>
        <p>{{ $assignments->count() }} devoir(s)</p>
    </div>
    <a href="{{ route('admin.assignments.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Publier un devoir</a>
</div>

@if(session('success'))
<div class="admin-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="admin-panel">
    @if($assignments->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Classe</th>
                <th>Matière</th>
                <th>Échéance</th>
                <th>Soumissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assignments as $assignment)
            <tr>
                <td><strong>{{ $assignment->title }}</strong></td>
                <td>{{ $assignment->course->schoolClass->name ?? '—' }}</td>
                <td>{{ $assignment->course->name ?? '—' }}</td>
                <td>{{ $assignment->due_date->format('d/m/Y') }}</td>
                <td>{{ $assignment->submissions->count() }}</td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.assignments.submissions', $assignment->id) }}" class="admin-row-btn admin-row-btn-green">Soumissions</a>
                        <a href="{{ route('admin.assignments.edit', $assignment->id) }}" class="admin-row-btn admin-row-btn-orange">Modifier</a>
                        <form action="{{ route('admin.assignments.destroy', $assignment->id) }}" method="POST" onsubmit="return confirm('Supprimer ce devoir ?');">
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
    <div class="admin-empty-row">Aucun devoir publié.</div>
    @endif
</div>
@endsection
