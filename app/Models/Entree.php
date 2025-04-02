<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Entree extends Model
{
    use HasFactory;
    protected $primaryKey = 'numEntree';
    protected $filable = [
        'numEntree',
        'stockEntree',
        'numProd',
    ];

    public function produits()
    {
        return $this->belongsTo(Produit::class, 'numProd');
    }
}
