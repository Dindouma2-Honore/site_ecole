@extends('layouts.app')

@section('title', 'Inscription en ligne')

@section('content')
<section class="reg-hero" style="background-image:url('/images/18.jpg'), linear-gradient(135deg, var(--royal-blue), var(--royal-blue-light));background-size:cover;background-position:center;position:relative;">

    <div class="container">
        <div class="section-tag" style="color:var(--gold);">Inscription en ligne</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2rem,4vw,2.6rem);font-weight:700;color:var(--white);line-height:1.2;">
            Inscrivez-vous en quelques étapes<br>et rejoignez la communauté Ambassadors
        </h1>
        <p style="color:rgba(255,255,255,0.75);font-size:1rem;max-width:600px;margin-top:14px;">
            Remplissez le formulaire d'inscription pour l'année scolaire 2026-2027. Notre équipe vous contactera pour finaliser le processus.
        </p>

        <div class="stepper" id="stepper">
            <div class="stepper-item active" data-step="1">
                <div class="stepper-circle"><i class="bi bi-person"></i></div>
                <div class="stepper-label">Informations<br>élève</div>
            </div>
            <div class="stepper-item" data-step="2">
                <div class="stepper-circle"><i class="bi bi-people"></i></div>
                <div class="stepper-label">Informations<br>parent / tuteur</div>
            </div>
            <div class="stepper-item" data-step="3">
                <div class="stepper-circle"><i class="bi bi-folder2-open"></i></div>
                <div class="stepper-label">Documents<br>à fournir</div>
            </div>
            <div class="stepper-item" data-step="4">
                <div class="stepper-circle"><i class="bi bi-check2-square"></i></div>
                <div class="stepper-label">Validation<br>& Envoi</div>
            </div>
        </div>
    </div>
</section>

<section style="padding:50px 0 80px;background:var(--white);">
    <div class="container">

        @if(session('success'))
        <div style="background:var(--gold-pale);border-left:4px solid var(--gold);padding:16px 20px;border-radius:var(--radius-sm);margin-bottom:30px;display:flex;align-items:center;gap:12px;max-width:900px;">
            <span style="font-size:1.5rem;"><i class="bi bi-check-circle-fill"></i></span>
            <div>
                <strong style="color:var(--royal-blue);">Inscription soumise !</strong>
                <p style="color:var(--text-body);font-size:0.9rem;margin:0;">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        @if($errors->any())
        <div style="background:#fdecea;border-left:4px solid #e74c3c;padding:16px 20px;border-radius:var(--radius-sm);margin-bottom:30px;max-width:900px;">
            <strong style="color:#c0392b;"><i class="bi bi-exclamation-triangle-fill"></i> Merci de corriger les points suivants :</strong>
            <ul style="margin:8px 0 0 20px;color:#c0392b;font-size:0.88rem;">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="reg-layout">
            <!-- Formulaire -->
            <div class="reg-form-card">
                <form action="{{ route('public.registration.store') }}" method="POST" id="regForm" enctype="multipart/form-data">
                    @csrf

                    <!-- Étape 1 -->
                    <div class="step-panel active" data-panel="1">
                        <span class="reg-step-badge">Étape 1 / 4</span>
                        <h3 class="reg-step-title"><i class="bi bi-person-circle"></i> Informations de l'élève</h3>

                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                            <div class="form-group">
                                <label class="form-label">Prénom</label>
                                <input type="text" name="first_name" class="form-input" value="{{ old('first_name') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nom</label>
                                <input type="text" name="last_name" class="form-input" value="{{ old('last_name') }}" required>
                            </div>
                        </div>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:14px;">
                            <div class="form-group">
                                <label class="form-label">Date de naissance</label>
                                <input type="date" name="birth_date" class="form-input" value="{{ old('birth_date') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Classe souhaitée</label>
                                <select name="class_souhaitee_id" class="form-select" required>
                                    <option value="">Choisir...</option>
                                    @foreach($classes as $classe)
                                    <option value="{{ $classe->id }}" {{ (string) old('class_souhaitee_id', $selectedClassId) === (string) $classe->id ? 'selected' : '' }}>{{ $classe->name }} ({{ $classe->level }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:14px;">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-input" value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Téléphone</label>
                                <input type="tel" name="phone" class="form-input" value="{{ old('phone') }}" required>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:14px;">
                            <label class="form-label">Adresse</label>
                            <input type="text" name="address" class="form-input" value="{{ old('address') }}" required>
                        </div>

                        <div class="step-nav">
                            <span></span>
                            <button type="button" class="btn btn-primary" onclick="nextStep(1)">Suivant : Informations parent / tuteur <i class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Étape 2 -->
                    <div class="step-panel" data-panel="2">
                        <span class="reg-step-badge">Étape 2 / 4</span>
                        <h3 class="reg-step-title"><i class="bi bi-people-fill"></i> Informations parent / tuteur</h3>

                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                            <div class="form-group">
                                <label class="form-label">Nom du parent / tuteur</label>
                                <input type="text" name="parent_name" class="form-input" value="{{ old('parent_name') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Téléphone du parent</label>
                                <input type="tel" name="parent_phone" class="form-input" value="{{ old('parent_phone') }}" required>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:14px;">
                            <label class="form-label">Email du parent / tuteur</label>
                            <input type="email" name="parent_email" class="form-input" value="{{ old('parent_email') }}" required>
                        </div>

                        <div class="step-nav">
                            <button type="button" class="btn btn-outline" onclick="prevStep(2)"><i class="bi bi-arrow-left"></i> Retour</button>
                            <button type="button" class="btn btn-primary" onclick="nextStep(2)">Suivant : Documents à fournir <i class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Étape 3 -->
                    <div class="step-panel" data-panel="3">
                        <span class="reg-step-badge">Étape 3 / 4</span>
                        <h3 class="reg-step-title"><i class="bi bi-folder2-open"></i> Documents à fournir</h3>
                        <p style="color:var(--grey-mid);font-size:0.88rem;margin-bottom:16px;">
                            Merci de préparer les documents suivants. Ils seront à déposer (physiquement ou par email) une fois votre pré-inscription en ligne validée par notre équipe.
                        </p>
                        <p style="color:var(--grey-mid);font-size:0.85rem;margin-bottom:8px;">Tous les documents sont optionnels à ce stade et peuvent être complétés plus tard, mais les fournir maintenant accélère le traitement de votre dossier.</p>
                        <div class="form-group">
                            <label class="form-label"><i class="bi bi-file-earmark-text"></i> Acte de naissance de l'élève</label>
                            <input type="file" name="documents[acte_naissance]">
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class="bi bi-file-earmark-text"></i> Bulletin scolaire</label>
                            <input type="file" name="documents[bulletin]">
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class="bi bi-image"></i> Photo d'identité de l'élève</label>
                            <input type="file" name="documents[photo]" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class="bi bi-file-earmark-medical"></i> Certificat médical (optionnel)</label>
                            <input type="file" name="documents[certificat_medical]">
                        </div>

                        <div class="step-nav">
                            <button type="button" class="btn btn-outline" onclick="prevStep(3)"><i class="bi bi-arrow-left"></i> Retour</button>
                            <button type="button" class="btn btn-primary" onclick="nextStep(3)">Suivant : Validation & Envoi <i class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Étape 4 -->
                    <div class="step-panel" data-panel="4">
                        <span class="reg-step-badge">Étape 4 / 4</span>
                        <h3 class="reg-step-title"><i class="bi bi-check2-square"></i> Validation & Envoi</h3>
                        <p style="color:var(--grey-mid);font-size:0.88rem;margin-bottom:16px;">
                            Vérifiez rapidement vos informations avant l'envoi. Vous pourrez suivre l'état de votre dossier depuis la page "Validation d'inscription".
                        </p>

                        <div class="reg-recap">
                            <div class="reg-recap-row"><span>Élève</span><span id="recapName">—</span></div>
                            <div class="reg-recap-row"><span>Email</span><span id="recapEmail">—</span></div>
                            <div class="reg-recap-row"><span>Classe souhaitée</span><span id="recapClasse">—</span></div>
                            <div class="reg-recap-row"><span>Parent / tuteur</span><span id="recapParent">—</span></div>
                        </div>

                        <div style="background:var(--gold-pale);border-left:4px solid var(--gold);padding:14px 16px;border-radius:var(--radius-sm);font-size:0.82rem;color:var(--text-body);margin-bottom:10px;">
                            <i class="bi bi-shield-check"></i> Vos données sont protégées et resteront confidentielles.
                        </div>

                        <div class="step-nav">
                            <button type="button" class="btn btn-outline" onclick="prevStep(4)"><i class="bi bi-arrow-left"></i> Retour</button>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-send-check"></i> Envoyer mon inscription</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Sidebar -->
            <div>
                <div class="reg-sidebar-card dark">
                    <div class="reg-sidebar-title">Pourquoi choisir Ambassadors ?</div>
                    <div class="reg-why-item">
                        <div class="reg-why-icon"><i class="bi bi-mortarboard-fill"></i></div>
                        <div><strong style="color:var(--white);">Excellence académique</strong><span style="color:rgba(255,255,255,0.6);">Un enseignement de qualité pour préparer les leaders de demain.</span></div>
                    </div>
                    <div class="reg-why-item">
                        <div class="reg-why-icon"><i class="bi bi-graph-up-arrow"></i></div>
                        <div><strong style="color:var(--white);">Développement global</strong><span style="color:rgba(255,255,255,0.6);">Nous cultivons le potentiel intellectuel, social et émotionnel de chaque élève.</span></div>
                    </div>
                    <div class="reg-why-item">
                        <div class="reg-why-icon"><i class="bi bi-person-check-fill"></i></div>
                        <div><strong style="color:var(--white);">Encadrement personnalisé</strong><span style="color:rgba(255,255,255,0.6);">Des classes à effectifs réduits et un suivi individualisé.</span></div>
                    </div>
                    <div class="reg-why-item">
                        <div class="reg-why-icon"><i class="bi bi-shield-check"></i></div>
                        <div><strong style="color:var(--white);">Environnement sécurisé</strong><span style="color:rgba(255,255,255,0.6);">Un cadre moderne, sûr et stimulant propice à l'apprentissage.</span></div>
                    </div>
                </div>

                <div class="reg-sidebar-card">
                    <div class="reg-sidebar-title" style="color:var(--royal-blue);">Besoin d'aide ?</div>
                    <p style="font-size:0.85rem;color:var(--grey-mid);margin-bottom:14px;">Notre équipe admission est à votre disposition pour vous accompagner.</p>
                    <p style="font-size:0.85rem;margin-bottom:6px;"><i class="bi bi-telephone-fill" style="color:var(--royal-blue);"></i> +237 6XX XXX XXX</p>
                    <p style="font-size:0.85rem;margin-bottom:14px;"><i class="bi bi-envelope" style="color:var(--royal-blue);"></i> admissions@ambassadors-school.com</p>
                    <a href="{{ route('public.contact.index') }}" class="btn btn-outline" style="width:100%;text-align:center;display:block;border-color:var(--royal-blue);color:var(--royal-blue);">Nous contacter</a>
                </div>
            </div>
        </div>

        <div class="reg-trust-band">
            <div class="reg-trust-item"><i class="bi bi-shield-lock-fill"></i> Vos données sont protégées</div>
            <div class="reg-trust-item"><i class="bi bi-patch-check-fill"></i> Inscription 100% en ligne, simple et sécurisée</div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    let currentStep = 1;
    const totalSteps = 4;

    function showStep(step) {
        document.querySelectorAll('.step-panel').forEach(p => p.classList.remove('active'));
        document.querySelector('.step-panel[data-panel="' + step + '"]').classList.add('active');

        document.querySelectorAll('.stepper-item').forEach(item => {
            const itemStep = parseInt(item.dataset.step);
            item.classList.remove('active', 'completed');
            if (itemStep < step) item.classList.add('completed');
            if (itemStep === step) item.classList.add('active');
        });

        currentStep = step;
        window.scrollTo({ top: document.querySelector('.reg-form-card').offsetTop - 100, behavior: 'smooth' });
    }

    function validateStep(step) {
        const panel = document.querySelector('.step-panel[data-panel="' + step + '"]');
        const inputs = panel.querySelectorAll('input[required], select[required]');
        for (const input of inputs) {
            if (!input.value) {
                input.reportValidity();
                return false;
            }
        }
        return true;
    }

    function nextStep(from) {
        if (!validateStep(from)) return;

        if (from === 3) {
            // Remplir le récapitulatif avant l'étape finale
            const form = document.getElementById('regForm');
            document.getElementById('recapName').textContent = form.first_name.value + ' ' + form.last_name.value;
            document.getElementById('recapEmail').textContent = form.email.value;
            document.getElementById('recapClasse').textContent = form.class_souhaitee_id.options[form.class_souhaitee_id.selectedIndex]?.text || '—';
            document.getElementById('recapParent').textContent = form.parent_name.value;
        }

        showStep(from + 1);
    }

    function prevStep(from) {
        showStep(from - 1);
    }
</script>
@endpush
