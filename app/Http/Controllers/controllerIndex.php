<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use DB;
use Illuminate\Http\Request;
use App\Models\Entretien;
use App\Models\Produit;


class controllerIndex
{
    public function showIndex()
    {
        $products = Produit::all();

        $totalReceteEntretien = Entretien::join('services', 'entretiens.numServ', '=', 'services.numServ')
            ->sum('services.prix');

        $totalReceteAchat = Achat::join('produits', 'achats.numProd', '=', 'produits.numProd')
            ->sum(DB::raw('produits.prixProduit * achats.nbrlitre'));

        $recetteTotal = $totalReceteAchat + $totalReceteEntretien;

        $productINferieurDix = Produit::where('stock', '<', 10)
            ->select('design')->get();

        return view('index', compact(
            'products',
            'recetteTotal',
            'productINferieurDix'
        ));
    }
}
