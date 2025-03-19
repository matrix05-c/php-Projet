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


    public function showProduit()
    {
        $produits = Produit::all();

        $productINferieurDix = Produit::where('stock', '<', 10)
            ->select('design')->get();

        return view('list_products', compact('produits', 'productINferieurDix'));
    }

    public function deleteProduit($numProd)
    {
        try {
            Produit::find($numProd)->delete();
            return redirect()->back()->with('success', 'delete entretien successfuly');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function loadEditProduit($numProd)
    {

        $produit = Produit::where('numProd', $numProd)->select('design', 'prixProduit')
            ->get();
        return view('modifie_produit', compact('produit', 'numProd'));

    }

    public function editProduit(Request $request)
    {
        $modifie_produi = Produit::where('numProd', $request->numero_produit)->update([
            'design' => $request->produit_name,
            'prixProduit' => $request->price_value,
        ]);
        return redirect('/list/products')->with('success', 'Produit modifie with success');
    }
}
