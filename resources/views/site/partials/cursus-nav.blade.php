<div class="subpage-nav">
    <div class="container subpage-nav-inner">
        <a href="{{ route('cursus.classes') }}" class="subpage-nav-link @if(request()->routeIs('cursus.classes')) active @endif">Classes disponibles</a>
        <a href="{{ route('cursus.admission') }}" class="subpage-nav-link @if(request()->routeIs('cursus.admission')) active @endif">Conditions d'admission</a>
        <a href="{{ route('cursus.frais') }}" class="subpage-nav-link @if(request()->routeIs('cursus.frais')) active @endif">Frais de scolarité</a>
        <a href="{{ route('cursus.disciplines') }}" class="subpage-nav-link @if(request()->routeIs('cursus.disciplines')) active @endif">Discipline</a>
        <a href="{{ route('cursus.reglement') }}" class="subpage-nav-link @if(request()->routeIs('cursus.reglement')) active @endif">Règlement intérieur</a>
    </div>
</div>
