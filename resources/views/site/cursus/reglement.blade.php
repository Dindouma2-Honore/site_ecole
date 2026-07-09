@extends('layouts.app')

@section('title', 'Règlement Intérieur')

@section('content')
<section class="subpage-hero">
    <div class="container">
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
@endsection
