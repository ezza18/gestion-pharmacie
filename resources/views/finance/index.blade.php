<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>État Financier</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f4; }
        h1 { color: #333; }
        .cards { display: flex; gap: 20px; flex-wrap: wrap; margin-top: 20px; }
        .card { background: white; padding: 25px; border-radius: 8px; flex: 1; min-width: 200px; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .card h2 { margin: 0; font-size: 16px; color: #666; }
        .card p { font-size: 28px; font-weight: bold; margin: 10px 0 0 0; }
        .ventes p { color: #28a745; }
        .achats p { color: #dc3545; }
        .benefice p { color: #007bff; }
        .benefice.negative p { color: #dc3545; }
    </style>
</head>
<body>
@include('partials.navbar')

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

</body>
</html>