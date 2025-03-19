<?php

namespace App\Http\Controllers;
use App\Models\Entretien;
use App\Models\Service;

use Illuminate\Http\Request;

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

        return view('maintenance', compact('service', 'entretien'));
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
}
