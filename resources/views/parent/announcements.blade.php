@extends('parent.layout')

@section('title', 'Annonces')
@section('page-title', 'Annonces')
@section('page-subtitle', "Communications de l'établissement")

@section('content')

<div class="ea-widget">
    <div class="ea-widget-header"><h3><i class="bi bi-megaphone"></i> Toutes les annonces</h3></div>
    <div class="ea-widget-body">
        @forelse($announcements as $announcement)
        <div class="ea-announce-item">
            <div class="ea-resource-icon"><i class="bi bi-info-circle"></i></div>
            <div class="ea-resource-info" style="flex:1;">
                <strong>{{ $announcement->title }}</strong>
                <span>{{ $announcement->body }}</span>
                <div style="font-size:0.68rem;color:var(--grey-mid);margin-top:4px;">{{ $announcement->published_at?->diffForHumans() }}</div>
            </div>
        </div>
        @empty
        <div class="admin-empty-row">Aucune annonce pour le moment.</div>
        @endforelse
    </div>
</div>

@endsection
