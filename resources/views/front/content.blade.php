@extends('layouts.index')

@section('content')
<header style="background-color: #F3B95F" class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Merchandise</h1>
            <p class="lead fw-normal text-dark mb-0">Cari berbagai merchandise murah meriah dan berkualitas sekarang</p>
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
                            <a class="btn btn-outline-warning mt-auto w-100 checkout-btn" data-bs-toggle="modal"
    data-bs-target="#checkoutModal-{{ $product->id }}" data-product-id="{{ $product->id }}">Checkout</a>
                        </div>
                        <div>
                            <a class="btn btn-outline-primary mt-auto" href="{{ route('cart.add', ['id' => $product->id]) }}"><i class="bi-cart-fill"></i></a>
                        </div>
                    </div>                                                        
                </a>
            </div>
        </div>

        <div id="checkoutModal-{{ $product->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="checkoutModalLabel-{{ $product->id }}" aria-hidden="true"> aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkoutModalLabel">Form Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('send-accpenjualan', ['id' => $product->id]) }}" method="post"
                            class="mb-4 checkout-form" data-product-id="{{ $product->id }}">
                            @csrf
                            <div class="form-group row mb-3">
                                <label for="jumlah" class="col-lg-2 col-lg-offset-1 control-label">Jumlah</label>
                                <div class="col-lg-12">
                                    <input type="number" name="jumlah" id="jumlah" class="form-control" required
                                        value="0">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pesan" class="col-lg-2 col-lg-offset-1 control-label">Pesan</label>
                                <div class="col-lg-12">
                                    <textarea type="text" name="pesan" id="pesan" class="form-control"
                                        required></textarea>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Checkout</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script>
    $(document).ready(function () {
        $('.checkout-btn').click(function (e) {
            e.preventDefault();
            var productId = $(this).data('product-id');
            $('#checkoutModal-' + productId).modal('show');
        });
    });
</script>

@endsection