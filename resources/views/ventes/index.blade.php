<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Ventes</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f4; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: #333; color: white; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 4px; color: white; margin-right: 5px; }
        .btn-add { background: #007bff; }
        .btn-delete { background: #dc3545; border: none; cursor: pointer; }
        .btn-back { display: inline-block; margin-bottom: 15px; text-decoration: none; color: #333; }
        .alert { padding: 10px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 15px; }
    </style>
</head>
<body>
@include('partials.navbar')
    <a href="{{ route('produits.index') }}" class="btn-back">&larr; Retour aux produits</a>
    <h1>Historique des Ventes</h1>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <a href="{{ route('ventes.create') }}" class="btn btn-add">+ Nouvelle vente</a>
    <br><br>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Total</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ventes as $vente)
            <tr>
                <td>{{ $vente->id }}</td>
                <td>{{ $vente->produit->nom }}</td>
                <td>{{ $vente->quantite_vendue }}</td>
                <td>{{ $vente->prix_unitaire }} MRU</td>
                <td>{{ $vente->total }} MRU</td>
                <td>{{ $vente->date_vente }}</td>
                <td>
                    <form action="{{ route('ventes.destroy', $vente->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Supprimer cette vente ? Le stock sera restauré.')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">Aucune vente enregistrée.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>