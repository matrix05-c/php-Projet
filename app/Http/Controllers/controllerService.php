<?php
namespace App\Http\Controllers;
use App\Models\Service;

use ErrorException;
use Illuminate\Http\Request;
use App\Models\Produit;


class controllerService
{
    public function addService(Request $request)
    {
        if ($request->service_price > 0){
            $new_service = new Service();
            $new_service->service = $request->service_name;
            $new_service->prix = $request->service_price;
            $new_service->save();

            return redirect('/list/services')
                ->with('success', 'add services successfully');
        } else {
            return redirect('/list/services')
                ->with('fail', 'error: ');
        }
    }

    public function showServices()
    {
        $new_services = Service::all();
        $productINferieurDix = Produit::where('stock', '<', 10)
            ->select('design')->get();

        return view('list_services', compact('new_services', 'productINferieurDix'));
    }

    public function deleteService($numServ)  {
        try {
            Service::find($numServ)->delete();
            return redirect()->back()->with('success', 'delete service successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function loadEditService($numServ){
        $services = Service::where('numServ', $numServ)->first();
        return view('modifie_service', compact('services'));
    }

    public function editService(Request $request){
        $update_service = Service::where('numServ', $request->numero_service)->update([
            'service' => $request->sevice_name,
            'prix' => $request->price_value,
        ]);
        return redirect('/list/services')->with('success', 'service update successfully');
    }
}
