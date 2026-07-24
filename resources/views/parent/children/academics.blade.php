@extends('parent.layout')

@section('title', 'Notes & absences')
@section('page-title', $learner->first_name . ' ' . $learner->last_name)
@section('page-subtitle', 'Notes & absences')

@section('content')

<div class="ea-stats-grid" style="grid-template-columns:repeat(2,1fr);margin-bottom:20px;">
    <div class="ea-stat-card">
        <div class="ea-stat-icon gold"><i class="bi bi-graph-up-arrow"></i></div>
        <div><div class="ea-stat-value">{{ $average !== null ? $average . '/20' : '—' }}</div><div class="ea-stat-label">Moyenne générale</div></div>
    </div>
    <div class="ea-stat-card">
        <div class="ea-stat-icon red"><i class="bi bi-calendar-x"></i></div>
        <div><div class="ea-stat-value">{{ $attendances->whereIn('status', ['absent','retard'])->count() }}</div><div class="ea-stat-label">Absences / retards</div></div>
    </div>
</div>

@foreach($grades as $matiere => $groupe)
<div class="ea-widget" style="margin-bottom:18px;">
    <div class="ea-widget-header"><h3><i class="bi bi-book"></i> {{ $matiere }}</h3></div>
    <table class="admin-table">
        <thead><tr><th>Évaluation</th><th>Trimestre</th><th>Note</th><th>Appréciation</th></tr></thead>
        <tbody>
            @foreach($groupe as $grade)
            <tr>
                <td>{{ $grade->title ?? '—' }}</td>
                <td>{{ $grade->term }}</td>
                <td><strong>{{ $grade->score }} / {{ $grade->max_score }}</strong></td>
                <td>{{ $grade->comment ?? '—' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endforeach

@if($grades->isEmpty())
<div class="ea-widget" style="margin-bottom:18px;"><div class="admin-empty-row">Aucune note disponible pour le moment.</div></div>
@endif

<div class="ea-widget">
    <div class="ea-widget-header"><h3><i class="bi bi-calendar-x"></i> Absences & retards</h3></div>
    @if($attendances->count())
    <table class="admin-table">
        <thead><tr><th>Date</th><th>Matière</th><th>Statut</th><th>Justifié</th><th>Motif</th></tr></thead>
        <tbody>
            @foreach($attendances as $attendance)
            <tr>
                <td>{{ $attendance->date->format('d/m/Y') }}</td>
                <td>{{ $attendance->course->name ?? 'Général' }}</td>
                <td>
                    <span class="admin-badge-status {{ $attendance->status == 'absent' ? 'rejected' : 'pending' }}">
                        {{ ucfirst($attendance->status) }}
                    </span>
                </td>
                <td>{{ $attendance->justified ? 'Oui' : 'Non' }}</td>
                <td>{{ $attendance->motif ?? '—' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="admin-empty-row">Aucune absence enregistrée.</div>
    @endif
</div>

@endsection
