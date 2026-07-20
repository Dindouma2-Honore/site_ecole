<div class="subpage-nav">
    <div class="container subpage-nav-inner">

        <a href="{{ route('public.programs.classes') }}" 
           class="subpage-nav-link @if(request()->routeIs('public.programs.classes')) active @endif">
            Classes disponibles
        </a>

        <a href="{{ route('public.programs.admission') }}" 
           class="subpage-nav-link @if(request()->routeIs('public.programs.admission')) active @endif">
            Conditions d'admission
        </a>

        <a href="{{ route('public.programs.frais') }}" 
           class="subpage-nav-link @if(request()->routeIs('public.programs.frais')) active @endif">
            Frais de scolarité
        </a>

        <a href="{{ route('public.programs.disciplines') }}" 
           class="subpage-nav-link @if(request()->routeIs('public.programs.disciplines')) active @endif">
            Discipline
        </a>

        <a href="{{ route('public.programs.reglement') }}" 
           class="subpage-nav-link @if(request()->routeIs('public.programs.reglement')) active @endif">
            Règlement intérieur
        </a>

    </div>
</div>