<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvelle Vente</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f4; }
        h1 { color: #333; }
        form { background: white; padding: 20px; border-radius: 8px; max-width: 500px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        select, input { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        .btn { margin-top: 15px; padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .btn-back { display: inline-block; margin-bottom: 15px; text-decoration: none; color: #333; }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
@include('partials.navbar')
    <a href="{{ route('ventes.index') }}" class="btn-back">&larr; Retour à la liste</a>
    <h1>Nouvelle Vente</h1>

    <form action="{{ route('ventes.store') }}" method="POST">
        @csrf

        <label>Produit</label>
        <select name="produit_id">
            <option value="">-- Choisir un produit --</option>
            @foreach($produits as $produit)
                <option value="{{ $produit->id }}">{{ $produit->nom }} (Stock: {{ $produit->quantite }})</option>
            @endforeach
        </select>
        @error('produit_id') <div class="error">{{ $message }}</div> @enderror

        <label>Quantité vendue</label>
        <input type="number" name="quantite_vendue" min="1" value="{{ old('quantite_vendue') }}">
        @error('quantite_vendue') <div class="error">{{ $message }}</div> @enderror

        <label>Date de vente</label>
        <input type="date" name="date_vente" value="{{ old('date_vente', date('Y-m-d')) }}">
        @error('date_vente') <div class="error">{{ $message }}</div> @enderror

        <button type="submit" class="btn">Enregistrer la vente</button>
    </form>

       </div>
</div>

</body>
</html>