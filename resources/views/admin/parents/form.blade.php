@extends('admin.layouts.app')

@section('title', $parentUser->exists ? 'Modifier le parent' : 'Ajouter un parent')

@section('content')
<div class="admin-topbar"><div><h1>{{ $parentUser->exists ? 'Modifier le parent' : 'Ajouter un parent' }}</h1></div></div>

<div class="admin-panel" style="max-width:650px;">
    <div style="padding:28px;">
        <form action="{{ $parentUser->exists ? route('admin.parents.update', $parentUser->id) : route('admin.parents.store') }}" method="POST">
            @csrf
            @if($parentUser->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label class="admin-form-label">Nom complet</label>
                <input type="text" name="name" class="admin-form-input" value="{{ old('name', $parentUser->name) }}" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Email</label>
                <input type="email" name="email" class="admin-form-input" value="{{ old('email', $parentUser->email) }}" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Téléphone</label>
                <input type="text" name="phone" class="admin-form-input" value="{{ old('phone', $parentUser->phone) }}">
            </div>

            @if(!$parentUser->exists)
            <div class="admin-form-group">
                <label class="admin-form-label">Mot de passe (laisser vide pour générer automatiquement)</label>
                <input type="password" name="password" class="admin-form-input">
            </div>
            @endif

            <div class="admin-form-group">
                <label class="admin-form-label">Enfant(s) associé(s)</label>
                <div style="max-height:220px;overflow-y:auto;border:1px solid var(--grey-light);border-radius:8px;padding:10px 14px;">
                    @foreach($learners as $learner)
                    <label style="display:flex;align-items:center;gap:8px;padding:6px 0;font-size:0.88rem;">
                        <input type="checkbox" name="children[]" value="{{ $learner->id }}" {{ in_array($learner->id, $linkedIds) ? 'checked' : '' }}>
                        {{ $learner->first_name }} {{ $learner->last_name }} ({{ $learner->matricule }})
                    </label>
                    @endforeach
                </div>
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer</button>
                <a href="{{ route('admin.parents.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
