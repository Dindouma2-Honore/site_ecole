@extends('layouts.app')

@section('title', 'Vision et Mission')

@section('content')
<section class="subpage-hero" style="background-image:url('../images/1.png'), linear-gradient(135deg, var(--royal-blue), var(--royal-blue-light));background-size:cover;background-position:center;position:relative;">
    <div style="position:absolute;inset:0;background:linear-gradient(135deg, rgba(6,18,60,0.85), rgba(10,36,99,0.55));"></div>
    <div class="container" style="position:relative;">
        <div class="section-tag" style="color:var(--gold);">Présentation</div>
        <h1>Vision & <span style="color:var(--gold-light);">Mission</span></h1>
        <p>Les valeurs qui guident notre établissement au quotidien</p>
    </div>
</section>

@include('site.partials.presentation-nav')

<!-- Vision / Mission -->
<section class="content-block" style="padding-bottom:0;">
    <div class="container">
        <div class="staff-grid" style="grid-template-columns:repeat(auto-fit, minmax(300px,1fr));">
            <div class="discipline-card" style="text-align:left;border-top:4px solid var(--gold);">
                <div class="discipline-icon" style="color:var(--gold);"><i class="bi bi-eye-fill"></i></div>
                <div class="discipline-name">Notre Vision</div>
                <p class="discipline-desc">Être une référence en éducation d'excellence en Afrique, reconnue pour son innovation pédagogique, son encadrement de qualité et ses résultats durables.</p>
            </div>
            <div class="discipline-card" style="text-align:left;border-top:4px solid var(--royal-blue);">
                <div class="discipline-icon" style="color:var(--royal-blue);"><i class="bi bi-bullseye"></i></div>
                <div class="discipline-name">Notre Mission</div>
                <p class="discipline-desc">Former des leaders responsables et compétents, dotés d'une solide culture académique et de valeurs éthiques, prêts à impacter positivement leur communauté et le monde.</p>
            </div>
        </div>
    </div>
</section>

<!-- Texte complémentaire (éditable admin) -->
<section class="content-block">
    <div class="container">
        <div class="content-inner">
            <p>{{ $page->body ?? "La vision et la mission de l'établissement sont en cours de mise à jour." }}</p>
        </div>
    </div>
</section>

<!-- Valeurs -->
<section class="content-block" style="background:var(--off-white);">
    <div class="container">
        <div class="text-center" style="margin-bottom:36px;">
            <div class="section-tag" style="justify-content:center;color:var(--gold);">Nos valeurs</div>
            <h2 class="section-title">Les piliers de <span>notre engagement</span></h2>
        </div>

        <div class="discipline-grid">
            <div class="discipline-card">
                <div class="discipline-icon"><i class="bi bi-award-fill"></i></div>
                <div class="discipline-name" style="font-size:1rem;">Excellence</div>
                <p class="discipline-desc">Viser le meilleur dans chaque enseignement et chaque accompagnement.</p>
            </div>
            <div class="discipline-card">
                <div class="discipline-icon"><i class="bi bi-shield-fill-check"></i></div>
                <div class="discipline-name" style="font-size:1rem;">Intégrité</div>
                <p class="discipline-desc">Agir avec honnêteté, transparence et cohérence en toute circonstance.</p>
            </div>
            <div class="discipline-card">
                <div class="discipline-icon"><i class="bi bi-people-fill"></i></div>
                <div class="discipline-name" style="font-size:1rem;">Respect</div>
                <p class="discipline-desc">Considérer chaque élève, parent et collaborateur avec bienveillance.</p>
            </div>
            <div class="discipline-card">
                <div class="discipline-icon"><i class="bi bi-graph-up-arrow"></i></div>
                <div class="discipline-name" style="font-size:1rem;">Leadership</div>
                <p class="discipline-desc">Développer la confiance et l'esprit d'initiative chez chaque apprenant.</p>
            </div>
            <div class="discipline-card">
                <div class="discipline-icon"><i class="bi bi-hand-thumbs-up-fill"></i></div>
                <div class="discipline-name" style="font-size:1rem;">Engagement</div>
                <p class="discipline-desc">S'investir pleinement dans la réussite de chaque élève, chaque jour.</p>
            </div>
        </div>
    </div>
</section>
@endsection
