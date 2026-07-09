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
                        📊 Tableau de bord
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.registrations') }}" class="admin-sidebar-link @if(request()->routeIs('admin.registrations')) active @endif">
                        📋 Inscriptions
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.equipe.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.equipe.*')) active @endif">
                        👥 Équipe administrative
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.classes.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.classes.*')) active @endif">
                        🏫 Classes / Cursus scolaire
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.disciplines.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.disciplines.*')) active @endif">
                        📘 Disciplines
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pages.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.pages.*')) active @endif">
                        📄 Pages de contenu
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.actualites.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.actualites.*')) active @endif">
                        📰 Actualités
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.gallery.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.gallery.*')) active @endif">
                        🖼️ Galerie
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.contact-messages.index') }}" class="admin-sidebar-link @if(request()->routeIs('admin.contact-messages.*')) active @endif">
                        ✉️ Messages de contact
                    </a>
                </li>
                <li>
                    <a href="{{ route('home') }}" class="admin-sidebar-link">
                        🌐 Voir le site
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
