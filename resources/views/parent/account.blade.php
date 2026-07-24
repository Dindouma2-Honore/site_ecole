@extends('parent.layout')

@section('title', 'Mon compte')
@section('page-title', 'Mon compte')
@section('page-subtitle', 'Paramètres et sécurité')

@section('content')

@if(session('success'))
<div class="admin-alert" style="margin-bottom:20px;">✅ {{ session('success') }}</div>
@endif

<div class="ea-widget" style="max-width:550px;">
    <div class="ea-widget-header"><h3><i class="bi bi-shield-lock"></i> Changer mon mot de passe</h3></div>
    <div class="ea-widget-body">
        @if($errors->any())
        <div class="admin-login-error show" style="position:static;margin-bottom:14px;">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('parent.account.security') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="admin-form-group">
                <label class="admin-form-label">Mot de passe actuel</label>
                <input type="password" name="current_password" class="admin-form-input" required>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label">Nouveau mot de passe</label>
                <input type="password" name="password" class="admin-form-input" required>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label">Confirmer le nouveau mot de passe</label>
                <input type="password" name="password_confirmation" class="admin-form-input" required>
            </div>
            <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Mettre à jour</button>
        </form>
    </div>
</div>

@endsection
