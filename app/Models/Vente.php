<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $fillable = [
        'produit_id',
        'quantite_vendue',
        'prix_unitaire',
        'total',
        'date_vente',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}