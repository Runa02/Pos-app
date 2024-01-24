@extends('layouts.index')

@section('content')
    <div class="container px-4 px-lg-5 mb-3">
        <h3>Wishlist</h3>
    </div>
    <div class="container">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach($wishlistItem as $items)
            <div class="col mb-5">
                <div class="card">
                    <!-- Product image-->
                    <a style="text-decoration: none" href="{{ route('produk.detail', ['id' => $items->produk->id]) }}">
                        <img class="card-img-top" width="500" height="150" src="{{ $items->produk->photo }}" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div style="color: black">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{ $items->produk->nama_produk }}</h5>
                                <!-- Product price-->
                                Rp. {{ $items->produk->harga_jual }}
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="d-grid gap-2">
                                <a class="btn btn-outline-primary mt-auto" href="{{ route('cart.add', ['id' => $items->produk->id]) }}">Keranjang</i></a>
                            </div>
                            <div class="d-grid gap-2 mt-2">
                                <form method="post" action="{{ route('wishlist.destroy', $items->id) }}" id="deleteForm{{ $items->id }}">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-outline-danger w-100" onclick="confirmDelete({{ $items->id }})"><i class="bi-trash"></i> Delete</button>
                                </form>
                            </div>
                        </div>                                                        
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script>
        function confirmDelete(itemsId) {
            var result = confirm('Apakah Anda yakin ingin menghapus produk dari keranjang?');
    
            if (result) {
                document.getElementById('deleteForm' + itemsId).submit();
            }
        }
    </script>
@endsection