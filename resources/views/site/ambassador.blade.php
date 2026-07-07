@extends('layouts.app')

@section('title', 'Ambassadeur - Présentation')

@section('content')
<section class="page-header" style="background:linear-gradient(135deg, var(--royal-blue), var(--royal-blue-light));padding:80px 0 60px;position:relative;">
    <div class="container" style="position:relative;z-index:2;">
        <div class="section-tag" style="color:var(--gold);">Ambassadeur</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2.5rem,5vw,4rem);font-weight:700;color:var(--white);line-height:1.1;">
            Notre <span style="color:var(--gold-light);">Ambassadeur</span>
        </h1>
        <p style="color:rgba(255,255,255,0.7);font-size:1.1rem;max-width:600px;margin-top:16px;">
            Découvrez le visage et la voix de l'Ambassadors School
        </p>
    </div>
</section>

<section class="ambassador-section" style="padding:80px 0;background:var(--off-white);">
    <div class="container">
        <div class="ambassador-grid" style="display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:start;">
            <!-- Présentation de l'ambassadeur -->
            <div>
                <div style="background:var(--white);border-radius:var(--radius-lg);padding:40px;box-shadow:var(--shadow-md);">
                    <div style="display:flex;align-items:center;gap:24px;margin-bottom:24px;">
                        <div style="width:120px;height:120px;border-radius:50%;background:linear-gradient(135deg,var(--royal-blue),var(--royal-blue-light));display:flex;align-items:center;justify-content:center;font-size:4rem;border:4px solid var(--gold);">
                            🌟
                        </div>
                        <div>
                            <h3 style="font-family:var(--font-display);font-size:1.8rem;color:var(--royal-blue);">Jean-Claude N.</h3>
                            <p style="color:var(--gold);font-weight:600;text-transform:uppercase;letter-spacing:0.1em;font-size:0.8rem;">Ambassadeur Officiel</p>
                        </div>
                    </div>
                    <p style="color:var(--text-body);line-height:1.8;font-size:1rem;">
                        Jean-Claude N. est un ancien élève de l'Ambassadors School, aujourd'hui entrepreneur et leader communautaire. 
                        Il incarne les valeurs d'excellence, d'intégrité et de leadership que nous transmettons à nos élèves.
                    </p>
                    <div style="margin-top:20px;display:flex;gap:12px;flex-wrap:wrap;">
                        <span style="background:var(--grey-light);padding:6px 14px;border-radius:20px;font-size:0.8rem;font-weight:600;">🎓 Promotion 2015</span>
                        <span style="background:var(--grey-light);padding:6px 14px;border-radius:20px;font-size:0.8rem;font-weight:600;">🏆 Prix d'Excellence</span>
                        <span style="background:var(--grey-light);padding:6px 14px;border-radius:20px;font-size:0.8rem;font-weight:600;">🌍 Ambassadeur UNESCO</span>
                    </div>
                </div>

                <div style="margin-top:32px;background:var(--white);border-radius:var(--radius-lg);padding:32px;box-shadow:var(--shadow-sm);">
                    <h4 style="font-family:var(--font-display);font-size:1.4rem;color:var(--royal-blue);margin-bottom:16px;">🎯 Son message</h4>
                    <blockquote style="font-family:var(--font-display);font-size:1.1rem;font-style:italic;color:var(--grey-dark);padding-left:20px;border-left:4px solid var(--gold);">
                        "L'Ambassadors School m'a donné les clés pour réussir. Aujourd'hui, je souhaite transmettre cette flamme à la prochaine génération."
                    </blockquote>
                </div>
            </div>

            <!-- Mission et engagements -->
            <div>
                <div style="background:var(--royal-blue);border-radius:var(--radius-lg);padding:40px;color:white;">
                    <h3 style="font-family:var(--font-display);font-size:1.6rem;margin-bottom:20px;">✨ Mission de l'Ambassadeur</h3>
                    <ul style="list-style:none;padding:0;">
                        <li style="display:flex;gap:14px;margin-bottom:18px;align-items:flex-start;">
                            <span style="font-size:1.5rem;">🎤</span>
                            <div>
                                <strong style="display:block;font-size:1rem;">Représenter l'école</strong>
                                <span style="color:rgba(255,255,255,0.7);font-size:0.9rem;">Être le visage et la voix de l'Ambassadors School dans les événements</span>
                            </div>
                        </li>
                        <li style="display:flex;gap:14px;margin-bottom:18px;align-items:flex-start;">
                            <span style="font-size:1.5rem;">🤝</span>
                            <div>
                                <strong style="display:block;font-size:1rem;">Inspirer les élèves</strong>
                                <span style="color:rgba(255,255,255,0.7);font-size:0.9rem;">Partager son parcours et motiver les jeunes à viser l'excellence</span>
                            </div>
                        </li>
                        <li style="display:flex;gap:14px;margin-bottom:18px;align-items:flex-start;">
                            <span style="font-size:1.5rem;">🌍</span>
                            <div>
                                <strong style="display:block;font-size:1rem;">Rayonnement international</strong>
                                <span style="color:rgba(255,255,255,0.7);font-size:0.9rem;">Promouvoir l'école à l'international et créer des partenariats</span>
                            </div>
                        </li>
                        <li style="display:flex;gap:14px;align-items:flex-start;">
                            <span style="font-size:1.5rem;">💡</span>
                            <div>
                                <strong style="display:block;font-size:1rem;">Innovation pédagogique</strong>
                                <span style="color:rgba(255,255,255,0.7);font-size:0.9rem;">Contribuer à l'évolution des méthodes d'enseignement</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <div style="margin-top:24px;background:var(--gold-pale);border-radius:var(--radius-md);padding:24px;border-left:4px solid var(--gold);">
                    <p style="font-weight:600;color:var(--royal-blue);margin-bottom:8px;">📅 Prochaines interventions</p>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;font-size:0.9rem;">
                        <span style="background:white;padding:8px 14px;border-radius:6px;">15 Mars - Conférence</span>
                        <span style="background:white;padding:8px 14px;border-radius:6px;">22 Avril - Atelier</span>
                        <span style="background:white;padding:8px 14px;border-radius:6px;">5 Mai - Cérémonie</span>
                        <span style="background:white;padding:8px 14px;border-radius:6px;">12 Juin - Graduation</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection