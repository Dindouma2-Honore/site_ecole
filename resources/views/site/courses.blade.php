@extends('layouts.app')

@section('title', 'Formations & Classes')

@section('content')
<section class="page-header" style="background:linear-gradient(135deg, #0a2463, #2952a3);padding:80px 0 60px;position:relative;">
    <div class="container" style="position:relative;z-index:2;">
        <div class="section-tag" style="color:var(--gold);">Formations</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2.5rem,5vw,4rem);font-weight:700;color:var(--white);line-height:1.1;">
            Nos <span style="color:var(--gold-light);">Formations</span> & Classes
        </h1>
        <p style="color:rgba(255,255,255,0.7);font-size:1.1rem;max-width:600px;margin-top:16px;">
            Découvrez l'ensemble de nos programmes éducatifs
        </p>
    </div>
</section>

<section style="padding:80px 0;background:var(--off-white);">
    <div class="container">
        <!-- Filtres -->
        <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:40px;justify-content:center;">
            <button class="gallery-tab active" data-level="all">Tous</button>
            <button class="gallery-tab" data-level="Maternelle">Maternelle</button>
            <button class="gallery-tab" data-level="Primaire">Primaire</button>
            <button class="gallery-tab" data-level="Collège">Collège</button>
            <button class="gallery-tab" data-level="Lycée">Lycée</button>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:30px;" id="coursesGrid">
            @php
            $courses = [
                ['name' => 'Petite Section', 'level' => 'Maternelle', 'desc' => 'Premiers apprentissages et socialisation', 'icon' => '🧸'],
                ['name' => 'Moyenne Section', 'level' => 'Maternelle', 'desc' => 'Développement du langage et des compétences motrices', 'icon' => '🎨'],
                ['name' => 'Grande Section', 'level' => 'Maternelle', 'desc' => 'Préparation à la lecture et aux mathématiques', 'icon' => '📖'],
                ['name' => 'CP - CE1', 'level' => 'Primaire', 'desc' => 'Apprentissage fondamental de la lecture et écriture', 'icon' => '✏️'],
                ['name' => 'CE2 - CM1', 'level' => 'Primaire', 'desc' => 'Renforcement des compétences et découverte culturelle', 'icon' => '🌍'],
                ['name' => 'CM2', 'level' => 'Primaire', 'desc' => 'Préparation à l\'entrée au collège', 'icon' => '🚀'],
                ['name' => '6ème - 5ème', 'level' => 'Collège', 'desc' => 'Transition et approfondissement des connaissances', 'icon' => '🔬'],
                ['name' => '4ème - 3ème', 'level' => 'Collège', 'desc' => 'Préparation au brevet et orientation', 'icon' => '📚'],
                ['name' => 'Seconde', 'level' => 'Lycée', 'desc' => 'Cycle de détermination et choix de spécialités', 'icon' => '🎯'],
                ['name' => 'Première - Terminale', 'level' => 'Lycée', 'desc' => 'Préparation au BAC et orientation supérieure', 'icon' => '🎓'],
            ];
            @endphp

            @foreach($courses as $course)
            <div class="course-card" data-level="{{ $course['level'] }}" style="background:var(--white);border-radius:var(--radius-lg);padding:28px;box-shadow:var(--shadow-sm);border:1px solid var(--grey-light);transition:var(--transition);cursor:pointer;">
                <div style="display:flex;align-items:center;gap:16px;margin-bottom:16px;">
                    <span style="font-size:2.5rem;">{{ $course['icon'] }}</span>
                    <div>
                        <h3 style="font-family:var(--font-display);font-size:1.3rem;color:var(--royal-blue);">{{ $course['name'] }}</h3>
                        <span style="font-size:0.75rem;color:var(--gold);font-weight:600;text-transform:uppercase;letter-spacing:0.08em;">{{ $course['level'] }}</span>
                    </div>
                </div>
                <p style="color:var(--grey-mid);font-size:0.95rem;line-height:1.6;">{{ $course['desc'] }}</p>
                <div style="margin-top:16px;display:flex;gap:8px;flex-wrap:wrap;">
                    <span style="background:var(--grey-light);padding:4px 12px;border-radius:20px;font-size:0.75rem;">📚 Matières générales</span>
                    <span style="background:var(--grey-light);padding:4px 12px;border-radius:20px;font-size:0.75rem;">🌍 Anglais</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.querySelectorAll('.gallery-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.gallery-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            const level = this.dataset.level;
            const cards = document.querySelectorAll('.course-card');
            
            cards.forEach(card => {
                if(level === 'all' || card.dataset.level === level) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush
@endsection