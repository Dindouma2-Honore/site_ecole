@extends('layouts.app')

@section('title', 'Historique')

@section('content')
<section class="subpage-hero" style="background-image:url('/images/1.png'), linear-gradient(135deg, var(--royal-blue), var(--royal-blue-light));background-size:cover;background-position:center;position:relative;">
    <div style="position:absolute;inset:0;background:linear-gradient(135deg, rgba(6,18,60,0.85), rgba(10,36,99,0.55));"></div>
    <div class="container" style="position:relative;">
        <div class="section-tag" style="color:var(--gold);">Présentation</div>
        <h1>Notre <span style="color:var(--gold-light);">Historique</span></h1>
        <p>Le parcours de l'Ambassadors Educational Complex depuis sa fondation</p>
    </div>
</section>

@include('site.partials.presentation-nav')

<section class="content-block">
    <div class="container">
        <div class="content-inner">
            <p>{{ $page->body ?? "L'historique de l'établissement est en cours de mise à jour." }}</p>
        </div>
    </div>
</section>

<section class="content-block" style="background:var(--off-white);padding-top:0;">
    <div class="container">
        <div class="text-center" style="margin-bottom:40px;">
            <div class="section-tag" style="justify-content:center;color:var(--gold);">Étapes clés</div>
            <h2 class="section-title">Les grandes <span>dates</span> de notre parcours</h2>
        </div>

        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-dot"><i class="bi bi-flag-fill"></i></div>
                <div class="timeline-year">2013</div>
                <div class="timeline-card">
                    <h4>Fondation de l'établissement</h4>
                    <p>Ouverture de l'Ambassadors Educational Complex à Yaoundé, avec les premières classes de maternelle et de primaire.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"><i class="bi bi-building-fill-add"></i></div>
                <div class="timeline-year">2016</div>
                <div class="timeline-card">
                    <h4>Extension du campus</h4>
                    <p>Ouverture du cycle secondaire et agrandissement des infrastructures pour accompagner la croissance des effectifs.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"><i class="bi bi-patch-check-fill"></i></div>
                <div class="timeline-year">2019</div>
                <div class="timeline-card">
                    <h4>Agrément officiel</h4>
                    <p>Obtention de l'agrément du Ministère des Enseignements Secondaires pour l'ensemble des cycles proposés.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"><i class="bi bi-mortarboard-fill"></i></div>
                <div class="timeline-year">2022</div>
                <div class="timeline-card">
                    <h4>Premières promotions au Baccalauréat</h4>
                    <p>Résultats d'excellence pour la première cohorte d'élèves ayant suivi l'intégralité du cursus Ambassadors.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"><i class="bi bi-stars"></i></div>
                <div class="timeline-year">Aujourd'hui</div>
                <div class="timeline-card">
                    <h4>Un établissement en pleine croissance</h4>
                    <p>Plus de 850 élèves accompagnés chaque année par une équipe pédagogique qualifiée et engagée.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
