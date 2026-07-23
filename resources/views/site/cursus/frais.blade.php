@extends('layouts.app')

@section('title', 'Frais de scolarité')

@section('content')
<section class="subpage-hero" style="background-image:url('/images/4.jpg'), linear-gradient(135deg, var(--royal-blue), var(--royal-blue-light));background-size:cover;background-position:center;position:relative;">
    <div style="position:absolute;inset:0;background:linear-gradient(135deg, rgba(6,18,60,0.85), rgba(10,36,99,0.55));"></div>
    <div class="container" style="position:relative;">
        <div class="section-tag" style="color:var(--gold);">Cursus scolaire</div>
        <h1>Frais de <span style="color:var(--gold-light);">scolarité</span></h1>
        <p>Le détail des frais par classe pour l'année scolaire en cours</p>
    </div>
</section>

@include('site.partials.cursus-nav')

<section class="content-block" style="background:var(--off-white);">
    <div class="container">
        @if($courses->count())
        <div class="admin-panel" style="max-width:900px;margin:0 auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Classe</th>
                        <th>Niveau</th>
                        <th>Frais annuel</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                    <tr>
                        <td><strong style="color:var(--royal-blue);">{{ $course->name }}</strong></td>
                        <td>{{ $course->level }}</td>
                        <td>{{ number_format($course->fee, 0, ',', ' ') }} FCFA</td>
                        <td><a href="{{ route('public.registration.create') }}?course_id={{ $course->id }}" class="btn btn-primary" style="padding:6px 14px;font-size:0.72rem;">S'inscrire</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p style="text-align:center;color:var(--grey-mid);">Aucune information disponible pour le moment.</p>
        @endif
    </div>
</section>
@endsection
