@extends('layouts.app')

@section('title', 'Équipe Administrative')

@section('content')
<section class="subpage-hero" style="background-image:url('/images/20.jpg'), linear-gradient(135deg, var(--royal-blue), var(--royal-blue-light));background-size:cover;background-position:center;position:relative;">
    <div style="position:absolute;inset:0;background:linear-gradient(135deg, rgba(6,18,60,0.85), rgba(10,36,99,0.55));"></div>
    <div class="container" style="position:relative;">
        <div class="section-tag" style="color:var(--gold);">Présentation</div>
        <h1>Équipe <span style="color:var(--gold-light);">Administrative</span></h1>
        <p>Une équipe dévouée à votre service pour une expérience éducative d'excellence</p>
    </div>
</section>

@include('site.partials.presentation-nav')

<section class="content-block" style="background:var(--off-white);">
    <div class="container">
        <div class="text-center" style="margin-bottom:36px;">
            <div class="section-tag" style="justify-content:center;color:var(--gold);">Notre équipe</div>
            <h2 class="section-title">Des professionnels <span>engagés à vos côtés</span></h2>
        </div>
        @if($membres->count())
        <div class="staff-grid">
            @foreach($membres as $membre)
            <div class="staff-card">
                @if($membre->photo)
                <img src="{{ Storage::url($membre->photo) }}" alt="{{ $membre->name }}" class="staff-photo">
                @else
                <div class="staff-photo-placeholder"><i class="bi bi-person-circle"></i></div>
                @endif
                <div class="staff-body">
                    <div class="staff-name">{{ $membre->name }}</div>
                    <div class="staff-role">{{ $membre->role }}</div>
                    @if($membre->bio)
                    <p class="staff-bio">{{ $membre->bio }}</p>
                    @endif
                    <div class="staff-contact">
                        @if($membre->email)<span><i class="bi bi-envelope"></i> {{ $membre->email }}</span>@endif
                        @if($membre->phone)<span><i class="bi bi-telephone-fill"></i> {{ $membre->phone }}</span>@endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p style="text-align:center;color:var(--grey-mid);">Aucun membre à afficher pour le moment.</p>
        @endif
    </div>
</section>
@endsection
