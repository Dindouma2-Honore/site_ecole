@extends('layouts.app')

@section('title', 'Espace Apprenant')

@section('content')
<section class="subpage-hero">
    <div class="container">
        <div class="section-tag" style="color:var(--gold);">Accueil</div>
        <h1>Espace <span style="color:var(--gold-light);">Apprenant</span></h1>
        <p>Votre portail personnel pour suivre votre scolarité</p>
    </div>
</section>

<section class="content-block" style="background:var(--off-white);">
    <div class="container">
        <div class="coming-soon-box">
            <div class="coming-soon-icon">🎓</div>
            <h2 style="font-family:var(--font-display);color:var(--royal-blue);font-size:1.5rem;margin-bottom:14px;">Bientôt disponible</h2>
            <p style="color:var(--grey-mid);line-height:1.7;">
                L'Espace Apprenant permettra bientôt aux élèves et à leurs familles de consulter leurs résultats, leur emploi du temps et leurs documents scolaires directement en ligne.
            </p>
            <a href="{{ route('dashboard') }}" class="btn-primary" style="display:inline-block;margin-top:20px;padding:12px 24px;">Suivre mon inscription</a>
        </div>
    </div>
</section>
@endsection
