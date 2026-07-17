<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Produits</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f4f4f4; }
        h1 { color: #333; }
        .breadcrumb { color: #888; font-size: 13px; margin-bottom: 15px; }
        .stats { display: flex; gap: 20px; margin-bottom: 25px; flex-wrap: wrap; }
        .stat-card { background: white; padding: 20px; border-radius: 8px; flex: 1; min-width: 180px; box-shadow: 0 2px 4px rgba(0,0,0,0.08); }
        .stat-card h3 { margin: 0; font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-card p { margin: 8px 0 0 0; font-size: 26px; font-weight: bold; color: #333; }
        .toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
        .search-box { padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; width: 250px; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.08); }
        th, td { padding: 14px 12px; border-bottom: 1px solid #eee; text-align: left; vertical-align: middle; }
        th { background: #1a2332; color: white; font-size: 13px; }
        .produit-cell { display: flex; align-items: center; gap: 10px; }
        .produit-icon { width: 38px; height: 38px; background: #eef2ff; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .produit-nom { font-weight: bold; color: #222; }
        .produit-cat { font-size: 12px; color: #999; }
        .badge { padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: bold; }
        .badge-valide { background: #d4edda; color: #155724; }
        .badge-expire { background: #f8d7da; color: #721c24; }
        .btn { padding: 6px 10px; text-decoration: none; border-radius: 5px; color: white; margin-right: 5px; font-size: 13px; }
        .btn-add { background: #28a745; padding: 10px 20px; }
        .btn-edit { background: #2563eb; }
        .btn-delete { background: #dc3545; border: none; cursor: pointer; font-size: 13px; }
        .alert { padding: 10px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 15px; }
        .quantite-badge { background: #fff3cd; color: #856404; padding: 3px 10px; border-radius: 12px; font-weight: bold; font-size: 13px; }
    </style>
</head>
<body>
@include('partials.navbar')

    <div class="breadcrumb">Accueil &gt; Produits</div>
    <h1>Liste des Produits</h1>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="stats">
        <div class="stat-card">
            <h3>Total Produits</h3>
            <p>{{ $totalProduits }}</p>
        </div>
        <div class="stat-card">
            <h3>Stock Total</h3>
            <p>{{ $stockTotal }}</p>
        </div>
        <div class="stat-card">
            <h3>Valeur du Stock</h3>
            <p>{{ number_format($valeurStock, 2) }} MRU</p>
        </div>
    </div>

    <div class="toolbar">
        <a href="{{ route('produits.create') }}" class="btn btn-add">+ Ajouter un produit</a>
        <input type="text" class="search-box" placeholder="Rechercher un produit...">
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Produit</th>
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
                <td>
                    <div class="produit-cell">
                        <div class="produit-icon">💊</div>
                        <div>
                            <div class="produit-nom">{{ $produit->nom }}</div>
                            <div class="produit-cat">{{ $produit->description ?? 'Médicament' }}</div>
                        </div>
                    </div>
                </td>
                <td>{{ $produit->prix_achat }} MRU</td>
                <td>{{ $produit->prix_vente }} MRU</td>
                <td><span class="quantite-badge">{{ $produit->quantite }}</span></td>
                <td>
                    {{ $produit->date_expiration }}<br>
                    @if($produit->date_expiration && \Carbon\Carbon::parse($produit->date_expiration)->isPast())
                        <span class="badge badge-expire">Expiré</span>
                    @else
                        <span class="badge badge-valide">Valide</span>
                    @endif
                </td>
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

    </div>
</div>

</body>
</html>