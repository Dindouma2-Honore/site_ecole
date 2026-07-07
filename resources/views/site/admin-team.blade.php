@extends('layouts.app')

@section('title', 'Équipe Administrative')

@section('content')
<section class="page-header" style="background:linear-gradient(135deg, #0a2463, #2952a3);padding:80px 0 60px;position:relative;">
    <div class="container" style="position:relative;z-index:2;">
        <div class="section-tag" style="color:var(--gold);">Équipe</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2.5rem,5vw,4rem);font-weight:700;color:var(--white);line-height:1.1;">
            Équipe <span style="color:var(--gold-light);">Administrative</span>
        </h1>
        <p style="color:rgba(255,255,255,0.7);font-size:1.1rem;max-width:600px;margin-top:16px;">
            Une équipe dévouée à votre service pour une expérience éducative d'excellence
        </p>
    </div>
</section>

<section style="padding:80px 0;background:var(--off-white);">
    <div class="container">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:30px;">
            <!-- Direction -->
            <div style="background:var(--white);border-radius:var(--radius-lg);padding:32px;text-align:center;box-shadow:var(--shadow-sm);border-top:4px solid var(--gold);">
                <div style="width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,var(--royal-blue),var(--royal-blue-light));display:flex;align-items:center;justify-content:center;font-size:3rem;margin:0 auto 16px;border:3px solid var(--gold);">
                    👤
                </div>
                <h3 style="font-family:var(--font-display);font-size:1.3rem;color:var(--royal-blue);">Dr. Jean Mbarga</h3>
                <p style="color:var(--gold);font-weight:600;font-size:0.85rem;text-transform:uppercase;letter-spacing:0.08em;">Directeur Général</p>
                <p style="color:var(--grey-mid);font-size:0.9rem;margin-top:12px;line-height:1.6;">
                    Plus de 20 ans d'expérience dans l'éducation et la formation des leaders.
                </p>
                <div style="margin-top:16px;display:flex;justify-content:center;gap:10px;">
                    <span style="background:var(--grey-light);padding:4px 12px;border-radius:20px;font-size:0.75rem;">📧 jean@ambassadors.school</span>
                </div>
            </div>

            <div style="background:var(--white);border-radius:var(--radius-lg);padding:32px;text-align:center;box-shadow:var(--shadow-sm);border-top:4px solid var(--royal-blue);">
                <div style="width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,var(--royal-blue-light),var(--royal-blue));display:flex;align-items:center;justify-content:center;font-size:3rem;margin:0 auto 16px;border:3px solid var(--gold);">
                    👩‍🏫
                </div>
                <h3 style="font-family:var(--font-display);font-size:1.3rem;color:var(--royal-blue);">Mme. Claire Ngo</h3>
                <p style="color:var(--gold);font-weight:600;font-size:0.85rem;text-transform:uppercase;letter-spacing:0.08em;">Directrice Pédagogique</p>
                <p style="color:var(--grey-mid);font-size:0.9rem;margin-top:12px;line-height:1.6;">
                    Spécialiste en pédagogie innovante et développement des programmes.
                </p>
                <div style="margin-top:16px;display:flex;justify-content:center;gap:10px;">
                    <span style="background:var(--grey-light);padding:4px 12px;border-radius:20px;font-size:0.75rem;">📧 claire@ambassadors.school</span>
                </div>
            </div>

            <div style="background:var(--white);border-radius:var(--radius-lg);padding:32px;text-align:center;box-shadow:var(--shadow-sm);border-top:4px solid var(--gold);">
                <div style="width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,var(--royal-blue),var(--royal-blue-light));display:flex;align-items:center;justify-content:center;font-size:3rem;margin:0 auto 16px;border:3px solid var(--gold);">
                    👨‍💼
                </div>
                <h3 style="font-family:var(--font-display);font-size:1.3rem;color:var(--royal-blue);">M. Paul Tchou</h3>
                <p style="color:var(--gold);font-weight:600;font-size:0.85rem;text-transform:uppercase;letter-spacing:0.08em;">Secrétaire Général</p>
                <p style="color:var(--grey-mid);font-size:0.9rem;margin-top:12px;line-height:1.6;">
                    Gestion administrative et coordination des services de l'école.
                </p>
                <div style="margin-top:16px;display:flex;justify-content:center;gap:10px;">
                    <span style="background:var(--grey-light);padding:4px 12px;border-radius:20px;font-size:0.75rem;">📧 paul@ambassadors.school</span>
                </div>
            </div>
        </div>

        <!-- Services -->
        <div style="margin-top:60px;">
            <h2 style="font-family:var(--font-display);font-size:2rem;color:var(--royal-blue);text-align:center;margin-bottom:40px;">
                🏢 Nos <span style="color:var(--gold);">Services</span>
            </h2>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;">
                <div style="background:var(--white);padding:24px;border-radius:var(--radius-md);text-align:center;box-shadow:var(--shadow-sm);">
                    <span style="font-size:2.5rem;display:block;">📋</span>
                    <h4 style="color:var(--royal-blue);margin:10px 0 6px;">Inscriptions</h4>
                    <p style="font-size:0.85rem;color:var(--grey-mid);">Accueil et orientation des nouveaux élèves</p>
                </div>
                <div style="background:var(--white);padding:24px;border-radius:var(--radius-md);text-align:center;box-shadow:var(--shadow-sm);">
                    <span style="font-size:2.5rem;display:block;">💰</span>
                    <h4 style="color:var(--royal-blue);margin:10px 0 6px;">Finance</h4>
                    <p style="font-size:0.85rem;color:var(--grey-mid);">Gestion des frais de scolarité et bourses</p>
                </div>
                <div style="background:var(--white);padding:24px;border-radius:var(--radius-md);text-align:center;box-shadow:var(--shadow-sm);">
                    <span style="font-size:2.5rem;display:block;">📚</span>
                    <h4 style="color:var(--royal-blue);margin:10px 0 6px;">Bibliothèque</h4>
                    <p style="font-size:0.85rem;color:var(--grey-mid);">Ressources documentaires et médiathèque</p>
                </div>
                <div style="background:var(--white);padding:24px;border-radius:var(--radius-md);text-align:center;box-shadow:var(--shadow-sm);">
                    <span style="font-size:2.5rem;display:block;">🏥</span>
                    <h4 style="color:var(--royal-blue);margin:10px 0 6px;">Santé</h4>
                    <p style="font-size:0.85rem;color:var(--grey-mid);">Suivi médical et bien-être des élèves</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection