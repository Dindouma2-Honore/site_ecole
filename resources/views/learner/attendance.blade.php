@extends('learner.layout')

@section('title', 'Absences')
@section('page-title', 'Absences & retards')
@section('page-subtitle', $learner->schoolClass->name ?? '')

@section('content')

<div class="ea-stats-grid" style="grid-template-columns:repeat(3,1fr);margin-bottom:24px;">
    <div class="ea-stat-card">
        <div class="ea-stat-icon red"><i class="bi bi-calendar-x"></i></div>
        <div><div class="ea-stat-value">{{ $stats['absences'] }}</div><div class="ea-stat-label">Absences</div></div>
    </div>
    <div class="ea-stat-card">
        <div class="ea-stat-icon gold"><i class="bi bi-clock-history"></i></div>
        <div><div class="ea-stat-value">{{ $stats['retards'] }}</div><div class="ea-stat-label">Retards</div></div>
    </div>
    <div class="ea-stat-card">
        <div class="ea-stat-icon purple"><i class="bi bi-exclamation-triangle"></i></div>
        <div><div class="ea-stat-value">{{ $stats['non_justifiees'] }}</div><div class="ea-stat-label">Non justifiées</div></div>
    </div>
</div>

<div class="ea-widget">
    <div class="ea-widget-header"><h3><i class="bi bi-calendar-x"></i> Historique</h3></div>
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
    <div class="admin-empty-row">Aucune absence enregistrée. Continuez ainsi !</div>
    @endif
</div>

@endsection
