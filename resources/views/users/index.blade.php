<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Utilisateurs</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f4f4f4; }
        h1 { color: #333; }
        .breadcrumb { color: #888; font-size: 13px; margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.08); }
        th, td { padding: 14px 12px; border-bottom: 1px solid #eee; text-align: left; vertical-align: middle; }
        th { background: #1a2332; color: white; font-size: 13px; }
        .btn { padding: 6px 10px; text-decoration: none; border-radius: 5px; color: white; margin-right: 5px; font-size: 13px; }
        .btn-add { background: #6f42c1; padding: 10px 20px; }
        .btn-edit { background: #2563eb; }
        .btn-delete { background: #dc3545; border: none; cursor: pointer; font-size: 13px; }
        .alert { padding: 10px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 15px; }
        .role-badge { padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: bold; }
        .role-admin { background: #fde2e2; color: #c0392b; }
        .role-vendeur { background: #e0f2fe; color: #0369a1; }
    </style>
</head>
<body>
@include('partials.navbar')

    <div class="breadcrumb">Accueil &gt; Utilisateurs</div>
    <h1>Gestion des Utilisateurs</h1>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <a href="{{ route('users.create') }}" class="btn btn-add">+ Ajouter un utilisateur</a>
    <br><br>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="role-badge role-{{ $user->role }}">{{ $user->role }}</span>
                </td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-edit">Modifier</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Aucun utilisateur trouvé.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    </div>
</div>

</body>
</html>