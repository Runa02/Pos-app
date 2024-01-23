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
                <img class="card-img-top" width="500" height="150" src="{{ $product->photo }}" alt="..." />
                <div class="card-body p-4">
                    <div>
                        <h5 class="fw-bolder">{{ $product->nama_produk }}</h5>
                        Rp. {{ $product->harga_jual }}
                    </div>
                </div>
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent d-flex justify-content-between">
                    <div>
                        <a type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#checkoutModal-{{ $product->id }}">Checkout</a>
                    </div>
                    <div>
                        <a class="btn btn-outline-dark mt-auto"
                            href="{{ route('cart.add', ['id' => $product->id]) }}"><i class="bi-cart-fill"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Checkout Modal -->
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
                            class="mb-4">
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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $('#checkoutForm').submit(function (e) {
            e.preventDefault();

            $('#checkoutModal-{{ $product->id }}').modal('show');
        });

    });
</script>


@endsection
