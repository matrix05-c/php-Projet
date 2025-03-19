<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use DB;
use Illuminate\Http\Request;
use App\Models\Entretien;
use App\Models\Produit;
use Carbon\Carbon;



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
        $recetteTotal = number_format($recetteTotal, 0, ',', ' ');

        //Calcule des recetteis par mois
        $fin = Carbon::now()->endOfMonth();
        $debut = Carbon::now()->subMonths(5)->startOfMonth();

        $recetteAchatParMois = Achat::join('produits', 'achats.numProd', '=', 'produits.numProd')
            ->selectRaw('DATE_FORMAT(achats.created_at, "%Y-%m") as month, SUM(produits.prixProduit * achats.nbrLitre) as recetteProduit')
            ->whereBetween('achats.created_at', [$debut, $fin])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $recetteEntretienParMois = Entretien::join('services', 'entretiens.numServ', '=', 'services.numServ')
            ->selectRaw('DATE_FORMAT(entretiens.created_at, "%Y-%m") as month, SUM(services.prix) as recetteService')
            ->whereBetween('entretiens.created_at', [$debut, $fin])
            ->groupBy('month')
            ->orderBy('month')
            ->limit(5)
            ->get();

        $recetteParMois = [];
        foreach ($recetteAchatParMois as $recette) {
            $recetteParMois[$recette["month"]] = $recette["recetteProduit"];
        }
        foreach ($recetteEntretienParMois as $mois => $recette) {
            $recetteDuMois = $recetteParMois[$recette["month"]] ?? 0;
            $recetteParMois[$recette["month"]] = $recetteDuMois + $recette["recetteService"];
        }

        // Verification des etats de stock
        $productINferieurDix = Produit::where('stock', '<', 11)
            ->select('design')->get();

        $top5Client = DB::table('achats')->select('nomClient', DB::raw('count(*) as totalInteraction'))
            ->groupBy('nomClient')

                ->union(
                    DB::table('entretiens')->select('nomClient', DB::raw('count(*) as totalInteraction'))
            ->groupBy('nomClient')
                       )

                ->groupBy('nomClient')
                ->orderByDesc('totalInteraction')
                ->limit(5)
                ->get();
            $top5Clients = collect($top5Client);
        
            

        // Envoye des données
        return view('index', compact(
            'products',
            'top5Clients',
            'recetteTotal',
            'recetteParMois',
            'productINferieurDix'
        ));


    }
}
