@extends('admin.layouts.app')

@section('title', 'Emploi du temps')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Emploi du temps</h1>
        <p>{{ $schedules->count() }} créneau(x)</p>
    </div>
    <a href="{{ route('admin.schedules.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Ajouter un créneau</a>
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
    @if($schedules->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Jour</th>
                <th>Horaire</th>
                <th>Classe</th>
                <th>Matière</th>
                <th>Salle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
            <tr>
                <td><strong>{{ $schedule->day_of_week }}</strong></td>
                <td>{{ substr($schedule->start_time,0,5) }} - {{ substr($schedule->end_time,0,5) }}</td>
                <td>{{ $schedule->schoolClass->name ?? '—' }}</td>
                <td>{{ $schedule->course->name ?? '—' }}</td>
                <td>{{ $schedule->room }}</td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.schedules.edit', $schedule->id) }}" class="admin-row-btn admin-row-btn-green">Modifier</a>
                        <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('Supprimer ce créneau ?');">
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
