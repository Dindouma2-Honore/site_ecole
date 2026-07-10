@extends('layouts.app')

@section('title', 'Ambassadors School - Accueil')

@section('content')
<!-- HERO SECTION -->
<section class="hero">

    <div class="overlay"></div>

    <div class="hero-content container">

        <div class="hero-text">
            <h1>Former les <br> leaders de demain aujourd'hui</h1>

            <span class="line"></span>

            <p>
                Un environnement épanouissant qui stimule la curiosité,
                développe le caractère et encourage l'excellence.
            </p>

            <a href="#" class="btn-school">
                DÉCOUVRIR NOTRE ÉCOLE
            </a>

        </div>

    </div>

    
     
</section>
<section class="hauteur" style="height: 250px">
      <div class="hero-features container">

        <div class="feature">
            <div class="icon">
                <i class='bx bxs-graduation'></i>
            </div>

            <h3>EXCELLENCE ACADÉMIQUE</h3>

            <p>
                Un programme éducatif rigoureux conçu pour la réussite.
            </p>
        </div>


        <div class="feature">
            <div class="icon">
                <i class='bx bxs-user'></i>
            </div>

            <h3>DÉVELOPPEMENT DU LEADERSHIP</h3>

            <p>
                Accompagner les élèves à devenir des leaders responsables
                et confiants.
            </p>
        </div>


        <div class="feature">
            <div class="icon">
                <i class='bx bx-world'></i>
            </div>

            <h3>OUVERTURE SUR LE MONDE</h3>

            <p>
                Préparer les élèves à évoluer dans un monde connecté.
            </p>
        </div>


        <div class="feature">
            <div class="icon">
                <i class='bx bx-heart'></i>
            </div>

            <h3>VALEURS ET PERSONNALITÉ</h3>

            <p>
                Développer des valeurs solides pour une vie riche de sens.
            </p>
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