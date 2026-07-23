@extends('admin.layouts.app')

@section('title', $schedule->exists ? 'Modifier le créneau' : 'Ajouter un créneau')

@section('content')
<div class="admin-topbar"><div><h1>{{ $schedule->exists ? 'Modifier le créneau' : 'Ajouter un créneau' }}</h1></div></div>

<div class="admin-panel" style="max-width:650px;">
    <div style="padding:28px;">
        <form action="{{ $schedule->exists ? route('admin.schedules.update', $schedule->id) : route('admin.schedules.store') }}" method="POST">
            @csrf
            @if($schedule->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label class="admin-form-label">Classe</label>
                <select name="class_id" class="admin-form-input" required>
                    <option value="">Choisir...</option>
                    @foreach($classes as $classe)
                    <option value="{{ $classe->id }}" {{ old('class_id', $schedule->class_id) == $classe->id ? 'selected' : '' }}>{{ $classe->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Matière</label>
                <select name="course_id" class="admin-form-input" required>
                    <option value="">Choisir...</option>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id', $schedule->course_id) == $course->id ? 'selected' : '' }}>{{ $course->name }} ({{ $course->schoolClass->name ?? '' }})</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Jour</label>
                <select name="day_of_week" class="admin-form-input" required>
                    @foreach(['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'] as $jour)
                    <option value="{{ $jour }}" {{ old('day_of_week', $schedule->day_of_week) == $jour ? 'selected' : '' }}>{{ $jour }}</option>
                    @endforeach
                </select>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div class="admin-form-group">
                    <label class="admin-form-label">Heure de début</label>
                    <input type="time" name="start_time" class="admin-form-input" value="{{ old('start_time', $schedule->start_time) }}" required>
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">Heure de fin</label>
                    <input type="time" name="end_time" class="admin-form-input" value="{{ old('end_time', $schedule->end_time) }}" required>
                </div>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Salle</label>
                <input type="text" name="room" class="admin-form-input" value="{{ old('room', $schedule->room) }}" placeholder="Ex: Salle 12">
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer</button>
                <a href="{{ route('admin.schedules.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
