@php
    $PK = 'numEntree';
    $page = 'list';
    $list = 'maintenances';
@endphp

@extends('layouts.layout')

@section('title', 'modifie Entree')
@section('content')

    <body  >

        <main class="container-fluid">
            <h3 class="mt-5 text text-warning ms-5">Modifie entree</h3>

            <form action="{{ route('editEntry') }}" method="post" class="container ">
                @csrf
                <div class="card card-body mt-5">
                    <div class="row my-2">
                        <div class="col-4 col-lg-2">
                            <input type="hidden" value="{{ $numEntree }}" name="numeroEntree">
                            <label class="h4 text text-warning" for="product-type-input" class="form-label">Product :</label>
                        </div>
                        <div class="col">
                            <select name="product" id="product-type-input" class="form-select" required>
                                @if (isset($produite))
                                    @foreach ($produite as $prod)
                                        <option value="{{  $prod->numProd }}">{{ $prod->design }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col">
                            <input type="number" name="quantity" id="product-purchase-quatity" min="0" class="form-control"
                                placeholder="Quantity" value="{{ $entrees[0]->stockEntree }}" required>
                        </div>
                    </div>

                    <div class="row my-8 justify-content-end">
                        <div class="col-2 d-flex justify-content-end align-items-start w-25">
                            <input type="submit" value="modifie" class="btn btn-lg btn-primary w-100">
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </body>
@endsection
