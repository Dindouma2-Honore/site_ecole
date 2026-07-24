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
            @if ($albums->count())
                <div class="gallery-tabs" style="justify-content:center;">
                    <a href="{{ route('public.gallery.index') }}"
                        class="gallery-tab @if (!request('album')) active @endif">Tout</a>
                    @foreach ($albums as $album)
                        <a href="{{ route('public.gallery.index', ['album' => $album]) }}"
                            class="gallery-tab @if (request('album') == $album) active @endif">{{ $album }}</a>
                    @endforeach
                </div>
            @endif

            @if ($items->count())
                <div class="gallery-grid">
                    @foreach ($items as $item)
                        <div class="gallery-item">
                            @if ($item->type === 'photo')
                                <img src="{{ Storage::url($item->media_path) }}" alt="{{ $item->title }}" onclick="openLightbox('photo', '{{ Storage::url($item->media_path) }}', {{ json_encode($item->title) }})">
                            @else
                                <div class="video-wrapper">
                                    <video src="{{ Storage::url($item->media_path) }}" 
                                           controls 
                                           preload="metadata"
                                           playsinline
                                           onclick="event.stopPropagation();"
                                           style="width:100%;height:250px;object-fit:cover;background:#000;display:block;">
                                    </video>
                                    <div class="video-overlay" onclick="this.previousElementSibling.play(); this.style.display='none';">
                                        <div class="play-button">▶</div>
                                    </div>
                                </div>
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
        var lightbox = document.getElementById('galleryLightbox');
        
        if (type === 'photo') {
            content.innerHTML = '<img src="' + url + '" alt="' + title + '" style="max-width:100%;max-height:85vh;border-radius:8px;box-shadow:0 20px 60px rgba(0,0,0,0.5);">';
        }
        
        lightbox.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        var lightbox = document.getElementById('galleryLightbox');
        var content = document.getElementById('lightboxContent');
        
        lightbox.classList.remove('open');
        document.body.style.overflow = '';
        
        setTimeout(function() {
            content.innerHTML = '';
        }, 300);
    }

    // Fermer avec la touche Échap
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        }
    });

    // Fermer en cliquant sur le fond
    document.getElementById('galleryLightbox').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLightbox();
        }
    });

    // Gestion des vidéos dans les vignettes
    document.addEventListener('DOMContentLoaded', function() {
        var videos = document.querySelectorAll('.video-wrapper video');
        
        videos.forEach(function(video) {
            // Quand la vidéo est jouée, cacher l'overlay
            video.addEventListener('play', function() {
                var overlay = this.parentElement.querySelector('.video-overlay');
                if (overlay) {
                    overlay.style.display = 'none';
                }
            });
            
            // Quand la vidéo est mise en pause, montrer l'overlay
            video.addEventListener('pause', function() {
                var overlay = this.parentElement.querySelector('.video-overlay');
                if (overlay && this.currentTime > 0) {
                    overlay.style.display = 'flex';
                    overlay.querySelector('.play-button').textContent = '⏸';
                }
            });
            
            // Quand la vidéo est terminée, montrer l'overlay avec rejouer
            video.addEventListener('ended', function() {
                var overlay = this.parentElement.querySelector('.video-overlay');
                if (overlay) {
                    overlay.style.display = 'flex';
                    overlay.querySelector('.play-button').textContent = '⟳';
                }
            });
        });
    });
</script>

<style>
    .video-wrapper {
        position: relative;
        width: 100%;
        height: 250px;
        background: #000;
        overflow: hidden;
        cursor: pointer;
    }

    .video-wrapper video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .video-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0,0,0,0.3);
        transition: background 0.3s;
        cursor: pointer;
        z-index: 2;
    }

    .video-overlay:hover {
        background: rgba(0,0,0,0.2);
    }

    .play-button {
        width: 70px;
        height: 70px;
        background: rgba(255, 0, 0, 0.85);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        border: 3px solid white;
        transition: transform 0.3s, background 0.3s;
        backdrop-filter: blur(5px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }

    .video-overlay:hover .play-button {
        transform: scale(1.1);
        background: rgba(255, 0, 0, 1);
    }

    .gallery-play-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(255,0,0,0.85);
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        z-index: 3;
        backdrop-filter: blur(5px);
    }
    
    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: var(--radius-md);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        background: white;
    }
    
    .gallery-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.2);
    }
    
    .gallery-item img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        display: block;
        cursor: pointer;
    }
    
    .gallery-caption {
        padding: 12px 15px;
        background: white;
        font-weight: 500;
        color: var(--royal-blue);
        text-align: center;
    }
    
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        margin-top: 40px;
    }
    
    .gallery-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 30px;
    }
    
    .gallery-tab {
        padding: 8px 20px;
        border-radius: 25px;
        background: white;
        color: var(--royal-blue);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s;
        border: 2px solid transparent;
    }
    
    .gallery-tab:hover {
        background: var(--royal-blue);
        color: white;
    }
    
    .gallery-tab.active {
        background: var(--royal-blue);
        color: white;
        border-color: var(--gold);
    }

    .gallery-lightbox {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.92);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    
    .gallery-lightbox.open {
        display: flex;
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .gallery-lightbox-close {
        position: absolute;
        top: 20px;
        right: 30px;
        font-size: 40px;
        color: white;
        background: none;
        border: none;
        cursor: pointer;
        z-index: 10000;
        transition: transform 0.3s;
    }
    
    .gallery-lightbox-close:hover {
        transform: scale(1.2);
    }
    
    .gallery-lightbox-content {
        width: 100%;
        max-width: 1200px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endpush