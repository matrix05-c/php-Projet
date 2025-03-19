<?php

namespace App\Http\Controllers;
use App\Models\Service;

use ErrorException;
use Illuminate\Http\Request;

class controllerService
{
    public function addService(Request $request)
    {
        // $request->validate([
        //     'service_name' => 'string|required',
        //     'service_price' => 'integer|required|min:0',

        // ]);

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


        return view('list_services', compact('new_services'));

    }


}
