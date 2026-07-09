@extends('layouts.app')

@section('title', 'Vision et Mission')

@section('content')
<section class="subpage-hero">
    <div class="container">
        <div class="section-tag" style="color:var(--gold);">Présentation</div>
        <h1>Vision & <span style="color:var(--gold-light);">Mission</span></h1>
        <p>Les valeurs qui guident notre établissement au quotidien</p>
    </div>
</section>

@include('site.partials.presentation-nav')

<section class="content-block">
    <div class="container">
        <div class="content-inner">
            <p>{{ $page->body ?? "La vision et la mission de l'établissement sont en cours de mise à jour." }}</p>
        </div>
    </div>
</section>
@endsection
