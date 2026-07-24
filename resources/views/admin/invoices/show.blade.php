@extends('admin.layouts.app')

@section('title', 'Détails de la facture')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>{{ $invoice->reference }}</h1>
        <p>{{ $invoice->learner->first_name ?? '' }} {{ $invoice->learner->last_name ?? '' }} — {{ $invoice->label }}</p>
    </div>
</div>

@if(session('success'))
<div class="admin-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="admin-stats-grid">
    <div class="admin-stat-card">
        <div class="admin-stat-label">Montant total</div>
        <div class="admin-stat-value">{{ number_format($invoice->amount, 0, ',', ' ') }}</div>
    </div>
    <div class="admin-stat-card green">
        <div class="admin-stat-label">Payé</div>
        <div class="admin-stat-value">{{ number_format($invoice->paid_amount, 0, ',', ' ') }}</div>
    </div>
    <div class="admin-stat-card red">
        <div class="admin-stat-label">Restant</div>
        <div class="admin-stat-value">{{ number_format($invoice->remaining_amount, 0, ',', ' ') }}</div>
    </div>
</div>

<div class="admin-panel" style="margin-bottom:24px;max-width:500px;">
    <div class="admin-panel-header"><h3>Enregistrer un paiement</h3></div>
    <div style="padding:20px;">
        <form action="{{ route('admin.invoices.payment', $invoice->id) }}" method="POST">
            @csrf
            <div class="admin-form-group">
                <label class="admin-form-label">Montant (FCFA)</label>
                <input type="number" name="amount" class="admin-form-input" required>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label">Date du paiement</label>
                <input type="date" name="paid_at" class="admin-form-input" value="{{ now()->format('Y-m-d') }}" required>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label">Mode de paiement</label>
                <select name="method" class="admin-form-input">
                    <option value="mobile_money">Mobile Money</option>
                    <option value="especes">Espèces</option>
                    <option value="virement">Virement</option>
                </select>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label">Référence de transaction (optionnel)</label>
                <input type="text" name="reference" class="admin-form-input">
            </div>
            <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer le paiement</button>
        </form>
    </div>
</div>

<div class="admin-panel">
    <div class="admin-panel-header"><h3>Historique des paiements</h3></div>
    @if($invoice->payments->count())
    <table class="admin-table">
        <thead><tr><th>Date</th><th>Montant</th><th>Mode</th><th>Référence</th></tr></thead>
        <tbody>
            @foreach($invoice->payments as $payment)
            <tr>
                <td>{{ $payment->paid_at->format('d/m/Y') }}</td>
                <td>{{ number_format($payment->amount, 0, ',', ' ') }} FCFA</td>
                <td>{{ ucfirst(str_replace('_', ' ', $payment->method)) }}</td>
                <td>{{ $payment->reference ?? '—' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="admin-empty-row">Aucun paiement enregistré.</div>
    @endif
</div>
@endsection
