@extends('parent.layout')

@section('title', 'Paiements')
@section('page-title', 'Paiements')
@section('page-subtitle', 'Suivi financier de vos enfants')

@section('content')

@php
    $totalDue = $invoices->sum('amount');
    $totalPaid = $invoices->sum('paid_amount');
@endphp

<div class="ea-stats-grid" style="grid-template-columns:repeat(3,1fr);margin-bottom:24px;">
    <div class="ea-stat-card">
        <div class="ea-stat-icon blue"><i class="bi bi-cash-stack"></i></div>
        <div><div class="ea-stat-value">{{ number_format($totalDue,0,',',' ') }}</div><div class="ea-stat-label">Total facturé (FCFA)</div></div>
    </div>
    <div class="ea-stat-card">
        <div class="ea-stat-icon green"><i class="bi bi-check-circle"></i></div>
        <div><div class="ea-stat-value">{{ number_format($totalPaid,0,',',' ') }}</div><div class="ea-stat-label">Total payé (FCFA)</div></div>
    </div>
    <div class="ea-stat-card">
        <div class="ea-stat-icon purple"><i class="bi bi-hourglass-split"></i></div>
        <div><div class="ea-stat-value">{{ number_format(max(0,$totalDue-$totalPaid),0,',',' ') }}</div><div class="ea-stat-label">Solde restant (FCFA)</div></div>
    </div>
</div>

@forelse($invoices as $invoice)
<div class="ea-widget" style="margin-bottom:18px;">
    <div class="ea-widget-header">
        <h3><i class="bi bi-receipt"></i> {{ $invoice->learner->first_name }} {{ $invoice->learner->last_name }} — {{ $invoice->label }}</h3>
        <span class="admin-badge-status {{ $invoice->status == 'payee' ? 'validated' : ($invoice->status == 'en_retard' ? 'rejected' : 'pending') }}">{{ ucfirst(str_replace('_',' ',$invoice->status)) }}</span>
    </div>
    <div class="ea-widget-body">
        <div class="ea-finance-row"><span>Référence</span><span>{{ $invoice->reference }}</span></div>
        <div class="ea-finance-row"><span>Montant total</span><span>{{ number_format($invoice->amount,0,',',' ') }} FCFA</span></div>
        <div class="ea-finance-row"><span>Payé</span><span>{{ number_format($invoice->paid_amount,0,',',' ') }} FCFA</span></div>
        <div class="ea-finance-row"><span>Échéance</span><span>{{ $invoice->due_date->format('d/m/Y') }}</span></div>

        @if($invoice->payments->count())
        <div style="margin-top:14px;">
            <strong style="font-size:0.8rem;color:var(--royal-blue);">Historique des paiements</strong>
            @foreach($invoice->payments as $payment)
            <div class="ea-finance-row">
                <span>{{ $payment->paid_at->format('d/m/Y') }} · {{ ucfirst(str_replace('_',' ',$payment->method)) }}</span>
                <span>{{ number_format($payment->amount,0,',',' ') }} FCFA</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@empty
<div class="ea-widget"><div class="admin-empty-row">Aucune facture émise pour le moment.</div></div>
@endforelse

@endsection
