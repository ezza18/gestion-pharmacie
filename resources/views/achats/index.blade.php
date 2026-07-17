<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Achats</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f4f4f4; }
        h1 { color: #333; }
        .breadcrumb { color: #888; font-size: 13px; margin-bottom: 15px; }
        .stats { display: flex; gap: 20px; margin-bottom: 25px; flex-wrap: wrap; }
        .stat-card { background: white; padding: 20px; border-radius: 8px; flex: 1; min-width: 180px; box-shadow: 0 2px 4px rgba(0,0,0,0.08); }
        .stat-card h3 { margin: 0; font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-card p { margin: 8px 0 0 0; font-size: 26px; font-weight: bold; color: #333; }
        .toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.08); }
        th, td { padding: 14px 12px; border-bottom: 1px solid #eee; text-align: left; vertical-align: middle; }
        th { background: #1a2332; color: white; font-size: 13px; }
        .produit-cell { display: flex; align-items: center; gap: 10px; }
        .produit-icon { width: 38px; height: 38px; background: #f3eaff; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .produit-nom { font-weight: bold; color: #222; }
        .btn { padding: 6px 10px; text-decoration: none; border-radius: 5px; color: white; margin-right: 5px; font-size: 13px; }
        .btn-add { background: #6f42c1; padding: 10px 20px; }
        .btn-delete { background: #dc3545; border: none; cursor: pointer; font-size: 13px; }
        .alert { padding: 10px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 15px; }
        .quantite-badge { background: #f3eaff; color: #6f42c1; padding: 3px 10px; border-radius: 12px; font-weight: bold; font-size: 13px; }
        .total-badge { color: #dc3545; font-weight: bold; }
    </style>
</head>
<body>
@include('partials.navbar')

    <div class="breadcrumb">Accueil &gt; Achats</div>
    <h1>Historique des Achats</h1>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="stats">
        <div class="stat-card">
            <h3>Nombre d'Achats</h3>
            <p>{{ $totalAchats }}</p>
        </div>
        <div class="stat-card">
            <h3>Quantité Achetée</h3>
            <p>{{ $quantiteTotale }}</p>
        </div>
        <div class="stat-card">
            <h3>Montant Total</h3>
            <p>{{ number_format($montantTotal, 2) }} MRU</p>
        </div>
    </div>

    <div class="toolbar">
        <a href="{{ route('achats.create') }}" class="btn btn-add">+ Nouvel achat</a>
    </div>

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
                <td>
                    <div class="produit-cell">
                        <div class="produit-icon">🛒</div>
                        <div class="produit-nom">{{ $achat->produit->nom }}</div>
                    </div>
                </td>
                <td>{{ $achat->fournisseur }}</td>
                <td><span class="quantite-badge">{{ $achat->quantite_achetee }}</span></td>
                <td>{{ $achat->prix_unitaire }} MRU</td>
                <td class="total-badge">{{ $achat->total }} MRU</td>
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

    </div>
</div>

</body>
</html>