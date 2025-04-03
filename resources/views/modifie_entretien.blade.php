@php
    $PK = 'numEntr';
    $page = '';
    $list = '';
@endphp

@extends('layouts.layout')

@section('title', 'Modifie_entretien')

@section('content')
    <body>

        <main class="container-fluid">

            <h3 class="mt-5 text-warning">Modifie Entretien</h3>

            <form action="{{ route('editMaintenance') }}" method="post" class="container">
                @csrf
                <div class="card card-body">
                    <div class="row my-2">
                        <div class="col-4 col-lg-2">
                            <label class="h4" for="service-type-input" class="form-label">Service</label>
                        </div>
                        <div class="col">
                            <input type="hidden" name="num_entretien" value="{{ $entretien->numEntr }}">
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
                            <label class="h4" for="purchase-customer-name" class="form-label">Customer</label>
                        </div>
                        <div class="col">
                            <input type="text" value="{{  $entretien->nomClient }}" name="name" id="purchase-customer-name"
                                class="form-control" placeholder="Name" required>
                        </div>
                        <div class="col">
                            <input type="text" value="{{  $entretien->numVoiture }}" name="vehNum"
                                id="purchase-customer-name" class="form-control" placeholder="Register number" required>
                        </div>
                    </div>

                    <div class="row my-2 justify-content-end">
                        <div class="col-4 col-lg-2">
                            <p class="h3">Data</p>
                        </div>
                        <div class="col">
                            <p class="fs-3"> Cost: <span id="service-cost" class="numeric-value fw-bold">0</span> Ar</p>
                        </div>
                        <div class="col-2 d-flex justify-content-end align-items-start">
                            <input type="submit" value="Save" class="btn btn-lg btn-primary">
                        </div>
                    </div>
                </div>

            </form>

        </main>
    </body>


    {{-- Javascript data assignation --}}
    @if (isset($service))

        <script>
            const service_list = {{ Js::from($service) }};
            console.log(document.getElementById("service-type-input").value);
            console.log(service_list);
        </script>
        <script src="{{ asset('Js/maintenace.js') }}"></script>
    @endif

@endsection
