@php
    $PK = 'numProd';
    $page = 'list';
    $list = 'products';
    $translate = [
        'numProd' => 'N',
        'design' => 'Name',
        'stock' => 'Stock',
        'prixProduit' => 'Cost'
    ];
    
    $has_bill = false;
@endphp

@extends('layouts.layout')
@section('title', 'Purchase')

@section('content')
    <body>

        <div class="container">
            <div class="my-3 row">
                <button class="btn btn-outline-primary col-4 col-lg-2" data-bs-toggle="modal"
                    data-bs-target="#product-modal">
                    New product
                </button>
                <div class="col"></div>
            </div>

            @if (isset($success))
                <div class="alert alert-success" {{ $success ? "" : "hidden" }}>Product added successfully</div>
                <div class="alert alert-danger" {{ $success ? "hidden" : "" }}>Failed to add product</div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (isset($produits))
                @include('partials.table', ['models' => $produits])
            @else
                @include('partials.table')
            @endif

        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="product-modal" aria-hidden="true">
            <div class="modal-dialog" role="document">

                <div class="modal-content rounded-4 shadow" style="margin-top: 25%">

                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h1 class="fw-bold mb-0 fs-2">Create products</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-5 pt-0">
                        <form action="{{ route('addProduct') }}" method="post">
                            @csrf
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control rounded-3" id="design-input" name="produit_name"
                                    placeholder="Product name">
                                <label for="design-input">Product </label>
                                @error('produit_name')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="number" class="form-control rounded-3" id="cost-input" name="price_value"
                                    placeholder="Product price">
                                <label for="cost-input">Price </label>
                                @error('produit_price')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Save</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </body>
@endsection
