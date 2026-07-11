@extends('admin.layouts.app')

@section('title', 'Tableau de bord')

@section('content')

<div class="admin-topbar">
    <div>
        <h1>Tableau de bord</h1>
        <p>Vue d'ensemble des inscriptions de l'école</p>
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
        <div class="admin-stat-label">En attente</div>
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
</div>

<div class="admin-panel">
    <div class="admin-panel-header">
        <h3>Dernières inscriptions</h3>
        <a href="{{ route('admin.registrations') }}" style="color:var(--royal-blue);font-weight:700;font-size:0.85rem;text-decoration:none;">Voir tout <i class="bi bi-arrow-right"></i></a>
    </div>

    @if($recent->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Élève</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Statut</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recent as $registration)
            <tr>
                <td>{{ $registration->first_name }} {{ $registration->last_name }}</td>
                <td>{{ $registration->email }}</td>
                <td>{{ $registration->phone }}</td>
                <td>
                    <span class="admin-badge-status {{ $registration->status }}">
                        @if($registration->status == 'pending') En attente
                        @elseif($registration->status == 'validated') Validée
                        @else Rejetée
                        @endif
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
