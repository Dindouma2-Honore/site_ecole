@extends('layouts.app')

@section('title', 'Équipe Administrative')

@section('content')
<section class="subpage-hero">
    <div class="container">
        <div class="section-tag" style="color:var(--gold);">Présentation</div>
        <h1>Équipe <span style="color:var(--gold-light);">Administrative</span></h1>
        <p>Une équipe dévouée à votre service pour une expérience éducative d'excellence</p>
    </div>
</section>

@include('site.partials.presentation-nav')

<section class="content-block">
    <div class="container">
        @if($membres->count())
        <div class="staff-grid">
            @foreach($membres as $membre)
            <div class="staff-card">
                @if($membre->photo)
                <img src="{{ Storage::url($membre->photo) }}" alt="{{ $membre->name }}" class="staff-photo">
                @else
                <div class="staff-photo-placeholder">👤</div>
                @endif
                <div class="staff-body">
                    <div class="staff-name">{{ $membre->name }}</div>
                    <div class="staff-role">{{ $membre->role }}</div>
                    @if($membre->bio)
                    <p class="staff-bio">{{ $membre->bio }}</p>
                    @endif
                    <div class="staff-contact">
                        @if($membre->email)<span>✉ {{ $membre->email }}</span>@endif
                        @if($membre->phone)<span>📞 {{ $membre->phone }}</span>@endif
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
