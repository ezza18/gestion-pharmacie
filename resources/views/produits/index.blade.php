<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Produits</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f4; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: #333; color: white; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 4px; color: white; margin-right: 5px; }
        .btn-add { background: #28a745; }
        .btn-edit { background: #ffc107; }
        .btn-delete { background: #dc3545; border: none; cursor: pointer; }
        .alert { padding: 10px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 15px; }
    </style>
</head>
<body>

    <h1>Liste des Produits</h1>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <a href="{{ route('produits.create') }}" class="btn btn-add">+ Ajouter un produit</a>
    <br><br>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix Achat</th>
                <th>Prix Vente</th>
                <th>Quantité</th>
                <th>Date Expiration</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produits as $produit)
            <tr>
                <td>{{ $produit->id }}</td>
                <td>{{ $produit->nom }}</td>
                <td>{{ $produit->prix_achat }} MRU</td>
                <td>{{ $produit->prix_vente }} MRU</td>
                <td>{{ $produit->quantite }}</td>
                <td>{{ $produit->date_expiration }}</td>
                <td>
                    <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-edit">Modifier</a>
                    <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Supprimer ce produit ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">Aucun produit trouvé.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>