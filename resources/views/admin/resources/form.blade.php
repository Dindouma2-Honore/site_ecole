@extends('admin.layouts.app')

@section('title', $resource->exists ? 'Modifier la ressource' : 'Ajouter une ressource')

@section('content')
<div class="admin-topbar"><div><h1>{{ $resource->exists ? 'Modifier la ressource' : 'Ajouter une ressource' }}</h1></div></div>

<div class="admin-panel" style="max-width:650px;">
    <div style="padding:28px;">
        <form action="{{ $resource->exists ? route('admin.resources.update', $resource->id) : route('admin.resources.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($resource->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label class="admin-form-label">Matière (classe)</label>
                <select name="course_id" class="admin-form-input" required>
                    <option value="">Choisir...</option>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id', $resource->course_id) == $course->id ? 'selected' : '' }}>{{ $course->name }} ({{ $course->schoolClass->name ?? '' }})</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Titre</label>
                <input type="text" name="title" class="admin-form-input" value="{{ old('title', $resource->title) }}" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Type</label>
                <select name="type" id="typeSelect" class="admin-form-input" onchange="toggleType()">
                    <option value="pdf" {{ old('type', $resource->type) == 'pdf' ? 'selected' : '' }}>PDF</option>
                    <option value="video" {{ old('type', $resource->type) == 'video' ? 'selected' : '' }}>Vidéo</option>
                    <option value="lien" {{ old('type', $resource->type) == 'lien' ? 'selected' : '' }}>Lien externe</option>
                </select>
            </div>

            <div class="admin-form-group" id="fileField">
                <label class="admin-form-label">Fichier</label>
                @if($resource->file_path)
                <p style="font-size:0.8rem;margin-bottom:8px;"><a href="{{ Storage::url($resource->file_path) }}" target="_blank">Fichier actuel</a></p>
                @endif
                <input type="file" name="file_path">
            </div>

            <div class="admin-form-group" id="linkField">
                <label class="admin-form-label">Lien URL</label>
                <input type="url" name="link_url" class="admin-form-input" value="{{ old('link_url', $resource->link_url) }}">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Date de publication</label>
                <input type="date" name="published_at" class="admin-form-input" value="{{ old('published_at', optional($resource->published_at)->format('Y-m-d')) }}" required>
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer</button>
                <a href="{{ route('admin.resources.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleType() {
        const type = document.getElementById('typeSelect').value;
        document.getElementById('linkField').style.display = type === 'lien' ? 'block' : 'none';
        document.getElementById('fileField').style.display = type === 'lien' ? 'none' : 'block';
    }
    toggleType();
</script>
@endsection
