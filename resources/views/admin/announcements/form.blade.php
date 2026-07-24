@extends('admin.layouts.app')

@section('title', 'Publier une annonce')

@section('content')
<div class="admin-topbar"><div><h1>Publier une annonce</h1></div></div>

<div class="admin-panel" style="max-width:650px;">
    <div style="padding:28px;">
        <form action="{{ route('admin.announcements.store') }}" method="POST">
            @csrf

            <div class="admin-form-group">
                <label class="admin-form-label">Audience</label>
                <select name="audience" class="admin-form-input">
                    <option value="tous">Tous (apprenants + parents)</option>
                    <option value="apprenants">Apprenants uniquement</option>
                    <option value="parents">Parents uniquement</option>
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Titre</label>
                <input type="text" name="title" class="admin-form-input" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Message</label>
                <textarea name="body" class="admin-form-input" rows="5" required></textarea>
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Publier</button>
                <a href="{{ route('admin.announcements.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
