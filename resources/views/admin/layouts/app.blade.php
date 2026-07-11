<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration') - Ambassadors Educational Complex</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;700&family=Montserrat:wght@300;400;600;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>

    <div class="admin-shell">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="admin-sidebar-brand">
                <span class="admin-sidebar-brand-name">Ambassadors</span>
                <span class="admin-sidebar-brand-tag">Administration</span>
            </div>

            <ul class="admin-sidebar-nav">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="admin-sidebar-link @if(request()->routeIs('admin.dashboard')) active @endif">
                        <i class="bi bi-bar-chart-fill"></i> Tableau de bord
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.registrations') }}" class="admin-sidebar-link @if(request()->routeIs('admin.registrations')) active @endif">
                        <i class="bi bi-clipboard-check"></i> Inscriptions
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.equipe.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.equipe.*')) active @endif">
                        <i class="bi bi-people-fill"></i> Équipe administrative
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.classes.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.classes.*')) active @endif">
                        <i class="bi bi-building"></i> Classes / Cursus scolaire
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.disciplines.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.disciplines.*')) active @endif">
                        <i class="bi bi-book"></i> Disciplines
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pages.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.pages.*')) active @endif">
                        <i class="bi bi-file-earmark-text"></i> Pages de contenu
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.actualites.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.actualites.*')) active @endif">
                        <i class="bi bi-newspaper"></i> Actualités
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.evenements.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.evenements.*')) active @endif">
                        <i class="bi bi-calendar-event"></i> Événements
                    </a>
                </li>
                <li style="margin-top:14px;padding-top:14px;border-top:1px solid var(--grey-light);">
                    <span style="font-size:0.68rem;font-weight:700;color:var(--grey-mid);text-transform:uppercase;letter-spacing:0.06em;padding:0 12px;">Espace Apprenant</span>
                </li>
                <li>
                    <a href="{{ route('admin.emploi-temps.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.emploi-temps.*')) active @endif">
                        <i class="bi bi-calendar-week"></i> Emploi du temps
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.evaluations.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.evaluations.*')) active @endif">
                        <i class="bi bi-clipboard-data"></i> Évaluations & Notes
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.devoirs.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.devoirs.*')) active @endif">
                        <i class="bi bi-journal-text"></i> Devoirs
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.factures.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.factures.*')) active @endif">
                        <i class="bi bi-cash-coin"></i> Factures & Paiements
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.notifications.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.notifications.*')) active @endif">
                        <i class="bi bi-bell"></i> Notifications
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.gallery.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.gallery.*')) active @endif">
                        <i class="bi bi-images"></i> Galerie
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.contact-messages.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.contact-messages.*')) active @endif">
                        <i class="bi bi-envelope"></i> Messages de contact
                    </a>
                </li>
                <li>
                    <a href="{{ route('home') }}" class="admin-sidebar-link">
                        <i class="bi bi-globe"></i> Voir le site
                    </a>
                </li>
            </ul>

            <div class="admin-sidebar-footer">
                <div class="admin-sidebar-user">
                    Connecté en tant que
                    <strong>{{ auth()->user()->name }}</strong>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="admin-logout-btn">Déconnexion</button>
                </form>
            </div>
        </aside>

        <!-- Main content -->
        <main class="admin-main">
            @yield('content')
        </main>
    </div>

</body>
</html>
