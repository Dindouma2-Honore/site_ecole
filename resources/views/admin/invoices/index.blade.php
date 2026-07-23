@extends('admin.layouts.app')

@section('title', 'Factures')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Factures & Paiements</h1>
        <p>{{ $invoices->count() }} facture(s)</p>
    </div>
    <a href="{{ route('admin.invoices.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Créer une facture</a>
</div>

@if(session('success'))
<div class="admin-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="admin-panel">
    @if($invoices->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Référence</th>
                <th>Élève</th>
                <th>Libellé</th>
                <th>Montant</th>
                <th>Payé</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->reference }}</td>
                <td><strong>{{ $invoice->learner->first_name ?? '' }} {{ $invoice->learner->last_name ?? '' }}</strong></td>
                <td>{{ $invoice->label }}</td>
                <td>{{ number_format($invoice->amount, 0, ',', ' ') }} FCFA</td>
                <td>{{ number_format($invoice->paid_amount, 0, ',', ' ') }} FCFA</td>
                <td>
                    <span class="admin-badge-status {{ $invoice->status == 'payee' ? 'validated' : ($invoice->status == 'en_retard' ? 'rejected' : 'pending') }}">
                        {{ ucfirst(str_replace('_',' ',$invoice->status)) }}
                    </span>
                </td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="admin-row-btn admin-row-btn-green">Détails / Paiement</a>
                        <form action="{{ route('admin.invoices.destroy', $invoice->id) }}" method="POST" onsubmit="return confirm('Supprimer cette facture ?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="admin-row-btn admin-row-btn-red">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="admin-empty-row">Aucune facture créée.</div>
    @endif
</div>
@endsection
