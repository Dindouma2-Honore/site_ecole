@extends('learner.layout')

@section('title', 'Mon Profil')
@section('page-title', 'Mon Profil')
@section('page-subtitle', $learner->matricule)

@section('content')

@if(session('success'))
<div class="admin-alert" style="margin-bottom:20px;">✅ {{ session('success') }}</div>
@endif

<div class="ea-widget" style="max-width:600px;">
    <div class="ea-widget-header"><h3><i class="bi bi-person-gear"></i> Mes informations</h3></div>
    <div class="ea-widget-body">
        <div class="ea-finance-row"><span>Nom complet</span><span>{{ $learner->first_name }} {{ $learner->last_name }}</span></div>
        <div class="ea-finance-row"><span>Matricule</span><span>{{ $learner->matricule }}</span></div>
        <div class="ea-finance-row"><span>Classe</span><span>{{ $learner->schoolClass->name ?? '—' }}</span></div>
        <div class="ea-finance-row"><span>Année scolaire</span><span>{{ $learner->annee_scolaire }}</span></div>

        <form action="{{ route('learner.profile.update') }}" method="POST" enctype="multipart/form-data" style="margin-top:20px;">
            @csrf
            @method('PUT')

            <div class="admin-form-group">
                <label class="admin-form-label">Email</label>
                <input type="email" name="email" class="admin-form-input" value="{{ old('email', auth()->user()->email) }}" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Photo de profil</label>
                @if($learner->photo)
                <div style="margin-bottom:10px;"><img src="{{ Storage::url($learner->photo) }}" style="width:70px;height:70px;border-radius:50%;object-fit:cover;"></div>
                @endif
                <input type="file" name="photo" accept="image/*">
            </div>

            <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer les modifications</button>
        </form>
    </div>
</div>

@endsection
