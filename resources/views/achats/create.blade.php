<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvel Achat</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f4f4f4;
        }

        h1 {
            color: #333;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        .btn {
            margin-top: 15px;
            padding: 10px 20px;
            background: #6f42c1;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-back {
            display: inline-block;
            margin-bottom: 15px;
            text-decoration: none;
            color: #333;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        .produit-search-wrapper {
            position: relative;
        }

        .produit-suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #ccc;
            border-top: none;
            max-height: 220px;
            overflow-y: auto;
            display: none;
            z-index: 1000;
        }

        .produit-suggestions div {
            padding: 8px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
        }

        .produit-suggestions div:hover {
            background: #6f42c1;
            color: white;
        }

        .no-result {
            color: #888;
            cursor: default;
        }

        .no-result:hover {
            background: white !important;
            color: #888 !important;
        }
    </style>
</head>

<body>

@include('partials.navbar')

<a href="{{ route('achats.index') }}" class="btn-back">
    &larr; Retour à la liste
</a>

<h1>Nouvel Achat</h1>

<form action="{{ route('achats.store') }}" method="POST">

    @csrf

    <label>Produit</label>

    <div class="produit-search-wrapper">

        <input
            type="text"
            id="produit_search"
            autocomplete="off"
            placeholder="Rechercher un médicament...">

        <input
            type="hidden"
            name="produit_id"
            id="produit_id">

        <div
            class="produit-suggestions"
            id="produit_suggestions">
        </div>

    </div>

    @error('produit_id')
        <div class="error">{{ $message }}</div>
    @enderror


    <label>Fournisseur</label>
    <input
        type="text"
        name="fournisseur"
        value="{{ old('fournisseur') }}">


    <label>Quantité achetée</label>
    <input
        type="number"
        name="quantite_achetee"
        min="1"
        value="{{ old('quantite_achetee') }}">

    @error('quantite_achetee')
        <div class="error">{{ $message }}</div>
    @enderror


    <label>Prix unitaire (achat)</label>
    <input
        type="number"
        step="0.01"
        name="prix_unitaire"
        value="{{ old('prix_unitaire') }}">

    @error('prix_unitaire')
        <div class="error">{{ $message }}</div>
    @enderror


    <label>Date d'achat</label>
    <input
        type="date"
        name="date_achat"
        value="{{ old('date_achat', date('Y-m-d')) }}">

    @error('date_achat')
        <div class="error">{{ $message }}</div>
    @enderror


    <button type="submit" class="btn">
        Enregistrer l'achat
    </button>

</form>


<script>

const produits = [

@foreach($produits as $produit)

{
    id: {{ $produit->id }},
    nom: "{{ $produit->nom }}",
    stock: {{ $produit->quantite }}
},

@endforeach

];

const searchInput = document.getElementById('produit_search');
const hiddenInput = document.getElementById('produit_id');
const suggestions = document.getElementById('produit_suggestions');

searchInput.addEventListener('input', function () {

    const texte = this.value.toLowerCase().trim();

    hiddenInput.value = '';
    suggestions.innerHTML = '';

    if (texte === '') {
        suggestions.style.display = 'none';
        return;
    }

    const resultat = produits.filter(function(p){

        return p.nom.toLowerCase().includes(texte);

    });

    if(resultat.length===0){

        suggestions.innerHTML='<div class="no-result">Aucun médicament trouvé</div>';

    }else{

        resultat.forEach(function(p){

            const div=document.createElement('div');

            div.innerHTML=p.nom+" (Stock actuel : "+p.stock+")";

            div.onclick=function(){

                searchInput.value=p.nom;
                hiddenInput.value=p.id;
                suggestions.style.display='none';

            };

            suggestions.appendChild(div);

        });

    }

    suggestions.style.display='block';

});

document.addEventListener('click',function(e){

    if(!e.target.closest('.produit-search-wrapper')){

        suggestions.style.display='none';

    }

});

</script>

</body>
</html>