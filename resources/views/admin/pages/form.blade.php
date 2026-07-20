@extends('admin.layouts.app')

@section('title', 'Modifier : ' . $page->title)

@section('content')
<div class="admin-topbar">
    <div><h1>{{ $page->title }}</h1></div>
</div>

<div class="admin-panel" style="max-width:750px;">
    <div style="padding:28px;">
        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="admin-form-group">
                <label class="admin-form-label">Titre</label>
                <input type="text" name="title" class="admin-form-input" value="{{ old('title', $page->title) }}" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Contenu</label>
                <textarea name="body" class="admin-form-input" rows="10">{{ old('body', $page->body) }}</textarea>
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer</button>
                <a href="{{ route('admin.pages.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
