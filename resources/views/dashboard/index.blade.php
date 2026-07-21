<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f4f4f4; }
        h1 { color: #333; }
        .breadcrumb { color: #888; font-size: 13px; margin-bottom: 15px; }
        .stats { display: flex; gap: 20px; margin-bottom: 25px; flex-wrap: wrap; }
        .stat-card { background: white; padding: 20px; border-radius: 8px; flex: 1; min-width: 200px; box-shadow: 0 2px 4px rgba(0,0,0,0.08); }
        .stat-card h3 { margin: 0; font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-card p { margin: 8px 0 0 0; font-size: 26px; font-weight: bold; color: #333; }
        .alert-box { padding: 15px; border-radius: 8px; margin-bottom: 15px; }
        .alert-danger { background: #fde2e2; color: #c0392b; }
        .alert-warning { background: #fff3cd; color: #856404; }
        .alert-box strong { display: block; margin-bottom: 6px; }
        .alert-box ul { margin: 0; padding-left: 20px; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.08); margin-top: 10px; }
        th, td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #1a2332; color: white; font-size: 13px; }
        .section-title { margin-top: 30px; margin-bottom: 10px; color: #333; }
    </style>
</head>
<body>
@include('partials.navbar')

    <div class="breadcrumb">Accueil &gt; Tableau de bord</div>
    <h1>Tableau de Bord</h1>

    @if($produitsRuptureListe->count() > 0)
        <div class="alert-box alert-danger">
            <strong>⚠️ Stock faible ({{ $produitsRuptureListe->count() }} produit(s))</strong>
            <ul>
                @foreach($produitsRuptureListe as $p)
                    <li>{{ $p->nom }} — quantité restante : {{ $p->quantite }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($produitsExpirantListe->count() > 0)
        <div class="alert-box alert-warning">
            <strong>⏰ Produits proches de la péremption ({{ $produitsExpirantListe->count() }})</strong>
            <ul>
                @foreach($produitsExpirantListe as $p)
                    <li>{{ $p->nom }} — expire le : {{ $p->date_expiration }}</li>
                @endforeach
            </ul>
        </div>
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

    <div class="stats">
        <div class="stat-card">
            <h3>Total Ventes</h3>
            <p style="color:#28a745;">{{ number_format($totalVentes, 2) }} MRU</p>
        </div>
        <div class="stat-card">
            <h3>Total Achats</h3>
            <p style="color:#dc3545;">{{ number_format($totalAchats, 2) }} MRU</p>
        </div>
        <div class="stat-card">
            <h3>Bénéfice Net</h3>
            <p style="color:{{ $benefice >= 0 ? '#2563eb' : '#dc3545' }};">{{ number_format($benefice, 2) }} MRU</p>
        </div>
    </div>

    <h2 class="section-title">Dernières ventes</h2>
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dernieresVentes as $vente)
            <tr>
                <td>{{ $vente->produit->nom }}</td>
                <td>{{ $vente->quantite_vendue }}</td>
                <td>{{ $vente->total }} MRU</td>
                <td>{{ $vente->date_vente }}</td>
            </tr>
            @empty
            <tr><td colspan="4">Aucune vente enregistrée.</td></tr>
            @endforelse
        </tbody>
    </table>

    </div>
</div>

</body>
</html>