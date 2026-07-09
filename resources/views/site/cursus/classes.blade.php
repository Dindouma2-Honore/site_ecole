@extends('layouts.app')

@section('title', 'Classes disponibles')

@section('content')
<section class="subpage-hero">
    <div class="container">
        <div class="section-tag" style="color:var(--gold);">Cursus scolaire</div>
        <h1>Classes <span style="color:var(--gold-light);">disponibles</span></h1>
        <p>Découvrez la présentation pédagogique de chaque classe proposée</p>
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
                    @if($course->pedagogical_content)
                    <p>{{ $course->pedagogical_content }}</p>
                    @elseif($course->description)
                    <p>{{ $course->description }}</p>
                    @else
                    <p>Présentation pédagogique à venir.</p>
                    @endif
                </div>
                <div class="class-card-footer">
                    <span class="program-fee">{{ number_format($course->fee, 0, ',', ' ') }} FCFA / an</span>
                    <a href="{{ route('registrations') }}?course_id={{ $course->id }}" class="btn btn-primary" style="padding:8px 16px;font-size:0.75rem;">S'inscrire</a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p style="text-align:center;color:var(--grey-mid);">Aucune classe disponible pour le moment.</p>
        @endif
    </div>
</section>
@endsection
