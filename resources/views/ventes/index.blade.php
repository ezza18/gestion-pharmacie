<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Ventes</title>
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
        .produit-icon { width: 38px; height: 38px; background: #eef7ff; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .produit-nom { font-weight: bold; color: #222; }
        .btn { padding: 6px 10px; text-decoration: none; border-radius: 5px; color: white; margin-right: 5px; font-size: 13px; }
        .btn-add { background: #2563eb; padding: 10px 20px; }
        .btn-delete { background: #dc3545; border: none; cursor: pointer; font-size: 13px; }
        .alert { padding: 10px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 15px; }
        .quantite-badge { background: #e0f2fe; color: #0369a1; padding: 3px 10px; border-radius: 12px; font-weight: bold; font-size: 13px; }
        .total-badge { color: #28a745; font-weight: bold; }
    </style>
</head>
<body>
@include('partials.navbar')

    <div class="breadcrumb">Accueil &gt; Ventes</div>
    <h1>Historique des Ventes</h1>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="stats">
        <div class="stat-card">
            <h3>Nombre de Ventes</h3>
            <p>{{ $totalVentes }}</p>
        </div>
        <div class="stat-card">
            <h3>Quantité Vendue</h3>
            <p>{{ $quantiteTotale }}</p>
        </div>
        <div class="stat-card">
            <h3>Montant Total</h3>
            <p>{{ number_format($montantTotal, 2) }} MRU</p>
        </div>
    </div>

    <div class="toolbar">
        <a href="{{ route('ventes.create') }}" class="btn btn-add">+ Nouvelle vente</a>
    </div>

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
                <td>
                    <div class="produit-cell">
                        <div class="produit-icon">💰</div>
                        <div class="produit-nom">{{ $vente->produit->nom }}</div>
                    </div>
                </td>
                <td><span class="quantite-badge">{{ $vente->quantite_vendue }}</span></td>
                <td>{{ $vente->prix_unitaire }} MRU</td>
                <td class="total-badge">{{ $vente->total }} MRU</td>
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

    </div>
</div>

</body>
</html>