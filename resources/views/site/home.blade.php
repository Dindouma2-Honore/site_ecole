@extends('layouts.app')

@section('title', 'Ambassadors School - Accueil')

@section('content')
<!-- Hero Section -->
   <section class="hero1">
    <div class="overlay-card">
        <h1>Construisez votre avenir dès aujourd'hui</h1>

        <p>
            Gérez votre parcours scolaire en toute simplicité.
            Suivez vos résultats, consultez vos informations et
            progressez vers la réussite.
        </p>

        <a href="#" class="btn-primary">Commencer maintenant</a>

        <a href="#" class="btn-secondary">
            Découvrir la plateforme
        </a>
    </div>
</section>
<section class="hero">
    <div class="hero-slides">
        <div class="hero-slide active"></div>
        <div class="hero-slide"></div>
        <div class="hero-slide"></div>
    </div>
    <div class="hero-overlay"></div>
    <div class="hero-circles">
        <div class="hero-circle"></div>
        <div class="hero-circle"></div>
        <div class="hero-circle"></div>
    </div>
    <div class="hero-dots"></div>

    <div class="hero-content">
        <div class="hero-inner">
            <div class="hero-badge">
                <span class="hero-badge-dot"></span>
                <span class="hero-badge-text">Excellence & Formation</span>
            </div>
            <h1 class="hero-title">
                Façonnons les <em>leaders</em><br>de demain
            </h1>
            <div class="hero-tagline">
                <span>Éducation d'excellence</span>
                <span class="hero-tagline-sep"></span>
                <span>Ambition & Succès</span>
            </div>
            <p class="hero-desc">
                L'Ambassadors School est un établissement d'excellence dédié à former la prochaine génération de leaders, avec un encadrement personnalisé et des méthodes pédagogiques innovantes.
            </p>
            <div class="hero-actions">
                <a href="{{ route('registrations') }}" class="btn btn-primary">📝 S'inscrire</a>
                <a href="{{ route('presentation.dossier') }}" class="btn btn-outline">Découvrir</a>
            </div>
            <div class="hero-stats">
                <div class="hero-stat">
                    <div class="hero-stat-num">{{ $stats['students'] ?? 0 }}+</div>
                    <div class="hero-stat-label">Élèves</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-num">{{ $stats['teachers'] ?? 0 }}+</div>
                    <div class="hero-stat-label">Enseignants</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-num">{{ $stats['courses'] ?? 0 }}+</div>
                    <div class="hero-stat-label">Formations</div>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-indicators">
        <span class="hero-ind active"></span>
        <span class="hero-ind"></span>
        <span class="hero-ind"></span>
    </div>

    <div class="hero-scroll">
        <span>Défiler</span>
        <div class="hero-scroll-line"></div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container stats-grid">
        <div class="stat-item">
            <span class="stat-icon">🎓</span>
            <span class="stat-number">{{ $stats['students'] ?? 0 }}</span>
            <span class="stat-label">Élèves</span>
        </div>
        <div class="stat-item">
            <span class="stat-icon">👨‍🏫</span>
            <span class="stat-number">{{ $stats['teachers'] ?? 0 }}</span>
            <span class="stat-label">Enseignants</span>
        </div>
        <div class="stat-item">
            <span class="stat-icon">📚</span>
            <span class="stat-number">{{ $stats['courses'] ?? 0 }}</span>
            <span class="stat-label">Formations</span>
        </div>
        <div class="stat-item">
            <span class="stat-icon">🏆</span>
            <span class="stat-number">100%</span>
            <span class="stat-label">Réussite</span>
        </div>
    </div>
</section>

<!-- Welcome Section -->
<section class="welcome-section">
    <div class="container">
        <div class="welcome-grid">
            <div class="welcome-content">
                <div class="section-tag">À propos</div>
                <h2 class="section-title">Bienvenue à <span>l'Ambassadors</span> School</h2>
                <p class="section-subtitle" style="max-width:100%;">
                    Depuis 2010, nous formons les leaders de demain dans un cadre d'excellence.
                </p>
                <div class="welcome-features">
                    <div class="feature-pill">
                        <span class="feature-pill-icon">🌟</span>
                        Excellence académique
                    </div>
                    <div class="feature-pill">
                        <span class="feature-pill-icon">🌍</span>
                        Ouverture internationale
                    </div>
                    <div class="feature-pill">
                        <span class="feature-pill-icon">🤝</span>
                        Encadrement personnalisé
                    </div>
                    <div class="feature-pill">
                        <span class="feature-pill-icon">🏅</span>
                        Développement de leadership
                    </div>
                </div>
            </div>
            <div class="welcome-visual">
                <div class="principal-card">
                    <div class="principal-avatar">👤</div>
                    <blockquote class="principal-quote">
                        L'éducation est l'arme la plus puissante qu'on puisse utiliser pour changer le monde.
                    </blockquote>
                    <div class="principal-name">Dr. Jean Mbarga</div>
                    <div class="principal-title">Directeur Général</div>
                </div>
                <div class="welcome-badge">
                    <div class="welcome-badge-num">15+</div>
                    <div class="welcome-badge-text">Années d'excellence</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="why-section">
    <div class="container">
        <div class="text-center">
            <div class="section-tag" style="justify-content:center;">Pourquoi nous choisir</div>
            <h2 class="section-title">Une éducation <span>d'exception</span></h2>
            <p class="section-subtitle">Découvrez les valeurs qui font la différence à l'Ambassadors School</p>
        </div>
        <div class="why-grid">
            <div class="why-card">
                <div class="why-icon">🎯</div>
                <h3 class="why-title">Excellence académique</h3>
                <p class="why-desc">Un programme d'études rigoureux avec des méthodes pédagogiques innovantes.</p>
            </div>
            <div class="why-card">
                <div class="why-icon">🌍</div>
                <h3 class="why-title">Ouverture mondiale</h3>
                <p class="why-desc">Des échanges internationaux et un enseignement bilingue pour préparer l'avenir.</p>
            </div>
            <div class="why-card">
                <div class="why-icon">💡</div>
                <h3 class="why-title">Développement de leadership</h3>
                <p class="why-desc">Des programmes spéciaux pour développer les compétences de leadership.</p>
            </div>
        </div>
    </div>
</section>

<!-- Programs -->
<section class="programs-section">
    <div class="container">
        <div class="text-center">
            <div class="section-tag" style="justify-content:center;">Nos formations</div>
            <h2 class="section-title">Des programmes <span>adaptés</span></h2>
            <p class="section-subtitle">Des formations de la maternelle au lycée pour un parcours d'excellence</p>
        </div>
        <div class="programs-grid">
            @foreach($courses as $course)
            <div class="program-card">
                <div class="program-header">
                    <div class="program-level">{{ $course->level }}</div>
                    <h3 class="program-name">{{ $course->name }}</h3>
                    <div class="program-ages">📖</div>
                    <span class="program-ages">{{ $course->level }}</span>
                </div>
                <div class="program-body">
                    <p style="font-size:0.85rem;color:var(--grey-mid);margin-bottom:14px;">{{ $course->description }}</p>
                    <div class="program-subjects">
                        <span class="subject-tag">📐 Maths</span>
                        <span class="subject-tag">📖 Français</span>
                        <span class="subject-tag">🌍 Anglais</span>
                    </div>
                </div>
                <div class="program-footer">
                    <div>
                        <span class="program-fee">{{ number_format($course->fee, 0, ',', ' ') }} FCFA</span>
                        <span class="program-fee-label">Par an</span>
                    </div>
                    <a href="{{ route('registrations') }}?course_id={{ $course->id }}" class="btn btn-primary" style="padding:8px 16px;font-size:0.7rem;">S'inscrire</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ... Autres sections ... -->
@endsection

@push('scripts')
<script>
    // Hero slides
    let currentSlide = 0;
    const slides = document.querySelectorAll('.hero-slide');
    const indicators = document.querySelectorAll('.hero-ind');

    function goToSlide(index) {
        slides.forEach(s => s.classList.remove('active'));
        indicators.forEach(i => i.classList.remove('active'));
        slides[index].classList.add('active');
        indicators[index].classList.add('active');
        currentSlide = index;
    }

    setInterval(() => {
        goToSlide((currentSlide + 1) % slides.length);
    }, 6000);

    indicators.forEach((ind, i) => {
        ind.addEventListener('click', () => goToSlide(i));
    });

    // Language switcher
    document.querySelectorAll('.lang-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const lang = this.dataset.lang;
            document.documentElement.setAttribute('data-lang', lang);
        });
    });

    // Le menu hamburger et les sous-menus mobiles sont gérés globalement dans layouts/app.blade.php
</script>
@endpush