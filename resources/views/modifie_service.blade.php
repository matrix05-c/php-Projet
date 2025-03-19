@php
    $PK = 'numProd';
    $page = 'list';
    $list = 'products';
@endphp

@extends('layouts.layout')
@section('title', 'Modifie Produit')
@section('content')

    <body  >
        
        <div class="card w-50 mx-auto" style="margin-top: 8%; border-radius: 5%;">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2">Modifie services</h1>
            </div>
            <div class="modal-body p-5 pt-0">
                <form action="{{ route('modifieService') }}" method="post">
                    @csrf
                    <div class="mb-3 form-floating">
                        <input type="hidden" name="numero_service" value="{{ $services->numServ }}">
                        <input type="text" class="form-control rounded-3" id="design-input" name="sevice_name"
                            placeholder="Service" value="{{ $services->service }}">
                        <label for="design-input">Service </label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="number" class="form-control rounded-3" id="cost-input" name="price_value"
                            placeholder="Service price" value="{{ $services->prix }}">
                        <label for="cost-input">Price </label>
                    </div>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Save</button>
                </form>
            </div>

        </div>
    </body>



@endsection