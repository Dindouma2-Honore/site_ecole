@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<section class="page-header" style="background:linear-gradient(135deg, #061842, #0a2463);padding:80px 0 60px;position:relative;">
    <div class="container" style="position:relative;z-index:2;">
        <div class="section-tag" style="color:var(--gold);">Tableau de bord</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2.5rem,5vw,4rem);font-weight:700;color:var(--white);line-height:1.1;">
            Tableau de <span style="color:var(--gold-light);">Bord</span>
        </h1>
        <p style="color:rgba(255,255,255,0.7);font-size:1.1rem;max-width:600px;margin-top:16px;">
            Accédez aux outils et informations pour gérer votre espace
        </p>
    </div>
</section>

<section style="padding:80px 0;background:var(--off-white);">
    <div class="container">
        @auth
        <!-- Dashboard admin -->
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;margin-bottom:40px;">
            <div style="background:var(--white);padding:24px;border-radius:var(--radius-md);text-align:center;box-shadow:var(--shadow-sm);">
                <div style="font-size:2.5rem;margin-bottom:8px;">📋</div>
                <div style="font-family:var(--font-display);font-size:2rem;font-weight:700;color:var(--royal-blue);">{{ $stats['total_registrations'] ?? 0 }}</div>
                <div style="font-size:0.75rem;color:var(--grey-mid);text-transform:uppercase;letter-spacing:0.08em;">Total inscriptions</div>
            </div>
            <div style="background:var(--white);padding:24px;border-radius:var(--radius-md);text-align:center;box-shadow:var(--shadow-sm);">
                <div style="font-size:2.5rem;margin-bottom:8px;">⏳</div>
                <div style="font-family:var(--font-display);font-size:2rem;font-weight:700;color:#f39c12;">{{ $stats['pending'] ?? 0 }}</div>
                <div style="font-size:0.75rem;color:var(--grey-mid);text-transform:uppercase;letter-spacing:0.08em;">En attente</div>
            </div>
            <div style="background:var(--white);padding:24px;border-radius:var(--radius-md);text-align:center;box-shadow:var(--shadow-sm);">
                <div style="font-size:2.5rem;margin-bottom:8px;">✅</div>
                <div style="font-family:var(--font-display);font-size:2rem;font-weight:700;color:#2ecc71;">{{ $stats['validated'] ?? 0 }}</div>
                <div style="font-size:0.75rem;color:var(--grey-mid);text-transform:uppercase;letter-spacing:0.08em;">Validées</div>
            </div>
            <div style="background:var(--white);padding:24px;border-radius:var(--radius-md);text-align:center;box-shadow:var(--shadow-sm);">
                <div style="font-size:2.5rem;margin-bottom:8px;">❌</div>
                <div style="font-family:var(--font-display);font-size:2rem;font-weight:700;color:#e74c3c;">{{ $stats['rejected'] ?? 0 }}</div>
                <div style="font-size:0.75rem;color:var(--grey-mid);text-transform:uppercase;letter-spacing:0.08em;">Non retenues</div>
            </div>
        </div>

        <div style="background:var(--white);border-radius:var(--radius-lg);padding:32px;box-shadow:var(--shadow-sm);">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
                <h3 style="font-family:var(--font-display);font-size:1.4rem;color:var(--royal-blue);">📊 Dernières inscriptions</h3>
                <a href="{{ route('admin.registrations') }}" class="btn btn-blue" style="padding:8px 20px;font-size:0.75rem;">Voir tout</a>
            </div>
            <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;font-size:0.9rem;">
                    <thead>
                        <tr style="background:var(--off-white);text-align:left;">
                            <th style="padding:12px 16px;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.08em;color:var(--grey-mid);">Élève</th>
                            <th style="padding:12px 16px;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.08em;color:var(--grey-mid);">Niveau</th>
                            <th style="padding:12px 16px;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.08em;color:var(--grey-mid);">Date</th>
                            <th style="padding:12px 16px;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.08em;color:var(--grey-mid);">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent ?? [] as $reg)
                        <tr style="border-bottom:1px solid var(--grey-light);">
                            <td style="padding:12px 16px;font-weight:600;color:var(--text-dark);">{{ $reg->first_name }} {{ $reg->last_name }}</td>
                            <td style="padding:12px 16px;color:var(--grey-dark);">{{ $reg->course->name ?? '-' }}</td>
                            <td style="padding:12px 16px;color:var(--grey-mid);font-size:0.8rem;">{{ $reg->created_at->format('d/m/Y') }}</td>
                            <td style="padding:12px 16px;">
                                @if($reg->status == 'pending')
                                <span style="background:#fef3d7;color:#f39c12;padding:4px 12px;border-radius:20px;font-size:0.7rem;font-weight:700;">En attente</span>
                                @elseif($reg->status == 'validated')
                                <span style="background:#d5f5e3;color:#2ecc71;padding:4px 12px;border-radius:20px;font-size:0.7rem;font-weight:700;">Validée</span>
                                @else
                                <span style="background:#fdedec;color:#e74c3c;padding:4px 12px;border-radius:20px;font-size:0.7rem;font-weight:700;">Rejetée</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="padding:24px;text-align:center;color:var(--grey-mid);">Aucune inscription pour le moment</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <!-- Espace public -->
        <div style="text-align:center;max-width:600px;margin:0 auto;">
            <div style="font-size:5rem;margin-bottom:20px;">🔐</div>
            <h2 style="font-family:var(--font-display);font-size:2rem;color:var(--royal-blue);margin-bottom:12px;">
                Accès restreint
            </h2>
            <p style="color:var(--grey-mid);font-size:1.05rem;line-height:1.7;margin-bottom:30px;">
                Cette section est réservée à l'administration de l'Ambassadors School. 
                Veuillez vous connecter pour accéder au tableau de bord.
            </p>
            <button class="btn btn-primary" onclick="document.getElementById('adminModal').classList.add('open')">
                🔑 Se connecter
            </button>
            <div style="margin-top:20px;background:var(--gold-pale);border-radius:var(--radius-md);padding:16px;border-left:4px solid var(--gold);">
                <p style="font-size:0.85rem;color:var(--text-body);margin:0;">
                    💡 Vous êtes un parent ? Utilisez le formulaire de <a href="{{ route('validation') }}" style="color:var(--royal-blue);font-weight:600;">suivi d'inscription</a> pour suivre votre dossier.
                </p>
            </div>
        </div>
        @endauth
    </div>
</section>
@endsection