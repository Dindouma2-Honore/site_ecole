@extends('layouts.app')

@section('title', "Résultat de la recherche")

@section('content')
<section class="page-header" style="background: url('/images/18.jpg'), linear-gradient(135deg, #0a2463, #2952a3);padding:80px 0 60px;position:relative;">
    <div class="container" style="position:relative;z-index:2;">
        <div class="section-tag" style="color:var(--gold);">Validation</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2.5rem,5vw,4rem);font-weight:700;color:var(--white);line-height:1.1;">
            Statut de <span style="color:var(--gold-light);">votre dossier</span>
        </h1>
    </div>
</section>

<section style="padding:80px 0;background:var(--off-white);">
    <div class="container">
        <div style="max-width:800px;margin:0 auto;background:var(--white);border-radius:var(--radius-xl);padding:40px;box-shadow:var(--shadow-sm);border:1px solid var(--grey-light);">

            @if($registration)
            <h4 style="font-size:1.1rem;color:var(--royal-blue);margin-bottom:16px;">
                <i class="bi bi-clipboard-check"></i> Dossier de {{ $registration->first_name }} {{ $registration->last_name }}
            </h4>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:20px;">
                <div>
                    <span style="display:block;font-size:0.75rem;color:var(--grey-mid);text-transform:uppercase;letter-spacing:0.08em;">Classe souhaitée</span>
                    <span style="font-weight:600;">{{ $registration->classeSouhaitee->name ?? 'Non défini' }}</span>
                </div>
                <div>
                    <span style="display:block;font-size:0.75rem;color:var(--grey-mid);text-transform:uppercase;letter-spacing:0.08em;">Date d'inscription</span>
                    <span style="font-weight:600;">{{ $registration->created_at->format('d/m/Y') }}</span>
                </div>
            </div>

            <div style="background:var(--off-white);border-radius:var(--radius-md);padding:20px;">
                <span style="display:block;font-size:0.75rem;color:var(--grey-mid);text-transform:uppercase;letter-spacing:0.08em;">Statut</span>
                @if(in_array($registration->status, ['nouvelle', 'en_examen']))
                <div style="display:flex;align-items:center;gap:10px;margin-top:4px;">
                    <span style="width:12px;height:12px;border-radius:50%;background:#f39c12;display:inline-block;"></span>
                    <span style="font-weight:700;color:#f39c12;font-size:1.1rem;">En attente de validation</span>
                </div>
                <p style="color:var(--grey-mid);font-size:0.85rem;margin-top:8px;">
                    Votre dossier est en cours d'examen. Vous serez notifié par email dès sa validation.
                </p>
                @elseif($registration->status == 'validee')
                <div style="display:flex;align-items:center;gap:10px;margin-top:4px;">
                    <span style="width:12px;height:12px;border-radius:50%;background:#2ecc71;display:inline-block;"></span>
                    <span style="font-weight:700;color:#2ecc71;font-size:1.1rem;"><i class="bi bi-check-circle-fill"></i> Inscription validée !</span>
                </div>
                <p style="color:var(--grey-mid);font-size:0.85rem;margin-top:8px;">
                    Félicitations ! Votre inscription est validée. Les identifiants de connexion de l'Espace Apprenant et de l'Espace Parent ont été envoyés par email.
                </p>
                @elseif($registration->status == 'liste_attente')
                <div style="display:flex;align-items:center;gap:10px;margin-top:4px;">
                    <span style="width:12px;height:12px;border-radius:50%;background:#f39c12;display:inline-block;"></span>
                    <span style="font-weight:700;color:#f39c12;font-size:1.1rem;">Liste d'attente</span>
                </div>
                <p style="color:var(--grey-mid);font-size:0.85rem;margin-top:8px;">
                    Votre dossier est actuellement sur liste d'attente. Nous vous contacterons si une place se libère.
                </p>
                @elseif($registration->status == 'rejetee')
                <div style="display:flex;align-items:center;gap:10px;margin-top:4px;">
                    <span style="width:12px;height:12px;border-radius:50%;background:#e74c3c;display:inline-block;"></span>
                    <span style="font-weight:700;color:#e74c3c;font-size:1.1rem;"><i class="bi bi-x-circle-fill"></i> Dossier non retenu</span>
                </div>
                <p style="color:var(--grey-mid);font-size:0.85rem;margin-top:8px;">
                    Nous vous invitons à contacter l'administration pour plus d'informations.
                </p>
                @endif
            </div>
            @else
            <div style="text-align:center;padding:20px 0;">
                <i class="bi bi-search" style="font-size:2rem;color:var(--grey-mid);"></i>
                <p style="color:var(--grey-mid);margin-top:12px;">Aucun dossier trouvé avec cette adresse email.</p>
            </div>
            @endif

            <a href="{{ route('public.registration.status') }}" class="btn-secondary" style="margin-top:24px;display:inline-block;"><i class="bi bi-arrow-left"></i> Nouvelle recherche</a>
        </div>
    </div>
</section>
@endsection
