@php
    $PK = 'numAchat';
    $page = 'purchase';
    $list = '';
    $translate = [
        'numAchat' => 'N',
        'design' => 'Product',
        'nomClient' => 'Name',
        'nbrLitre' => 'Quantity',
        'created_at' => 'Date',
    ];

    $has_bill = false;
@endphp

@extends('layouts.layout')

@section('title', 'Purchase')

@section('content')
    <body>
        <main class="container-fluid">
            <div class="my-3 row">
                <h3 class="col-4 col-lg-2 text-warning">Purchase :</h3>
                <dic class="col"></dic>
                <form action="{{ route('searchPurchases') }}" method="post" class="d-flex btn-group col-6 col-lg-4">
                    @csrf
                    <input type="search" name="search" class="form-control" placeholder="Name">
                    <input type="submit" value="Search" class="btn btn-secondary">
                </form>
            </div>

            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('addPurchase') }}" method="post" class="container" style="margin-top: 40px">
                @csrf
                <div class="row my-2">
                    <div class="col-4 col-lg-2">
                        <label class="h4 text-white" for="product-type-input" class="form-label">Product</label>

                    </div>

                    <div class="col">
                        <select name="product" id="product-type-input" class="form-select" required>
                            @if (isset($produit))
                                @foreach ($produit as $prod)
                                    <option value="{{ $prod->numProd }}">{{ $prod->design }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col">
                        <input type="number" name="quantity" id="product-purchase-quatity" min="0" class="form-control"
                            placeholder="Quantity" required>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-4 col-lg-2">
                        <label class="h4 text-white" for="purchase-customer-name" class="form-label">Customer</label>
                    </div>
                    <div class="col">
                        <input type="text" name="name" id="purchase-customer-name" class="form-control" placeholder="Name"
                            required>
                    </div>
                </div>

                <div class="row my-2 justify-content-end">
                    <div class="col-4 col-lg-2">
                        <p class="h3 text-white">Data</p>
                    </div>
                    <div class="col">
                        <p class="fs-3 text-white"> Stock: <span id="product-stock" class="numeric-value fw-bold">0</span> l</p>
                    </div>
                    <div class="col">
                        <p class="fs-3 text-white"> Total: <span id="product-cost" class="numeric-value fw-bold">0</span> Ar</p>
                    </div>
                    <div class="col-2 d-flex justify-content-end align-items-start">
                        <input type="submit" value="Save" class="btn btn-lg btn-primary">
                    </div>
                </div>

            </form>

            <h3 class="mt-5 text-warning">List :</h3>

            <div class="container">
                @if (isset($achat))
                
                    @foreach ($achat as $achate)


                    @endforeach
                    @include('partials.table', ['models' => $achat])
                @else
                    @include('partials.table')
                @endif
            </div>

        </main>
    </body>


    {{-- Javascript data assignation --}}
    @if (isset($produit))

        <script>
            const product_list = {{ Js::from($produit) }};
            console.log(product_list);
        </script>
        <script src="{{ asset('Js/purchase.js') }}"></script>

    @endif

@endsection
