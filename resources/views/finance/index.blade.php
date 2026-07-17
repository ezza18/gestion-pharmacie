<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>État Financier</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f4f4f4; }
        h1 { color: #333; }
        .breadcrumb { color: #888; font-size: 13px; margin-bottom: 15px; }
        .cards { display: flex; gap: 20px; flex-wrap: wrap; margin-top: 20px; }
        .card { background: white; padding: 25px; border-radius: 8px; flex: 1; min-width: 220px; box-shadow: 0 2px 6px rgba(0,0,0,0.08); }
        .card h2 { margin: 0; font-size: 13px; color: #888; text-transform: uppercase; letter-spacing: 0.5px; }
        .card p { font-size: 30px; font-weight: bold; margin: 12px 0 0 0; }
        .card small { color: #999; }
        .ventes p { color: #28a745; }
        .achats p { color: #dc3545; }
        .benefice p { color: #2563eb; }
        .benefice.negative p { color: #dc3545; }
    </style>
</head>
<body>
@include('partials.navbar')

    <div class="breadcrumb">Accueil &gt; Finance</div>
    <h1>État Financier</h1>

    <div class="cards">
        <div class="card ventes">
            <h2>💰 Total des Ventes</h2>
            <p>{{ number_format($totalVentes, 2) }} MRU</p>
            <small>{{ $nombreVentes }} vente(s)</small>
        </div>

        <div class="card achats">
            <h2>🛒 Total des Achats</h2>
            <p>{{ number_format($totalAchats, 2) }} MRU</p>
            <small>{{ $nombreAchats }} achat(s)</small>
        </div>

        <div class="card benefice {{ $benefice < 0 ? 'negative' : '' }}">
            <h2>📊 Bénéfice Net</h2>
            <p>{{ number_format($benefice, 2) }} MRU</p>
            <small>{{ $benefice >= 0 ? 'Profit' : 'Perte' }}</small>
        </div>
    </div>

    </div>
</div>

</body>
</html>