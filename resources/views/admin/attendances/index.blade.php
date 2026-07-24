@extends('admin.layouts.app')

@section('title', 'Absences')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Absences & retards</h1>
        <p>{{ $attendances->count() }} enregistrement(s)</p>
    </div>
    <a href="{{ route('admin.attendances.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Faire l'appel</a>
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
    @if($attendances->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Élève</th>
                <th>Date</th>
                <th>Matière</th>
                <th>Statut</th>
                <th>Justifié</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
            <tr>
                <td><strong>{{ $attendance->learner->first_name ?? '' }} {{ $attendance->learner->last_name ?? '' }}</strong></td>
                <td>{{ $attendance->date->format('d/m/Y') }}</td>
                <td>{{ $attendance->course->name ?? 'Général' }}</td>
                <td>
                    <span class="admin-badge-status {{ $attendance->status == 'absent' ? 'rejected' : 'pending' }}">
                        {{ ucfirst($attendance->status) }}
                    </span>
                </td>
                <td>{{ $attendance->justified ? 'Oui' : 'Non' }}</td>
                <td>
                    <form action="{{ route('admin.attendances.destroy', $attendance->id) }}" method="POST" onsubmit="return confirm('Supprimer cet enregistrement ?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="admin-row-btn admin-row-btn-red">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="admin-empty-row">Aucune absence enregistrée.</div>
    @endif
</div>
@endsection
