<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le Produit</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f4; }
        h1 { color: #333; }
        form { background: white; padding: 20px; border-radius: 8px; max-width: 500px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, textarea { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        .btn { margin-top: 15px; padding: 10px 20px; background: #ffc107; color: #333; border: none; border-radius: 4px; cursor: pointer; }
        .btn-back { display: inline-block; margin-bottom: 15px; text-decoration: none; color: #333; }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
@include('partials.navbar')
    <a href="{{ route('produits.index') }}" class="btn-back">&larr; Retour à la liste</a>
    <h1>Modifier le Produit</h1>

    <form action="{{ route('produits.update', $produit->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nom</label>
        <input type="text" name="nom" value="{{ old('nom', $produit->nom) }}">
        @error('nom') <div class="error">{{ $message }}</div> @enderror

        <label>Description</label>
        <textarea name="description">{{ old('description', $produit->description) }}</textarea>

        <label>Prix Achat</label>
        <input type="number" step="0.01" name="prix_achat" value="{{ old('prix_achat', $produit->prix_achat) }}">
        @error('prix_achat') <div class="error">{{ $message }}</div> @enderror

        <label>Prix Vente</label>
        <input type="number" step="0.01" name="prix_vente" value="{{ old('prix_vente', $produit->prix_vente) }}">
        @error('prix_vente') <div class="error">{{ $message }}</div> @enderror

        <label>Quantité</label>
        <input type="number" name="quantite" value="{{ old('quantite', $produit->quantite) }}">
        @error('quantite') <div class="error">{{ $message }}</div> @enderror

        <label>Date d'expiration</label>
        <input type="date" name="date_expiration" value="{{ old('date_expiration', $produit->date_expiration) }}">

        <button type="submit" class="btn">Mettre à jour</button>
    </form>

</body>
</html>