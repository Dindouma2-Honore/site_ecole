@extends('admin.layouts.app')

@section('title', 'Emploi du temps')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Emploi du temps</h1>
        <p>{{ $creneaux->count() }} créneau(x)</p>
    </div>
    <a href="{{ route('admin.emploi-temps.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Ajouter un créneau</a>
</div>

@if(session('success'))
<div class="admin-alert">✅ {{ session('success') }}</div>
@endif

<div class="admin-panel" style="margin-bottom:20px;">
    <div style="padding:16px 20px;">
        <form method="GET" style="display:flex;gap:10px;align-items:center;">
            <label class="admin-form-label" style="margin:0;">Filtrer par classe :</label>
            <select name="course_id" class="admin-form-input" style="width:auto;" onchange="this.form.submit()">
                <option value="">Toutes les classes</option>
                @foreach($courses as $course)
                <option value="{{ $course->id }}" {{ (string) $courseId === (string) $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>

<div class="admin-panel">
    @if($creneaux->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Jour</th>
                <th>Horaire</th>
                <th>Classe</th>
                <th>Matière</th>
                <th>Enseignant</th>
                <th>Salle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($creneaux as $creneau)
            <tr>
                <td><strong>{{ $creneau->jour }}</strong></td>
                <td>{{ substr($creneau->heure_debut,0,5) }} - {{ substr($creneau->heure_fin,0,5) }}</td>
                <td>{{ $creneau->course->name ?? '—' }}</td>
                <td>{{ $creneau->discipline->name ?? '—' }}</td>
                <td>{{ $creneau->enseignant->name ?? '—' }}</td>
                <td>{{ $creneau->salle }}</td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.emploi-temps.edit', $creneau->id) }}" class="admin-row-btn admin-row-btn-green">Modifier</a>
                        <form action="{{ route('admin.emploi-temps.destroy', $creneau->id) }}" method="POST" onsubmit="return confirm('Supprimer ce créneau ?');">
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
    <div class="admin-empty-row">Aucun créneau enregistré.</div>
    @endif
</div>
@endsection
