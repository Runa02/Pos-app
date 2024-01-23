@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <img class="img-thumbnail" width="500" height="50" src="{{ $detail->photo }}" alt="Product Image"> <!-- Menggunakan data produk untuk menampilkan gambar -->
        </div>
        <div class="col-6">
            <h2>{{ $detail->nama_produk }}</h2> <!-- Menampilkan nama produk -->
            <p>{{ $detail->desc }}</p> <!-- Menampilkan deskripsi produk -->
            <div class="button mt-5">
                <a href="#" type="button" class="btn btn-primary"><i class="bi-bag-check"></i> Checkout</a>
                <a href="{{ route('cart.add', ['id' => $detail->id]) }}" type="button" class="btn btn-success"><i class="bi-cart"></i> Keranjang</a>
                <button type="button" class="btn btn-outline-danger"><i class="bi-heart"></i> Suka</button>
            </div>
        </div>
    </div>
</div>
@endsection