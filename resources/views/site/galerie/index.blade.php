@extends('layouts.app')

@section('title', 'Galerie Photos / Vidéos')

@section('content')
<section class="subpage-hero">
    <div class="container">
        <div class="section-tag" style="color:var(--gold);">Vie scolaire</div>
        <h1>Galerie <span style="color:var(--gold-light);">Photos / Vidéos</span></h1>
        <p>Revivez les temps forts de la vie de notre établissement</p>
    </div>
</section>

<section class="content-block" style="background:var(--off-white);">
    <div class="container">
        @if($categories->count())
        <div class="gallery-tabs" style="justify-content:center;">
            <a href="{{ route('galerie') }}" class="gallery-tab @if(!request('category')) active @endif">Tout</a>
            @foreach($categories as $category)
            <a href="{{ route('galerie', ['category' => $category]) }}" class="gallery-tab @if(request('category') == $category) active @endif">{{ $category }}</a>
            @endforeach
        </div>
        @endif

        @if($items->count())
        <div class="gallery-grid">
            @foreach($items as $item)
            <div class="gallery-item"
                 onclick="openLightbox('{{ $item->type }}', '{{ $item->type === 'photo' ? Storage::url($item->image) : $item->embed_url }}', '{{ addslashes($item->title) }}')">
                @if($item->type === 'photo')
                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}">
                @else
                <div class="gallery-video-thumb">▶</div>
                <span class="gallery-play-badge">Vidéo</span>
                @endif
                <div class="gallery-caption">{{ $item->title }}</div>
            </div>
            @endforeach
        </div>
        @else
        <p style="text-align:center;color:var(--grey-mid);">Aucun média disponible pour le moment.</p>
        @endif
    </div>
</section>

<div class="gallery-lightbox" id="galleryLightbox">
    <button class="gallery-lightbox-close" onclick="closeLightbox()">&times;</button>
    <div class="gallery-lightbox-content" id="lightboxContent"></div>
</div>
@endsection

@push('scripts')
<script>
    function openLightbox(type, url, title) {
        var content = document.getElementById('lightboxContent');
        if (type === 'photo') {
            content.innerHTML = '<img src="' + url + '" alt="' + title + '">';
        } else {
            content.innerHTML = '<iframe src="' + url + '" allowfullscreen></iframe>';
        }
        document.getElementById('galleryLightbox').classList.add('open');
    }

    function closeLightbox() {
        document.getElementById('galleryLightbox').classList.remove('open');
        document.getElementById('lightboxContent').innerHTML = '';
    }

    document.getElementById('galleryLightbox').addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
    });
</script>
@endpush
