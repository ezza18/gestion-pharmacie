<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du Produit</title>
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
    <a href="{{ route('produits.index') }}" class="btn-back">&larr; Retour à la liste</a>

    <div class="card">
        <h1>{{ $produit->nom }}</h1>
        <p><strong>Description :</strong> {{ $produit->description }}</p>
        <p><strong>Prix Achat :</strong> {{ $produit->prix_achat }} MRU</p>
        <p><strong>Prix Vente :</strong> {{ $produit->prix_vente }} MRU</p>
        <p><strong>Quantité :</strong> {{ $produit->quantite }}</p>
        <p><strong>Date d'expiration :</strong> {{ $produit->date_expiration }}</p>
    </div>

</body>
</html>