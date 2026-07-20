@extends('parent.layout')

@section('title', $learner->first_name . ' ' . $learner->last_name)
@section('page-title', $learner->first_name . ' ' . $learner->last_name)
@section('page-subtitle', $learner->schoolClass->name ?? '')

@section('content')

<div class="ea-welcome-card">
    <div class="ea-welcome-photo">
        @if($learner->photo)
        <img src="{{ Storage::url($learner->photo) }}" alt="">
        @else
        {{ strtoupper(substr($learner->first_name,0,1) . substr($learner->last_name,0,1)) }}
        @endif
    </div>
    <div class="ea-welcome-text">
        <h2>{{ $learner->first_name }} {{ $learner->last_name }}</h2>
        <div class="ea-welcome-meta">
            <span><i class="bi bi-upc-scan"></i> {{ $learner->matricule }}</span>
            <span><i class="bi bi-mortarboard"></i> {{ $learner->schoolClass->name ?? '—' }}</span>
            <span><i class="bi bi-calendar3"></i> {{ $learner->annee_scolaire }}</span>
        </div>
    </div>
</div>

<div class="ea-stats-grid" style="grid-template-columns:repeat(2,1fr);margin-bottom:20px;">
    <div class="ea-stat-card">
        <div class="ea-stat-icon gold"><i class="bi bi-graph-up-arrow"></i></div>
        <div><div class="ea-stat-value">{{ $average !== null ? $average . '/20' : '—' }}</div><div class="ea-stat-label">Moyenne générale</div></div>
    </div>
    <div class="ea-stat-card">
        <div class="ea-stat-icon blue"><i class="bi bi-calendar-week"></i></div>
        <div><div class="ea-stat-value">{{ $schedule->flatten()->count() }}</div><div class="ea-stat-label">Créneaux hebdomadaires</div></div>
    </div>
</div>

<div class="ea-widget" style="margin-bottom:20px;">
    <div class="ea-widget-header">
        <h3><i class="bi bi-graph-up-arrow"></i> Notes & absences</h3>
        <a href="{{ route('parent.children.academics', $learner->id) }}">Voir le détail</a>
    </div>
</div>

<div class="ea-widget">
    <div class="ea-widget-header"><h3><i class="bi bi-calendar-week"></i> Emploi du temps</h3></div>
    <div class="ea-widget-body">
        @forelse($schedule as $jour => $items)
        <div style="margin-bottom:18px;">
            <div style="font-family:var(--font-display);font-weight:700;color:var(--royal-blue);margin-bottom:8px;">{{ $jour }}</div>
            @foreach($items as $creneau)
            <div class="ea-schedule-row">
                <div class="ea-schedule-day">{{ substr($creneau->start_time,0,5) }}</div>
                <div class="ea-schedule-info"><strong>{{ $creneau->course->name ?? '' }}</strong><span class="ea-schedule-room">{{ substr($creneau->start_time,0,5) }} - {{ substr($creneau->end_time,0,5) }} · {{ $creneau->room }}</span></div>
            </div>
            @endforeach
        </div>
        @empty
        <p style="color:var(--grey-mid);font-size:0.9rem;">Aucun emploi du temps disponible.</p>
        @endforelse
    </div>
</div>

@endsection
