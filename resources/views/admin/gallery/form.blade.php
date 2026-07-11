@extends('admin.layouts.app')

@section('title', $item->exists ? "Modifier l'élément" : 'Ajouter à la galerie')

@section('content')
<div class="admin-topbar">
    <div><h1>{{ $item->exists ? "Modifier l'élément" : 'Ajouter à la galerie' }}</h1></div>
</div>

@if($errors->any())
<div class="admin-alert" style="background:#fdecea;border-color:#e74c3c;color:#c0392b;"><i class="bi bi-exclamation-triangle"></i> {{ $errors->first() }}</div>
@endif

<div class="admin-panel" style="max-width:700px;">
    <div style="padding:28px;">
        <form action="{{ $item->exists ? route('admin.gallery.update', $item->id) : route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($item->exists) @method('PUT') @endif

            <div class="admin-form-group">
                <label class="admin-form-label">Titre</label>
                <input type="text" name="title" class="admin-form-input" value="{{ old('title', $item->title) }}" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Type</label>
                <select name="type" id="typeSelect" class="admin-form-input" onchange="toggleTypeFields()">
                    <option value="photo" {{ old('type', $item->type) == 'photo' ? 'selected' : '' }}>Photo</option>
                    <option value="video" {{ old('type', $item->type) == 'video' ? 'selected' : '' }}>Vidéo</option>
                </select>
            </div>

            <div class="admin-form-group" id="photoField">
                <label class="admin-form-label">Image</label>
                @if($item->image)
                <div style="margin-bottom:10px;"><img src="{{ Storage::url($item->image) }}" style="width:120px;border-radius:8px;"></div>
                @endif
                <input type="file" name="image" accept="image/*">
            </div>

            <div id="videoField">
                <div class="admin-form-group">
                    <label class="admin-form-label">Uploader une vidéo (depuis l'ordinateur ou le téléphone)</label>
                    @if($item->video_file)
                    <div style="margin-bottom:10px;">
                        <video src="{{ Storage::url($item->video_file) }}" controls style="width:100%;max-width:320px;border-radius:8px;"></video>
                    </div>
                    @endif
                    <input type="file" name="video_file" accept="video/mp4,video/quicktime,video/x-msvideo,video/webm,video/x-matroska">
                    <p style="font-size:0.75rem;color:var(--grey-mid);margin-top:6px;">Formats acceptés : MP4, MOV, AVI, WEBM, MKV — 50 Mo maximum.</p>
                </div>

                <div style="text-align:center;color:var(--grey-mid);font-size:0.8rem;font-weight:700;margin:14px 0;">— OU —</div>

                <div class="admin-form-group">
                    <label class="admin-form-label">Lien YouTube (alternative à l'upload)</label>
                    <input type="url" name="video_url" class="admin-form-input" value="{{ old('video_url', $item->video_url) }}" placeholder="https://www.youtube.com/watch?v=...">
                </div>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Catégorie (optionnel)</label>
                <input type="text" name="category" class="admin-form-input" value="{{ old('category', $item->category) }}" placeholder="Ex: Événements, Sport, Classes">
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Ordre d'affichage</label>
                <input type="number" name="order" class="admin-form-input" value="{{ old('order', $item->order ?? 0) }}">
            </div>

            <div class="admin-form-group" style="display:flex;align-items:center;gap:8px;">
                <input type="checkbox" name="active" value="1" id="active" {{ old('active', $item->active ?? true) ? 'checked' : '' }}>
                <label for="active" style="margin:0;">Visible sur le site</label>
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer</button>
                <a href="{{ route('admin.gallery.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleTypeFields() {
        var type = document.getElementById('typeSelect').value;
        document.getElementById('photoField').style.display = type === 'photo' ? 'block' : 'none';
        document.getElementById('videoField').style.display = type === 'video' ? 'block' : 'none';
    }
    toggleTypeFields();
</script>
@endsection
