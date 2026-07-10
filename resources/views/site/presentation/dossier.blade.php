@extends('layouts.app')

@section('title', "Dossier de l'établissement")

@section('content')
<section class="about-hero1">

    <div class="overlay1"></div>

    <div class="container hero-content1">

        <span class="subtitle">
            — À PROPOS DE NOUS
        </span>

        <h1>Présentation de l'établissement</h1>

        <p>
            Ambassadors s'engage à offrir un environnement
            d'apprentissage stimulant, où chaque élève est accompagné
            pour développer son plein potentiel académique,
            personnel et social.
        </p>

        <div class="breadcrumb">
            Accueil >
            À propos >
            <span>Présentation de l'établissement</span>
        </div>

    </div>

</section>


<section class="about-cards container">

    <div class="card">
        <i class='bx bx-target-lock'></i>

        <h3>Notre Mission</h3>

        <p>
            Former des leaders responsables et compétents.
        </p>
    </div>

    <div class="card">
        <i class='bx bx-show'></i>

        <h3>Notre Vision</h3>

        <p>
            Être une référence en Afrique.
        </p>
    </div>

    <div class="card">
        <i class='bx bx-diamond'></i>

        <h3>Nos Valeurs</h3>

        <ul>
            <li>Excellence</li>
            <li>Respect</li>
            <li>Leadership</li>
            <li>Engagement</li>
        </ul>

    </div>

    <div class="stats">

        <div class="stat">
            <i class='bx bxs-graduation'></i>
            <h2>12+</h2>
            <span>Années d'excellence</span>
        </div>

        <div class="stat">
            <i class='bx bx-group'></i>
            <h2>850+</h2>
            <span>Élèves</span>
        </div>

        <div class="stat">
            <i class='bx bx-user'></i>
            <h2>45+</h2>
            <span>Enseignants</span>
        </div>

        <div class="stat">
            <i class='bx bx-building-house'></i>
            <h2>1</h2>
            <span>Campus</span>
        </div>

    </div>

</section>



<section class="about-content1 container">

    <div class="about-image">

        <img src="{{ asset('images/2.png') }}" alt="">

    </div>

    <div class="about-text">

        <span>NOTRE ENGAGEMENT</span>

        <h2>
            Un cadre d'apprentissage favorisant la réussite
        </h2>

        <p>
            À Ambassadors, nous croyons que chaque élève est unique...
        </p>

        <div class="features">

            <div>
                <i class='bx bx-book'></i>
                Programmes académiques
            </div>

            <div>
                <i class='bx bx-user-check'></i>
                Encadrement personnalisé
            </div>

            <div>
                <i class='bx bx-trophy'></i>
                Développement personnel
            </div>

            <div>
                <i class='bx bx-world'></i>
                Ouverture internationale
            </div>

        </div>

    </div>

</section>



<section class="cta container">

    <div>

        <h3>Rejoignez la communauté Ambassadors</h3>

        <p>
            Offrez à votre enfant une éducation d'excellence.
        </p>

    </div>

    <a href="#" class="btn">
        INSCRIPTION EN LIGNE
    </a>

</section>
@endsection
