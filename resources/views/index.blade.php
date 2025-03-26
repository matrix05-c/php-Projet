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

                                <h3>Income :</h3>
                                <p class="text-center h3"><span class="numeric-value">{{ $recetteTotal }}
                                    </span> Ar</p>

                                <h3>Client:</h3>
                                <p class="numeric-value text-center h3">0</p>

                            </div>
                        </div>
                    </div>

                    <div>

                    </div>
                </div>

            </div>

        </main>
    </body>
@endsection
