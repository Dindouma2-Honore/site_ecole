@extends('site.espace-apprenant.layout')

@section('title', 'Mes paiements')
@section('page-title', 'Mes paiements')
@section('page-subtitle', $apprenant->course->name ?? '')

@section('content')

@php
    $totalDu = $factures->sum('montant_total');
    $totalPaye = $factures->sum('montant_paye');
@endphp

<div class="ea-stats-grid" style="grid-template-columns:repeat(3,1fr);margin-bottom:24px;">
    <div class="ea-stat-card">
        <div class="ea-stat-icon blue"><i class="bi bi-cash-stack"></i></div>
        <div><div class="ea-stat-value">{{ number_format($totalDu,0,',',' ') }}</div><div class="ea-stat-label">Total facturé (FCFA)</div></div>
    </div>
    <div class="ea-stat-card">
        <div class="ea-stat-icon green"><i class="bi bi-check-circle"></i></div>
        <div><div class="ea-stat-value">{{ number_format($totalPaye,0,',',' ') }}</div><div class="ea-stat-label">Total payé (FCFA)</div></div>
    </div>
    <div class="ea-stat-card">
        <div class="ea-stat-icon purple"><i class="bi bi-hourglass-split"></i></div>
        <div><div class="ea-stat-value">{{ number_format(max(0,$totalDu-$totalPaye),0,',',' ') }}</div><div class="ea-stat-label">Solde restant (FCFA)</div></div>
    </div>
</div>

@forelse($factures as $facture)
<div class="ea-widget" style="margin-bottom:18px;">
    <div class="ea-widget-header">
        <h3><i class="bi bi-receipt"></i> {{ $facture->libelle }}</h3>
        <span class="admin-badge-status {{ $facture->statut == 'payee' ? 'validated' : ($facture->statut == 'partielle' ? 'pending' : 'rejected') }}">{{ ucfirst($facture->statut) }}</span>
    </div>
    <div class="ea-widget-body">
        <div class="ea-finance-row"><span>Référence</span><span>{{ $facture->reference }}</span></div>
        <div class="ea-finance-row"><span>Montant total</span><span>{{ number_format($facture->montant_total,0,',',' ') }} FCFA</span></div>
        <div class="ea-finance-row"><span>Payé</span><span>{{ number_format($facture->montant_paye,0,',',' ') }} FCFA</span></div>
        <div class="ea-finance-row"><span>Échéance</span><span>{{ $facture->echeance->format('d/m/Y') }}</span></div>

        @if($facture->paiements->count())
        <div style="margin-top:14px;">
            <strong style="font-size:0.8rem;color:var(--royal-blue);">Historique des paiements</strong>
            @foreach($facture->paiements as $paiement)
            <div class="ea-finance-row">
                <span>{{ $paiement->date_paiement->format('d/m/Y') }} · {{ ucfirst(str_replace('_',' ',$paiement->mode_paiement)) }}</span>
                <span>{{ number_format($paiement->montant,0,',',' ') }} FCFA</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@empty
<div class="ea-widget"><div class="admin-empty-row">Aucune facture n'a été émise pour le moment.</div></div>
@endforelse

@endsection
