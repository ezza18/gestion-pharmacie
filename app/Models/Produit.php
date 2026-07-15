<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'prix_achat',
        'prix_vente',
        'quantite',
        'date_expiration',
    ];

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }
}