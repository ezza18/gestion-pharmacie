<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Produit;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    public function index()
    {
        $ventes = Vente::with('produit')->orderBy('date_vente', 'desc')->get();
        $totalVentes = $ventes->count();
        $montantTotal = $ventes->sum('total');
        $quantiteTotale = $ventes->sum('quantite_vendue');

        return view('ventes.index', compact('ventes', 'totalVentes', 'montantTotal', 'quantiteTotale'));
    }

    public function create()
    {
        $produits = Produit::all();
        return view('ventes.create', compact('produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite_vendue' => 'required|integer|min:1',
            'date_vente' => 'required|date',
        ]);

        $produit = Produit::findOrFail($request->produit_id);

        if ($request->quantite_vendue > $produit->quantite) {
            return back()->withErrors(['quantite_vendue' => 'Quantité insuffisante en stock. Stock disponible: ' . $produit->quantite]);
        }

        $total = $produit->prix_vente * $request->quantite_vendue;

        Vente::create([
            'produit_id' => $produit->id,
            'quantite_vendue' => $request->quantite_vendue,
            'prix_unitaire' => $produit->prix_vente,
            'total' => $total,
            'date_vente' => $request->date_vente,
        ]);

        $produit->quantite -= $request->quantite_vendue;
        $produit->save();

        return redirect()->route('ventes.index')->with('success', 'Vente enregistrée avec succès.');
    }

    public function show(Vente $vente)
    {
        return view('ventes.show', compact('vente'));
    }

    public function destroy(Vente $vente)
    {
        $vente->produit->quantite += $vente->quantite_vendue;
        $vente->produit->save();
        $vente->delete();

        return redirect()->route('ventes.index')->with('success', 'Vente supprimée et stock restauré.');
    }
}