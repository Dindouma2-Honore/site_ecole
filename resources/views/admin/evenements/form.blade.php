@extends('admin.layouts.app')

@section('title', $evenement->exists ? "Modifier l'événement" : 'Ajouter un événement')

@section('content')
<div class="admin-topbar">
    <div><h1>{{ $evenement->exists ? "Modifier l'événement" : 'Ajouter un événement' }}</h1></div>
</div>

<div class="admin-panel" style="max-width:650px;">
    <div style="padding:28px;">
        <form action="{{ $evenement->exists ? route('admin.events.update', $evenement->id) : route('admin.events.store') }}" method="POST">
            @csrf
            @if($evenement->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label class="admin-form-label">Titre</label>
                <input type="text" name="title" class="admin-form-input" value="{{ old('title', $evenement->title) }}" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Icône (emoji, optionnel)</label>
                <input type="text" name="icon" class="admin-form-input" value="{{ old('icon', $evenement->icon) }}" placeholder="🎓" maxlength="10">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Date</label>
                <input type="date" name="event_date" class="admin-form-input" value="{{ old('event_date', optional($evenement->event_date)->format('Y-m-d')) }}" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Heure (optionnel)</label>
                <input type="time" name="event_time" class="admin-form-input" value="{{ old('event_time', $evenement->event_time) }}">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Lieu (optionnel)</label>
                <input type="text" name="location" class="admin-form-input" value="{{ old('location', $evenement->location) }}">
            </div>

            <div class="admin-form-group" style="display:flex;align-items:center;gap:8px;">
                <input type="checkbox" name="active" value="1" id="active" {{ old('active', $evenement->active ?? true) ? 'checked' : '' }}>
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
