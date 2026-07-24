@extends('admin.layouts.app')

@section('title', $item->exists ? "Modifier l'actualité" : 'Publier une actualité')

@section('content')
<div class="admin-topbar">
    <div><h1>{{ $item->exists ? "Modifier l'actualité" : 'Publier une actualité' }}</h1></div>
</div>

<div class="admin-panel" style="max-width:750px;">
    <div style="padding:28px;">
        <form action="{{ $item->exists ? route('admin.actualites.update', $item->id) : route('admin.actualites.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($item->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label class="admin-form-label">Titre</label>
                <input type="text" name="title" class="admin-form-input" value="{{ old('title', $item->title) }}" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Portée</label>
                <select name="course_id" class="admin-form-input">
                    <option value="">Actualité générale</option>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id', $item->course_id) == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Contenu</label>
                <textarea name="content" class="admin-form-input" rows="6" required>{{ old('content', $item->content) }}</textarea>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Image</label>
                @if($item->image)
                <div style="margin-bottom:10px;"><img src="{{ Storage::url($item->image) }}" style="width:120px;border-radius:8px;"></div>
                @endif
                <input type="file" name="image" accept="image/*">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Date de publication</label>
                <input type="date" name="published_at" class="admin-form-input" value="{{ old('published_at', optional($item->published_at)->format('Y-m-d')) }}" required>
            </div>

            <div class="admin-form-group" style="display:flex;align-items:center;gap:8px;">
                <input type="checkbox" name="active" value="1" id="active" {{ old('active', $item->active ?? true) ? 'checked' : '' }}>
                <label for="active" style="margin:0;">Publiée (visible sur le site)</label>
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer</button>
                <a href="{{ route('admin.actualites.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
