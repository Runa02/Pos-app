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
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        @foreach($produkfront as $product)
        <div class="col mb-5">
            <div class="card">
                <!-- Product image-->
                <img class="card-img-top" width="500" height="150" src="{{ $product->photo }}" alt="..." />
                <!-- Product details-->
                <div class="card-body p-4">
                    <div>
                        <!-- Product name-->
                        <h5 class="fw-bolder">{{ $product->nama_produk }}</h5>
                        <!-- Product price-->
                        Rp. {{ $product->harga_jual }}
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent d-flex justify-content-between">
                    <form action="{{ route('send-accpenjualan', $product->id_produk) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-warning">Checkout</button>
                    </form>
                    <div>
                        <a class="btn btn-outline-dark mt-auto" href="{{ route('cart.add', ['id' => $product->id]) }}"><i class="bi-cart-fill"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection