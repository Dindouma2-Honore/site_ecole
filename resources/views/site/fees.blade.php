@extends('layouts.app')

@section('title', 'Frais de Scolarité')

@section('content')
<section class="page-header" style="background:linear-gradient(135deg, #0a2463, #2952a3);padding:80px 0 60px;position:relative;">
    <div class="container" style="position:relative;z-index:2;">
        <div class="section-tag" style="color:var(--gold);">Frais</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2.5rem,5vw,4rem);font-weight:700;color:var(--white);line-height:1.1;">
            Frais de <span style="color:var(--gold-light);">Scolarité</span>
        </h1>
        <p style="color:rgba(255,255,255,0.7);font-size:1.1rem;max-width:600px;margin-top:16px;">
            Une éducation d'excellence accessible avec des formules adaptées
        </p>
    </div>
</section>

<section style="padding:80px 0;background:var(--off-white);">
    <div class="container">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:30px;">
            @php
            $fees = [
                ['level' => 'Maternelle', 'fee' => '350 000', 'features' => ['Garderie incluse', 'Repas', 'Activités ludiques']],
                ['level' => 'Primaire', 'fee' => '450 000', 'features' => ['Manuels scolaires', 'Activités sportives', 'Club de lecture']],
                ['level' => 'Collège', 'fee' => '550 000', 'features' => ['Laboratoires', 'Sorties pédagogiques', 'Cours d\'anglais renforcé']],
                ['level' => 'Lycée', 'fee' => '650 000', 'features' => ['Préparation BAC', 'Orientation', 'Bourse au mérite']],
            ];
            @endphp

            @foreach($fees as $fee)
            <div style="background:var(--white);border-radius:var(--radius-lg);overflow:hidden;box-shadow:var(--shadow-sm);transition:var(--transition);border:1px solid var(--grey-light);">
                <div style="background:linear-gradient(135deg,var(--royal-blue),var(--royal-blue-light));padding:28px;text-align:center;color:white;">
                    <h3 style="font-family:var(--font-display);font-size:1.6rem;">{{ $fee['level'] }}</h3>
                    <div style="font-family:var(--font-display);font-size:2.8rem;font-weight:700;margin:12px 0;">
                        {{ $fee['fee'] }}
                        <span style="font-size:0.9rem;font-weight:400;opacity:0.7;">FCFA</span>
                    </div>
                    <span style="background:rgba(255,255,255,0.15);padding:4px 16px;border-radius:20px;font-size:0.75rem;">Par an</span>
                </div>
                <div style="padding:28px;">
                    <ul style="display:grid;gap:10px;margin-bottom:20px;">
                        @foreach($fee['features'] as $feature)
                        <li style="display:flex;align-items:center;gap:8px;color:var(--text-body);font-size:0.9rem;">
                            <span style="color:var(--gold);font-size:1.1rem;">✓</span>
                            {{ $feature }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('registrations') }}" class="btn btn-primary" style="width:100%;justify-content:center;padding:10px;">
                        S'inscrire
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Options de paiement -->
        <div style="margin-top:60px;background:var(--royal-blue);border-radius:var(--radius-lg);padding:40px;color:white;">
            <h3 style="font-family:var(--font-display);font-size:1.8rem;text-align:center;margin-bottom:24px;">
                💳 Options de <span style="color:var(--gold-light);">paiement</span>
            </h3>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;">
                <div style="background:rgba(255,255,255,0.05);padding:20px;border-radius:var(--radius-md);text-align:center;border:1px solid rgba(255,255,255,0.1);">
                    <span style="font-size:2.5rem;display:block;">🏦</span>
                    <strong>Paiement comptant</strong>
                    <p style="font-size:0.85rem;opacity:0.7;margin-top:4px;">À l'inscription</p>
                </div>
                <div style="background:rgba(255,255,255,0.05);padding:20px;border-radius:var(--radius-md);text-align:center;border:1px solid rgba(255,255,255,0.1);">
                    <span style="font-size:2.5rem;display:block;">📅</span>
                    <strong>Échelonné</strong>
                    <p style="font-size:0.85rem;opacity:0.7;margin-top:4px;">3 mensualités</p>
                </div>
                <div style="background:rgba(255,255,255,0.05);padding:20px;border-radius:var(--radius-md);text-align:center;border:1px solid rgba(255,255,255,0.1);">
                    <span style="font-size:2.5rem;display:block;">🎓</span>
                    <strong>Bourses</strong>
                    <p style="font-size:0.85rem;opacity:0.7;margin-top:4px;">Sur dossier</p>
                </div>
                <div style="background:rgba(255,255,255,0.05);padding:20px;border-radius:var(--radius-md);text-align:center;border:1px solid rgba(255,255,255,0.1);">
                    <span style="font-size:2.5rem;display:block;">🤝</span>
                    <strong>Parrainage</strong>
                    <p style="font-size:0.85rem;opacity:0.7;margin-top:4px;">Réduction famille</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection