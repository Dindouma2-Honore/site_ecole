<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administration - Ambassadors Educational Complex</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;700&family=Montserrat:wght@300;400;600;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body style="background:linear-gradient(135deg, var(--royal-blue), var(--royal-blue-light));min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;">

    <div class="admin-login-box" style="position:relative;">
        <a href="{{ route('home') }}" style="position:absolute;top:16px;left:16px;color:var(--grey-mid);font-size:0.8rem;text-decoration:none;">&larr; Retour au site</a>

        <div class="admin-login-logo">🔐</div>
        <h2 class="admin-login-title">Administration</h2>
        <p class="admin-login-sub">Connectez-vous pour gérer le site</p>

        @if ($errors->any())
        <div class="admin-login-error show">
            {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST" style="margin-top:20px;">
            @csrf
            <div class="admin-form-group">
                <label class="admin-form-label">Email</label>
                <input type="email" name="email" class="admin-form-input" placeholder="admin@example.com" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label">Mot de passe</label>
                <input type="password" name="password" class="admin-form-input" placeholder="••••••••" required>
            </div>
            <button type="submit" class="admin-login-btn">Se connecter</button>
        </form>
    </div>

</body>
</html>
