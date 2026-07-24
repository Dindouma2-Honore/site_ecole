@extends('layouts.app')

@section('title', 'Règlement Intérieur')

@section('content')
<section class="subpage-hero" style="background-image:url('/images/3.jpg'), linear-gradient(135deg, var(--royal-blue), var(--royal-blue-light));background-size:cover;background-position:center;position:relative;">
    <div style="position:absolute;inset:0;background:linear-gradient(135deg, rgba(6,18,60,0.85), rgba(10,36,99,0.55));"></div>
    <div class="container" style="position:relative;">
        <div class="section-tag" style="color:var(--gold);">Cursus scolaire</div>
        <h1>Règlement <span style="color:var(--gold-light);">Intérieur</span></h1>
        <p>Les règles de vie qui régissent notre communauté éducative</p>
    </div>
</section>

@include('site.partials.cursus-nav')

<section class="content-block">
    <div class="container">
        <div class="content-inner">
            <p>{{ $page->body ?? "Le règlement intérieur est en cours de mise à jour." }}</p>
        </div>
    </div>
</section>

<section class="content-block" style="background:var(--off-white);">
    <div class="container">
        <div class="text-center" style="margin-bottom:36px;">
            <div class="section-tag" style="justify-content:center;color:var(--gold);">En bref</div>
            <h2 class="section-title">Les grandes <span>catégories</span> du règlement</h2>
        </div>

        <div class="discipline-grid">
            <div class="discipline-card">
                <div class="discipline-icon"><i class="bi bi-clock-fill"></i></div>
                <div class="discipline-name" style="font-size:1rem;">Assiduité & Ponctualité</div>
                <p class="discipline-desc">Présence obligatoire aux cours, gestion des retards et absences justifiées.</p>
            </div>
            <div class="discipline-card">
                <div class="discipline-icon"><i class="bi bi-person-badge-fill"></i></div>
                <div class="discipline-name" style="font-size:1rem;">Tenue & Comportement</div>
                <p class="discipline-desc">Port de l'uniforme, respect mutuel et bonne conduite en toute circonstance.</p>
            </div>
            <div class="discipline-card">
                <div class="discipline-icon"><i class="bi bi-journal-check"></i></div>
                <div class="discipline-name" style="font-size:1rem;">Évaluations & Discipline</div>
                <p class="discipline-desc">Modalités d'évaluation, sanctions disciplinaires et procédures associées.</p>
            </div>
            <div class="discipline-card">
                <div class="discipline-icon"><i class="bi bi-people-fill"></i></div>
                <div class="discipline-name" style="font-size:1rem;">Relations École-Famille</div>
                <p class="discipline-desc">Communication avec les parents, réunions et suivi de la scolarité.</p>
            </div>
        </div>

        <p style="text-align:center;color:var(--grey-mid);font-size:0.85rem;margin-top:30px;">
            <i class="bi bi-info-circle"></i> Le règlement intérieur complet est remis à chaque famille lors de l'inscription.
        </p>
    </div>
</section>
@endsection
