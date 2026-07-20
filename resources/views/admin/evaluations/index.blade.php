@extends('admin.layouts.app')

@section('title', 'Évaluations')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Évaluations</h1>
        <p>{{ $evaluations->count() }} évaluation(s)</p>
    </div>
    <a href="{{ route('admin.evaluations.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Créer une évaluation</a>
</div>

@if(session('success'))
<div class="admin-alert">✅ {{ session('success') }}</div>
@endif

<div class="admin-panel">
    @if($evaluations->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Classe</th>
                <th>Matière</th>
                <th>Type</th>
                <th>Date</th>
                <th>Notes saisies</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evaluations as $evaluation)
            <tr>
                <td><strong>{{ $evaluation->titre }}</strong></td>
                <td>{{ $evaluation->course->name ?? '—' }}</td>
                <td>{{ $evaluation->discipline->name ?? '—' }}</td>
                <td>{{ ucfirst($evaluation->type) }}</td>
                <td>{{ $evaluation->date_evaluation->format('d/m/Y') }}</td>
                <td>{{ $evaluation->notes->count() }}</td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.evaluations.notes', $evaluation->id) }}" class="admin-row-btn admin-row-btn-green">Saisir notes</a>
                        <a href="{{ route('admin.evaluations.edit', $evaluation->id) }}" class="admin-row-btn admin-row-btn-orange">Modifier</a>
                        <form action="{{ route('admin.evaluations.destroy', $evaluation->id) }}" method="POST" onsubmit="return confirm('Supprimer cette évaluation ?');">
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
    <div class="admin-empty-row">Aucune évaluation créée.</div>
    @endif
</div>
@endsection
