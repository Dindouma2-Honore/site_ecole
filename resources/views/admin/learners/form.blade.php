@extends('admin.layouts.app')

@section('title', $learner->exists ? "Modifier l'apprenant" : 'Ajouter un apprenant')

@section('content')
<div class="admin-topbar"><div><h1>{{ $learner->exists ? "Modifier l'apprenant" : 'Ajouter un apprenant' }}</h1></div></div>

<div class="admin-panel" style="max-width:650px;">
    <div style="padding:28px;">
        <form action="{{ $learner->exists ? route('admin.learners.update', $learner->id) : route('admin.learners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($learner->exists) @method('PUT') @endif

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div class="admin-form-group">
                    <label class="admin-form-label">Prénom</label>
                    <input type="text" name="first_name" class="admin-form-input" value="{{ old('first_name', $learner->first_name) }}" required>
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">Nom</label>
                    <input type="text" name="last_name" class="admin-form-input" value="{{ old('last_name', $learner->last_name) }}" required>
                </div>
            </div>

            @if(!$learner->exists)
            <div class="admin-form-group">
                <label class="admin-form-label">Email (pour la création du compte)</label>
                <input type="email" name="email" class="admin-form-input" value="{{ old('email') }}" required>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label">Mot de passe (laisser vide pour générer automatiquement)</label>
                <input type="password" name="password" class="admin-form-input">
            </div>
            @endif

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div class="admin-form-group">
                    <label class="admin-form-label">Date de naissance</label>
                    <input type="date" name="birth_date" class="admin-form-input" value="{{ old('birth_date', optional($learner->birth_date)->format('Y-m-d')) }}">
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">Genre</label>
                    <select name="gender" class="admin-form-input">
                        <option value="">—</option>
                        <option value="M" {{ old('gender', $learner->gender) == 'M' ? 'selected' : '' }}>Masculin</option>
                        <option value="F" {{ old('gender', $learner->gender) == 'F' ? 'selected' : '' }}>Féminin</option>
                    </select>
                </div>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Classe</label>
                <select name="class_id" class="admin-form-input" required>
                    <option value="">Choisir...</option>
                    @foreach($classes as $classe)
                    <option value="{{ $classe->id }}" {{ old('class_id', $learner->class_id) == $classe->id ? 'selected' : '' }}>{{ $classe->name }}</option>
                    @endforeach
                </select>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div class="admin-form-group">
                    <label class="admin-form-label">Statut</label>
                    <select name="status" class="admin-form-input">
                        <option value="actif" {{ old('status', $learner->status ?? 'actif') == 'actif' ? 'selected' : '' }}>Actif</option>
                        <option value="inactif" {{ old('status', $learner->status) == 'inactif' ? 'selected' : '' }}>Inactif</option>
                        <option value="diplome" {{ old('status', $learner->status) == 'diplome' ? 'selected' : '' }}>Diplômé</option>
                    </select>
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">Année scolaire</label>
                    <input type="text" name="annee_scolaire" class="admin-form-input" value="{{ old('annee_scolaire', $learner->annee_scolaire) }}" placeholder="2025-2026">
                </div>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Photo</label>
                @if($learner->photo)
                <div style="margin-bottom:10px;"><img src="{{ Storage::url($learner->photo) }}" style="width:70px;height:70px;border-radius:50%;object-fit:cover;"></div>
                @endif
                <input type="file" name="photo" accept="image/*">
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer</button>
                <a href="{{ route('admin.learners.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
