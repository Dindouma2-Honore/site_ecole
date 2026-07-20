<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; background:#f4f4f4; padding:30px;">
    <div style="max-width:520px;margin:0 auto;background:#fff;border-radius:10px;overflow:hidden;">
        <div style="background:#0a2463;padding:24px;text-align:center;">
            <h1 style="color:#fff;margin:0;font-size:1.3rem;">Ambassadors International School</h1>
        </div>
        <div style="padding:30px;">
            <p>Bonjour {{ $recipientName }},</p>
            <p>Votre compte {{ $role === 'parent' ? 'Espace Parent' : 'Espace Apprenant' }} a été créé avec succès. Voici vos identifiants de connexion :</p>

            <div style="background:#f4f4f4;border-radius:8px;padding:16px 20px;margin:20px 0;">
                @if($matricule)
                <p style="margin:4px 0;"><strong>Matricule :</strong> {{ $matricule }}</p>
                @endif
                <p style="margin:4px 0;"><strong>Email :</strong> {{ $email }}</p>
                <p style="margin:4px 0;"><strong>Mot de passe temporaire :</strong> {{ $password }}</p>
            </div>

            <p>Nous vous recommandons de changer ce mot de passe dès votre première connexion, depuis la rubrique "Mon compte".</p>
            <p style="margin-top:30px;">Cordialement,<br>L'équipe Ambassadors</p>
        </div>
    </div>
</body>
</html>
