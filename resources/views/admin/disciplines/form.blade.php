@extends('admin.layouts.app')

@section('title', $discipline->exists ? 'Modifier la discipline' : 'Ajouter une discipline')

@section('content')
<div class="admin-topbar">
    <div><h1>{{ $discipline->exists ? 'Modifier la discipline' : 'Ajouter une discipline' }}</h1></div>
</div>

<div class="admin-panel" style="max-width:650px;">
    <div style="padding:28px;">
        <form action="{{ $discipline->exists ? route('admin.disciplines.update', $discipline->id) : route('admin.disciplines.store') }}" method="POST">
            @csrf
            @if($discipline->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label class="admin-form-label">Nom de la discipline</label>
                <input type="text" name="name" class="admin-form-input" value="{{ old('name', $discipline->name) }}" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Icône (emoji)</label>
                <input type="text" name="icon" class="admin-form-input" value="{{ old('icon', $discipline->icon) }}" placeholder="📐" maxlength="10">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Description</label>
                <textarea name="description" class="admin-form-input" rows="3">{{ old('description', $discipline->description) }}</textarea>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Ordre d'affichage</label>
                <input type="number" name="order" class="admin-form-input" value="{{ old('order', $discipline->order ?? 0) }}">
            </div>

            <div class="admin-form-group" style="display:flex;align-items:center;gap:8px;">
                <input type="checkbox" name="active" value="1" id="active" {{ old('active', $discipline->active ?? true) ? 'checked' : '' }}>
                <label for="active" style="margin:0;">Discipline active (visible sur le site)</label>
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer</button>
                <a href="{{ route('admin.disciplines.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
