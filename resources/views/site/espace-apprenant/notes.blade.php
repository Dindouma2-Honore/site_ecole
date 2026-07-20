@extends('site.espace-apprenant.layout')

@section('title', 'Notes & Performances')
@section('page-title', 'Notes & Performances')
@section('page-subtitle', $apprenant->course->name ?? '')

@section('content')

<div class="ea-stats-grid" style="grid-template-columns:repeat(2,1fr);margin-bottom:24px;">
    <div class="ea-stat-card">
        <div class="ea-stat-icon gold"><i class="bi bi-graph-up-arrow"></i></div>
        <div><div class="ea-stat-value">{{ $moyenneGenerale !== null ? $moyenneGenerale . '/20' : '—' }}</div><div class="ea-stat-label">Moyenne générale</div></div>
    </div>
    <div class="ea-stat-card">
        <div class="ea-stat-icon blue"><i class="bi bi-journal-check"></i></div>
        <div><div class="ea-stat-value">{{ $notes->flatten()->count() }}</div><div class="ea-stat-label">Notes enregistrées</div></div>
    </div>
</div>

<div class="ea-widget" style="margin-bottom:20px;">
    <div class="ea-widget-header"><h3><i class="bi bi-bar-chart-fill"></i> Moyenne par matière</h3></div>
    <div class="ea-widget-body">
        @forelse($performancesParMatiere as $matiere => $pourcentage)
        <div class="ea-perf-row">
            <span>{{ $matiere }}</span>
            <div class="ea-perf-bar-bg"><div class="ea-perf-bar-fill" style="width:{{ $pourcentage }}%;"></div></div>
            <strong>{{ $pourcentage }}%</strong>
        </div>
        @empty
        <p style="color:var(--grey-mid);font-size:0.9rem;">Aucune note enregistrée pour le moment.</p>
        @endforelse
    </div>
</div>

@foreach($notes as $matiere => $groupe)
<div class="ea-widget" style="margin-bottom:20px;">
    <div class="ea-widget-header"><h3><i class="bi bi-book"></i> {{ $matiere }}</h3></div>
    <table class="admin-table">
        <thead><tr><th>Évaluation</th><th>Type</th><th>Date</th><th>Note</th><th>Appréciation</th></tr></thead>
        <tbody>
            @foreach($groupe as $note)
            <tr>
                <td>{{ $note->evaluation->titre }}</td>
                <td>{{ ucfirst($note->evaluation->type) }}</td>
                <td>{{ $note->evaluation->date_evaluation->format('d/m/Y') }}</td>
                <td><strong>{{ $note->valeur }} / {{ $note->evaluation->bareme }}</strong></td>
                <td>{{ $note->appreciation ?? '—' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endforeach

@if($notes->isEmpty())
<div class="ea-widget"><div class="admin-empty-row">Aucune note disponible pour le moment.</div></div>
@endif

@endsection
