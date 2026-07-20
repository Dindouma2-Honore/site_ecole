<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration') - Ambassadors International School</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;700&family=Montserrat:wght@300;400;600;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @stack('styles')
</head>
<body>

    <div class="admin-shell">
        <!-- Sidebar (fixe) -->
        <aside class="admin-sidebar">
            <div class="admin-sidebar-brand">
                <span class="admin-sidebar-brand-name">Ambassadors</span>
                <span class="admin-sidebar-brand-tag">Administration</span>
            </div>

            <ul class="admin-sidebar-nav">
                <li><a href="{{ route('admin.dashboard') }}" class="admin-sidebar-link @if(request()->routeIs('admin.dashboard')) active @endif"><i class="bi bi-bar-chart-fill"></i> Tableau de bord</a></li>
                <li><a href="{{ route('admin.registrations.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.registrations.*')) active @endif"><i class="bi bi-clipboard-check"></i> Inscriptions</a></li>

                <li style="margin-top:14px;padding-top:14px;border-top:1px solid rgba(255,255,255,0.08);">
                    <span style="font-size:0.68rem;font-weight:700;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:0.06em;padding:0 12px;">Structure pédagogique</span>
                </li>
                <li><a href="{{ route('admin.academic-years.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.academic-years.*')) active @endif"><i class="bi bi-calendar4-range"></i> Années scolaires</a></li>
                <li><a href="{{ route('admin.classes.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.classes.*')) active @endif"><i class="bi bi-building"></i> Classes</a></li>
                <li><a href="{{ route('admin.courses.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.courses.*')) active @endif"><i class="bi bi-book"></i> Matières</a></li>
                <li><a href="{{ route('admin.schedules.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.schedules.*')) active @endif"><i class="bi bi-calendar-week"></i> Emploi du temps</a></li>

                <li style="margin-top:14px;padding-top:14px;border-top:1px solid rgba(255,255,255,0.08);">
                    <span style="font-size:0.68rem;font-weight:700;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:0.06em;padding:0 12px;">Vie scolaire</span>
                </li>
                <li><a href="{{ route('admin.assignments.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.assignments.*')) active @endif"><i class="bi bi-journal-text"></i> Devoirs</a></li>
                <li><a href="{{ route('admin.resources.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.resources.*')) active @endif"><i class="bi bi-folder2-open"></i> Ressources</a></li>
                <li><a href="{{ route('admin.grades.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.grades.*')) active @endif"><i class="bi bi-clipboard-data"></i> Notes</a></li>
                <li><a href="{{ route('admin.attendances.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.attendances.*')) active @endif"><i class="bi bi-calendar-x"></i> Absences</a></li>
                <li><a href="{{ route('admin.documents.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.documents.*')) active @endif"><i class="bi bi-file-earmark-arrow-up"></i> Documents</a></li>

                <li style="margin-top:14px;padding-top:14px;border-top:1px solid rgba(255,255,255,0.08);">
                    <span style="font-size:0.68rem;font-weight:700;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:0.06em;padding:0 12px;">Finances</span>
                </li>
                <li><a href="{{ route('admin.invoices.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.invoices.*')) active @endif"><i class="bi bi-cash-coin"></i> Factures & Paiements</a></li>

                <li style="margin-top:14px;padding-top:14px;border-top:1px solid rgba(255,255,255,0.08);">
                    <span style="font-size:0.68rem;font-weight:700;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:0.06em;padding:0 12px;">Utilisateurs</span>
                </li>
                <li><a href="{{ route('admin.learners.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.learners.*')) active @endif"><i class="bi bi-mortarboard"></i> Apprenants</a></li>
                <li><a href="{{ route('admin.parents.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.parents.*')) active @endif"><i class="bi bi-people"></i> Parents</a></li>
                <li><a href="{{ route('admin.equipe.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.equipe.*')) active @endif"><i class="bi bi-person-badge"></i> Équipe administrative</a></li>

                <li style="margin-top:14px;padding-top:14px;border-top:1px solid rgba(255,255,255,0.08);">
                    <span style="font-size:0.68rem;font-weight:700;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:0.06em;padding:0 12px;">Communication</span>
                </li>
                <li><a href="{{ route('admin.news.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.news.*')) active @endif"><i class="bi bi-newspaper"></i> Actualités</a></li>
                <li><a href="{{ route('admin.events.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.events.*')) active @endif"><i class="bi bi-calendar-event"></i> Événements</a></li>
                <li><a href="{{ route('admin.gallery.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.gallery.*')) active @endif"><i class="bi bi-images"></i> Galerie</a></li>
                <li><a href="{{ route('admin.announcements.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.announcements.*')) active @endif"><i class="bi bi-megaphone"></i> Annonces</a></li>
                <li><a href="{{ route('admin.contact-messages.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.contact-messages.*')) active @endif"><i class="bi bi-envelope"></i> Messages de contact</a></li>
                <li><a href="{{ route('admin.pages.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.pages.*')) active @endif"><i class="bi bi-file-earmark-text"></i> Pages de contenu</a></li>

                <li style="margin-top:14px;padding-top:14px;border-top:1px solid rgba(255,255,255,0.08);">
                    <a href="{{ route('public.home') }}" class="admin-sidebar-link"><i class="bi bi-globe"></i> Voir le site</a>
                </li>
            </ul>

            <div class="admin-sidebar-footer">
                <div class="admin-sidebar-user">
                    Connecté en tant que
                    <strong>{{ auth()->user()->name }}</strong>
                </div>
                <form action="{{ route('auth.logout') }}" method="POST">
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
