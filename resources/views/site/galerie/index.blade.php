@extends('layouts.app')

@section('title', 'Galerie Photos / Vidéos')

@section('content')
<section class="subpage-hero"
        style="background-image:url('/images/1.jpg'), linear-gradient(135deg, var(--royal-blue), var(--royal-blue-light));background-size:cover;background-position:center;position:relative;">
        <div style="position:absolute;inset:0;background:linear-gradient(135deg, rgba(6,18,60,0.85), rgba(10,36,99,0.55));">
        </div>
        <div class="container" style="position:relative;">
            <div class="section-tag" style="color:var(--gold);">Vie scolaire</div>
            <h1>Galerie <span style="color:var(--gold-light);">Photos / Vidéos</span></h1>
            <p>Revivez les temps forts de la vie de notre établissement</p>
        </div>
    </section>

<section class="content-block" style="background:var(--off-white);">
    <div class="container">
        @if($albums->count())
        <div class="gallery-tabs" style="justify-content:center;">
            <a href="{{ route('public.gallery.index') }}" class="gallery-tab @if(!request('album')) active @endif">Tout</a>
            @foreach($albums as $album)
            <a href="{{ route('public.gallery.index', ['album' => $album]) }}" class="gallery-tab @if(request('album') == $album) active @endif">{{ $album }}</a>
            @endforeach
        </div>
        @endif

        @if($items->count())
        <div class="gallery-grid">
            @foreach($items as $item)
            <div class="gallery-item"
                 onclick="openLightbox('{{ $item->type }}', '{{ $item->type === 'photo' ? Storage::url($item->media_path) : $item->embed_url }}', '{{ addslashes($item->title) }}', '{{ $item->video_source }}')">
                @if($item->type === 'photo')
                <img src="{{ Storage::url($item->media_path) }}" alt="{{ $item->title }}">
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
    function openLightbox(type, url, title, videoSource) {
        var content = document.getElementById('lightboxContent');
        if (type === 'photo') {
            content.innerHTML = '<img src="' + url + '" alt="' + title + '">';
        } else if (videoSource === 'local') {
            content.innerHTML = '<video src="' + url + '" controls autoplay style="width:100%;max-height:85vh;border-radius:var(--radius-md);"></video>';
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
