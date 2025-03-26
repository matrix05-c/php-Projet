@php
    $page = '';
    $list = '';
@endphp
@extends('layouts.layout')

@section('title', 'Modifier Achat')

@section('content')

    <body  >
        <main class="container-fluid">
            <h3 class="mt-5 text-warning">Modifier Achat :</h3>
            <form action="{{ route('modifieAchat') }}" method="post" class="container">
                @csrf
                <div class="card card-body">
                    <div class="row my-2">
                        <div class="col-4 col-lg-2">
                            <label class="h4" for="product-type-input" class="form-label">Product</label>
                        </div>
                        <div class="col">
                            <input type="hidden" name="numAchat" value="{{ $achat->numAchat }}">
                            <select name="produc" id="product-type-input" class="form-select" required>
                                @if (isset($produit))
                                    @foreach ($produit as $prod)
                                        <option value="{{ $prod->numProd }}">{{ $prod->design }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col">
                            <input type="number" name="quantit" id="product-purchase-quatity" min="0" class="form-control"
                                placeholder="Quantity" required value="{{ $achat->nbrLitre }}">
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-4 col-lg-2">
                            <label class="h4" for="purchase-customer-name" class="form-label">Customer</label>
                        </div>
                        <div class="col">
                            <input type="text" name="name" id="purchase-customer-name" class="form-control"
                                placeholder="Name" required value="{{ $achat->nomClient }}">
                        </div>
                    </div>

                    <div class="row my-2 justify-content-end">
                        <div class="col-4 col-lg-2">
                            <p class="h3">Data</p>
                        </div>
                        <div class="col">
                            <p class="fs-3"> Stock: <span id="product-stock" class="numeric-value fw-bold">0</span> l</p>
                        </div>
                        <div class="col">
                            <p class="fs-3"> Cost: <span id="product-cost" class="numeric-value fw-bold">0</span> Ar</p>
                        </div>
                        <div class="col-2 d-flex justify-content-end align-items-start">
                            <input type="submit" value="Save" class="btn btn-lg btn-primary">
                        </div>
                    </div>

            </form>
            </div>
        </main>
    </body>

@endsection