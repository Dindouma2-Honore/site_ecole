@extends('parent.layout')

@section('title', 'Mes enfants')
@section('page-title', 'Mes enfants')

@section('content')

<div class="ea-widgets-row" style="grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));">
    @forelse($children as $child)
    <div class="ea-widget">
        <div class="ea-widget-body" style="text-align:center;padding:26px 20px;">
            <div class="ea-welcome-photo" style="margin:0 auto 14px;background:var(--royal-blue);color:var(--white);">
                {{ strtoupper(substr($child->first_name,0,1) . substr($child->last_name,0,1)) }}
            </div>
            <h3 style="font-family:var(--font-display);color:var(--royal-blue);margin-bottom:4px;">{{ $child->first_name }} {{ $child->last_name }}</h3>
            <p style="color:var(--grey-mid);font-size:0.85rem;margin-bottom:4px;">Matricule : {{ $child->matricule }}</p>
            <p style="color:var(--grey-mid);font-size:0.85rem;margin-bottom:16px;">Classe : {{ $child->schoolClass->name ?? '—' }}</p>
            <a href="{{ route('parent.children.show', $child->id) }}" class="ea-action-btn" style="flex-direction:row;gap:8px;background:var(--royal-blue);color:var(--white);">
                <i class="bi bi-eye"></i> Voir le profil
            </a>
        </div>
    </div>
    @empty
    <div class="admin-empty-row">Aucun enfant associé à votre compte.</div>
    @endforelse
</div>

@endsection
