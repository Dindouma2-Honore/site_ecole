@extends('admin.layouts.app')

@section('title', $learner->first_name . ' ' . $learner->last_name)

@section('content')

<div class="admin-topbar">
    <div>
        <h1>{{ $learner->first_name }} {{ $learner->last_name }}</h1>
        <p>{{ $learner->matricule }} — {{ $learner->schoolClass->name ?? '—' }}</p>
    </div>
    <a href="{{ route('admin.learners.edit', $learner->id) }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">Modifier</a>
</div>

<div class="admin-panel" style="margin-bottom:20px;max-width:600px;">
    <div class="admin-panel-header"><h3><i class="bi bi-person-circle"></i> Informations</h3></div>
    <div style="padding:20px 24px;">
        <div class="ea-finance-row"><span>Email</span><span>{{ $learner->user->email ?? '—' }}</span></div>
        <div class="ea-finance-row"><span>Date de naissance</span><span>{{ optional($learner->birth_date)->format('d/m/Y') ?? '—' }}</span></div>
        <div class="ea-finance-row"><span>Genre</span><span>{{ $learner->gender == 'M' ? 'Masculin' : ($learner->gender == 'F' ? 'Féminin' : '—') }}</span></div>
        <div class="ea-finance-row"><span>Statut</span><span>{{ ucfirst($learner->status) }}</span></div>
        <div class="ea-finance-row"><span>Année scolaire</span><span>{{ $learner->annee_scolaire }}</span></div>
    </div>
</div>

<div class="admin-panel" style="max-width:600px;">
    <div class="admin-panel-header"><h3><i class="bi bi-people-fill"></i> Parent(s) / tuteur(s)</h3></div>
    <div style="padding:20px 24px;">
        @forelse($learner->parents as $parent)
        <div class="ea-finance-row">
            <span>{{ $parent->name }} ({{ ucfirst($parent->pivot->relationship) }})</span>
            <span>{{ $parent->email }}</span>
        </div>
        @empty
        <p style="color:var(--grey-mid);font-size:0.85rem;">Aucun parent associé.</p>
        @endforelse
    </div>
</div>

@endsection
