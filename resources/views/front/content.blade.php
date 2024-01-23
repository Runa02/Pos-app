@extends('layouts.index')

@section('content')
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Merchandise</h1>
            <p class="lead fw-normal text-white-50 mb-0">Deskripsi Toko</p>
        </div>
    </div>
</header>
<div class="container px-4 px-lg-5 mt-5">
    <form action="{{ route('front.index') }}" method="GET">
        <div class="row g-2">
            <div class="col-4">
                <label for="min_price">Min Price:</label>
                <input type="number" class="form-control" name="min_price" id="min_price" value="{{ $minPrice }}">
            </div>
            <div class="col-4">
                <label for="max_price">Max Price:</label>
                <input type="number" class="form-control" name="max_price" id="max_price" value="{{ $maxPrice }}">
            </div>
            <div class="col-4 pt-4">
                <button class="btn btn-primary" type="submit">Filter</button>
            </div>
        </form>
    </div>
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center mt-5">
        @foreach($produkfront as $product)
        <div class="col mb-5">
            <div class="card position-relative">
                <a href="{{ route('wishlist.add', ['id' => $product->id]) }}" class="position-absolute top-0 end-0 p-3 text-danger love-icon"><i class="bi-heart"></i></a>
                <a style="text-decoration: none" href="{{ route('produk.detail', ['id' => $product->id]) }}">
                    <img class="card-img-top" width="500" height="150" src="{{ $product->photo }}" alt="..." />
                    <div class="card-body p-4">
                        <div style="color: black">
                            <h5 class="fw-bolder">{{ $product->nama_produk }}</h5>
                            Rp. {{ $product->harga_jual }}
                        </div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent d-flex justify-content-between">
                        <div class="flex-grow-1 me-3">
                            <a class="btn btn-outline-warning mt-auto w-100" href="#">Checkout</a>
                        </div>
                        <div>
                            <a class="btn btn-outline-primary mt-auto" href="{{ route('cart.add', ['id' => $product->id]) }}"><i class="bi-cart-fill"></i></a>
                        </div>
                    </div>                                                        
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection