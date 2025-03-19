<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Produit;

class controllerProduct
{
    public function addproduit(Request $request)
    {
        $request->validate([
            "produit_name" => "required|string",
            "price_value" => "required|integer|min:0",
        ]);

        try {
            $new_product = new Produit();
            $new_product->design = $request->produit_name;
            $new_product->prixProduit = $request->price_value;
            $new_product->save();
            return redirect('/list/products')
                ->with('success', true);
        } catch (Exception $e) {
            return redirect('/list/products')
                ->with('success', false);
        }



    }
    public function showProduit(){
        $produits = Produit::all();

        return view('list_products', compact('produits'));
    }
}
