@extends('layouts.app')

@section('title', 'Disciplines enseignées')

@section('content')
<section class="subpage-hero">
    <div class="container">
        <div class="section-tag" style="color:var(--gold);">Cursus scolaire</div>
        <h1>Disciplines <span style="color:var(--gold-light);">enseignées</span></h1>
        <p>Un programme complet couvrant l'ensemble des matières fondamentales</p>
    </div>
</section>

@include('site.partials.cursus-nav')

<section class="content-block" style="background:var(--off-white);">
    <div class="container">
        @if($disciplines->count())
        <div class="discipline-grid">
            @foreach($disciplines as $discipline)
            <div class="discipline-card">
                <div class="discipline-icon">{{ $discipline->icon ?: '📘' }}</div>
                <div class="discipline-name">{{ $discipline->name }}</div>
                @if($discipline->description)
                <p class="discipline-desc">{{ $discipline->description }}</p>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <p style="text-align:center;color:var(--grey-mid);">Aucune discipline à afficher pour le moment.</p>
        @endif
    </div>
</section>
@endsection
