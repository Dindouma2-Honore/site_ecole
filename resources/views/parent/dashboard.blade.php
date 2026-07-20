@extends('parent.layout')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('page-subtitle', 'Suivi de la scolarité de vos enfants')

@section('content')

@if(session('success'))
<div class="admin-alert" style="margin-bottom:20px;">✅ {{ session('success') }}</div>
@endif

@if($children->isEmpty())
<div class="ea-widget">
    <div class="admin-empty-row">Aucun enfant n'est encore associé à votre compte. Contactez l'administration si cela vous semble anormal.</div>
</div>
@else

<div class="ea-welcome-card">
    <div class="ea-welcome-photo"><i class="bi bi-people-fill"></i></div>
    <div class="ea-welcome-text">
        <h2>Bienvenue, {{ auth()->user()->name }}</h2>
        <div class="ea-welcome-meta">
            <span><i class="bi bi-people"></i> {{ $children->count() }} enfant(s) suivi(s)</span>
        </div>
        <div class="ea-welcome-quote">Retrouvez ici le suivi scolaire et financier de chacun de vos enfants.</div>
    </div>
</div>

<div class="ea-widgets-row" style="grid-template-columns:repeat({{ min($childrenData->count(), 3) }}, 1fr);">
    @foreach($childrenData as $data)
    <div class="ea-widget">
        <div class="ea-widget-header">
            <h3><i class="bi bi-person-circle"></i> {{ $data['learner']->first_name }} {{ $data['learner']->last_name }}</h3>
            <a href="{{ route('parent.children.show', $data['learner']->id) }}">Voir le profil</a>
        </div>
        <div class="ea-widget-body">
            <div class="ea-finance-row"><span>Classe</span><span>{{ $data['learner']->schoolClass->name ?? '—' }}</span></div>
            <div class="ea-finance-row"><span>Moyenne générale</span><span>{{ $data['average'] !== null ? $data['average'] . '/20' : '—' }}</span></div>
            <div class="ea-finance-row"><span>Scolarité réglée</span><span>{{ $data['due'] > 0 ? round(($data['paid'] / $data['due']) * 100) . '%' : '—' }}</span></div>
            <a href="{{ route('parent.children.academics', $data['learner']->id) }}" class="ea-action-btn" style="flex-direction:row;gap:8px;margin-top:12px;background:var(--royal-blue);color:var(--white);"><i class="bi bi-graph-up-arrow"></i> Notes & absences</a>
        </div>
    </div>
    @endforeach
</div>

<div class="ea-widget" style="margin-top:20px;">
    <div class="ea-widget-header"><h3><i class="bi bi-megaphone"></i> Annonces récentes</h3></div>
    <div class="ea-widget-body">
        @forelse($announcements as $announcement)
        <div class="ea-announce-item">
            <div class="ea-resource-icon"><i class="bi bi-info-circle"></i></div>
            <div class="ea-resource-info"><strong>{{ $announcement->title }}</strong><span>{{ \Illuminate\Support\Str::limit($announcement->body, 100) }}</span></div>
        </div>
        @empty
        <p style="color:var(--grey-mid);font-size:0.85rem;">Aucune annonce pour le moment.</p>
        @endforelse
    </div>
</div>

<div class="ea-widget" style="margin-top:20px;">
    <div class="ea-widget-header"><h3><i class="bi bi-grid-1x2-fill"></i> Accès rapides</h3></div>
    <div class="ea-widget-body">
        <div class="ea-actions-grid">
            <a href="{{ route('parent.children.index') }}" class="ea-action-btn"><i class="bi bi-people"></i> Mes enfants</a>
            <a href="{{ route('parent.finances.index') }}" class="ea-action-btn"><i class="bi bi-credit-card-2-front"></i> Paiements</a>
            <a href="{{ route('parent.documents.index') }}" class="ea-action-btn"><i class="bi bi-file-earmark-text"></i> Documents</a>
            <a href="{{ route('parent.messages.index') }}" class="ea-action-btn"><i class="bi bi-envelope"></i> Messages</a>
            <a href="{{ route('parent.requests.index') }}" class="ea-action-btn"><i class="bi bi-chat-left-text"></i> Faire une demande</a>
            <a href="{{ route('parent.events.index') }}" class="ea-action-btn"><i class="bi bi-calendar-event"></i> Calendrier</a>
        </div>
    </div>
</div>

@endif
@endsection
