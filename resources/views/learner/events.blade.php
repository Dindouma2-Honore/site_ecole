@extends('learner.layout')

@section('title', 'Calendrier')
@section('page-title', 'Calendrier')
@section('page-subtitle', "Événements de l'établissement")

@section('content')

<div class="ea-widget">
    <div class="ea-widget-header"><h3><i class="bi bi-calendar-event"></i> Événements à venir</h3></div>
    <div class="ea-widget-body">
        @forelse($events as $event)
        <div class="event-mini" style="padding:14px 0;">
            <div class="event-mini-date">
                <span class="day">{{ $event->start_date->format('d') }}</span>
                <span class="month">{{ $event->start_date->translatedFormat('M') }}</span>
            </div>
            <div class="event-mini-info">
                <strong>{{ $event->title }}</strong>
                <span>{{ $event->category }} @if($event->location) · {{ $event->location }} @endif</span>
            </div>
        </div>
        @empty
        <div class="admin-empty-row">Aucun événement programmé.</div>
        @endforelse
    </div>
</div>

@endsection
