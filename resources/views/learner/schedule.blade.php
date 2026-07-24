@extends('learner.layout')

@section('title', 'Emploi du temps')
@section('page-title', 'Emploi du temps')
@section('page-subtitle', $learner->schoolClass->name ?? '')

@section('content')

<div class="ea-widget">
    <div class="ea-widget-header"><h3><i class="bi bi-calendar-week"></i> Emploi du temps de la semaine</h3></div>
    <div class="ea-widget-body">
        @forelse($schedule as $jour => $items)
        <div style="margin-bottom:22px;">
            <div style="font-family:var(--font-display);font-weight:700;color:var(--royal-blue);margin-bottom:10px;">{{ $jour }}</div>
            @foreach($items as $creneau)
            <div class="ea-schedule-row">
                <div class="ea-schedule-day">{{ substr($creneau->start_time,0,5) }}</div>
                <div class="ea-schedule-info">
                    <strong>{{ $creneau->course->name ?? '' }}</strong>
                    <span class="ea-schedule-room">{{ substr($creneau->start_time,0,5) }} - {{ substr($creneau->end_time,0,5) }} · {{ $creneau->room }} @if($creneau->course->teacher) · {{ $creneau->course->teacher->name }} @endif</span>
                </div>
            </div>
            @endforeach
        </div>
        @empty
        <p style="color:var(--grey-mid);font-size:0.9rem;">Aucun emploi du temps n'a encore été configuré pour votre classe.</p>
        @endforelse
    </div>
</div>

@endsection
