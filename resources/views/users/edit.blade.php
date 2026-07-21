<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'Utilisateur</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f4f4f4; }
        h1 { color: #333; }
        form { background: white; padding: 20px; border-radius: 8px; max-width: 500px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        .btn { margin-top: 15px; padding: 10px 20px; background: #2563eb; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .btn-back { display: inline-block; margin-bottom: 15px; text-decoration: none; color: #333; }
        .error { color: red; font-size: 14px; }
        .hint { font-size: 12px; color: #888; }
    </style>
</head>
<body>
@include('partials.navbar')

    <a href="{{ route('users.index') }}" class="btn-back">&larr; Retour à la liste</a>
    <h1>Modifier l'Utilisateur</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nom</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}">
        @error('name') <div class="error">{{ $message }}</div> @enderror

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}">
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label>Mot de passe</label>
        <input type="password" name="password">
        <div class="hint">Laisser vide pour ne pas changer le mot de passe.</div>

        <label>Rôle</label>
        <select name="role">
            <option value="vendeur" {{ $user->role == 'vendeur' ? 'selected' : '' }}>Vendeur</option>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        @error('role') <div class="error">{{ $message }}</div> @enderror

        <button type="submit" class="btn">Mettre à jour</button>
    </form>

    </div>
</div>

</body>
</html>