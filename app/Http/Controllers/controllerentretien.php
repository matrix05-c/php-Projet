<?php

namespace App\Http\Controllers;
use App\Models\Entretien;
use App\Models\Service;

use Exception;
use Illuminate\Http\Request;
use App\Models\Produit;
use Barryvdh\DomPDF\Facade\Pdf;

class controllerentretien
{
    public function showEntretienList_nomService()
    {
        $service = Service::select('numServ', 'service', 'prix')
            ->get();

        $entretien = Entretien::select(
            'numEntr',
            'numServ',
            'numVoiture',
            'nomClient',
            'created_at'
        )->get();

        $productINferieurDix = Produit::where('stock', '<', 10)
            ->select('design')->get();


        return view('maintenance', compact('service', 'entretien', 'productINferieurDix'));
    }

    public function saveEntretien(Request $request)
    {

        try {
            $new_entretien = new Entretien();
            $new_entretien->numServ = $request->service;
            $new_entretien->numVoiture = $request->vehNum;
            $new_entretien->nomClient = $request->name;
            $new_entretien->save();

            return redirect('/list/maintenances')
                ->with('success', 'added entretien successfully');
        } catch (\Throwable $th) {
            return redirect('/list/maintenances')
                ->with('error', 'failed to add entretien');
        }
    }

    public function deleteMaintenance($numEntr)
    {

        try {
            Entretien::find($numEntr)->delete();
            return redirect()->back()->with('success', 'delete entretien successfuly');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function loadEditEntretien($numEntr)
    {
        $num_service = Entretien::where('numEntr', $numEntr)
            ->select('numServ')
            ->get();
        $current_num_service = $num_service[0]->numServ;
        $service = Service::where('numServ', $current_num_service)
            ->select('numServ', 'service', 'prix')->get();
        $entretien = Entretien::find($numEntr);

        return view('modifie_entretien', compact('service', 'entretien'));
    }

    public function editEntretien(Request $request)
    {
        $request->validate([
            //'service'=>''
            "name" => "required|string",
            "vehNum" => "required|string|min:5"
        ]);

        try {
            $update_entretien = Entretien::where('numEntr', $request->num_entretien)->update([
                'numVoiture' => $request->vehNum,
                'nomClient' => $request->name
            ]);
            return redirect('list/maintenances')->with('success', 'Entretien modifi with succes');

        } catch (Exception $e) {
            return redirect('list/maintenances')->with('error', $e->getMessage());
        }

    }
    public function search(Request $request)
    {
        if ($request->search == "") {
            $service = Service::select('numServ', 'service', 'prix')
                ->get();

            $entretien = Entretien::select(
                'numEntr',
                'numServ',
                'numVoiture',
                'nomClient',
                'created_at'
            )->get();
        } else {

            $service = Service::select('numServ', 'service', 'prix')
                ->get();

            $entretien = Entretien::where('nomClient', 'LIKE', '%' . $request->search . '%')
                ->select(
                    'numEntr',
                    'numServ',
                    'numVoiture',
                    'nomClient',
                    'created_at'
                )->get();
        }
        return view('maintenance', compact('service', 'entretien'));
    }

    public function filterMaintenancesClientList(Request $request)
    {
        $request->validate([
            "begin" => "date|required",
            "end" => "date|required"
        ]);

        $service = Service::select('numServ', 'service', 'prix')
            ->get();

        $entretien = Entretien::select('numEntr', 'numServ', 'numVoiture', 'nomClient', 'created_at')
            ->whereBetween('created_at', [$request->begin, $request->end])
            ->get();

        $productINferieurDix = Produit::where('stock', '<', 10)
            ->select('design')->get();

        return view('maintenance', compact('service', 'entretien', 'productINferieurDix'));
    }

    public function generateBill($numEntretien)
    {  
    
        $date = Entretien::find($numEntretien)
            ->created_at;
        $nomClient = Entretien::find($numEntretien)->nomClient;
           // dd($nomClient);
        $maintenances = Entretien::with('services')
            ->where('nomClient', $nomClient)
            ->whereDate('created_at', $date)
            ->get();

        $first = $maintenances->first();
        $numVoiture = $first->numVoiture ?? null;
        $total = $maintenances->sum(function($maintenance) {
            return $maintenance->services->prix;
        });

        $data["nomClient"] = $nomClient;
        $data["numVoiture"] = $numVoiture;
        $data["maintenances"] = $maintenances;
        $data["date"] = $date->format('Y-m-d');
        $data["total"] = $total;

        $pdf = Pdf::loadView('bill', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'sans-serif'
            ]);

        return $pdf->download("facture-{$nomClient}-{$date->format('Y-m-d')}.pdf");
    }

}
