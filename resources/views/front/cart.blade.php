@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h5>Keranjang</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama Produk</th>
                                <th>Harga Jual</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                          @forelse($cartItems as $cartItem)
                          <tr>
                              <td><img class="img-thumbnail" width="150" height="150" src="{{ $cartItem->produk->photo }}" /></td>
                              <td>{{ $cartItem->produk->nama_produk }}</td>
                              <td>Rp. {{ $cartItem->produk->harga_jual }}</td>
                              <td>
                                  <div class="row g-0">
                                      <div class="col-6">
                                          <form method="post" class="mb-2">
                                              @csrf
                                              @method('put')
                                              <input type="number" style="width: 100px;" name="stok" value="{{ $cartItem->stok }}" min="1" class="form-control">
                                          </form>
                                      </div>
                                      <div class="col-3">
                                          <form method="post" action="{{ route('cart.destroy', $cartItem->id) }}" id="deleteForm{{ $cartItem->id }}">
                                              @csrf
                                              @method('delete')
                                              <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $cartItem->id }})"><i class="bi-trash"></i></button>
                                          </form>
                                      </div>
                                      <div class="col-3">
                                          <form method="post">
                                              <button type="submit" class="btn btn-primary"><i class="bi-check"></i></button>
                                          </form>
                                      </div>
                                  </div>
                              </td>
                          </tr>
                          @empty
                              <tr>
                                  <td colspan="4">Keranjang kosong.</td>
                              </tr>
                          @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5>Detail Informasi</h5>
                    @php
                        $totalBayar = 0;
                    @endphp
                    @foreach($cartItems as $cartItem)
                        @php
                            $totalBayar += $cartItem->produk->harga_jual * $cartItem->stok;
                        @endphp
                    @endforeach
                    <p class="total-harga"><strong>Total Bayar: </strong>{{ $totalBayar }}</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(cartItemId) {
        var result = confirm('Apakah Anda yakin ingin menghapus produk dari keranjang?');

        if (result) {
            document.getElementById('deleteForm' + cartItemId).submit();
        }
    }
</script>
@endsection
