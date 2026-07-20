@extends('admin.layouts.app')

@section('title', 'Factures')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Factures & Paiements</h1>
        <p>{{ $factures->count() }} facture(s)</p>
    </div>
    <a href="{{ route('admin.factures.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Créer une facture</a>
</div>

@if(session('success'))
<div class="admin-alert">✅ {{ session('success') }}</div>
@endif

<div class="admin-panel">
    @if($factures->count())
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
            @foreach($factures as $facture)
            <tr>
                <td>{{ $facture->reference }}</td>
                <td><strong>{{ $facture->apprenant->first_name ?? '' }} {{ $facture->apprenant->last_name ?? '' }}</strong></td>
                <td>{{ $facture->libelle }}</td>
                <td>{{ number_format($facture->montant_total, 0, ',', ' ') }} FCFA</td>
                <td>{{ number_format($facture->montant_paye, 0, ',', ' ') }} FCFA</td>
                <td>
                    <span class="admin-badge-status {{ $facture->statut == 'payee' ? 'validated' : ($facture->statut == 'partielle' ? 'pending' : 'rejected') }}">
                        {{ ucfirst($facture->statut) }}
                    </span>
                </td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.factures.show', $facture->id) }}" class="admin-row-btn admin-row-btn-green">Détails / Paiement</a>
                        <form action="{{ route('admin.factures.destroy', $facture->id) }}" method="POST" onsubmit="return confirm('Supprimer cette facture ?');">
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
