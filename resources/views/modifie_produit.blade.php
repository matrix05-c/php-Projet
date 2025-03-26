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
                <h1 class="fw-bold mb-0 fs-2">Modifie products</h1>
            </div>
            {{-- {{ dd($produit[0]->prixProduit) }} --}}
            <div class="modal-body p-5 pt-0">
                <form action="{{ route('modifieProduit') }}" method="post">
                    @csrf
                    <div class="mb-3 form-floating">
                        <input type="hidden" value="{{ $numProd }}" name="numero_produit">
                        <input type="text" class="form-control rounded-3" id="design-input" name="produit_name"
                            placeholder="Product name" value="{{ $produit[0]->design }}">
                        <label for="design-input">Product </label>

                    </div>
                    <div class="mb-3 form-floating">
                        <input type="number" class="form-control rounded-3" id="cost-input" name="price_value"
                            placeholder="Product price" value="{{ $produit[0]->prixProduit }}">
                        <label for="cost-input">Price </label>

                    </div>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Save</button>
                </form>
            </div>

        </div>
    </body>



@endsection