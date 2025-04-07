<?php

namespace App\Http\Controllers;
use App\Models\Entree;
use App\Models\Produit;


use Illuminate\Http\Request;

class controllerentree
{
    public function showentre_produit()
    {
        $produit = Produit::select('numProd', 'design')
            ->get();
        $entre = Entree::join('produits', 'produits.numProd', '=', 'entrees.numProd')
            ->select('numEntree', 'stockEntree', 'design', 'created_at')
            ->get();
        $productINferieurDix = Produit::where('stock', '<', 10)
            ->select('design')->get();

        return view('entree', compact('produit', 'entre', 'productINferieurDix'));
    }

    public function addEntree(Request $request)
    {
        $produite = Produit::find($request->product);
        $produite->stock += $request->quantity;
        $produite->save();
        $new_entree = new Entree();
        $new_entree->stockEntree = $request->quantity;
        $new_entree->numProd = $request->product;
        $new_entree->save();
        return redirect()->back()->with('success', 'Entry added successfuly');
    }

    public function deleteEntree($numEntree)
    {
        try {
            $entree = Entree::find($numEntree);
            //$produit = Produit::find($entree->numProd);
            //if ($produit->stock >= $entree->stockEntree) {
            //    $produit->stock -= $entree->stockEntree;
            //    $produit->save();
                $entree->delete();
                return redirect()->back()->with('success', 'Entry deleted successfuly');
            //} else {
            //    return redirect()->back()->with('error', 'Modification not permited');
            // }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function loadeditEntree($numEntree)
    {
        $num_produit = Entree::where('numEntree', $numEntree)
            ->select('numProd')->get();
        $num_produit_entree = $num_produit[0]->numProd;
        $produite = Produit::where('numProd', $num_produit_entree)
            ->select('numProd', 'design')->get();
        $entrees = Entree::where('numEntree', $numEntree)
            ->select('stockEntree')->get();

        return view('modifie_entree', compact('entrees', 'produite', 'numEntree'));
    }

    public function editEntree(Request $request)
    {
        $entree = Entree::find($request->numeroEntree);
        $produite = Produit::find($request->product);

        if ($produite->stock - $entree->stockEntree + $request->quantity >= 0) {
            $produite->stock -= $entree->stockEntree;
            $entree->stockEntree = $request->quantity;
            $produite->stock += $entree->stockEntree;
            $produite->save();
            $entree->save();
            return redirect(route('entry'))->with('success', 'Entry modified successfuly');
        } else {
            return redirect(route('entry'))->with('error', 'You can\'t modifie anymore');
        }
    }
}
