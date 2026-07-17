<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de l'Achat</title>
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

    <a href="{{ route('achats.index') }}" class="btn-back">&larr; Retour à la liste</a>

    <div class="card">
        <h1>Achat #{{ $achat->id }}</h1>
        <p><strong>Produit :</strong> {{ $achat->produit->nom }}</p>
        <p><strong>Fournisseur :</strong> {{ $achat->fournisseur }}</p>
        <p><strong>Quantité achetée :</strong> {{ $achat->quantite_achetee }}</p>
        <p><strong>Prix unitaire :</strong> {{ $achat->prix_unitaire }} MRU</p>
        <p><strong>Total :</strong> {{ $achat->total }} MRU</p>
        <p><strong>Date :</strong> {{ $achat->date_achat }}</p>
    </div>

       </div>
</div>

</body>
</html>