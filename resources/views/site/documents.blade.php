@extends('layouts.app')

@section('title', 'Documents à Fournir')

@section('content')
<section class="page-header" style="background:linear-gradient(135deg, #0d1f4a, #0a2463);padding:80px 0 60px;position:relative;">
    <div class="container" style="position:relative;z-index:2;">
        <div class="section-tag" style="color:var(--gold);">Documents</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2.5rem,5vw,4rem);font-weight:700;color:var(--white);line-height:1.1;">
            Documents <span style="color:var(--gold-light);">à Fournir</span>
        </h1>
        <p style="color:rgba(255,255,255,0.7);font-size:1.1rem;max-width:600px;margin-top:16px;">
            La liste complète des documents nécessaires pour l'inscription
        </p>
    </div>
</section>

<section style="padding:80px 0;background:var(--white);">
    <div class="container">
        <div style="max-width:900px;margin:0 auto;">
            <div style="background:var(--gold-pale);border-radius:var(--radius-lg);padding:24px;margin-bottom:40px;display:flex;align-items:center;gap:16px;border-left:4px solid var(--gold);">
                <span style="font-size:2rem;"><i class="bi bi-clipboard-check"></i></span>
                <div>
                    <strong style="color:var(--royal-blue);font-size:1.1rem;">Liste récapitulative</strong>
                    <p style="color:var(--text-body);font-size:0.9rem;margin:0;">Tous les documents doivent être fournis en original et en copie</p>
                </div>
            </div>

            <div style="display:grid;gap:20px;">
                @php
                $documents = [
                    ['name' => 'Acte de naissance', 'desc' => 'Copie légalisée de l\'acte de naissance de l\'élève', 'icon' => '<i class="bi bi-file-earmark-text"></i>', 'required' => true],
                    ['name' => 'Bulletins scolaires', 'desc' => 'Bulletins des deux dernières années (pour les élèves ayant déjà été scolarisés)', 'icon' => '<i class="bi bi-bar-chart-fill"></i>', 'required' => true],
                    ['name' => 'Certificat de vaccination', 'desc' => 'Certificat médical attestant des vaccinations à jour', 'icon' => '<i class="bi bi-shield-plus"></i>', 'required' => true],
                    ['name' => 'Photos d\'identité', 'desc' => '4 photos d\'identité récentes de l\'élève', 'icon' => '<i class="bi bi-camera-fill"></i>', 'required' => true],
                    ['name' => 'Certificat de scolarité', 'desc' => 'Certificat de l\'établissement précédent (pour les transferts)', 'icon' => '<i class="bi bi-building"></i>', 'required' => true],
                    ['name' => 'Pièce d\'identité des parents', 'desc' => 'Copie de la CNI ou du passeport des parents/tuteurs', 'icon' => '<i class="bi bi-person-vcard-fill"></i>', 'required' => true],
                    ['name' => 'Justificatif de domicile', 'desc' => 'Facture d\'électricité ou d\'eau de moins de 3 mois', 'icon' => '<i class="bi bi-house-fill"></i>', 'required' => true],
                    ['name' => 'Certificat médical', 'desc' => 'Certificat médical de non-contre-indication à la pratique sportive', 'icon' => '<i class="bi bi-heart-pulse-fill"></i>', 'required' => false],
                ];
                @endphp

                @foreach($documents as $doc)
                <div style="background:var(--off-white);border-radius:var(--radius-md);padding:20px 24px;display:flex;gap:16px;align-items:center;border:1px solid var(--grey-light);transition:var(--transition);">
                    <span style="font-size:2rem;flex-shrink:0;">{{ $doc['icon'] }}</span>
                    <div style="flex:1;">
                        <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                            <h4 style="color:var(--royal-blue);font-size:1rem;">{{ $doc['name'] }}</h4>
                            @if($doc['required'])
                            <span style="background:var(--gold);color:white;font-size:0.65rem;padding:2px 10px;border-radius:20px;font-weight:700;">OBLIGATOIRE</span>
                            @else
                            <span style="background:var(--grey-mid);color:white;font-size:0.65rem;padding:2px 10px;border-radius:20px;font-weight:700;">FACULTATIF</span>
                            @endif
                        </div>
                        <p style="color:var(--grey-mid);font-size:0.85rem;margin:4px 0 0;">{{ $doc['desc'] }}</p>
                    </div>
                    <span style="color:var(--grey-mid);font-size:1.2rem;">›</span>
                </div>
                @endforeach
            </div>

            <!-- Checklist interactive -->
            <div style="margin-top:40px;background:var(--royal-blue);border-radius:var(--radius-lg);padding:32px;color:white;">
                <h3 style="font-family:var(--font-display);font-size:1.4rem;margin-bottom:20px;"><i class="bi bi-check-circle-fill"></i> Checklist de préparation</h3>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;padding:8px 12px;border-radius:var(--radius-sm);background:rgba(255,255,255,0.05);">
                        <input type="checkbox" style="width:18px;height:18px;accent-color:var(--gold);">
                        <span>Acte de naissance</span>
                    </label>
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;padding:8px 12px;border-radius:var(--radius-sm);background:rgba(255,255,255,0.05);">
                        <input type="checkbox" style="width:18px;height:18px;accent-color:var(--gold);">
                        <span>Bulletins scolaires</span>
                    </label>
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;padding:8px 12px;border-radius:var(--radius-sm);background:rgba(255,255,255,0.05);">
                        <input type="checkbox" style="width:18px;height:18px;accent-color:var(--gold);">
                        <span>Certificat de vaccination</span>
                    </label>
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;padding:8px 12px;border-radius:var(--radius-sm);background:rgba(255,255,255,0.05);">
                        <input type="checkbox" style="width:18px;height:18px;accent-color:var(--gold);">
                        <span>Photos d'identité</span>
                    </label>
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;padding:8px 12px;border-radius:var(--radius-sm);background:rgba(255,255,255,0.05);">
                        <input type="checkbox" style="width:18px;height:18px;accent-color:var(--gold);">
                        <span>Certificat de scolarité</span>
                    </label>
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;padding:8px 12px;border-radius:var(--radius-sm);background:rgba(255,255,255,0.05);">
                        <input type="checkbox" style="width:18px;height:18px;accent-color:var(--gold);">
                        <span>Pièce d'identité des parents</span>
                    </label>
                </div>
                <div style="margin-top:20px;padding-top:20px;border-top:1px solid rgba(255,255,255,0.1);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
                    <span style="opacity:0.7;font-size:0.85rem;"><i class="bi bi-pin-angle-fill"></i> Tous les documents doivent être au format A4</span>
                    <span id="checklistProgress" style="font-weight:700;color:var(--gold-light);">0/6 préparés</span>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.querySelectorAll('.admin-mode [type="checkbox"]')?.forEach(cb => {
        cb.addEventListener('change', function() {
            const total = document.querySelectorAll('.admin-mode [type="checkbox"]').length;
            const checked = document.querySelectorAll('.admin-mode [type="checkbox"]:checked').length;
            document.getElementById('checklistProgress').textContent = `${checked}/${total} préparés`;
        });
    });
</script>
@endpush
@endsection