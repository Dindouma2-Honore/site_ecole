<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Ambassadors International School</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;700&family=Montserrat:wght@300;400;600;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body style="background:linear-gradient(135deg, var(--royal-blue), var(--royal-blue-light));min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;">

    <div class="admin-login-box" style="position:relative;">
        <a href="{{ route('public.home') }}" style="position:absolute;top:16px;left:16px;color:var(--grey-mid);font-size:0.8rem;text-decoration:none;"><i class="bi bi-arrow-left"></i> Retour au site</a>

        <div class="admin-login-logo"><i class="bi bi-shield-lock-fill" style="color:var(--gold);"></i></div>
        <h2 class="admin-login-title">Connexion</h2>
        <p class="admin-login-sub">Apprenant, parent ou administrateur — un seul espace de connexion</p>

        @if ($errors->any())
        <div class="admin-login-error show">
            {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('auth.login.post') }}" method="POST" style="margin-top:20px;">
            @csrf
            <div class="admin-form-group">
                <label class="admin-form-label">Email</label>
                <input type="email" name="email" class="admin-form-input" placeholder="vous@exemple.com" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label">Mot de passe</label>
                <input type="password" name="password" class="admin-form-input" placeholder="••••••••" required>
            </div>
            <button type="submit" class="admin-login-btn"><i class="bi bi-box-arrow-in-right"></i> Se connecter</button>
        </form>
    </div>

</body>
</html>
