<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Vente;
use App\Models\Achat;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduits = Produit::count();
        $stockTotal = Produit::sum('quantite');
        $valeurStock = Produit::all()->sum(function($p) {
            return $p->prix_vente * $p->quantite;
        });

        $totalVentes = Vente::sum('total');
        $totalAchats = Achat::sum('total');
        $benefice = $totalVentes - $totalAchats;

        $produitsExpirantListe = Produit::whereNotNull('date_expiration')
            ->whereDate('date_expiration', '<=', Carbon::now()->addDays(30))
            ->get();

        $produitsRuptureListe = Produit::where('quantite', '<=', 10)->get();

        $dernieresVentes = Vente::with('produit')->orderBy('date_vente', 'desc')->take(5)->get();

        return view('dashboard.index', compact(
            'totalProduits', 'stockTotal', 'valeurStock',
            'totalVentes', 'totalAchats', 'benefice',
            'produitsExpirantListe', 'produitsRuptureListe', 'dernieresVentes'
        ));
    }
}