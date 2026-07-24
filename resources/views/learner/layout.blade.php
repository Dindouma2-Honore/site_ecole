<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Espace Apprenant') - Ambassadors International School</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;700&family=Montserrat:wght@300;400;600;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

@php
    $currentLearner = auth()->user()->learner;
    $nbNotifNonLues = \App\Models\Message::where('recipient_id', auth()->id())->whereNull('read_at')->count();
@endphp

<div class="ea-shell">
    <!-- Sidebar -->
    <aside class="ea-sidebar">
        <div class="ea-sidebar-brand">
            <i class="bi bi-shield-fill-check"></i>
            <div>
                <span class="ea-sidebar-brand-name">Ambassadors</span>
                <span class="ea-sidebar-brand-tag">Espace Apprenant</span>
            </div>
        </div>

        <div class="ea-nav-section">Tableau de bord</div>
        <ul class="ea-nav-list">
            <li><a href="{{ route('learner.dashboard') }}" class="ea-nav-link @if(request()->routeIs('learner.dashboard')) active @endif"><i class="bi bi-house-door-fill"></i> Accueil</a></li>
        </ul>

        <div class="ea-nav-section">Mon espace</div>
        <ul class="ea-nav-list">
            <li><a href="{{ route('learner.profile.index') }}" class="ea-nav-link @if(request()->routeIs('learner.profile.*')) active @endif"><i class="bi bi-person"></i> Mon Profil</a></li>
            <li><a href="{{ route('learner.schedule.index') }}" class="ea-nav-link @if(request()->routeIs('learner.schedule.*')) active @endif"><i class="bi bi-calendar-week"></i> Emploi du temps</a></li>
            <li><a href="{{ route('learner.assignments.index') }}" class="ea-nav-link @if(request()->routeIs('learner.assignments.*')) active @endif"><i class="bi bi-clipboard-data"></i> Devoirs</a></li>
            <li><a href="{{ route('learner.resources.index') }}" class="ea-nav-link @if(request()->routeIs('learner.resources.*')) active @endif"><i class="bi bi-folder2-open"></i> Ressources</a></li>
            <li><a href="{{ route('learner.grades.index') }}" class="ea-nav-link @if(request()->routeIs('learner.grades.*')) active @endif"><i class="bi bi-graph-up-arrow"></i> Notes</a></li>
            <li><a href="{{ route('learner.performance.index') }}" class="ea-nav-link @if(request()->routeIs('learner.performance.*')) active @endif"><i class="bi bi-bar-chart-fill"></i> Performances</a></li>
            <li><a href="{{ route('learner.attendance.index') }}" class="ea-nav-link @if(request()->routeIs('learner.attendance.*')) active @endif"><i class="bi bi-calendar-x"></i> Absences</a></li>
            <li><a href="{{ route('learner.documents.index') }}" class="ea-nav-link @if(request()->routeIs('learner.documents.*')) active @endif"><i class="bi bi-file-earmark-text"></i> Documents</a></li>
        </ul>

        <div class="ea-nav-section">Communication</div>
        <ul class="ea-nav-list">
            <li>
                <a href="{{ route('learner.messages.index') }}" class="ea-nav-link @if(request()->routeIs('learner.messages.*')) active @endif">
                    <i class="bi bi-envelope"></i> Messages
                    @if($nbNotifNonLues > 0)
                    <span style="background:var(--gold);color:var(--white);border-radius:20px;font-size:0.65rem;padding:1px 7px;margin-left:auto;">{{ $nbNotifNonLues }}</span>
                    @endif
                </a>
            </li>
            <li><a href="{{ route('learner.announcements.index') }}" class="ea-nav-link @if(request()->routeIs('learner.announcements.*')) active @endif"><i class="bi bi-megaphone"></i> Annonces</a></li>
            <li><a href="{{ route('learner.events.index') }}" class="ea-nav-link @if(request()->routeIs('learner.events.*')) active @endif"><i class="bi bi-calendar-event"></i> Calendrier</a></li>
        </ul>

        <div class="ea-nav-section">Mon compte</div>
        <ul class="ea-nav-list">
            <li><a href="{{ route('learner.account.index') }}" class="ea-nav-link @if(request()->routeIs('learner.account.*')) active @endif"><i class="bi bi-gear"></i> Paramètres</a></li>
        </ul>

        <div class="ea-nav-section">&nbsp;</div>
        <ul class="ea-nav-list">
            <li>
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="ea-nav-link" style="width:100%;background:none;border:none;color:#e74c3c;cursor:pointer;text-align:left;">
                        <i class="bi bi-box-arrow-right" style="color:#e74c3c;"></i> Déconnexion
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <!-- Main -->
    <div class="ea-main">
        <div class="ea-topbar">
            <div class="ea-topbar-title">
                @yield('page-title', "Espace de l'Apprenant")
                <span>@yield('page-subtitle', 'Votre espace personnel')</span>
            </div>
            <div class="ea-topbar-right">
                <a href="{{ route('learner.messages.index') }}" class="ea-icon-btn" style="text-decoration:none;">
                    <i class="bi bi-envelope"></i>
                    @if($nbNotifNonLues > 0)<span class="ea-icon-badge">{{ $nbNotifNonLues }}</span>@endif
                </a>
                <div class="ea-user-chip">
                    <div class="ea-user-avatar">
                        @if($currentLearner?->photo)
                        <img src="{{ Storage::url($currentLearner->photo) }}" alt="">
                        @else
                        {{ strtoupper(substr($currentLearner->first_name ?? 'A', 0, 1) . substr($currentLearner->last_name ?? 'P', 0, 1)) }}
                        @endif
                    </div>
                    <div>
                        <div class="ea-user-name">{{ $currentLearner->first_name ?? '' }} {{ $currentLearner->last_name ?? '' }}</div>
                        <div class="ea-user-role">{{ $currentLearner->schoolClass->name ?? 'Apprenant' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ea-content">
            @yield('content')
        </div>
    </div>
</div>

</body>
</html>
