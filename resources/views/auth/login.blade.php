<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Gestion Pharmacie</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #1a2332; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-box { background: white; padding: 40px; border-radius: 10px; width: 350px; box-shadow: 0 4px 20px rgba(0,0,0,0.3); }
        .login-box h1 { text-align: center; color: #1a2332; font-size: 22px; margin-bottom: 5px; }
        .login-box .subtitle { text-align: center; color: #888; font-size: 13px; margin-bottom: 25px; }
        label { display: block; margin-top: 15px; font-weight: bold; font-size: 14px; color: #333; }
        input { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        .btn { width: 100%; margin-top: 20px; padding: 12px; background: #2563eb; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 15px; }
        .error { color: #dc3545; font-size: 13px; margin-top: 5px; }
    </style>
</head>
<body>

    <div class="login-box">
        <h1>🏥 Gestion Pharmacie</h1>
        <p class="subtitle">Connectez-vous pour continuer</p>

        <form action="{{ url('/login') }}" method="POST">
            @csrf

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email') <div class="error">{{ $message }}</div> @enderror

            <label>Mot de passe</label>
            <input type="password" name="password">

            <button type="submit" class="btn">Se connecter</button>
        </form>
    </div>

</body>
</html>