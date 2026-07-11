@extends('site.espace-apprenant.layout')

@section('title', 'Annonces & Notifications')
@section('page-title', 'Annonces & Notifications')
@section('page-subtitle', $apprenant->course->name ?? '')

@section('content')

<div class="ea-widget">
    <div class="ea-widget-header"><h3><i class="bi bi-megaphone"></i> Toutes mes notifications</h3></div>
    <div class="ea-widget-body">
        @forelse($notifications as $notification)
        <div class="ea-announce-item" style="align-items:center;">
            <div class="ea-resource-icon" style="background:{{ $notification->type == 'alerte' ? 'rgba(231,76,60,0.1)' : ($notification->type == 'annonce' ? 'rgba(212,175,55,0.15)' : 'rgba(10,36,99,0.08)') }};color:{{ $notification->type == 'alerte' ? '#c0392b' : ($notification->type == 'annonce' ? '#a9820a' : 'var(--royal-blue)') }};">
                <i class="bi {{ $notification->type == 'alerte' ? 'bi-exclamation-circle' : ($notification->type == 'annonce' ? 'bi-megaphone' : 'bi-info-circle') }}"></i>
            </div>
            <div class="ea-resource-info" style="flex:1;">
                <strong>{{ $notification->titre }} @if(!$notification->lu)<span class="ea-tag-pill new">Nouveau</span>@endif</strong>
                <span>{{ $notification->message }}</span>
                <div style="font-size:0.68rem;color:var(--grey-mid);margin-top:4px;">{{ $notification->created_at->diffForHumans() }}</div>
            </div>
            @if(!$notification->lu)
            <form action="{{ route('espace-apprenant.notifications.read', $notification->id) }}" method="POST">
                @csrf @method('PUT')
                <button type="submit" class="admin-row-btn admin-row-btn-green">Marquer lu</button>
            </form>
            @endif
        </div>
        @empty
        <div class="admin-empty-row">Aucune notification pour le moment.</div>
        @endforelse
    </div>
</div>

@endsection
