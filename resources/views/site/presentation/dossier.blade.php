@extends('layouts.app')

@section('title', "Présentation de l'établissement")

@section('content')
<section class="subpage-hero" style="background-image:url('/images/1.png'), linear-gradient(135deg, var(--royal-blue), var(--royal-blue-light));background-size:cover;background-position:center;position:relative;">
    <div style="position:absolute;inset:0;background:linear-gradient(135deg, rgba(6,18,60,0.85), rgba(10,36,99,0.55));"></div>
    <div class="container" style="position:relative;">
        <div class="section-tag" style="color:var(--gold);">À propos de nous</div>
        <h1>Présentation de <span style="color:var(--gold-light);">l'établissement</span></h1>
        <p>Ambassadors s'engage à offrir un environnement d'apprentissage stimulant, où chaque élève est accompagné pour développer son plein potentiel académique, personnel et social.</p>
    </div>
</section>

@include('site.partials.presentation-nav')

<!-- Stats bar -->
<section style="background:var(--royal-blue);">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-icon"><i class="bi bi-mortarboard-fill"></i></span>
                <span class="stat-number">12+</span>
                <span class="stat-label">Années d'excellence</span>
            </div>
            <div class="stat-item">
                <span class="stat-icon"><i class="bi bi-people-fill"></i></span>
                <span class="stat-number">{{ $stats['students'] > 0 ? $stats['students'] . '+' : '850+' }}</span>
                <span class="stat-label">Élèves accompagnés</span>
            </div>
            <div class="stat-item">
                <span class="stat-icon"><i class="bi bi-person-workspace"></i></span>
                <span class="stat-number">{{ $stats['teachers'] > 0 ? $stats['teachers'] . '+' : '45+' }}</span>
                <span class="stat-label">Enseignants qualifiés</span>
            </div>
            <div class="stat-item">
                <span class="stat-icon"><i class="bi bi-building"></i></span>
                <span class="stat-number">1</span>
                <span class="stat-label">Campus moderne</span>
            </div>
        </div>
    </div>
</section>

<!-- Mission / Vision / Valeurs -->
<section class="content-block" style="padding-bottom:0;">
    <div class="container">
        <div class="staff-grid" style="grid-template-columns:repeat(auto-fit, minmax(260px,1fr));">
            <div class="discipline-card" style="text-align:left;">
                <div class="discipline-icon" style="color:var(--gold);"><i class="bi bi-bullseye"></i></div>
                <div class="discipline-name">Notre Mission</div>
                <p class="discipline-desc">Former des leaders responsables et compétents, dotés d'une solide culture académique et de valeurs éthiques, prêts à impacter positivement leur communauté et le monde.</p>
            </div>
            <div class="discipline-card" style="text-align:left;">
                <div class="discipline-icon" style="color:var(--gold);"><i class="bi bi-eye-fill"></i></div>
                <div class="discipline-name">Notre Vision</div>
                <p class="discipline-desc">Être une référence en éducation d'excellence en Afrique, reconnue pour son innovation pédagogique, son encadrement de qualité et ses résultats durables.</p>
            </div>
            <div class="discipline-card" style="text-align:left;">
                <div class="discipline-icon" style="color:var(--gold);"><i class="bi bi-gem"></i></div>
                <div class="discipline-name">Nos Valeurs</div>
                <p class="discipline-desc">Excellence · Intégrité · Respect · Leadership · Engagement — les piliers qui guident chacune de nos actions au quotidien.</p>
            </div>
        </div>
    </div>
</section>

<!-- Engagement -->
<section class="content-block">
    <div class="container">
        <div class="content-inner">
            <div class="section-tag" style="color:var(--gold);">Notre engagement</div>
            <h2 style="font-family:var(--font-display);color:var(--royal-blue);font-size:1.6rem;margin-bottom:16px;">Un cadre d'apprentissage favorisant la réussite</h2>
            <p>{{ $page->body ?? "Le dossier de l'établissement est en cours de mise à jour." }}</p>

            <div class="discipline-grid" style="margin-top:28px;">
                <div class="discipline-card">
                    <div class="discipline-icon"><i class="bi bi-book-half"></i></div>
                    <div class="discipline-name" style="font-size:0.95rem;">Programmes académiques de qualité</div>
                </div>
                <div class="discipline-card">
                    <div class="discipline-icon"><i class="bi bi-person-check-fill"></i></div>
                    <div class="discipline-name" style="font-size:0.95rem;">Encadrement personnalisé</div>
                </div>
                <div class="discipline-card">
                    <div class="discipline-icon"><i class="bi bi-graph-up-arrow"></i></div>
                    <div class="discipline-name" style="font-size:0.95rem;">Développement global de l'élève</div>
                </div>
                <div class="discipline-card">
                    <div class="discipline-icon"><i class="bi bi-globe-americas"></i></div>
                    <div class="discipline-name" style="font-size:0.95rem;">Ouverture internationale et culturelle</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section style="background:var(--royal-blue);padding:36px 0;">
    <div class="container" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:20px;">
        <div style="display:flex;align-items:center;gap:16px;">
            <i class="bi bi-mortarboard-fill" style="font-size:2.2rem;color:var(--gold);"></i>
            <div>
                <div style="color:var(--white);font-weight:700;font-family:var(--font-display);font-size:1.2rem;">Rejoignez la communauté Ambassadors</div>
                <div style="color:rgba(255,255,255,0.7);font-size:0.9rem;">Offrez à votre enfant une éducation d'excellence pour un avenir sans limites.</div>
            </div>
        </div>
        <a href="{{ route('registrations') }}" class="btn btn-primary" style="white-space:nowrap;">Inscription en ligne <i class="bi bi-arrow-right"></i></a>
    </div>
</section>
@endsection
