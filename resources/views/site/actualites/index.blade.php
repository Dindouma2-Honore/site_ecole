@extends('layouts.app')

@section('title', 'Actualités & Événements')

@section('content')
<section class="subpage-hero">
    <div class="container">
        <div class="section-tag" style="color:var(--gold);">Vie scolaire</div>
        <h1>Actualités & <span style="color:var(--gold-light);">Événements</span></h1>
        <p>Toute l'actualité générale de l'établissement et de chaque classe</p>
    </div>
</section>

<section class="content-block" style="background:var(--off-white);">
    <div class="container">
        <div class="news-filter-bar">
            <a href="{{ route('actualites.index') }}" class="gallery-tab @if(!request('course_id')) active @endif">Toutes</a>
            <a href="{{ route('actualites.index', ['course_id' => 'generale']) }}" class="gallery-tab @if(request('course_id') == 'generale') active @endif">Générale</a>
            @foreach($courses as $course)
            <a href="{{ route('actualites.index', ['course_id' => $course->id]) }}" class="gallery-tab @if((string) request('course_id') === (string) $course->id) active @endif">{{ $course->name }}</a>
            @endforeach
        </div>

        @if($news->count())
        <div class="news-grid">
            @foreach($news as $item)
            <div class="news-card">
                @if($item->image)
                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" class="news-image">
                @else
                <div class="news-image-placeholder">📰</div>
                @endif
                <div class="news-body">
                    <span class="news-tag">{{ $item->course->name ?? 'Actualité générale' }}</span>
                    <div class="news-title">{{ $item->title }}</div>
                    <p class="news-excerpt">{{ \Illuminate\Support\Str::limit($item->content, 110) }}</p>
                    <div class="news-date">{{ $item->published_at->format('d/m/Y') }}</div>
                </div>
            </div>
            @endforeach
        </div>
        <div style="margin-top:40px;">
            {{ $news->links() }}
        </div>
        @else
        <p style="text-align:center;color:var(--grey-mid);">Aucune actualité pour le moment.</p>
        @endif
    </div>
</section>
@endsection
