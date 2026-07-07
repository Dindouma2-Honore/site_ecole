@extends('layouts.app')

@section('title', 'Visite & Mission')

@section('content')
<section class="page-header" style="background:linear-gradient(135deg, #0d1f4a, #0a2463);padding:80px 0 60px;position:relative;">
    <div class="container" style="position:relative;z-index:2;">
        <div class="section-tag" style="color:var(--gold);">Visite & Mission</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2.5rem,5vw,4rem);font-weight:700;color:var(--white);line-height:1.1;">
            Notre <span style="color:var(--gold-light);">Mission</span> et nos <span style="color:var(--gold-light);">Visites</span>
        </h1>
        <p style="color:rgba(255,255,255,0.7);font-size:1.1rem;max-width:600px;margin-top:16px;">
            Découvrez notre mission éducative et planifiez une visite de l'établissement
        </p>
    </div>
</section>

<section style="padding:80px 0;background:var(--white);">
    <div class="container">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:50px;">
            <!-- Mission -->
            <div>
                <h2 style="font-family:var(--font-display);font-size:2.2rem;color:var(--royal-blue);margin-bottom:24px;">
                    🎯 Notre <span style="color:var(--gold);">Mission</span>
                </h2>
                <div style="background:var(--off-white);border-radius:var(--radius-lg);padding:36px;">
                    <p style="font-size:1.05rem;line-height:1.8;color:var(--text-body);margin-bottom:20px;">
                        L'Ambassadors School a pour mission de former des leaders compétents, intègres et visionnaires, capables de contribuer au développement de leur communauté et du monde.
                    </p>
                    
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div style="background:white;padding:20px;border-radius:var(--radius-md);box-shadow:var(--shadow-sm);text-align:center;">
                            <span style="font-size:2rem;display:block;margin-bottom:8px;">📚</span>
                            <strong style="display:block;color:var(--royal-blue);">Excellence</strong>
                            <span style="font-size:0.85rem;color:var(--grey-mid);">Académique</span>
                        </div>
                        <div style="background:white;padding:20px;border-radius:var(--radius-md);box-shadow:var(--shadow-sm);text-align:center;">
                            <span style="font-size:2rem;display:block;margin-bottom:8px;">🌍</span>
                            <strong style="display:block;color:var(--royal-blue);">Ouverture</strong>
                            <span style="font-size:0.85rem;color:var(--grey-mid);">Internationale</span>
                        </div>
                        <div style="background:white;padding:20px;border-radius:var(--radius-md);box-shadow:var(--shadow-sm);text-align:center;">
                            <span style="font-size:2rem;display:block;margin-bottom:8px;">🤝</span>
                            <strong style="display:block;color:var(--royal-blue);">Intégrité</strong>
                            <span style="font-size:0.85rem;color:var(--grey-mid);">et Éthique</span>
                        </div>
                        <div style="background:white;padding:20px;border-radius:var(--radius-md);box-shadow:var(--shadow-sm);text-align:center;">
                            <span style="font-size:2rem;display:block;margin-bottom:8px;">💡</span>
                            <strong style="display:block;color:var(--royal-blue);">Innovation</strong>
                            <span style="font-size:0.85rem;color:var(--grey-mid);">Pédagogique</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visites -->
            <div>
                <h2 style="font-family:var(--font-display);font-size:2.2rem;color:var(--royal-blue);margin-bottom:24px;">
                    🏫 <span style="color:var(--gold);">Visites</span> de l'école
                </h2>
                
                <div style="background:var(--royal-blue);border-radius:var(--radius-lg);padding:36px;color:white;">
                    <p style="margin-bottom:20px;opacity:0.9;">Planifiez votre visite pour découvrir notre cadre d'excellence</p>
                    
                    <div style="display:grid;gap:16px;">
                        <div style="background:rgba(255,255,255,0.05);border-radius:var(--radius-md);padding:20px;border:1px solid rgba(255,255,255,0.1);">
                            <span style="font-size:1.2rem;">📅</span>
                            <strong style="display:block;margin:6px 0 4px;">Visites individuelles</strong>
                            <span style="font-size:0.9rem;opacity:0.7;">Lundi - Vendredi, 9h - 16h</span>
                        </div>
                        <div style="background:rgba(255,255,255,0.05);border-radius:var(--radius-md);padding:20px;border:1px solid rgba(255,255,255,0.1);">
                            <span style="font-size:1.2rem;">👨‍👩‍👧‍👦</span>
                            <strong style="display:block;margin:6px 0 4px;">Journées portes ouvertes</strong>
                            <span style="font-size:0.9rem;opacity:0.7;">Dernier samedi de chaque mois</span>
                        </div>
                        <div style="background:rgba(255,255,255,0.05);border-radius:var(--radius-md);padding:20px;border:1px solid rgba(255,255,255,0.1);">
                            <span style="font-size:1.2rem;">🏫</span>
                            <strong style="display:block;margin:6px 0 4px;">Visites de groupe</strong>
                            <span style="font-size:0.9rem;opacity:0.7;">Sur rendez-vous</span>
                        </div>
                    </div>

                    <a href="#" class="btn btn-primary" style="margin-top:24px;width:100%;justify-content:center;">
                        📝 Planifier une visite
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Galerie de visite virtuelle -->
<section style="padding:80px 0;background:var(--off-white);">
    <div class="container">
        <div class="text-center">
            <h2 style="font-family:var(--font-display);font-size:2.5rem;color:var(--royal-blue);">
                🖼️ Visite <span style="color:var(--gold);">virtuelle</span>
            </h2>
            <p style="color:var(--grey-mid);">Découvrez notre campus en images</p>
        </div>
        <div class="tour-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:3px;margin-top:40px;border-radius:var(--radius-lg);overflow:hidden;">
            <div class="tour-cell" style="position:relative;height:200px;cursor:pointer;overflow:hidden;">
                <div class="tour-cell-bg" style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:3rem;background:linear-gradient(135deg,#1a3a7a,#0a2463);">
                    🏛️
                </div>
                <div class="tour-overlay" style="position:absolute;inset:0;background:linear-gradient(to top,rgba(6,18,60,0.85) 0%,transparent 60%);z-index:1;"></div>
                <div class="tour-label" style="position:absolute;bottom:16px;left:16px;z-index:2;font-weight:600;color:white;">Bâtiment Principal</div>
            </div>
            <div class="tour-cell" style="position:relative;height:200px;cursor:pointer;overflow:hidden;">
                <div class="tour-cell-bg" style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:3rem;background:linear-gradient(135deg,#0a2463,#061842);">
                    📚
                </div>
                <div class="tour-overlay" style="position:absolute;inset:0;background:linear-gradient(to top,rgba(6,18,60,0.85) 0%,transparent 60%);z-index:1;"></div>
                <div class="tour-label" style="position:absolute;bottom:16px;left:16px;z-index:2;font-weight:600;color:white;">Bibliothèque</div>
            </div>
            <div class="tour-cell" style="position:relative;height:200px;cursor:pointer;overflow:hidden;">
                <div class="tour-cell-bg" style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:3rem;background:linear-gradient(135deg,#c9962c,#8b6914);">
                    🧪
                </div>
                <div class="tour-overlay" style="position:absolute;inset:0;background:linear-gradient(to top,rgba(6,18,60,0.85) 0%,transparent 60%);z-index:1;"></div>
                <div class="tour-label" style="position:absolute;bottom:16px;left:16px;z-index:2;font-weight:600;color:white;">Laboratoire</div>
            </div>
            <div class="tour-cell" style="position:relative;height:200px;cursor:pointer;overflow:hidden;">
                <div class="tour-cell-bg" style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:3rem;background:linear-gradient(135deg,#061842,#0a2463);">
                    ⚽
                </div>
                <div class="tour-overlay" style="position:absolute;inset:0;background:linear-gradient(to top,rgba(6,18,60,0.85) 0%,transparent 60%);z-index:1;"></div>
                <div class="tour-label" style="position:absolute;bottom:16px;left:16px;z-index:2;font-weight:600;color:white;">Terrain de Sport</div>
            </div>
            <div class="tour-cell" style="position:relative;height:200px;cursor:pointer;overflow:hidden;">
                <div class="tour-cell-bg" style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:3rem;background:linear-gradient(135deg,#2952a3,#1a3a7a);">
                    💻
                </div>
                <div class="tour-overlay" style="position:absolute;inset:0;background:linear-gradient(to top,rgba(6,18,60,0.85) 0%,transparent 60%);z-index:1;"></div>
                <div class="tour-label" style="position:absolute;bottom:16px;left:16px;z-index:2;font-weight:600;color:white;">Salle Informatique</div>
            </div>
            <div class="tour-cell" style="position:relative;height:200px;cursor:pointer;overflow:hidden;">
                <div class="tour-cell-bg" style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:3rem;background:linear-gradient(135deg,#0d1f4a,#061842);">
                    🎭
                </div>
                <div class="tour-overlay" style="position:absolute;inset:0;background:linear-gradient(to top,rgba(6,18,60,0.85) 0%,transparent 60%);z-index:1;"></div>
                <div class="tour-label" style="position:absolute;bottom:16px;left:16px;z-index:2;font-weight:600;color:white;">Salle Polyvalente</div>
            </div>
        </div>
    </div>
</section>
@endsection