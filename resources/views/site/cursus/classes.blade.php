@extends('layouts.app')

@section('title', 'Formations')

@section('content')
<section class="subpage-hero" style="background-image:url('/images/1.png'), linear-gradient(135deg, var(--royal-blue), var(--royal-blue-light));background-size:cover;background-position:center;position:relative;">
    <div style="position:absolute;inset:0;background:linear-gradient(135deg, rgba(6,18,60,0.85), rgba(10,36,99,0.55));"></div>
    <div class="container" style="position:relative;">
        <div class="section-tag" style="color:var(--gold);">Nos formations</div>
        <h1>Des parcours <span style="color:var(--gold-light);">d'excellence</span><br>pour chaque ambition</h1>
        <p>Nous proposons des programmes académiques rigoureux et innovants, conçus pour développer le potentiel de chaque élève à chaque étape de son parcours.</p>
    </div>
</section>

@include('site.partials.cursus-nav')

<section class="content-block" style="background:var(--off-white);">
    <div class="container">
        <div class="text-center" style="margin-bottom:36px;">
            <div class="section-tag" style="justify-content:center;color:var(--gold);">Nos programmes</div>
            <h2 class="section-title">Un enseignement adapté à <span>chaque étape</span> de la vie scolaire</h2>
        </div>

        <div class="level-cards-grid">
            @php
                $categories = [
                    'Maternelle' => ['age' => '3 - 5 ans', 'icon' => 'bi-flower2', 'desc' => "Un environnement bienveillant et stimulant pour éveiller la curiosité et développer les compétences de base.", 'items' => ['Éveil & découvertes', 'Développement socio-émotionnel', 'Langage & communication', 'Activités créatives et motrices']],
                    'Primaire' => ['age' => '6 - 11 ans', 'icon' => 'bi-book', 'desc' => "Une base solide de connaissances fondamentales, avec un apprentissage actif qui développe la pensée critique.", 'items' => ['Français, Anglais, Mathématiques', 'Sciences & Technologie', 'Éducation à la citoyenneté', 'Clubs & projets d\'élèves']],
                    'Collège' => ['age' => '12 - 14 ans', 'icon' => 'bi-mortarboard', 'desc' => "Un enseignement exigeant préparant aux examens nationaux, tout en développant leadership et autonomie.", 'items' => ['Sciences, Lettres, Langues', 'Préparation BEPC', 'Développement personnel', 'Clubs & activités parascolaires']],
                    'Lycée' => ['age' => '15 - 17 ans', 'icon' => 'bi-globe-americas', 'desc' => "Des parcours et partenariats offrant une ouverture sur le monde et des opportunités d'études supérieures.", 'items' => ['Préparation Baccalauréat', 'Orientation universitaire', 'Échanges & partenariats', 'Développement du leadership']],
                ];
            @endphp

            @foreach($categories as $level => $info)
            <div class="level-card">
                <div class="level-card-icon"><i class="bi {{ $info['icon'] }}"></i></div>
                <div class="level-card-name">{{ $level }}</div>
                <div class="level-card-age">{{ $info['age'] }}</div>
                <p class="level-card-desc">{{ $info['desc'] }}</p>
                <ul class="level-checklist">
                    @foreach($info['items'] as $item)
                    <li><i class="bi bi-check-circle-fill"></i> {{ $item }}</li>
                    @endforeach
                </ul>

                @if(isset($groupedByLevel[$level]) && $groupedByLevel[$level]->count())
                <div style="margin-bottom:14px;">
                    @foreach($groupedByLevel[$level] as $course)
                    <div style="font-size:0.78rem;color:var(--royal-blue);font-weight:700;margin-bottom:4px;">
                        <i class="bi bi-dot"></i>{{ $course->name }} — {{ number_format($course->fee, 0, ',', ' ') }} FCFA/an
                    </div>
                    @endforeach
                </div>
                @endif

<a href="{{ route('public.programs.admission') }}" class="level-card-btn">
    En savoir plus <i class="bi bi-arrow-right"></i>
</a>            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Feature strip -->
<section class="feature-strip">
    <div class="container">
        <div class="feature-strip-grid">
            <div class="feature-strip-item">
                <div class="feature-strip-icon"><i class="bi bi-bullseye"></i></div>
                <div class="feature-strip-text"><strong>Approche pédagogique</strong><span>Centrée sur l'élève, interactive et axée sur la réussite.</span></div>
            </div>
            <div class="feature-strip-item">
                <div class="feature-strip-icon"><i class="bi bi-people-fill"></i></div>
                <div class="feature-strip-text"><strong>Enseignants qualifiés</strong><span>Une équipe passionnée et expérimentée.</span></div>
            </div>
            <div class="feature-strip-item">
                <div class="feature-strip-icon"><i class="bi bi-award-fill"></i></div>
                <div class="feature-strip-text"><strong>Ressources modernes</strong><span>Salles équipées, laboratoires, bibliothèque et outils numériques.</span></div>
            </div>
            <div class="feature-strip-item">
                <div class="feature-strip-icon"><i class="bi bi-shield-check"></i></div>
                <div class="feature-strip-text"><strong>Suivi personnalisé</strong><span>Un accompagnement individualisé pour chaque élève.</span></div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-band">
    <div class="container cta-band-inner">
        <div class="cta-band-text">
            <i class="bi bi-mortarboard-fill" style="color:var(--gold);font-size:1.6rem;"></i>
            <strong>Vous hésitez sur le programme adapté à votre enfant ?</strong>
            <span>Nos conseillers sont là pour vous guider.</span>
        </div>
        <div class="cta-band-actions">
            <a href="{{ route('public.contact.index') }}" class="btn btn-outline" style="border-color:var(--royal-blue);color:var(--royal-blue);"><i class="bi bi-calendar-check"></i> Prendre rendez-vous</a>
            <a href="{{ route('public.registration.create') }}" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Inscription en ligne</a>
        </div>
    </div>
</section>
@endsection
