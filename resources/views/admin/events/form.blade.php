@extends('admin.layouts.app')

@section('title', $event->exists ? "Modifier l'événement" : 'Ajouter un événement')

@section('content')
<div class="admin-topbar"><div><h1>{{ $event->exists ? "Modifier l'événement" : 'Ajouter un événement' }}</h1></div></div>

<div class="admin-panel" style="max-width:650px;">
    <div style="padding:28px;">
        <form action="{{ $event->exists ? route('admin.events.update', $event->id) : route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($event->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label class="admin-form-label">Titre</label>
                <input type="text" name="title" class="admin-form-input" value="{{ old('title', $event->title) }}" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Catégorie</label>
                <input type="text" name="category" class="admin-form-input" value="{{ old('category', $event->category) }}" placeholder="Ex: Événements, Académique, Sport">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Description</label>
                <textarea name="description" class="admin-form-input" rows="3">{{ old('description', $event->description) }}</textarea>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div class="admin-form-group">
                    <label class="admin-form-label">Date de début</label>
                    <input type="datetime-local" name="start_date" class="admin-form-input" value="{{ old('start_date', optional($event->start_date)->format('Y-m-d\TH:i')) }}" required>
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">Date de fin (optionnel)</label>
                    <input type="datetime-local" name="end_date" class="admin-form-input" value="{{ old('end_date', optional($event->end_date)->format('Y-m-d\TH:i')) }}">
                </div>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Lieu</label>
                <input type="text" name="location" class="admin-form-input" value="{{ old('location', $event->location) }}">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Image (optionnel)</label>
                @if($event->image)
                <div style="margin-bottom:10px;"><img src="{{ Storage::url($event->image) }}" style="width:120px;border-radius:8px;"></div>
                @endif
                <input type="file" name="image" accept="image/*">
            </div>

            <div class="admin-form-group" style="display:flex;align-items:center;gap:8px;">
                <input type="checkbox" name="active" value="1" id="active" {{ old('active', $event->active ?? true) ? 'checked' : '' }}>
                <label for="active" style="margin:0;">Visible sur le site</label>
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer</button>
                <a href="{{ route('admin.events.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
