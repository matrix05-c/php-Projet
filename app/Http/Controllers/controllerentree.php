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
        $entre = Entree::select('numEntree', 'stockEntree', 'numProd', 'created_at')
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
        return redirect()->back()->with('success', 'Entree ajoute avec succes');
    }

    public function deleteEntree($numEntree)
    {
        try {
            Entree::find($numEntree)->delete();
            return redirect()->back()->with('success', 'delete entree successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function loadeditEntree($numEntree)
    {
        //$entrees = Entree::find('numEntree', $numEntre)->get();
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
        //$produite = Produit::find($request->produc);

        if ($produite->stock - $entree->stockEntree + $request->quantity >= 0) {
            $produite->stock -= $entree->stockEntree;
            $entree->stockEntree = $request->quantity;
            $produite->stock += $entree->stockEntree;
            $produite->save();
            $entree->save();
            return redirect('/list/Entree')->with('success', 'Entree modifie with successfuly');
        } else {
            return redirect('/list/Entree')->with('error', 'you can\'t modifie anymore');
        }
    }
}
