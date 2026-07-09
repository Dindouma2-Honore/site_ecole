@extends('layouts.app')

@section('title', "Dossier de l'établissement")

@section('content')
<section class="subpage-hero">
    <div class="container">
        <div class="section-tag" style="color:var(--gold);">Présentation</div>
        <h1>Dossier de <span style="color:var(--gold-light);">l'établissement</span></h1>
        <p>Informations administratives et légales de l'Ambassadors Educational Complex</p>
    </div>
</section>

@include('site.partials.presentation-nav')

<section class="content-block">
    <div class="container">
        <div class="content-inner">
            <p>{{ $page->body ?? "Le dossier de l'établissement est en cours de mise à jour." }}</p>
        </div>
    </div>
</section>
@endsection
