<div class="subpage-nav">
    <div class="container subpage-nav-inner">

        <a href="{{ route('public.about.dossier') }}" 
           class="subpage-nav-link @if(request()->routeIs('public.about.dossier')) active @endif">
            Dossier de l'établissement
        </a>

        <a href="{{ route('public.about.histoire') }}" 
           class="subpage-nav-link @if(request()->routeIs('public.about.histoire')) active @endif">
            Historique
        </a>

        <a href="{{ route('public.about.vision-mission') }}" 
           class="subpage-nav-link @if(request()->routeIs('public.about.vision-mission')) active @endif">
            Vision / Mission
        </a>

        <a href="{{ route('public.about.equipe') }}" 
           class="subpage-nav-link @if(request()->routeIs('public.about.equipe')) active @endif">
            Équipe administrative
        </a>

    </div>
</div>