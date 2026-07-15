<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvel Achat</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f4; }
        h1 { color: #333; }
        form { background: white; padding: 20px; border-radius: 8px; max-width: 500px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        select, input { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        .btn { margin-top: 15px; padding: 10px 20px; background: #6f42c1; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .btn-back { display: inline-block; margin-bottom: 15px; text-decoration: none; color: #333; }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
@include('partials.navbar')

    <a href="{{ route('achats.index') }}" class="btn-back">&larr; Retour à la liste</a>
    <h1>Nouvel Achat</h1>

    <form action="{{ route('achats.store') }}" method="POST">
        @csrf

        <label>Produit</label>
        <select name="produit_id">
            <option value="">-- Choisir un produit --</option>
            @foreach($produits as $produit)
                <option value="{{ $produit->id }}">{{ $produit->nom }} (Stock actuel: {{ $produit->quantite }})</option>
            @endforeach
        </select>
        @error('produit_id') <div class="error">{{ $message }}</div> @enderror

        <label>Fournisseur</label>
        <input type="text" name="fournisseur" value="{{ old('fournisseur') }}">

        <label>Quantité achetée</label>
        <input type="number" name="quantite_achetee" min="1" value="{{ old('quantite_achetee') }}">
        @error('quantite_achetee') <div class="error">{{ $message }}</div> @enderror

        <label>Prix unitaire (achat)</label>
        <input type="number" step="0.01" name="prix_unitaire" value="{{ old('prix_unitaire') }}">
        @error('prix_unitaire') <div class="error">{{ $message }}</div> @enderror

        <label>Date d'achat</label>
        <input type="date" name="date_achat" value="{{ old('date_achat', date('Y-m-d')) }}">
        @error('date_achat') <div class="error">{{ $message }}</div> @enderror

        <button type="submit" class="btn">Enregistrer l'achat</button>
    </form>

</body>
</html>