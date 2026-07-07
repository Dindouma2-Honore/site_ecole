@extends('layouts.app')

@section('title', 'Validation d\'Inscription')

@section('content')
<section class="page-header" style="background:linear-gradient(135deg, #0a2463, #2952a3);padding:80px 0 60px;position:relative;">
    <div class="container" style="position:relative;z-index:2;">
        <div class="section-tag" style="color:var(--gold);">Validation</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2.5rem,5vw,4rem);font-weight:700;color:var(--white);line-height:1.1;">
            Validation <span style="color:var(--gold-light);">d'Inscription</span>
        </h1>
        <p style="color:rgba(255,255,255,0.7);font-size:1.1rem;max-width:600px;margin-top:16px;">
            Suivez l'état de votre inscription en temps réel
            @if(session('success'))
            <span style="display:block;color:var(--gold-light);margin-top:8px;">✅ {{ session('success') }}</span>
            @endif
        </p>
    </div>
</section>

<section style="padding:80px 0;background:var(--off-white);">
    <div class="container">
        <div style="max-width:800px;margin:0 auto;">
            <!-- Formulaire de recherche -->
            <div style="background:var(--white);border-radius:var(--radius-xl);padding:40px;box-shadow:var(--shadow-sm);border:1px solid var(--grey-light);">
                <h3 style="font-family:var(--font-display);font-size:1.4rem;color:var(--royal-blue);margin-bottom:20px;">
                    🔍 Suivre votre inscription
                </h3>
                <p style="color:var(--grey-mid);margin-bottom:24px;">
                    Entrez votre adresse email pour connaître l'état de votre dossier
                </p>
                <form action="{{ route('validation.check') }}" method="POST">
                    @csrf
                    <div style="display:flex;gap:12px;">
                        <input type="email" name="email" class="form-input" placeholder="votre@email.com" required style="flex:1;">
                        <button type="submit" class="btn btn-primary" style="white-space:nowrap;">Vérifier</button>
                    </div>
                </form>

                @if(isset($registration))
                <div style="margin-top:32px;padding-top:32px;border-top:1px solid var(--grey-light);">
                    <h4 style="font-size:1rem;color:var(--royal-blue);margin-bottom:16px;">
                        📋 Dossier de {{ $registration->first_name }} {{ $registration->last_name }}
                    </h4>
                    
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:20px;">
                        <div>
                            <span style="display:block;font-size:0.75rem;color:var(--grey-mid);text-transform:uppercase;letter-spacing:0.08em;">Niveau</span>
                            <span style="font-weight:600;">{{ $registration->course->name ?? 'Non défini' }}</span>
                        </div>
                        <div>
                            <span style="display:block;font-size:0.75rem;color:var(--grey-mid);text-transform:uppercase;letter-spacing:0.08em;">Date d'inscription</span>
                            <span style="font-weight:600;">{{ $registration->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>

                    <div style="background:var(--off-white);border-radius:var(--radius-md);padding:20px;">
                        <span style="display:block;font-size:0.75rem;color:var(--grey-mid);text-transform:uppercase;letter-spacing:0.08em;">Statut</span>
                        @if($registration->status == 'pending')
                        <div style="display:flex;align-items:center;gap:10px;margin-top:4px;">
                            <span style="width:12px;height:12px;border-radius:50%;background:#f39c12;display:inline-block;"></span>
                            <span style="font-weight:700;color:#f39c12;font-size:1.1rem;">En attente de validation</span>
                        </div>
                        <p style="color:var(--grey-mid);font-size:0.85rem;margin-top:8px;">
                            Votre dossier est en cours d'examen. Vous serez notifié par email dès sa validation.
                        </p>
                        @elseif($registration->status == 'validated')
                        <div style="display:flex;align-items:center;gap:10px;margin-top:4px;">
                            <span style="width:12px;height:12px;border-radius:50%;background:#2ecc71;display:inline-block;"></span>
                            <span style="font-weight:700;color:#2ecc71;font-size:1.1rem;">✅ Inscription validée !</span>
                        </div>
                        <p style="color:var(--grey-mid);font-size:0.85rem;margin-top:8px;">
                            Félicitations ! Votre inscription est validée. Vous recevrez prochainement les informations pour la rentrée.
                            @if($registration->validated_at)
                            <br><span style="font-size:0.75rem;">Validé le {{ $registration->validated_at->format('d/m/Y') }}</span>
                            @endif
                        </p>
                        @elseif($registration->status == 'rejected')
                        <div style="display:flex;align-items:center;gap:10px;margin-top:4px;">
                            <span style="width:12px;height:12px;border-radius:50%;background:#e74c3c;display:inline-block;"></span>
                            <span style="font-weight:700;color:#e74c3c;font-size:1.1rem;">❌ Dossier non retenu</span>
                        </div>
                        <p style="color:var(--grey-mid);font-size:0.85rem;margin-top:8px;">
                            Nous vous invitons à contacter l'administration pour plus d'informations.
                        </p>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <!-- Renvoi d'approbation -->
            <div style="margin-top:32px;background:var(--white);border-radius:var(--radius-xl);padding:32px;border:1px solid var(--grey-light);">
                <h4 style="font-family:var(--font-display);font-size:1.2rem;color:var(--royal-blue);margin-bottom:12px;">
                    📨 Renvoi d'approbation
                </h4>
                <p style="color:var(--grey-mid);font-size:0.9rem;margin-bottom:16px;">
                    Si vous n'avez pas reçu votre email d'approbation, vous pouvez en demander le renvoi.
                </p>
                <form action="#" method="POST" style="display:flex;gap:12px;">
                    @csrf
                    <input type="email" name="resend_email" class="form-input" placeholder="votre@email.com" required style="flex:1;">
                    <button type="submit" class="btn btn-blue" style="white-space:nowrap;">📧 Renvoyer</button>
                </form>
            </div>

            <div style="margin-top:24px;background:var(--gold-pale);border-radius:var(--radius-md);padding:16px 20px;border-left:4px solid var(--gold);display:flex;gap:12px;align-items:flex-start;">
                <span style="font-size:1.2rem;">💡</span>
                <div>
                    <strong style="color:var(--royal-blue);font-size:0.9rem;">Besoin d'aide ?</strong>
                    <p style="color:var(--text-body);font-size:0.85rem;margin:0;">
                        Contactez notre service d'inscription au <strong>+237 6XX XXX XXX</strong> ou par email à <strong>inscriptions@ambassadors.school</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection