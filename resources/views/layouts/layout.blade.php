<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    <script src="{{ asset('node_modules/fastbootstrap/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('node_modules/fastbootstrap/dist/css/fastbootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>
    @if (isset($productINferieurDix) && ($productINferieurDix->count() > 0))
        <div role="alert" aria-live="assertive" aria-atomic="true"
            class="toast show bg-danger text-light m-5 top-0 end-0 position-fixed" style="z-index: 10000">
            <div class="toast-header">
                <strong class="me-auto">Alert</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                un des produits est inferieur a 10 Litre
            </div>
        </div>
    @endif

    <nav class="navbar navbar-expand-lg mb-3">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarExample"
                aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand" href="{{ route('index') }}"><img
                    src="{{ asset('resource/icon/icons8-gas-station-64.png')}}" width="36" /></a>

            <div class="collapse navbar-collapse" id="navbarExample">
                <ul class="navbar-nav me-auto mb-0">

                    <li class="nav-item"><a @class(['nav-link', 'active' => $page == 'home']) aria-current="page"
                            href="{{ route('index') }}">Home</a></li>
                    <li class="nav-item"><a @class(['nav-link', 'active' => $page == 'purchase']) aria-current="page"
                            href="{{ route('purchase') }}">Achat</a></li>
                    <li class="nav-item"><a @class(['nav-link', 'active' => $page == 'maintenance']) aria-current="page"
                            href="{{ Route('maintenance')}}">Entretien</a></li>

                    <li class="nav-item dropdown">
                        <a @class(['nav-link', 'dropdown-toggle', 'active' => $page == 'list']) href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Lists</a>
                        <ul class="dropdown-menu">
                            <li><a @class(['dropdown-item', 'active' => $list == 'products'])
                                    href="{{ Route('list_products') }}">Products</a></li>
                            <li><a @class(['dropdown-item', 'active' => $list == 'services'])
                                    href="{{ Route('list_services') }}">Services</a></li>
                            <li><a @class(['dropdown-item', 'active' => $list == 'maintenances'])
                                    href="{{ Route('Entree') }}">Entree</a></li>
                        </ul>

                    </li>

                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

</body>

</html>
