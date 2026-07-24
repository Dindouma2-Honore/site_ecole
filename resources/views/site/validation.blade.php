@extends('layouts.app')

@section('title', "Validation d'Inscription")

@section('content')
<section class="subpage-hero"
        style="background-image:url('/images/18.jpg'), linear-gradient(135deg, var(--royal-blue), var(--royal-blue-light));background-size:cover;background-position:center;position:relative;">
        <div style="position:absolute;inset:0;background:linear-gradient(135deg, rgba(6,18,60,0.85), rgba(10,36,99,0.55));">
        </div>
        <div class="container" style="position:relative;">
            <div class="section-tag" style="color:var(--gold);">Validation</div>
            <h1>Validation <span style="color:var(--gold-light);">d'inscription</span></h1>
            <p> Suivez l'état de votre inscription en temps réel
                </p>
        </div>
    </section>

<section style="padding:80px 0;background:var(--off-white);">
    <div class="container">
        <div style="max-width:800px;margin:0 auto;">
            <div style="background:var(--white);border-radius:var(--radius-xl);padding:40px;box-shadow:var(--shadow-sm);border:1px solid var(--grey-light);">
                <h3 style="font-family:var(--font-display);font-size:1.4rem;color:var(--royal-blue);margin-bottom:20px;">
                    <i class="bi bi-search"></i> Suivre votre inscription
                </h3>
                <p style="color:var(--grey-mid);margin-bottom:24px;">
                    Entrez l'adresse email du parent / tuteur pour connaître l'état du dossier
                </p>
                <form action="{{ route('public.registration.check') }}" method="POST">
                    @csrf
                    <div style="display:flex;gap:12px;">
                        <input type="email" name="email" class="form-input" placeholder="votre@email.com" required style="flex:1;">
                        <button type="submit" class="btn btn-primary" style="white-space:nowrap;">Vérifier</button>
                    </div>
                </form>
            </div>

            <div style="margin-top:24px;background:var(--gold-pale);border-radius:var(--radius-md);padding:16px 20px;border-left:4px solid var(--gold);display:flex;gap:12px;align-items:flex-start;">
                <span style="font-size:1.2rem;"><i class="bi bi-lightbulb-fill"></i></span>
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
