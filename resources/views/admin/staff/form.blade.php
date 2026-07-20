@extends('admin.layouts.app')

@section('title', $membre->exists ? 'Modifier le membre' : 'Ajouter un membre')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>{{ $membre->exists ? 'Modifier le membre' : 'Ajouter un membre' }}</h1>
    </div>
</div>

<div class="admin-panel" style="max-width:700px;">
    <div style="padding:28px;">
        <form action="{{ $membre->exists ? route('admin.equipe.update', $membre->id) : route('admin.equipe.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($membre->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label class="admin-form-label">Nom complet</label>
                <input type="text" name="name" class="admin-form-input" value="{{ old('name', $membre->name) }}" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Rôle / Fonction</label>
                <input type="text" name="role" class="admin-form-input" value="{{ old('role', $membre->role) }}" placeholder="Ex: Directeur, Enseignant de Mathématiques" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Email</label>
                <input type="email" name="email" class="admin-form-input" value="{{ old('email', $membre->email) }}">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Téléphone</label>
                <input type="text" name="phone" class="admin-form-input" value="{{ old('phone', $membre->phone) }}">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Biographie courte</label>
                <textarea name="bio" class="admin-form-input" rows="4">{{ old('bio', $membre->bio) }}</textarea>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Photo</label>
                @if($membre->photo)
                <div style="margin-bottom:10px;"><img src="{{ Storage::url($membre->photo) }}" style="width:80px;height:80px;border-radius:50%;object-fit:cover;"></div>
                @endif
                <input type="file" name="photo" accept="image/*">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Ordre d'affichage</label>
                <input type="number" name="order" class="admin-form-input" value="{{ old('order', $membre->order ?? 0) }}">
            </div>

            <div class="admin-form-group" style="display:flex;align-items:center;gap:8px;">
                <input type="checkbox" name="active" value="1" id="active" {{ old('active', $membre->active ?? true) ? 'checked' : '' }}>
                <label for="active" style="margin:0;">Membre actif (visible sur le site)</label>
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer</button>
                <a href="{{ route('admin.equipe.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
