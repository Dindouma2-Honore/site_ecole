<div class="subpage-nav">
    <div class="container subpage-nav-inner">
        <a href="{{ route('presentation.dossier') }}" class="subpage-nav-link @if(request()->routeIs('presentation.dossier')) active @endif">Dossier de l'établissement</a>
        <a href="{{ route('presentation.histoire') }}" class="subpage-nav-link @if(request()->routeIs('presentation.histoire')) active @endif">Historique</a>
        <a href="{{ route('presentation.vision-mission') }}" class="subpage-nav-link @if(request()->routeIs('presentation.vision-mission')) active @endif">Vision / Mission</a>
        <a href="{{ route('presentation.equipe') }}" class="subpage-nav-link @if(request()->routeIs('presentation.equipe')) active @endif">Équipe administrative</a>
    </div>
</div>
