@php
    $page = 'home';
    $list = '';
@endphp

@extends('layouts.layout')
@section('title', 'home')

@section('content')

    @if (isset($recetteParMois))
        <script>
            const recetteParMois = {{ Js::from($recetteParMois) }};
        </script>
        <script src="{{ asset('node_modules/highcharts/highcharts.js') }}"></script>
        <script src="{{ asset('Js/script.js') }}"></script>
    @endif

    <body>
        <main class="container-fluid">

            @include('partials.product')

            <h3 class="text-warning">Income</h3>

            <div class="d-flex gap-12 m-5">

                <div id="income-graph" class="flex-grow-1 h-25">

                </div>

                <div class="grid w-25">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-text">

                                <h3 class="text text-warning">Income :</h3>
                                <p class="text-center h3"><span class="numeric-value">{{ $recetteTotal }}
                                    </span> Ar</p>
                            </div>
                        </div>
                    </div>

                    <div>

                    </div>
                </div>

            </div>
            <h3 class="text text-warning">Liste des client le plus participatif: </3>
                <div class="container">
                    @if (isset($top5Clients))
                        <table class="table table-striped-columns mt-5">
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <th>Nombre d'interaction</th>
                                    <th>Nom</th>
                                </tr>
                            </thead>
                            @foreach ($top5Clients as $top)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $top->totalInteraction }}</td>
                                    <td>{{ $top->nomClient }}</td>
                                </tr>

                            @endforeach
                        </table>

                    @endif
                </div>

        </main>
    </body>
@endsection