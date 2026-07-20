@extends('admin.layouts.app')

@section('title', 'Tableau de bord')

@section('content')

<div class="admin-topbar">
    <div>
        <h1>Tableau de bord</h1>
        <p>Vue d'ensemble de l'établissement</p>
    </div>
</div>

@if(session('success'))
<div class="admin-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="admin-stats-grid">
    <div class="admin-stat-card">
        <div class="admin-stat-label">Total inscriptions</div>
        <div class="admin-stat-value">{{ $stats['total_registrations'] }}</div>
    </div>
    <div class="admin-stat-card gold">
        <div class="admin-stat-label">En attente / en examen</div>
        <div class="admin-stat-value">{{ $stats['pending'] }}</div>
    </div>
    <div class="admin-stat-card green">
        <div class="admin-stat-label">Validées</div>
        <div class="admin-stat-value">{{ $stats['validated'] }}</div>
    </div>
    <div class="admin-stat-card red">
        <div class="admin-stat-label">Rejetées</div>
        <div class="admin-stat-value">{{ $stats['rejected'] }}</div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-label">Apprenants actifs</div>
        <div class="admin-stat-value">{{ $stats['learners'] }}</div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-label">Classes</div>
        <div class="admin-stat-value">{{ $stats['classes'] }}</div>
    </div>
    <div class="admin-stat-card red">
        <div class="admin-stat-label">Factures impayées</div>
        <div class="admin-stat-value">{{ $stats['unpaid_invoices'] }}</div>
    </div>
</div>

<div class="admin-panel">
    <div class="admin-panel-header">
        <h3>Dernières demandes d'inscription</h3>
        <a href="{{ route('admin.registrations.index') }}" style="color:var(--royal-blue);font-weight:700;font-size:0.85rem;text-decoration:none;">Voir tout <i class="bi bi-arrow-right"></i></a>
    </div>

    @if($recent->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Élève</th>
                <th>Classe souhaitée</th>
                <th>Parent / tuteur</th>
                <th>Statut</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recent as $registration)
            <tr>
                <td>{{ $registration->first_name }} {{ $registration->last_name }}</td>
                <td>{{ $registration->classeSouhaitee->name ?? '—' }}</td>
                <td>{{ $registration->parent_name }}</td>
                <td>
                    <span class="admin-badge-status {{ $registration->status == 'validee' ? 'validated' : ($registration->status == 'rejetee' ? 'rejected' : 'pending') }}">
                        {{ ucfirst(str_replace('_', ' ', $registration->status)) }}
                    </span>
                </td>
                <td>{{ $registration->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="admin-empty-row">Aucune inscription pour le moment.</div>
    @endif
</div>

@endsection
