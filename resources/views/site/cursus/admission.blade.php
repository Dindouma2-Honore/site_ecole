@extends('layouts.app')

@section('title', "Conditions d'admission")

@section('content')
{{-- <section class="subpage-hero">
    <div class="container">
        <div class="section-tag" style="color:var(--gold);">Cursus scolaire</div>
        <h1>Conditions <span style="color:var(--gold-light);">d'admission</span></h1>
        <p>Les critères d'admission propres à chaque classe</p>
    </div>
</section> --}}

{{-- @include('site.partials.cursus-nav') --}}


<!-- ============================================================
     HERO AVEC IMAGE ET OVERLAY (comme dans la maquette)
     ============================================================ -->
<section class="hero-formation">

    <div class="overlay2">
        <div class="hero-content">
            <span class="hero-badge"><i class="fas fa-graduation-cap" style="margin-right:8px;"></i> Nos formations</span>
            <h1>Des parcours d'<span>excellence</span> pour chaque ambition</h1>
            <p>Nous proposons des programmes académiques rigoureux et innovants, conçus pour développer le potentiel de chaque élève à chaque étape de son parcours.</p>
        </div>
    </div>
</section>


<!-- ===== SECTION FORMATIONS ===== -->
<div class="container fond">

    <!-- En-tête de section -->
    <div class="section-header">
        <span class="tag">Un enseignement adapté</span>
        <h2>À chaque étape de la vie scolaire</h2>
        <p>Des programmes conçus pour accompagner chaque enfant dans son développement et sa réussite.</p>
    </div>

    <!-- Grille des formations -->
    <div class="programmes-grid">

        <!-- MATERNELLE -->
        <div class="carte">
            <span class="badge maternelle"><i class="fas fa-seedling" style="margin-right:6px;"></i> Éveil</span>
            <h3>Maternelle</h3>
            <div class="age">3 – 5 ans</div>
            <p>Un environnement bienveillant et stimulant pour éveiller la curiosité, développer les compétences de base et favoriser l'épanouissement global de l'enfant.</p>
            <ul>
                <li><i class="fas fa-circle"></i> Éveil &amp; découvertes</li>
                <li><i class="fas fa-circle"></i> Développement socio-émotionnel</li>
                <li><i class="fas fa-circle"></i> Langage &amp; communication</li>
                <li><i class="fas fa-circle"></i> Activités créatives &amp; motrices</li>
            </ul>
            <a href="#" class="btn-savoir">EN SAVOIR PLUS <i class="fas fa-arrow-right"></i></a>
        </div>

        <!-- PRIMAIRE -->
        <div class="carte">
            <span class="badge primaire"><i class="fas fa-book-open" style="margin-right:6px;"></i> Fondations</span>
            <h3>Primaire</h3>
            <div class="age">6 – 11 ans</div>
            <p>Une base solide en connaissances fondamentales, avec un apprentissage actif qui développe la pensée critique, la créativité et la confiance en soi.</p>
            <ul>
                <li><i class="fas fa-circle"></i> Français, Anglais, Mathématiques</li>
                <li><i class="fas fa-circle"></i> Sciences &amp; Technologie</li>
                <li><i class="fas fa-circle"></i> Éducation à la citoyenneté</li>
                <li><i class="fas fa-circle"></i> Arts, Sport &amp; Informatique</li>
            </ul>
            <a href="#" class="btn-savoir">EN SAVOIR PLUS <i class="fas fa-arrow-right"></i></a>
        </div>

        <!-- SECONDAIRE -->
        <div class="carte">
            <span class="badge secondaire"><i class="fas fa-graduation-cap" style="margin-right:6px;"></i> Excellence</span>
            <h3>Secondaire</h3>
            <div class="age">12 – 17 ans</div>
            <p>Un enseignement académique exigeant préparant aux examens nationaux et internationaux, tout en développant le leadership et l'autonomie.</p>
            <ul>
                <li><i class="fas fa-circle"></i> Sciences, Lettres, Langues</li>
                <li><i class="fas fa-circle"></i> Préparation BEPC / Baccalauréat</li>
                <li><i class="fas fa-circle"></i> Développement personnel</li>
                <li><i class="fas fa-circle"></i> Clubs &amp; projets d'élèves</li>
            </ul>
            <a href="#" class="btn-savoir">EN SAVOIR PLUS <i class="fas fa-arrow-right"></i></a>
        </div>

        <!-- PROGRAMMES INTERNATIONAUX -->
        <div class="carte">
            <span class="badge international"><i class="fas fa-globe" style="margin-right:6px;"></i> International</span>
            <h3>Programmes internationaux</h3>
            <div class="age">Cambridge · IGCSE · A-Levels</div>
            <p>Des parcours et partenariats internationaux offrant une ouverture sur le monde et des opportunités d'études supérieures à l'international.</p>
            <ul>
                <li><i class="fas fa-circle"></i> Cambridge Curriculum</li>
                <li><i class="fas fa-circle"></i> IGCSE / A-Levels</li>
                <li><i class="fas fa-circle"></i> Échanges &amp; partenariats</li>
                <li><i class="fas fa-circle"></i> Orientation universitaire</li>
            </ul>
            <a href="#" class="btn-savoir">EN SAVOIR PLUS <i class="fas fa-arrow-right"></i></a>
        </div>

      

    </div>
    <div class="d-flex ">
          <!-- APPROCHE PÉDAGOGIQUE -->
        <div class="">
            <div class="icon-circle"><i class="fas fa-chalkboard-teacher"></i></div>
            <h4>Approche pédagogique</h4>
            <p>Centrée sur l'élève, interactive et axée sur la réussite.</p>
            <a href="#" class="btn-savoir-plus">EN SAVOIR PLUS <i class="fas fa-arrow-right"></i></a>
        </div><hr>

        <!-- ENSEIGNANTS QUALIFIÉS -->
        <div class="">
            <div class="icon-circle"><i class="fas fa-user-graduate"></i></div>
            <h4>Enseignants qualifiés</h4>
            <p>Une équipe passionnée et expérimentée au service de l'excellence.</p>
            <a href="#" class="btn-savoir-plus">EN SAVOIR PLUS <i class="fas fa-arrow-right"></i></a>
        </div><hr>

        <!-- RESSOURCES MODERNES -->
        <div class="">
            <div class="icon-circle"><i class="fas fa-laptop"></i></div>
            <h4>Ressources modernes</h4>
            <p>Salles équipées, laboratoires, bibliothèque et outils numériques.</p>
            <a class="btn-savoir-plus">EN SAVOIR PLUS <i class="fas fa-arrow-right"></i></a>
        </div><hr>

        <!-- SUIVI PERSONNALISÉ -->
        <div>
            <div class="icon-circle"><i class="fas fa-heart"></i></div>
            <h4>Suivi personnalisé</h4>
            <p>Un accompagnement individuel pour chaque élève.</p>
            <a href="#" class="btn-savoir-plus">EN SAVOIR PLUS <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
    <!-- ZONE DE CONTACT -->
    <div class="contact-zone">
        <div>
            <h3>Vous hésitez sur le programme adapté à votre enfant ?</h3>
            <p>Nos conseillers sont là pour vous guider.</p>
        </div>
        <a href="#" class="btn-contact">
            <i class="fas fa-calendar-check"></i> Prendre rendez-vous
        </a>
    </div>

</div>
@endsection
