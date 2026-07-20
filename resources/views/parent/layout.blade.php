<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Espace Parent') - Ambassadors International School</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;700&family=Montserrat:wght@300;400;600;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

@php
    $currentParent = auth()->user();
    $nbNotifNonLues = \App\Models\Message::where('recipient_id', $currentParent->id)->whereNull('read_at')->count();
@endphp

<div class="ea-shell">
    <!-- Sidebar -->
    <aside class="ea-sidebar">
        <div class="ea-sidebar-brand">
            <i class="bi bi-shield-fill-check"></i>
            <div>
                <span class="ea-sidebar-brand-name">Ambassadors</span>
                <span class="ea-sidebar-brand-tag">Espace Parent</span>
            </div>
        </div>

        <div class="ea-nav-section">Tableau de bord</div>
        <ul class="ea-nav-list">
            <li><a href="{{ route('parent.dashboard') }}" class="ea-nav-link @if(request()->routeIs('parent.dashboard')) active @endif"><i class="bi bi-house-door-fill"></i> Accueil</a></li>
        </ul>

        <div class="ea-nav-section">Mes enfants</div>
        <ul class="ea-nav-list">
            <li><a href="{{ route('parent.children.index') }}" class="ea-nav-link @if(request()->routeIs('parent.children.*')) active @endif"><i class="bi bi-people"></i> Mes enfants</a></li>
        </ul>

        <div class="ea-nav-section">Finances</div>
        <ul class="ea-nav-list">
            <li><a href="{{ route('parent.finances.index') }}" class="ea-nav-link @if(request()->routeIs('parent.finances.*')) active @endif"><i class="bi bi-credit-card"></i> Paiements</a></li>
        </ul>

        <div class="ea-nav-section">Documents</div>
        <ul class="ea-nav-list">
            <li><a href="{{ route('parent.documents.index') }}" class="ea-nav-link @if(request()->routeIs('parent.documents.*')) active @endif"><i class="bi bi-file-earmark-text"></i> Documents</a></li>
        </ul>

        <div class="ea-nav-section">Communication</div>
        <ul class="ea-nav-list">
            <li>
                <a href="{{ route('parent.messages.index') }}" class="ea-nav-link @if(request()->routeIs('parent.messages.*')) active @endif">
                    <i class="bi bi-envelope"></i> Messages
                    @if($nbNotifNonLues > 0)
                    <span style="background:var(--gold);color:var(--white);border-radius:20px;font-size:0.65rem;padding:1px 7px;margin-left:auto;">{{ $nbNotifNonLues }}</span>
                    @endif
                </a>
            </li>
            <li><a href="{{ route('parent.announcements.index') }}" class="ea-nav-link @if(request()->routeIs('parent.announcements.*')) active @endif"><i class="bi bi-megaphone"></i> Annonces</a></li>
            <li><a href="{{ route('parent.events.index') }}" class="ea-nav-link @if(request()->routeIs('parent.events.*')) active @endif"><i class="bi bi-calendar-event"></i> Calendrier</a></li>
            <li><a href="{{ route('parent.requests.index') }}" class="ea-nav-link @if(request()->routeIs('parent.requests.*')) active @endif"><i class="bi bi-chat-left-text"></i> Mes demandes</a></li>
        </ul>

        <div class="ea-nav-section">Mon compte</div>
        <ul class="ea-nav-list">
            <li><a href="{{ route('parent.account.index') }}" class="ea-nav-link @if(request()->routeIs('parent.account.*')) active @endif"><i class="bi bi-gear"></i> Paramètres</a></li>
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
                @yield('page-title', 'Espace Parent')
                <span>@yield('page-subtitle', 'Suivi de la scolarité de vos enfants')</span>
            </div>
            <div class="ea-topbar-right">
                <a href="{{ route('parent.messages.index') }}" class="ea-icon-btn" style="text-decoration:none;">
                    <i class="bi bi-envelope"></i>
                    @if($nbNotifNonLues > 0)<span class="ea-icon-badge">{{ $nbNotifNonLues }}</span>@endif
                </a>
                <div class="ea-user-chip">
                    <div class="ea-user-avatar">
                        {{ strtoupper(substr($currentParent->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="ea-user-name">{{ $currentParent->name }}</div>
                        <div class="ea-user-role">Parent</div>
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
