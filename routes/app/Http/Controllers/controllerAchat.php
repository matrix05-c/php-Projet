<?php

namespace App\Http\Controllers;
use App\Models\Produit;
use App\Models\Achat;

use Illuminate\Http\Request;

class controllerAchat
{
    public function showAchat_produit(){
           $produit = Produit::select('numProd','design', 'prixProduit')->get();
           $achat = Achat::select('numAchat', 'numProd', 'nomClient', 'nbrLitre', 'created_at')
           ->get();

           return view('purchase', compact('produit', 'achat'));
    }

    public function addAchat(Request $request){
              $request->validate([
                  "quantity" => "required|min:1|integer",
                  "product" => "required",
                  "name" => "required"
              ]);
//requte pour le quantite de produit;

      $new_achat = new Achat();
       $new_achat->numProd = $request->product;
       $new_achat->nomClient = $request->name;
       $new_achat->nbrLitre = $request->quantity;
       $new_achat->save();
        //  Achat::create([
        //     'numProd' =>$request->product,
        //     'nomClient' => $request->name,
        //     'nbrLitre' => $request->quantity,
        //  ]);
         return redirect()->back()->with('success', 'Produit ajoute avec succes');
    }
}
