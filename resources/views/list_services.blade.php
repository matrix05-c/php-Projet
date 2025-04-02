@php
    $PK = 'numServ';
    $page = 'list';
    $list = 'services';
    $translate = [
        'numServ' => 'N',
        'service' => 'Service',
        'prix' => 'Cost'
    ];

    $has_bill = false;
@endphp

@extends('layouts.layout')
@section('title', 'Purchase')

@section('content')
    <div class="container">
        <div class="my-3 row">
            <button class="btn btn-outline-primary col-4 col-lg-2" data-bs-toggle="modal" data-bs-target="#service-modal">
                New service
            </button>
            <dic class="col"></dic>
            <form action="" method="GET" class="d-flex col-6 col-lg-4">
                <input type="search" name="search" class="form-control">
                <input type="submit" value="Search" class="btn btn-secondary">
            </form>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif



        @if (isset($new_services))
            @include('partials.table', ['models' => $new_services, 'PK' => 'numServ'])
        @else
            @include('partials.table')
        @endif


    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="service-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <div class="modal-content rounded-4 shadow" style="margin-top: 25%">

                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h1 class="fw-bold mb-0 fs-2">Create service</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-5 pt-0">
                    <form action="{{ route('addServices') }}" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" name="service_name" id="design-input"
                                placeholder="service name">
                            <label for="design-input">service </label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control rounded-3" id="cost-input" name="service_price" min="0"
                                step="100" placeholder="service price">
                            <label for="cost-input">Price </label>
                        </div>
                        <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Save</button>
                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection
