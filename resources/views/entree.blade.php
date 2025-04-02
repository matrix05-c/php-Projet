@php
    $PK = 'numEntree';
    $page = 'list';
    $list = 'maintenances';
    $translate = [
        'numEntree' => 'N',
        'stockEntree' => 'Quantite',
        'numProd' => 'N produit',
        'created_at' => 'Date',
    ]; 

    $has_bill = false;
@endphp

@extends('layouts.layout')

@section('title', 'Purchase')
@section('content')
    <body  >
        <main class="container-fluid">
            <h3 class="mt-5 text-warning">Entree </h3>

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

            <form action="{{ route('AddEntree') }}" method="post" class="container">
                @csrf
                <div class="row my-2">
                    <div class="col-4 col-lg-2">
                        <label class="h4 text-warning" for="product-type-input" class="form-label">Product :</label>
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

                <div class="row my-8 justify-content-end">
                    <div class="col-2 d-flex justify-content-end align-items-start w-25">
                        <input type="submit" value="Save" class="btn btn-lg btn-primary w-100">
                    </div>
                </div>

            </form>

            <h3 class="mt-5 text-warning">List : </h3>

            <div class="container">
                @if (isset($entre))
                    @foreach ($entre as $achate)

                    @endforeach
                    @include('partials.table', ['models' => $entre])
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
                console.log(product_list[0].stock);
            </script>
            <script src="{{ asset('Js/purchase.js') }}"></script>

        @endif
@endsection
