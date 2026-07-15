<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la Vente</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f4; }
        .card { background: white; padding: 20px; border-radius: 8px; max-width: 500px; }
        .btn-back { display: inline-block; margin-bottom: 15px; text-decoration: none; color: #333; }
        p { font-size: 16px; }
        strong { color: #555; }
    </style>
</head>
<body>
@include('partials.navbar')
    <a href="{{ route('ventes.index') }}" class="btn-back">&larr; Retour à la liste</a>

    <div class="card">
        <h1>Vente #{{ $vente->id }}</h1>
        <p><strong>Produit :</strong> {{ $vente->produit->nom }}</p>
        <p><strong>Quantité vendue :</strong> {{ $vente->quantite_vendue }}</p>
        <p><strong>Prix unitaire :</strong> {{ $vente->prix_unitaire }} MRU</p>
        <p><strong>Total :</strong> {{ $vente->total }} MRU</p>
        <p><strong>Date :</strong> {{ $vente->date_vente }}</p>
    </div>

</body>
</html>