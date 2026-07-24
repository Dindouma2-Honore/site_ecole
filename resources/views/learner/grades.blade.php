@extends('learner.layout')

@section('title', 'Notes')
@section('page-title', 'Notes')
@section('page-subtitle', $learner->schoolClass->name ?? '')

@section('content')

<div class="ea-stats-grid" style="grid-template-columns:repeat(2,1fr);margin-bottom:24px;">
    <div class="ea-stat-card">
        <div class="ea-stat-icon gold"><i class="bi bi-graph-up-arrow"></i></div>
        <div><div class="ea-stat-value">{{ $average !== null ? $average . '/20' : '—' }}</div><div class="ea-stat-label">Moyenne générale</div></div>
    </div>
    <div class="ea-stat-card">
        <div class="ea-stat-icon blue"><i class="bi bi-journal-check"></i></div>
        <div><div class="ea-stat-value">{{ $grades->flatten()->count() }}</div><div class="ea-stat-label">Notes enregistrées</div></div>
    </div>
</div>

@forelse($grades as $matiere => $groupe)
<div class="ea-widget" style="margin-bottom:20px;">
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
@empty
<div class="ea-widget"><div class="admin-empty-row">Aucune note disponible pour le moment.</div></div>
@endforelse

@endsection
