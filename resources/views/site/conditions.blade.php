@extends('layouts.app')

@section('title', 'Conditions d\'Adhésion')

@section('content')
<section class="page-header" style="background:linear-gradient(135deg, #0d1f4a, #0a2463);padding:80px 0 60px;position:relative;">
    <div class="container" style="position:relative;z-index:2;">
        <div class="section-tag" style="color:var(--gold);">Conditions</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2.5rem,5vw,4rem);font-weight:700;color:var(--white);line-height:1.1;">
            Conditions <span style="color:var(--gold-light);">d'Adhésion</span>
        </h1>
        <p style="color:rgba(255,255,255,0.7);font-size:1.1rem;max-width:600px;margin-top:16px;">
            Les conditions requises pour rejoindre la communauté Ambassadors School
        </p>
    </div>
</section>

<section style="padding:80px 0;background:var(--white);">
    <div class="container">
        <div style="display:grid;grid-template-columns:2fr 1fr;gap:50px;">
            <div>
                <h2 style="font-family:var(--font-display);font-size:2rem;color:var(--royal-blue);margin-bottom:30px;">
                    📋 Conditions <span style="color:var(--gold);">Générales</span>
                </h2>

                <div style="background:var(--off-white);border-radius:var(--radius-lg);padding:32px;">
                    <div style="display:grid;gap:20px;">
                        <div style="background:white;padding:20px;border-radius:var(--radius-md);box-shadow:var(--shadow-sm);border-left:4px solid var(--gold);">
                            <h4 style="color:var(--royal-blue);margin-bottom:8px;">1. Âge requis</h4>
                            <p style="color:var(--grey-mid);font-size:0.95rem;">L'élève doit avoir l'âge correspondant au niveau souhaité :</p>
                            <ul style="margin-top:8px;padding-left:20px;color:var(--text-body);">
                                <li style="list-style:disc;">Maternelle : 3 - 5 ans</li>
                                <li style="list-style:disc;">Primaire : 6 - 11 ans</li>
                                <li style="list-style:disc;">Collège : 12 - 14 ans</li>
                                <li style="list-style:disc;">Lycée : 15 - 18 ans</li>
                            </ul>
                        </div>

                        <div style="background:white;padding:20px;border-radius:var(--radius-md);box-shadow:var(--shadow-sm);border-left:4px solid var(--royal-blue);">
                            <h4 style="color:var(--royal-blue);margin-bottom:8px;">2. Documents requis</h4>
                            <ul style="padding-left:20px;color:var(--text-body);">
                                <li style="list-style:disc;">Acte de naissance</li>
                                <li style="list-style:disc;">Bulletins scolaires des 2 dernières années</li>
                                <li style="list-style:disc;">Certificat de vaccination</li>
                                <li style="list-style:disc;">Photos d'identité (4)</li>
                                <li style="list-style:disc;">Certificat de scolarité (pour les transferts)</li>
                            </ul>
                        </div>

                        <div style="background:white;padding:20px;border-radius:var(--radius-md);box-shadow:var(--shadow-sm);border-left:4px solid var(--gold);">
                            <h4 style="color:var(--royal-blue);margin-bottom:8px;">3. Tests d'entrée</h4>
                            <p style="color:var(--grey-mid);font-size:0.95rem;">Des tests d'évaluation sont organisés pour déterminer le niveau de l'élève :</p>
                            <ul style="margin-top:8px;padding-left:20px;color:var(--text-body);">
                                <li style="list-style:disc;">Tests de français et mathématiques</li>
                                <li style="list-style:disc;">Entretien individuel</li>
                                <li style="list-style:disc;">Évaluation des compétences linguistiques (anglais)</li>
                            </ul>
                        </div>

                        <div style="background:white;padding:20px;border-radius:var(--radius-md);box-shadow:var(--shadow-sm);border-left:4px solid var(--royal-blue);">
                            <h4 style="color:var(--royal-blue);margin-bottom:8px;">4. Engagement parental</h4>
                            <p style="color:var(--grey-mid);font-size:0.95rem;">Les parents s'engagent à :</p>
                            <ul style="margin-top:8px;padding-left:20px;color:var(--text-body);">
                                <li style="list-style:disc;">Respecter le règlement intérieur</li>
                                <li style="list-style:disc;">Participer aux réunions parents-professeurs</li>
                                <li style="list-style:disc;">Assurer le suivi pédagogique de l'élève</li>
                                <li style="list-style:disc;">S'acquitter des frais de scolarité</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div style="background:var(--royal-blue);border-radius:var(--radius-lg);padding:36px;color:white;position:sticky;top:100px;">
                    <h3 style="font-family:var(--font-display);font-size:1.6rem;margin-bottom:20px;">📝 Procédure</h3>
                    <div style="display:grid;gap:16px;">
                        <div style="background:rgba(255,255,255,0.05);padding:16px;border-radius:var(--radius-sm);border-left:3px solid var(--gold);">
                            <strong>Étape 1</strong>
                            <p style="font-size:0.9rem;opacity:0.8;">Prendre rendez-vous pour une visite</p>
                        </div>
                        <div style="background:rgba(255,255,255,0.05);padding:16px;border-radius:var(--radius-sm);border-left:3px solid var(--gold);">
                            <strong>Étape 2</strong>
                            <p style="font-size:0.9rem;opacity:0.8;">Soumettre le dossier de candidature</p>
                        </div>
                        <div style="background:rgba(255,255,255,0.05);padding:16px;border-radius:var(--radius-sm);border-left:3px solid var(--gold);">
                            <strong>Étape 3</strong>
                            <p style="font-size:0.9rem;opacity:0.8;">Passer les tests d'entrée</p>
                        </div>
                        <div style="background:rgba(255,255,255,0.05);padding:16px;border-radius:var(--radius-sm);border-left:3px solid var(--gold);">
                            <strong>Étape 4</strong>
                            <p style="font-size:0.9rem;opacity:0.8;">Validation et confirmation d'inscription</p>
                        </div>
                        <div style="background:rgba(255,255,255,0.05);padding:16px;border-radius:var(--radius-sm);border-left:3px solid var(--gold);">
                            <strong>Étape 5</strong>
                            <p style="font-size:0.9rem;opacity:0.8;">Paiement des frais et intégration</p>
                        </div>
                    </div>
                    <a href="{{ route('registrations') }}" class="btn btn-primary" style="margin-top:24px;width:100%;justify-content:center;">
                        📝 Commencer l'inscription
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection