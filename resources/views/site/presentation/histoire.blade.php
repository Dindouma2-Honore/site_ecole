@extends('layouts.app')

@section('title', 'Historique')

@section('content')
<section class="subpage-hero">
    <div class="container">
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
@endsection
