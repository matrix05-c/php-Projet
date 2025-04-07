<?php
namespace App\Http\Controllers;
use App\Models\Produit;
use App\Models\Achat;

use Illuminate\Http\Request;

class controllerAchat
{
    public function showAchat_produit()
    {
        $produit = Produit::select('numProd', 'design', 'stock', 'prixProduit')
            ->get();
        $achat = Achat::join('produits', 'produits.numProd', '=', 'achats.numProd')
            ->select('numAchat', 'design', 'nomClient', 'nbrLitre', 'created_at')
            ->get();


        $productINferieurDix = Produit::where('stock', '<', 10)
            ->select('design')->get();

        return view('purchase', compact('produit', 'achat', 'productINferieurDix'));
    }

    public function addAchat(Request $request)
    {
        $request->validate([
            "quantity" => "required|min:1|integer",
            "product" => "required",
            "name" => "required"
        ]);

        $produite = Produit::find($request->product);
        if ($produite->stock >= $request->quantity) {
            $produite->stock -= $request->quantity;
            $produite->save();

            $new_achat = new Achat();
            $new_achat->numProd = $request->product;
            $new_achat->nomClient = $request->name;
            $new_achat->nbrLitre = $request->quantity;
            $new_achat->save();
            return redirect()->back()->with('success', 'Product added successfuly');
        } else {
            return redirect()->back()->with('error', 'Out of stock');
        }
    }

    public function deleteAchat($numAchat)
    {
        try {
            $achat = Achat::find($numAchat);
            // $produit = Produit::find($achat->numProd);
            // $produit->stock += $achat->nbrLitre;
            // $produit->save();
            $achat->delete();
            return redirect()->back()->with('success', 'Purchase deleted successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function loadEditAchat($numAchat)
    {
        $num_produit_modifie = Achat::where('numAchat', $numAchat)
            ->select('numProd')->get();

        $num_produit_modifie_actuel = $num_produit_modifie[0]->numProd;

        $produit = Produit::where('numProd', $num_produit_modifie_actuel)
            ->select('numProd', 'design', 'prixProduit')->get();

        $productINferieurDix = Produit::where('stock', '<', 10)
            ->select('design')->get();


        $achat = Achat::find($numAchat);
        return view('modifie_achat', compact('achat', 'produit', 'productINferieurDix'));
    }

    public function editAchat(Request $request)
    {
        $request->validate([
            "quantit" => "required|min:1|integer",
            "produc" => "required",
            "name" => "required"
        ]);
        $produite = Produit::find($request->produc);
        $ProduitAchete = Achat::where('numAchat', $request->numAchat)
            ->select('nbrLitre')
            ->get();
        $produitAcheteValue = $ProduitAchete[0]['nbrLitre'];

        if (($produite->stock + $produitAcheteValue) >= $request->quantit) {
            $produite->stock = ($produite->stock + $produitAcheteValue) - $request->quantit;
            $produite->save();

            $updtade_achat = Achat::where('numAchat', $request->numAchat)->update([
                'numProd' => $request->produc,
                'nomClient' => $request->name,
                'nbrLitre' => $request->quantit
            ]);

            return redirect(route('purchase'))->with('success', 'Purchase modified successfuly');
        } else {
            return redirect(route('purchase'))->with('error', 'Failed to edit purchase');
        }
    }

    public function search(Request $request)
    {
        if ($request->search == "") {
            $produit = Produit::select('numProd', 'design', 'stock', 'prixProduit')->get();
            $achat = Achat::select('numAchat', 'numProd', 'nomClient', 'nbrLitre', 'created_at')->get();
        } else {
            $produit = Produit::select('numProd', 'design', 'stock', 'prixProduit')->get();
            $achat = Achat::where('nomclient', 'LIKE', '%' . $request->search . '%')
                ->select('numAchat', 'numProd', 'nomClient', 'nbrLitre', 'created_at')
                ->get();
        }
        return view('purchase', compact('produit', 'achat'));
    }


}
