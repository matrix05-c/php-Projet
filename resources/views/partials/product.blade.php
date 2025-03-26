<h3 class="text text-warning">Products</h3>

<div class="d-flex flex-row flex-wrap gap-7 m-5">

    @if (isset($products) && count($products))
        @foreach ($products as $prod)
            <button class="card flex-grow-1">
                <div class="card-body d-flex gap-3">
                    <div class="card-text font-monospace display-3"><span class="numeric-value">{{ $prod->stock }}</span>l</div>
                    <div>
                        <h5 class="card-title"> {{ $prod->design }} </h5>
                        <p class="card-text text-secondary"><span class="numeric-value">{{ $prod->prixProduit }}</span> Ar</p>
                    </div>
                </div>
            </button>
        @endforeach
    @else
        <h1 class="text-secondary m-auto ">No products</h1>
    @endif

</div>
