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
        .produit-search-wrapper { position: relative; }
        .produit-suggestions {
            position: absolute; top: 100%; left: 0; right: 0;
            background: white; border: 1px solid #ccc; border-top: none;
            max-height: 220px; overflow-y: auto; z-index: 10;
            border-radius: 0 0 4px 4px; display: none;
        }
        .produit-suggestions div {
            padding: 8px; cursor: pointer; border-bottom: 1px solid #eee;
        }
        .produit-suggestions div:hover, .produit-suggestions div.active {
            background: #007bff; color: white;
        }
        .produit-suggestions .no-result { color: #999; cursor: default; }
        .produit-suggestions .no-result:hover { background: white; color: #999; }
    </style>
</head>
<body>
@include('partials.navbar')
    <a href="{{ route('ventes.index') }}" class="btn-back">&larr; Retour à la liste</a>
    <h1>Nouvelle Vente</h1>

    <form action="{{ route('ventes.store') }}" method="POST">
        @csrf

        <label>Produit</label>
        <div class="produit-search-wrapper">
            <input type="text" id="produit_search" autocomplete="off" placeholder="Tapez le nom du médicament...">
            <input type="hidden" name="produit_id" id="produit_id">
            <div class="produit-suggestions" id="produit_suggestions"></div>
        </div>
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

<script>
    const produits = [
        @foreach($produits as $produit)
        { id: {{ $produit->id }}, nom: "{{ $produit->nom }}", stock: {{ $produit->quantite }} },
        @endforeach
    ];

    const searchInput = document.getElementById('produit_search');
    const hiddenInput = document.getElementById('produit_id');
    const suggestionsBox = document.getElementById('produit_suggestions');

    searchInput.addEventListener('input', function () {
        const val = this.value.trim().toLowerCase();
        hiddenInput.value = '';
        suggestionsBox.innerHTML = '';

        if (val.length === 0) {
            suggestionsBox.style.display = 'none';
            return;
        }

        const matches = produits.filter(p => p.nom.toLowerCase().includes(val));

        if (matches.length === 0) {
            suggestionsBox.innerHTML = '<div class="no-result">Aucun médicament trouvé</div>';
        } else {
            matches.forEach(p => {
                const div = document.createElement('div');
                div.textContent = p.nom + " (Stock: " + p.stock + ")";
                div.addEventListener('click', function () {
                    searchInput.value = p.nom;
                    hiddenInput.value = p.id;
                    suggestionsBox.style.display = 'none';
                });
                suggestionsBox.appendChild(div);
            });
        }
        suggestionsBox.style.display = 'block';
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.produit-search-wrapper')) {
            suggestionsBox.style.display = 'none';
        }
    });
</script>

</body>
</html>