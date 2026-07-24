@extends('learner.layout')

@section('title', 'Performances')
@section('page-title', 'Performances')
@section('page-subtitle', $learner->schoolClass->name ?? '')

@section('content')

<div class="ea-widget">
    <div class="ea-widget-header"><h3><i class="bi bi-bar-chart-fill"></i> Moyenne par matière</h3></div>
    <div class="ea-widget-body">
        @forelse($performanceByCourse as $matiere => $pourcentage)
        <div class="ea-perf-row">
            <span>{{ $matiere }}</span>
            <div class="ea-perf-bar-bg"><div class="ea-perf-bar-fill" style="width:{{ $pourcentage }}%;"></div></div>
            <strong>{{ $pourcentage }}%</strong>
        </div>
        @empty
        <p style="color:var(--grey-mid);font-size:0.9rem;">Aucune donnée de performance disponible.</p>
        @endforelse
    </div>
</div>

@endsection
