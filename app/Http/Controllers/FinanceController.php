<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Achat;

class FinanceController extends Controller
{
    public function index()
    {
        $totalVentes = Vente::sum('total');
        $totalAchats = Achat::sum('total');
        $benefice = $totalVentes - $totalAchats;

        $nombreVentes = Vente::count();
        $nombreAchats = Achat::count();

        return view('finance.index', compact('totalVentes', 'totalAchats', 'benefice', 'nombreVentes', 'nombreAchats'));
    }
}