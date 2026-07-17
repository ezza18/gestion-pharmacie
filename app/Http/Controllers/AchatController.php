<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Produit;
use Illuminate\Http\Request;

class AchatController extends Controller
{
    public function index()
    {
        $achats = Achat::with('produit')->orderBy('date_achat', 'desc')->get();
        $totalAchats = $achats->count();
        $montantTotal = $achats->sum('total');
        $quantiteTotale = $achats->sum('quantite_achetee');

        return view('achats.index', compact('achats', 'totalAchats', 'montantTotal', 'quantiteTotale'));
    }

    public function create()
    {
        $produits = Produit::all();
        return view('achats.create', compact('produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite_achetee' => 'required|integer|min:1',
            'prix_unitaire' => 'required|numeric|min:0',
            'date_achat' => 'required|date',
        ]);

        $produit = Produit::findOrFail($request->produit_id);
        $total = $request->prix_unitaire * $request->quantite_achetee;

        Achat::create([
            'produit_id' => $produit->id,
            'fournisseur' => $request->fournisseur,
            'quantite_achetee' => $request->quantite_achetee,
            'prix_unitaire' => $request->prix_unitaire,
            'total' => $total,
            'date_achat' => $request->date_achat,
        ]);

        $produit->quantite += $request->quantite_achetee;
        $produit->save();

        return redirect()->route('achats.index')->with('success', 'Achat enregistré avec succès.');
    }

    public function show(Achat $achat)
    {
        return view('achats.show', compact('achat'));
    }

    public function destroy(Achat $achat)
    {
        $achat->produit->quantite -= $achat->quantite_achetee;
        $achat->produit->save();
        $achat->delete();

        return redirect()->route('achats.index')->with('success', 'Achat supprimé et stock ajusté.');
    }
}