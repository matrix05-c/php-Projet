@php
    $PK = 'numEntr';
    $page = 'maintenance';
    $list = '';
    $translate = [
        'numEntr' => 'N',
        'numServ' => 'N service',
        'numVoiture' => 'N vehicule',
        'nomClient' => 'Nom',
        'created_at' => 'Date',
    ];
    $has_bill = true;
@endphp

@extends('layouts.layout')

@section('title', 'Maintenance')

@section('content')

@section('content')
    <body  >
        <main class="container-fluid">
            <div class="my-3 row">
                <h3 class="col-4 col-lg-2 text-warning">Entretien :</h3>
                <dic class="col"></dic>
                <form action="{{ route('serachEntretien') }}" method="post" class="d-flex col-6 col-lg-4 btn-group">
                    @csrf
                    <input type="search" name="search" class="form-control" placeholder="Entrer votre nom">
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


            <form action="{{ route('addMaintenance') }}" method="post" class="container" style="margin-top: 40px">
                @csrf
                <div class="row my-2">
                    <div class="col-4 col-lg-2">
                        <label class="h4 text-white" for="service-type-input" class="form-label">Service</label>
                    </div>
                    <div class="col">
                        <select name="service" id="service-type-input" class="form-select">
                            @if (isset($service))
                                @foreach ($service as $serv)
                                    <option value="{{ $serv->numServ }}">{{ $serv->service }}</option>
                                @endforeach
                            @endif
                        </select>
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
                    <div class="col">
                        <input type="text" name="vehNum" id="purchase-customer-name" class="form-control"
                            placeholder="Register number" required>
                    </div>
                </div>

                <div class="row my-2 justify-content-end">
                    <div class="col-4 col-lg-2">
                        <p class="h3 text-white">Data</p>
                    </div>
                    <div class="col">
                        <p class="fs-3 text-white"> Cost: <span id="service-cost" class="numeric-value fw-bold">0</span> Ar</p>
                    </div>
                    <div class="col-2 d-flex justify-content-end align-items-start">
                        <input type="submit" value="Save" class="btn btn-lg btn-primary">
                    </div>
                </div>

            </form>

            <div class="d-flex justify-content-between">
                <h3 class="text-warning">List :</h3>
                <form action="{{ route("filterMaintenances") }}" method="post" class="btn-group">
                    @csrf
                    <input type="button" value="from" class="form-control btn">
                    <input type="date" name="begin" class="form-control">
                    <input type="button" value="to" class="form-control btn">
                    <input type="date" name="end" class="form-control">
                    <input type="submit" value="Filter" class="btn btn-secondary">
                </form>
            </div>

            <div class="container">
                @if (isset($entretien))

                    @include('partials.table', ['models' => $entretien])
                @endif
            </div>

        </main>
    </body>


    {{-- Javascript data assignation --}}
    @if (isset($service))

        <script>
            const service_list = {{ Js::from($service) }};
            console.log(document.getElementById("service-type-input").value);
        </script>
        <script src="{{ asset('Js/maintenace.js') }}"></script>
    @endif
@endsection
