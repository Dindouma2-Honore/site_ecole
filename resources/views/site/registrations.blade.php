@extends('layouts.app')

@section('title', 'Inscriptions')

@section('content')
<section class="page-header" style="background:linear-gradient(135deg, #061842, #0a2463);padding:80px 0 60px;position:relative;">
    <div class="container" style="position:relative;z-index:2;">
        <div class="section-tag" style="color:var(--gold);">Inscriptions</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2.5rem,5vw,4rem);font-weight:700;color:var(--white);line-height:1.1;">
            Formulaire <span style="color:var(--gold-light);">d'Inscription</span>
        </h1>
        <p style="color:rgba(255,255,255,0.7);font-size:1.1rem;max-width:600px;margin-top:16px;">
            Rejoignez la communauté Ambassadors School en remplissant ce formulaire
        </p>
    </div>
</section>

<section style="padding:80px 0;background:var(--white);">
    <div class="container">
        <div style="max-width:800px;margin:0 auto;">
            @if(session('success'))
            <div style="background:var(--gold-pale);border-left:4px solid var(--gold);padding:16px 20px;border-radius:var(--radius-sm);margin-bottom:30px;display:flex;align-items:center;gap:12px;">
                <span style="font-size:1.5rem;">✅</span>
                <div>
                    <strong style="color:var(--royal-blue);">Inscription soumise !</strong>
                    <p style="color:var(--text-body);font-size:0.9rem;margin:0;">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            <div style="background:var(--off-white);border-radius:var(--radius-xl);padding:48px;border:1px solid var(--grey-light);">
                <form action="{{ route('registration.submit') }}" method="POST">
                    @csrf
                    
                    <!-- Informations personnelles -->
                    <div style="margin-bottom:30px;">
                        <h3 style="font-family:var(--font-display);font-size:1.4rem;color:var(--royal-blue);margin-bottom:16px;">👤 Informations personnelles</h3>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                            <div class="form-group">
                                <label class="form-label">Prénom</label>
                                <input type="text" name="first_name" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nom</label>
                                <input type="text" name="last_name" class="form-input" required>
                            </div>
                        </div>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:14px;">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Téléphone</label>
                                <input type="tel" name="phone" class="form-input" required>
                            </div>
                        </div>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:14px;">
                            <div class="form-group">
                                <label class="form-label">Date de naissance</label>
                                <input type="date" name="birth_date" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Niveau souhaité</label>
                                <select name="course_id" class="form-select" required>
                                    <option value="">Choisir...</option>
                                    @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }} ({{ $course->level }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:14px;">
                            <label class="form-label">Adresse</label>
                            <input type="text" name="address" class="form-input" required>
                        </div>
                    </div>

                    <!-- Informations parentales -->
                    <div style="margin-bottom:30px;">
                        <h3 style="font-family:var(--font-display);font-size:1.4rem;color:var(--royal-blue);margin-bottom:16px;">👨‍👩‍👦 Informations parentales</h3>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                            <div class="form-group">
                                <label class="form-label">Nom du parent / tuteur</label>
                                <input type="text" name="parent_name" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Téléphone du parent</label>
                                <input type="tel" name="parent_phone" class="form-input" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:16px;">
                        📝 Soumettre l'inscription
                    </button>
                </form>
            </div>

            <div style="margin-top:32px;background:var(--gold-pale);border-radius:var(--radius-md);padding:20px;border-left:4px solid var(--gold);display:flex;gap:14px;align-items:flex-start;">
                <span style="font-size:1.5rem;">ℹ️</span>
                <div>
                    <strong style="color:var(--royal-blue);">Procédure après l'inscription</strong>
                    <p style="color:var(--text-body);font-size:0.9rem;margin:4px 0 0;">
                        Un email de confirmation vous sera envoyé. Vous pourrez suivre l'avancement de votre dossier 
                        et recevrez les informations pour la validation.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection