@extends('site.espace-apprenant.layout')

@section('title', 'Mon Profil')
@section('page-title', 'Mon Profil')
@section('page-subtitle', $apprenant->matricule)

@section('content')

@if(session('success'))
<div class="admin-alert" style="margin-bottom:20px;">✅ {{ session('success') }}</div>
@endif

<div class="ea-widget" style="max-width:600px;">
    <div class="ea-widget-header"><h3><i class="bi bi-person-gear"></i> Mes informations</h3></div>
    <div class="ea-widget-body">
        <div class="ea-finance-row"><span>Nom complet</span><span>{{ $apprenant->first_name }} {{ $apprenant->last_name }}</span></div>
        <div class="ea-finance-row"><span>Matricule</span><span>{{ $apprenant->matricule }}</span></div>
        <div class="ea-finance-row"><span>Classe</span><span>{{ $apprenant->course->name ?? '—' }}</span></div>
        <div class="ea-finance-row"><span>Année scolaire</span><span>{{ $apprenant->annee_scolaire }}</span></div>

        <form action="{{ route('espace-apprenant.profil.update') }}" method="POST" enctype="multipart/form-data" style="margin-top:20px;">
            @csrf
            @method('PUT')

            <div class="admin-form-group">
                <label class="admin-form-label">Email</label>
                <input type="email" name="email" class="admin-form-input" value="{{ old('email', $apprenant->email) }}" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Photo de profil</label>
                @if($apprenant->photo)
                <div style="margin-bottom:10px;"><img src="{{ Storage::url($apprenant->photo) }}" style="width:70px;height:70px;border-radius:50%;object-fit:cover;"></div>
                @endif
                <input type="file" name="photo" accept="image/*">
            </div>

            <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer les modifications</button>
        </form>
    </div>
</div>

@endsection
