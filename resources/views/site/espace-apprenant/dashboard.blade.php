@extends('site.espace-apprenant.layout')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('page-subtitle', 'Votre espace personnel')

@section('content')

@if(session('success'))
<div class="admin-alert" style="margin-bottom:20px;">✅ {{ session('success') }}</div>
@endif

<!-- Welcome card -->
<div class="ea-welcome-card">
    <div class="ea-welcome-photo">
        @if($learner->photo)
        <img src="{{ Storage::url($learner->photo) }}" alt="">
        @else
        {{ strtoupper(substr($learner->first_name, 0, 1) . substr($learner->last_name, 0, 1)) }}
        @endif
    </div>
    <div class="ea-welcome-text">
        <h2>Bienvenue, {{ $learner->first_name }} {{ $learner->last_name }}</h2>
        <div class="ea-welcome-meta">
            <span><i class="bi bi-upc-scan"></i> Matricule : {{ $learner->matricule }}</span>
            <span><i class="bi bi-mortarboard"></i> Classe : {{ $learner->course->name ?? '—' }}</span>
            <span><i class="bi bi-calendar3"></i> Année scolaire : {{ $learner->annee_scolaire }}</span>
        </div>
        <div class="ea-welcome-quote">"L'excellence n'est pas un acte, mais une habitude." — Aristote</div>
    </div>
</div>

<!-- Stats -->
<div class="ea-stats-grid">
    <div class="ea-stat-card">
        <div class="ea-stat-icon blue"><i class="bi bi-book"></i></div>
        <div><div class="ea-stat-value">{{ $coursesCount }}</div><div class="ea-stat-label">Matières ce trimestre</div></div>
    </div>
    <div class="ea-stat-card">
        <div class="ea-stat-icon gold"><i class="bi bi-graph-up-arrow"></i></div>
        <div><div class="ea-stat-value">{{ $average !== null ? $average . '/20' : '—' }}</div><div class="ea-stat-label">Moyenne générale</div></div>
    </div>
    <div class="ea-stat-card">
        <div class="ea-stat-icon green"><i class="bi bi-wallet2"></i></div>
        <div><div class="ea-stat-value">{{ $totalDue > 0 ? round(($totalPaid / $totalDue) * 100) . '%' : '—' }}</div><div class="ea-stat-label">Scolarité réglée</div></div>
    </div>
    <div class="ea-stat-card">
        <div class="ea-stat-icon purple"><i class="bi bi-bell"></i></div>
        <div><div class="ea-stat-value">0</div><div class="ea-stat-label">Notification(s) non lue(s)</div></div>
    </div>
</div>

<!-- Aperçu du jour + accès rapides -->
<div class="ea-widgets-grid">
    <div class="ea-widget">
        <div class="ea-widget-header">
            <h3><i class="bi bi-calendar-week"></i> Prochains cours</h3>
            <a href="{{ route('learner.schedule.index') }}">Emploi du temps complet</a>
        </div>
        <div class="ea-widget-body">
            @forelse($todaySchedule as $creneau)
            <div class="ea-schedule-row">
                <div class="ea-schedule-day">{{ strtoupper(substr($creneau->jour, 0, 3)) }}</div>
                <div class="ea-schedule-info"><strong>{{ substr($creneau->heure_debut,0,5) }} - {{ substr($creneau->heure_fin,0,5) }} · {{ $creneau->discipline->name ?? '' }}</strong><span class="ea-schedule-room">{{ $creneau->salle }}</span></div>
            </div>
            @empty
            <p style="color:var(--grey-mid);font-size:0.85rem;">Aucun cours programmé pour le moment.</p>
            @endforelse
        </div>
    </div>

    <div class="ea-widget">
        <div class="ea-widget-header">
            <h3><i class="bi bi-clipboard-data"></i> Devoirs à venir</h3>
            <a href="{{ route('learner.assignments.index')}}">Voir tout</a>
        </div>
        <div class="ea-widget-body">
            @forelse($upcomingAssignments as $devoir)
            <div class="ea-resource-item">
                <div class="ea-resource-icon"><i class="bi bi-file-earmark-text"></i></div>
                <div class="ea-resource-info"><strong>{{ $devoir->titre }}</strong><span>{{ $devoir->discipline->name ?? '' }} · à rendre le {{ $devoir->date_limite}}</span></div>
            </div>
            @empty
            <p style="color:var(--grey-mid);font-size:0.85rem;">Aucun devoir en attente.</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Accès rapides -->
<div class="ea-widget">
    <div class="ea-widget-header"><h3><i class="bi bi-grid-1x2-fill"></i> Accès rapides</h3></div>
    <div class="ea-widget-body">
        <div class="ea-actions-grid">
            <a href="{{ route('learner.profile.index') }}" class="ea-action-btn"><i class="bi bi-person-gear"></i> Mon profil</a>
            <a href="{{ route('learner.grades.index') }}" class="ea-action-btn"><i class="bi bi-file-earmark-bar-graph"></i> Mes notes</a>
            <a href="{{ route('learner.schedule.index') }}" class="ea-action-btn"><i class="bi bi-calendar-week"></i> Emploi du temps</a>
            <a href="{{ route('learner.assignments.index') }}" class="ea-action-btn"><i class="bi bi-journal-text"></i> Mes devoirs</a>
            <a href="{{ route('learner.account.index')}}" class="ea-action-btn"><i class="bi bi-credit-card-2-front"></i> Mes paiements</a>
            <a href="{{ route('learner.announcements.index')}}" class="ea-action-btn"><i class="bi bi-megaphone"></i> Annonces</a>
        </div>
    </div>
</div>

@endsection
