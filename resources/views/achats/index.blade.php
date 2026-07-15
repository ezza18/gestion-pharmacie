<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Achats</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f4; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: #333; color: white; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 4px; color: white; margin-right: 5px; }
        .btn-add { background: #6f42c1; }
        .btn-delete { background: #dc3545; border: none; cursor: pointer; }
        .btn-back { display: inline-block; margin-bottom: 15px; text-decoration: none; color: #333; }
        .alert { padding: 10px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 15px; }
    </style>
</head>
<body>
@include('partials.navbar')

    <h1>Historique des Achats</h1>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <a href="{{ route('achats.create') }}" class="btn btn-add">+ Nouvel achat</a>
    <br><br>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Produit</th>
                <th>Fournisseur</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Total</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($achats as $achat)
            <tr>
                <td>{{ $achat->id }}</td>
                <td>{{ $achat->produit->nom }}</td>
                <td>{{ $achat->fournisseur }}</td>
                <td>{{ $achat->quantite_achetee }}</td>
                <td>{{ $achat->prix_unitaire }} MRU</td>
                <td>{{ $achat->total }} MRU</td>
                <td>{{ $achat->date_achat }}</td>
                <td>
                    <form action="{{ route('achats.destroy', $achat->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Supprimer cet achat ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">Aucun achat enregistré.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>