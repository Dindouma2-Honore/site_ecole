@extends('layouts.app')

@section('title', "Conditions d'admission")

@section('content')
<section class="subpage-hero" style="background-image:url('/images/formations-hero.jpg'), linear-gradient(135deg, var(--royal-blue), var(--royal-blue-light));background-size:cover;background-position:center;position:relative;">
    <div style="position:absolute;inset:0;background:linear-gradient(135deg, rgba(6,18,60,0.85), rgba(10,36,99,0.55));"></div>
    <div class="container" style="position:relative;">
        <div class="section-tag" style="color:var(--gold);">Cursus scolaire</div>
        <h1>Conditions <span style="color:var(--gold-light);">d'admission</span></h1>
        <p>Les critères d'admission propres à chaque classe</p>
    </div>
</section>

@include('site.partials.cursus-nav')

<section class="content-block" style="background:var(--off-white);">
    <div class="container">
        @if($courses->count())
        <div class="class-grid">
            @foreach($courses as $course)
            <div class="class-card">
                <div class="class-card-header">
                    <div class="class-card-level">{{ $course->level }}</div>
                    <div class="class-card-name">{{ $course->name }}</div>
                </div>
                <div class="class-card-body">
                    @if($course->admission_conditions)
                    <p>{{ $course->admission_conditions }}</p>
                    @else
                    <p>Conditions d'admission à venir. Merci de nous contacter pour plus d'informations.</p>
                    @endif
                </div>
                <div class="class-card-footer">
                    <span style="font-size:0.8rem;color:var(--grey-mid);">Places limitées</span>
                    <a href="{{ route('registrations') }}?course_id={{ $course->id }}" class="btn btn-primary" style="padding:8px 16px;font-size:0.75rem;">S'inscrire</a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p style="text-align:center;color:var(--grey-mid);">Aucune information disponible pour le moment.</p>
        @endif
    </div>
</section>
@endsection
